# Tafseela

Laravel 11 e-commerce with nwidart/laravel-modules.

## Structure

- `tafseela-laravel/` — Main application
- Docker files (Dockerfile, docker-compose.yml, nginx.conf) at **repo root**, not inside laravel dir.
- `tafseela-frontend/` — Design reference / static landing pages (not the app)

**Modules** (10, all enabled): Admin, Cart, Core, Customer, Delivery, Identity, Order, Payment, Product, Support

## Dev Commands

Run from `tafseela-laravel/`:

```bash
composer run dev          # PHP server + queue (--tries=1) + pail logs + Vite (concurrently)
php artisan serve         # PHP server only
npm run build             # Build frontend (Vite)
npm run dev               # Vite dev server

# Module migrations (these exist alongside root migrations)
php artisan module:migrate       # Migrate all modules
php artisan module:migrate -m Order  # Migrate a specific module
php artisan module:seed          # Seed all modules

# Tests — root tests auto-discovered; module tests are NOT in phpunit.xml
php artisan test                          # tests/Unit + tests/Feature only
./vendor/bin/phpunit Modules/Order/tests  # Run a module's tests directly
./vendor/bin/phpunit --filter=OrderApiTest

# Code style
./vendor/bin/pint         # Fixes (no pint.json — uses Laravel defaults)
./vendor/bin/pint --test  # Check only

# Clear caches
php artisan view:clear && php artisan cache:clear && php artisan route:clear
```

## Docker

From repo root: `docker compose up -d`

| Service | Internal | Host Port |
|---------|----------|-----------|
| Nginx | :80 | :8090 |
| MySQL 8.4 | :3306 | :3307 |
| Mailpit UI | :8025 | :8025 |
| Mailpit SMTP | :1025 | :1025 |

Composer/npm/artisan run inside the container: `docker compose exec app <command>`

## Namespace Convention (CRITICAL)

Composer autoload maps `Modules\{Module}\` directly to `Modules/{Module}/app/`.

```php
// CORRECT:
namespace Modules\Identity\Http\Controllers;
namespace Modules\Identity\Models;

// WRONG (no app/ segment):
namespace Modules\Identity\app\Http\Controllers;
```

## Module Architecture

```
Modules/{Module}/
├── app/
│   ├── Http/Controllers/
│   ├── Models/
│   ├── Providers/    {Module}ServiceProvider, RouteServiceProvider, EventServiceProvider
│   └── Services/
├── routes/           web.php, api.php
├── database/
│   ├── migrations/
│   ├── factories/
│   └── seeders/
├── resources/views/
└── tests/            NOT auto-discovered — run directly via phpunit path
```

Blade components: Identity and Customer modules use explicit `Blade::component()` in their ServiceProvider; the other 8 use `Blade::componentNamespace()` auto-discovery (via generated `registerViews()`).

API routes follow pattern `/api/v1/{resource}` (e.g., `/api/v1/orders`) with `auth:sanctum` middleware. Customer module has NO api.php — storefront is web-only.

## Key Packages

- `laravel/sanctum` — API tokens
- `laravel/socialite` — Google & Facebook OAuth (credentials in `.env`)
- `spatie/laravel-permission` — RBAC
- `spatie/laravel-activitylog` — Activity logging
- `lorisleiva/laravel-actions` — Action classes for business logic
- `nwidart/laravel-modules` — Module system (v12)

## Defaults & Environment Quirks

- **Locale**: Config defaults `ar`/`ar`/`ar_EG` (actual `.env` matches). `.env.example` has `en/en/en_US`.
- **DB**: MySQL (`.env`). Queue, cache, session all use `database` driver (MySQL tables).
- **Session**: `SESSION_DRIVER=database` (not file/cookie)
- **App URL**: `http://localhost`
- **pnpm-workspace.yaml** present but `composer run dev` uses `npm run dev`. `pnpm-workspace.yaml` blocks esbuild builds.
- **No CI** workflows exist (no `.github/` directory).

## Testing Notes

- `phpunit.xml` disables `DB_CONNECTION=sqlite` (commented out) — tests hit MySQL by default
- Test env: `QUEUE_CONNECTION=sync`, `CACHE_STORE=array`, `SESSION_DRIVER=array`, `MAIL_MAILER=array`
- Module tests (`Modules/{Module}/tests/`) extend `Tests\TestCase` but need explicit phpunit path to run
- **Only Cart and Order modules have tests** (one Feature test each)
- Identity module applies rate limiting (5/min) on login, register, OTP, change-password routes
- Cross-module imports in tests are normal (e.g., Cart test imports `Modules\Identity\Models\User`)

## Frontend Stack

- Tailwind CSS 3, Vite 6 (`laravel-vite-plugin`), PostCSS
- Font Awesome Free (`@fortawesome/fontawesome-free`)
- Design system: `DESIGN.md` (Mediterranean Luxury theme)

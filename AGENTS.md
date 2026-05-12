# Tafseela

Laravel 11 e-commerce with nwidart/laravel-modules.

## Structure

- `tafseela-laravel/` — Main application
- Docker files (Dockerfile, docker-compose.yml, nginx.conf) are at the **repo root**, not inside laravel dir.

**Modules**: Admin, Cart, Core, Customer, Delivery, Identity, Order, Payment, Product, Support

## Dev Commands

Run from `tafseela-laravel/`:

```bash
composer run dev          # PHP server + queue + logs + Vite (concurrently)
php artisan serve         # Run just the PHP server
npm run dev               # Run just Vite dev server
npm run build             # Build frontend assets

# Tests
php artisan test          # Run all tests
./vendor/bin/phpunit --filter=TestClassName    # Run single test class
./vendor/bin/phpunit --filter=test_method_name # Run single test method

# Code style
./vendor/bin/pint         # Laravel Pint (fixes style issues)
./vendor/bin/pint --test  # Check without fixing

# Database
php artisan migrate       # Run migrations
php artisan db:seed       # Seed database
```

Clear caches: `php artisan view:clear && php artisan cache:clear && php artisan route:clear`

## Docker

Run from repo root (where docker-compose.yml lives): `docker compose up -d`

Ports: Nginx :8090, MySQL :3307, Mailpit :8025 (web UI), SMTP :1025

## Namespace Convention (CRITICAL)

Composer autoload maps `Modules\{Module}\` directly to `Modules/{Module}/app/`.

```php
// CORRECT:
namespace Modules\Identity\Http\Controllers;
namespace Modules\Identity\Models;

// WRONG (don't include app/ segment):
namespace Modules\Identity\app\Http\Controllers;
```

## Module Architecture

- Routes: `Modules/{Module}/routes/web.php` (web) and `Modules/{Module}/routes/api.php` (API)
- RouteServiceProvider loads routes from each module
- Controllers: `Modules/{Module}/app/Http/Controllers/`
- Models: `Modules/{Module}/app/Models/`
- Services: `Modules/{Module}/app/Services/`
- Migrations: `Modules/{Module}/database/migrations/`

Blade components registered in ServiceProvider `registerViews()`:
```php
Blade::component('identity::components.auth-input', 'auth-input');
```
Use as `<x-auth-input>`

## Key Packages

- `laravel/sanctum` — API authentication
- `laravel/socialite` — Social login (Google, Facebook configured)
- `spatie/laravel-permission` — RBAC
- `spatie/laravel-activitylog` — Activity logging
- `lorisleiva/laravel-actions` — Action classes for business logic
- `nwidart/laravel-modules` — Modular structure

## Defaults

- Default locale: `ar` (Arabic), fallback `ar`, Faker locale `ar_EG`
- DB: MySQL (connection via database queue and cache store by default)
- Session/Queue/Cache drivers: `database`
- App URL: `http://localhost`

## Git

Commits: `type(module): description`  
Types: feat, fix, refactor, docs, chore, test  
Branches: `feat/{module}/feature-name`
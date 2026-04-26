# Tafseela

Laravel 11 e-commerce + nwidart/laravel-modules.

## Structure

- `tafseela-laravel/` — Main application (Laravel 11 + nwidart/laravel-modules)
- `tafseela-frontend/` — Static client mockups

**Modules** (`Modules/{Module}/app/`): Admin, Cart, Core, Customer, Delivery, Identity, Order, Payment, Product, Support

## Commands

Run from `tafseela-laravel/`:

```bash
# Dev
composer run dev

# Tests
./vendor/bin/phpunit

# Code style (Laravel Pint)
./vendor/bin/pint

# Clear caches
php artisan view:clear && php artisan cache:clear && php artisan route:clear
```

## Docker

```bash
docker compose up -d
```

Ports: Nginx :8090, MySQL :3307, Mailpit :8025

## Namespace Convention (CRITICAL)

Module autoload maps `Modules\{Module}\` to `Modules/{Module}/app/`. Check `composer.json` autoload config.

```php
// Correct namespaces per composer.json:
namespace Modules\Identity\Http\Controllers;
namespace Modules\Identity\Http\Requests;
namespace Modules\Identity\Services;
namespace Modules\Identity\Models;
```

NOT `Modules\Identity\app\Http\Controllers` - the autoload does NOT include `app/` segment.

## Blade Components

Register anonymous components in ServiceProvider:

```php
// In IdentityServiceProvider::registerViews():
Blade::component('identity::components.auth-input', 'auth-input');
Blade::component('identity::layouts.auth', 'layouts.auth');
```

Use short alias: `<x-auth-input>`, `<x-auth-card>`, `<x-auth-layout>`

## Routes

Module routes at `Modules/{Module}/routes/web.php` — imported via `RouteServiceProvider`.

## Git

Conventional: `type(module): description`

Types: feat, fix, refactor, docs, chore, test  
Branches: `feat/{module}/feature-name`
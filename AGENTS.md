# Tafseela

E-commerce platform: Laravel 11 backend + frontend mockups (static HTML).

## Structure

- `tafseela-laravel/` — Main application
- `tafseela-frontend/` — Static client mockups only (no build)

**Backend uses `nwidart/laravel-modules`:** Modules/{ModuleName}/
- Admin, Cart, Core, Customer, Delivery, Identity, Order, Payment, Product, Support
- Core module = shared utilities, middlewares, base resources

## Commands

Run from `tafseela-laravel/`:

```bash
# All services + dev server
composer run dev

# Tests
./vendor/bin/phpunit
./vendor/bin/phpunit --testsuite=Unit
./vendor/bin/phpunit --testsuite=Feature

# Code style fix
./vendor/bin/pint
```

## Docker

```bash
docker compose up -d
```

Services: Nginx localhost:8090, MySQL localhost:3307, Mailpit localhost:8025

## Testing

- MySQL required (no SQLite)
- DB commented in phpunit.xml. Uses `.env` database
- Run migrations before tests: `php artisan migrate`

## Git

Conventional commits:

```
type(module): description
```

Types: `feat`, `fix`, `refactor`, `docs`, `chore`, `test`
Bracket branch names: `feat/{module}/feature-name`
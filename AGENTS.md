# Repository Guidelines

This document provides essential guidelines for contributing to the Tafseela project.

## Project Structure

Tafseela is a monorepo with two main components:

- `tafseela-laravel/` — Laravel 11 backend (main application)
- `tafseela-frontend/` — Frontend directories (admin/client placeholders)

### Modular Architecture

The backend uses `nwidart/laravel-modules` for a modular structure. Each module follows this pattern:

```
Modules/{ModuleName}/
├── app/
│   ├── Http/
│   └── Providers/
├── database/
│   ├── migrations/
│   ├── factories/
│   └── seeders/
├── routes/
└── Resources/
```

**Existing modules:** Admin, Cart, Core, Delivery, Identity, Order, Payment, Product, Support

**Core module** contains shared utilities, middlewares, and base resources used across all modules.

## Development Environment

### Docker Stack

Start all services via Docker Compose:

```bash
docker compose up -d
```

Services exposed at:
- **Nginx:** http://localhost:8090
- **MySQL:** localhost:3307
- **Mailpit:** http://localhost:8025

### Laravel Development Command

Runs all services concurrently:

```bash
composer run dev
```

This starts: PHP server, queue worker, log viewer, and Vite.

## Coding Standards

### Style Configuration

- **Indentation:** 4 spaces
- **Line endings:** LF
- **Encoding:** UTF-8

### Code Formatting

Use Laravel Pint to auto-fix styling:

```bash
./vendor/bin/pint
```

Run before committing to ensure consistent code style.

## Testing

**Framework:** PHPUnit 11

Run all tests:

```bash
./vendor/bin/phpunit
```

Run specific suites:

```bash
./vendor/bin/phpunit --testsuite=Unit
./vendor/bin/phpunit --testsuite=Feature
```

Test files live in `tafseela-laravel/tests/`:
- `tests/Unit/` — Unit tests
- `tests/Feature/` — Feature/integration tests

## Git Conventions

### Commit Message Format

Follow **Conventional Commits**:

```
type(scope): description
```

**Examples:**
```
feat(identity): add OTP verification support
refactor(cart): simplify quantity update logic
fix(order): resolve double-charging issue
docs: update API documentation
```

**Types:** `feat`, `fix`, `refactor`, `docs`, `chore`, `test`

**Scope:** Use the module name (e.g., `identity`, `cart`, `core`) or omit for cross-cutting changes.

### Branch Naming

```
feat/{module}/feature-name
fix/{module}/issue-description
```

### Pull Requests

- Link related issues in the PR description
- Ensure all tests pass before requesting review
- Run `./vendor/bin/pint` before submitting

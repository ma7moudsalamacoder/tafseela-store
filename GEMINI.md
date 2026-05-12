# Tafseela - Modular E-commerce Platform

Tafseela is a comprehensive, modular e-commerce solution built with Laravel 11, designed for scalability and maintainability.

## Project Overview

- **Architecture**: Modular Monolith using `nwidart/laravel-modules`.
- **Backend**: Laravel 11.x (PHP 8.3)
- **Frontend**: Tailwind CSS, Vite (integrated).
- **Infrastructure**: Dockerized environment (Nginx, MySQL 8.4, PHP-FPM 8.3, Mailpit).

## Core Modules

The application is divided into several functional modules located in `tafseela-laravel/Modules`:

- **Core**: Shared utilities, traits, macros, and base system logic.
- **Identity**: Authentication, user profiles, and role-based access control (RBAC) via `spatie/laravel-permission`.
- **Customer**: Customer-specific data and management.
- **Product**: Product catalog, inventory, and category management.
- **Cart**: Shopping cart persistence and logic.
- **Order**: Order management, history, and processing.
- **Payment**: Integration with payment gateways.
- **Delivery**: Shipping methods and tracking.
- **Admin**: Backend administration interface.
- **Support**: Customer service and support features.

## Tech Stack & Key Packages

- **Framework**: [Laravel 11](https://laravel.com/docs/11.x)
- **Modularity**: [nwidart/laravel-modules](https://nwidart.com/laravel-modules/v11/introduction)
- **Logic Encapsulation**: [lorisleiva/laravel-actions](https://laravelactions.com/)
- **Permissions**: [spatie/laravel-permission](https://spatie.be/docs/laravel-permission/v6/introduction)
- **Auditing**: [spatie/laravel-activitylog](https://spatie.be/docs/laravel-activitylog/v4/introduction)
- **Database**: MySQL 8.4
- **Environment**: Docker & Docker Compose

## Getting Started

### Prerequisites

- Docker & Docker Compose
- Node.js & NPM (optional, for local frontend dev)
- PHP 8.3 (optional, for local artisan commands)

### Installation

1. **Clone the repository** (if not already done).
2. **Setup Environment**:
   ```bash
   cp tafseela-laravel/.env.example tafseela-laravel/.env
   ```
3. **Build and Start Containers**:
   ```bash
   docker-compose up -d --build
   ```
4. **Install Dependencies**:
   ```bash
   docker-compose exec app composer install
   docker-compose exec app npm install
   ```
5. **Generate Application Key**:
   ```bash
   docker-compose exec app php artisan key:generate
   ```
6. **Run Migrations & Seeders**:
   ```bash
   docker-compose exec app php artisan migrate
   docker-compose exec app php artisan module:migrate
   docker-compose exec app php artisan module:seed
   ```

## Development Workflow

### Useful Commands

- **Artisan**: `docker-compose exec app php artisan [command]`
- **Composer**: `docker-compose exec app composer [command]`
- **NPM/Vite**: `docker-compose exec app npm run dev`
- **Running Tests**: `docker-compose exec app php artisan test`
- **Creating a New Module**: `docker-compose exec app php artisan module:make [ModuleName]`

### Coding Standards

- **Actions**: Use `Laravel Actions` for business logic to keep controllers thin and logic reusable.
- **Modularity**: New features should be placed within appropriate modules or in a new module if they represent a distinct domain.
- **Migrations**: Always use `module:migrate` for module-specific changes.
- **Styling**: Use Tailwind CSS classes; configuration is located in `tafseela-laravel/tailwind.config.js`.

## Design System

The project follows a **Modern Minimalism with a Mediterranean Luxury** aesthetic, as detailed in `DESIGN.md`.

- **Philosophy**: "White Space as Luxury" — generous margins and high-contrast typography.
- **Typography**: 
    - Headlines: **Almarai** (Modern Arabic).
    - Body/UI: **IBM Plex Sans Arabic**.
- **Colors**:
    - Primary: Gold/Camel (#A67C52) for CTAs.
    - Neutral: Charcoal (#1A1A1A) for text and high-contrast buttons.
    - Background: Warm White (#FDFCFB) and Neutral Beige (#F7F3F0).
- **Shapes**: Strictly linear with sharp corners (0px radius) for most components.
- **RTL Support**: Designed natively for Right-to-Left.

## Frontend Assets

The `tafseela-frontend` directory contains design references and static landing pages:
- `tafseela-frontend/client`: Arabic landing page variations.
- `tafseela-frontend/admin`: (Placeholder for admin-specific static assets).

Actual application frontend logic is managed within the `tafseela-laravel` module resources.

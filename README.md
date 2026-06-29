# Smart School

A school management platform built with **Laravel 13**, **Inertia.js v3**, and **Svelte 5**. It handles roles, courses, classes, assessments, grading, announcements, and more.

## Tech Stack

- **Backend:** PHP 8.3, Laravel 13
- **Frontend:** Svelte 5, Inertia.js v3
- **Styling:** Tailwind CSS v4
- **Database:** SQLite (default) / MySQL
- **Auth:** Session-based + Laravel Socialite (Google OAuth)
- **Testing:** PHPUnit 12

## Requirements

- PHP 8.3+
- Composer
- Node.js 20+ & npm
- SQLite (default) or a MySQL/PostgreSQL database

## Installation

### 1. Clone the repository

```bash
git clone <repository-url>
cd smart-school
```

### 2. One-command setup

```bash
composer run setup
```

This runs: `composer install` → copy `.env` → generate app key → run migrations → `npm install` → `npm run build`.

### 3. Manual setup (alternative)

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
npm install
npm run build
```

## Configuration

Edit `.env` to configure your environment. Key variables:

```env
APP_NAME="Smart School"
APP_URL=http://localhost

# Database (SQLite by default — no extra config needed)
DB_CONNECTION=sqlite

# Google OAuth (optional)
GOOGLE_CLIENT_ID=
GOOGLE_CLIENT_SECRET=
GOOGLE_REDIRECT_URI="${APP_URL}/auth/google/callback"
```

## Running the Application

### Development (all services in one command)

```bash
composer run dev
```

This starts concurrently:
- `php artisan serve` — Laravel dev server at `http://localhost:8000`
- `npm run dev` — Vite HMR frontend bundler
- `php artisan queue:listen` — Background job processor
- `php artisan pail` — Real-time log viewer

### Production build

```bash
npm run build
php artisan serve
```

## Testing

```bash
# Run all tests
composer run test

# Or directly via Artisan
php artisan test --compact

# Run a specific test file
php artisan test --compact tests/Feature/RoleTest.php

# Filter by test name
php artisan test --compact --filter=testName
```

## Key Features

- **Role management** — Create, assign, and manage user roles
- **Courses & Classes** — Organise subjects, class rooms, and periods
- **Assessments & Grading** — Questions, marking periods, grade tracking
- **Announcements & Posts** — School-wide and group-scoped content
- **Google OAuth** — Sign in with Google via Laravel Socialite
- **Invitations** — Invite teachers and students to the platform

## Project Structure

```
app/
├── Http/Controllers/   # Request handlers
├── Models/             # Eloquent models
resources/
├── js/
│   ├── Pages/          # Inertia/Svelte page components
│   └── Components/     # Reusable Svelte components
database/
├── migrations/         # Database schema
├── factories/          # Model factories for testing
└── seeders/            # Database seeders
tests/
├── Feature/            # Feature (HTTP) tests
└── Unit/               # Unit tests
```

## Code Quality

Run Pint to auto-format PHP code:

```bash
vendor/bin/pint --dirty
```

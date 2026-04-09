# Benefactors

Benefactors is a web system in PHP/Laravel 11 for managing benefactors and contributions. It registers benefactors with personal data, address, and spouse information; records contributions by monthly competence. Dashboard with totals and annual chart. PDF report generation. Vue 3 + Inertia.js + Tailwind CSS. Docker + MySQL.

Focus on speed and simplicity.

<img width="984" height="454" alt="benefactors" src="https://github.com/user-attachments/assets/d2e50036-7f27-4c59-9252-07ee73390f92" />

## 🚀 Stack

- PHP 8.4 (Laravel 11)
- Vue 3 + Inertia.js
- Tailwind CSS
- Docker & Docker Compose (local execution)
- MySQL 8.0 (via Compose service)

## 📦 Running with Docker

### Prerequisites

- [Docker](https://docs.docker.com/get-docker/)
- [Docker Compose](https://docs.docker.com/compose/)

### Quick Steps

```bash
# 1) Clone the repository and enter the project folder
git clone https://github.com/thiagoschoeffel/benefactors.git
cd benefactors

# 2) Copy the environment file and generate the APP_KEY
cp .env.example .env
php artisan key:generate

# 3) Start the services (app + database)
docker compose up -d --build
```

Once started, access:

- App: [http://localhost:8001](http://localhost:8001)
- Database: host/port/credentials defined in `docker-compose.yml`

ℹ️ By default, the configured port for the app is **8001** and the database **3306** in `docker-compose.yml`. Adjust as needed.

> The database is created and populated automatically on the first initialization. An administrator user is created with the credentials below — change them after the first access.
>
> - **Email:** admin@example.com
> - **Password:** password

### Useful Commands

Below are some useful commands to manage the application containers.

```bash
# Stop
docker compose stop

# Restart
docker compose up -d

# Tear down everything (removes containers)
docker compose down -v
```

⚠️ When removing containers with `-v`, database data is also deleted. Data persists as long as the `mysql_data` volume exists.

### Structure

- `app/` — Laravel application code (models, controllers, etc.)
- `resources/js/` — Vue 3 components and Inertia pages
- `resources/views/` — Blade templates (including PDFs)
- `database/` — migrations and seeders
- `docker-compose.yml` — service orchestration (app/db)
- `Dockerfile` — PHP 8.4/Apache image with frontend build

## 📄 License

**No license.**

This repository is made available for **viewing only**. It is **not permitted** to use, copy, modify, or distribute the code without **written** authorization from the author.

All rights reserved.

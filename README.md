# 📚 BookaBuku

An online book rental and exchange platform built with Laravel.

---

## Prerequisites

Make sure the following tools are installed before starting:

| Tool | Minimum Version |
|------|--------------|
| PHP | 8.2+ |
| Composer | 2.x |
| Node.js | 18+ |
| NPM | 9+ |
| MySQL | 8.0+ |
| Git | any |

Check installed versions:

```bash
php -v
composer -V
node -v
npm -v
mysql --version
```

---

## Installation

### 1. Clone repository

```bash
git clone https://github.com/username/projek-akhir-paw-bookabuku.git
cd projek-akhir-paw-bookabuku
```

### 2. Install PHP dependencies

```bash
composer install
```

### 3. Install Node dependencies

```bash
npm install
```

### 4. Setup environment file

Copy `.env.example` into `.env`:

```bash
cp .env.example .env
```

Then open `.env` and adjust the configuration.

### 5. Generate application key

```bash
php artisan key:generate
```

### 6. Create database

Create a new MySQL database with the same name as `DB_DATABASE` in the `.env` file:

```sql
CREATE DATABASE bookabuku;
```

### 7. Run migrations

```bash
php artisan migrate
```

Or if you want to seed initial data:

```bash
php artisan migrate --seed
```

---

## Running the Project

Run two terminals simultaneously:

**Terminal 1 — Laravel server:**
```bash
php artisan serve
```

**Terminal 2 — Vite (asset bundler):**
```bash
npm run dev
```

The application can be accessed at: **http://localhost:8000**

---

## Build for Production

```bash
npm run build
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---
# Adminer Setup Report (Pre-Phase 2) — Mahasagar Project

## Objective

Set up a lightweight database browser (Adminer) separately from the Laravel application to safely and efficiently inspect the Mahasagar database during development.

---

## Environment Context

* OS: WSL (Ubuntu 22.04)
* Project Root: `/home/alex/projects/mahasagar-v2`
* Access via Windows path: `\\wsl.localhost\Ubuntu-22.04\home\alex\projects\mahasagar-v2`
* Laravel app runs independently via `php artisan serve`

---

## Key Decision

Adminer will **NOT** be installed inside the Laravel `/public` directory.

Instead:

* A **separate project directory** is used
* A **separate PHP server** runs on a different port

This ensures:

* No interference with Laravel routing
* No UI/CSS issues
* Clean separation of concerns

---

## Folder Structure Created

```
/home/alex/projects/
    ├── mahasagar-v2/
    └── adminer/
```

---

## Adminer Installation Steps

### 1. Create Directory

Navigated to projects folder and created a dedicated Adminer directory:

```
cd /home/alex/projects
mkdir adminer
cd adminer
```

---

### 2. Download Adminer

Downloaded latest Adminer as `index.php`:

```
wget https://www.adminer.org/latest.php -O index.php
```

---

### 3. Start PHP Server (Separate Port)

Adminer is served using PHP built-in server on port **8002**:

```
php -S 127.0.0.1:8002 > /dev/null 2>&1 &
```

Notes:

* Runs in **background**
* Terminal remains free
* Output suppressed for clean execution

---

### 4. Access Adminer

URL:

```
http://127.0.0.1:8002
```

---

## Database Connection Configuration

Use Laravel `.env` credentials:

* System: MySQL / MariaDB
* Server: `127.0.0.1` (or `localhost`)
* Username: `DB_USERNAME`
* Password: `DB_PASSWORD`
* Database: `DB_DATABASE`

---

## Issue Faced & Resolution

### Issue:

When Adminer was placed inside Laravel (`/public/adminer.php`) and accessed via:

```
php artisan serve
```

UI appeared broken:

* Misaligned layout
* Numbers like 33, 34 visible
* CSS not loading correctly

---

### Root Cause:

Laravel dev server (`artisan serve`) interferes with:

* Headers
* Output rendering
* Static asset handling (Adminer expects direct PHP execution)

---

### Resolution:

* Avoid using `artisan serve` for Adminer
* Use **plain PHP server (`php -S`)**
* Move Adminer outside Laravel project

---

## Background Process Management

### Check running server:

```
lsof -i :8002
```

### Stop server:

```
kill -9 $(lsof -t -i:8002)
```

---

## Current State

✅ Adminer running independently
✅ Clean UI rendering
✅ Accessible on port 8002
✅ Connected to Laravel database
✅ No conflict with Laravel app

---

## Usage Role in Project

Adminer is now used for:

* Quick table inspection
* Debugging database state
* Manual query execution
* Verifying migrations and seeders

---

## Important Rules (Carry Forward)

1. Never run Adminer through `artisan serve`
2. Always keep Adminer isolated from Laravel project
3. Use background server (`php -S`) for Adminer
4. Use `.env` credentials — do not hardcode anything
5. This setup is **development only**

---

## Next Phase Context

This setup is part of:
👉 Pre-Phase 2 (Admin Panel & DB Management Preparation)

Adminer will assist in:

* Validating schema
* Supporting admin panel development
* Debugging permission & role systems

---

## Instruction for Next Chat

When continuing:

* Do NOT assume DB structure
* Ask if uncertain
* Use this Adminer setup for DB inspection when needed

---

# File Tree After Phase 2 completed : 

mahasagar-v2/
├─ app/
│  ├─ Http/
│  │  ├─ Controllers/
│  │  │  ├─ Admin/
│  │  │  │  ├─ Auth/
│  │  │  │  │  └─ LoginController.php
│  │  │  │  ├─ CategoryController.php
│  │  │  │  └─ DashboardController.php
│  │  │  ├─ Web/
│  │  │  │  └─ HomepageController.php
│  │  │  └─ Controller.php
│  │  └─ Middleware/
│  │     ├─ CheckPermission.php
│  │     └─ IsAdmin.php
│  ├─ Models/
│  │  ├─ Article.php
│  │  ├─ Category.php
│  │  ├─ Permission.php
│  │  ├─ Role.php
│  │  └─ User.php
│  ├─ Observers/
│  │  └─ PermissionObserver.php
│  └─ Providers/
│     └─ AppServiceProvider.php
├─ bootstrap/
│  ├─ cache/
│  │  ├─ .gitignore
│  │  ├─ packages.php
│  │  └─ services.php
│  ├─ app.php
│  └─ providers.php
├─ config/
│  ├─ admin_menu.php
│  ├─ app.php
│  ├─ auth.php
│  ├─ cache.php
│  ├─ database.php
│  ├─ filesystems.php
│  ├─ logging.php
│  ├─ mail.php
│  ├─ queue.php
│  ├─ services.php
│  └─ session.php
├─ database/
│  ├─ factories/
│  │  └─ UserFactory.php
│  ├─ migrations/
│  │  ├─ 0001_01_01_000000_create_users_table.php
│  │  ├─ 0001_01_01_000001_create_cache_table.php
│  │  ├─ 0001_01_01_000002_create_jobs_table.php
│  │  ├─ 2026_03_14_091820_create_roles_table.php
│  │  ├─ 2026_03_14_091838_create_permissions_table.php
│  │  ├─ 2026_03_14_091937_create_categories_table.php
│  │  ├─ 2026_03_14_091942_create_articles_table.php
│  │  ├─ 2026_03_14_091947_create_permission_role_table.php
│  │  └─ 2026_03_14_091952_create_role_user_table.php
│  ├─ seeders/
│  │  ├─ AdminUserSeeder.php
│  │  ├─ DatabaseSeeder.php
│  │  └─ RolesAndPermissionsSeeder.php
│  └─ .gitignore
├─ public/
│  ├─ build/
│  │  ├─ assets/
│  │  │  ├─ app-9a5VGcvv.css
│  │  │  └─ app-CoDean7B.js
│  │  └─ manifest.json
│  ├─ images/
│  │  └─ logo/
│  │     └─ logo.png
│  ├─ .htaccess
│  ├─ favicon.ico
│  ├─ hot
│  ├─ index.php
│  └─ robots.txt
├─ resources/
│  ├─ css/
│  │  └─ app.css
│  ├─ js/
│  │  ├─ app.js
│  │  └─ bootstrap.js
│  └─ views/
│     ├─ admin/
│     │  ├─ auth/
│     │  │  └─ login.blade.php
│     │  ├─ categories/
│     │  │  ├─ _form.blade.php
│     │  │  ├─ create.blade.php
│     │  │  ├─ edit.blade.php
│     │  │  └─ index.blade.php
│     │  └─ dashboard.blade.php
│     ├─ components/
│     │  ├─ admin/
│     │  │  ├─ empty-state.blade.php
│     │  │  ├─ page-header.blade.php
│     │  │  └─ table.blade.php
│     │  └─ web/
│     │     ├─ cards/
│     │     │  ├─ featured.blade.php
│     │     │  ├─ horizontal.blade.php
│     │     │  └─ vertical.blade.php
│     │     └─ section-header.blade.php
│     ├─ errors/
│     │  └─ 404.blade.php
│     ├─ layouts/
│     │  ├─ admin/
│     │  │  └─ app.blade.php
│     │  └─ web/
│     │     └─ app.blade.php
│     ├─ partials/
│     │  ├─ admin/
│     │  └─ web/
│     │     ├─ footer.blade.php
│     │     └─ header.blade.php
│     └─ web/
│        ├─ article.blade.php
│        ├─ category.blade.php
│        └─ home.blade.php
├─ routes/
│  ├─ admin.php
│  ├─ console.php
│  └─ web.php
├─ storage/
│  ├─ app/
│  │  ├─ private/
│  │  │  └─ .gitignore
│  │  ├─ public/
│  │  │  └─ .gitignore
│  │  └─ .gitignore
│  ├─ framework/
│  │  ├─ cache/
│  │  │  ├─ data/
│  │  │  │  └─ .gitignore
│  │  │  └─ .gitignore
│  │  ├─ sessions/
│  │  │  └─ .gitignore
│  │  ├─ testing/
│  │  │  └─ .gitignore
│  │  ├─ views/
│  │  │  ├─ .gitignore
│  │  │  ├─ ...
│  │  └─ .gitignore
│  └─ logs/
│     └─ .gitignore
├─ tests/
│  ├─ Feature/
│  │  └─ ExampleTest.php
│  ├─ Unit/
│  │  └─ ExampleTest.php
│  └─ TestCase.php
├─ vendor/
│  ├─ ...
│  │     ├─ .deepsource.toml
│  │     ├─ CHANGELOG.md
│  │     ├─ composer.json
│  │     ├─ LICENSE.txt
│  │     └─ README.md
│  └─ autoload.php
├─ .editorconfig
├─ .env
├─ .env.example
├─ .gitattributes
├─ .gitignore
├─ artisan
├─ composer.json
├─ composer.lock
├─ package-lock.json
├─ package.json
├─ phpunit.xml
├─ README.md
└─ vite.config.js
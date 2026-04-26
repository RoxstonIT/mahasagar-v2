# Mahasagar Project – Technical Progress Report (Phase 1 Complete)

## 1. Project Context

* Framework: Laravel 12 (Kernel-less architecture)
* Environment: WSL (Ubuntu) on Windows
* Database: MySQL (MariaDB)
* Development approach: Domain-driven, step-by-step, no assumptions

---

## 2. Core Architectural Decisions

### 2.1 Domain Separation

The project is structured with clear separation:

* Web (public-facing)
* Admin (backend panel)

Directory structure reflects this:

* Controllers:

  * `App\Http\Controllers\Web`
  * `App\Http\Controllers\Admin`
* Views:

  * `resources/views/web`
  * `resources/views/admin`
* Layouts:

  * `resources/views/layouts/web`
  * `resources/views/layouts/admin`
* Routes:

  * `routes/web.php`
  * `routes/admin.php`

---

### 2.2 Routing Strategy

* `web.php` handles public routes
* `admin.php` is separately included via:

```php
require __DIR__.'/admin.php';
```

* Admin routes are grouped with:

```php
Route::prefix('admin')->group(...)
```

---

## 3. Database Design

### 3.1 Tables Created

#### Users (default Laravel)

* id
* name
* email
* password
* timestamps

---

### 3.2 RBAC System

#### roles

* id
* name (unique)
* label
* timestamps

#### permissions

* id
* name (unique)
* label
* timestamps

#### permission_role (pivot)

* id
* role_id
* permission_id
* unique(role_id, permission_id)

#### role_user (pivot)

* id
* user_id
* role_id
* unique(user_id, role_id)

---

### 3.3 Categories

* id
* name
* slug (unique)
* created_by (FK → users)
* updated_by (FK → users)
* timestamps
* softDeletes

---

### 3.4 Articles

* id
* category_id (FK)
* banner (full URL or path)
* title
* slug (unique)
* sub_title (nullable)
* short_article (nullable)
* full_article (longText, TipTap HTML)
* meta_title (nullable)
* meta_description (nullable)
* status (string, default: draft)
* meta (JSON, nullable)
* created_by (FK)
* updated_by (FK)
* approved_by (FK)
* approved_at (nullable timestamp)
* timestamps
* softDeletes

---

### 3.5 Articles Design Strategy

Hybrid model used:

* Core fields → columns
* Variable data → JSON `meta`

Example meta:

```json
{
  "author_name": "Mahasagar Desk",
  "label": "Breaking",
  "display_date": "2026-03-14 18:00:00"
}
```

---

## 4. RBAC Implementation

### 4.1 Seeder: RolesAndPermissionsSeeder

Creates:

Permissions:

* add_news_categories
* submit_news_article
* edit_news_article_before_approval
* delete_news_article_before_approval
* approve_disapprove_news_article
* edit_news_article_after_approval
* delete_approved_news_article

Role:

* superadmin

Assigns all permissions to superadmin.

---

### 4.2 Seeder: AdminUserSeeder

Creates:

User:

* email: [admin@mahasagar.com](mailto:admin@mahasagar.com)
* password: password

Assigns:

* superadmin role

---

### 4.3 Relationships

User model:

```php
public function roles()
{
    return $this->belongsToMany(Role::class);
}
```

Role model:

```php
public function permissions()
{
    return $this->belongsToMany(Permission::class);
}
```

Permission model:

```php
public function roles()
{
    return $this->belongsToMany(Role::class);
}
```

---

## 5. Automation

### 5.1 Permission Observer

Location:

```
App\Observers\PermissionObserver
```

Behavior:

* On permission creation → auto attach to superadmin

Registered in:

```
AppServiceProvider
```

---

## 6. Authentication System (Manual)

### 6.1 Reason for Manual Auth

Laravel Breeze was NOT used because:

* It pollutes structure
* Not aligned with admin-first architecture
* Requires cleanup and restructuring

---

### 6.2 LoginController

Handles:

* showLoginForm
* login
* logout

Uses:

```php
Auth::attempt()
```

---

### 6.3 Login View

Location:

```
resources/views/admin/auth/login.blade.php
```

Basic form:

* email
* password
* CSRF protected

---

### 6.4 Auth Routes

Inside `admin.php`:

```php
Route::get('/login', ...)
Route::post('/login', ...)
Route::post('/logout', ...)
```

---

## 7. Middleware System

### 7.1 IsAdmin Middleware

Checks:

```php
$user->roles()->where('name', 'superadmin')->exists()
```

---

### 7.2 CheckPermission Middleware

Usage:

```php
->middleware('permission:add_news_categories')
```

Logic:

```php
$user->hasPermission($permission)
```

---

### 7.3 User Permission Helper

```php
public function hasPermission($permissionName)
{
    return $this->roles()
        ->whereHas('permissions', function ($q) use ($permissionName) {
            $q->where('name', $permissionName);
        })
        ->exists();
}
```

---

### 7.4 Middleware Registration (Laravel 11+)

In:

```
bootstrap/app.php
```

```php
$middleware->alias([
    'is_admin' => IsAdmin::class,
    'permission' => CheckPermission::class,
]);
```

---

### 7.5 Auth Redirect Fix

Since Laravel expects `route('login')`, we configured:

```php
$middleware->redirectGuestsTo(function () {
    return route('admin.login');
});
```

---

## 8. Admin Panel Foundation

### 8.1 Dashboard

Controller:

```
Admin/DashboardController
```

View:

```
resources/views/admin/dashboard.blade.php
```

Layout:

```
resources/views/layouts/admin/app.blade.php
```

---

### 8.2 Route Protection

```php
Route::middleware(['auth', 'is_admin'])->group(...)
```

---

## 9. Environment Setup

### 9.1 .env

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mahasagar
DB_USERNAME=root
DB_PASSWORD=
```

---

### 9.2 App Key

Generated using:

```bash
php artisan key:generate
```

---

## 10. Current System Status

### Fully Working

* Admin login/logout
* Role-based access (superadmin)
* Permission system
* Permission middleware
* Auto permission assignment
* Database schema
* Admin dashboard route

---

## 11. Important Constraints

* No Breeze / Jetstream
* No assumptions allowed
* Always confirm before design decisions
* Step-by-step execution only
* Windows + WSL environment
* Admin-first architecture

---

## 12. Next Planned Feature

**Admin Category Management (CRUD)**

Will include:

* Controller
* Routes
* Views
* Permission protection

---

## 13. Instruction for Next Chat

When continuing in a new chat:

* Do NOT assume anything
* Ask clarification if unsure
* Follow existing structure strictly
* Maintain admin/web separation
* Respect RBAC already implemented
* Continue step-by-step only

---

END OF REPORT

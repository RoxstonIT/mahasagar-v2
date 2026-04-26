# Phase 3 — Article Module to Frontend Foundation

## Scope Covered

This phase starts from:

**Article Module → Option A (Single Form)**

and ends at:

**STEP 74.4 — Web Navigation Completion + Active State**

Phase 4 will continue frontend web development for:
- category-wise listing pages
- article/news detail reading pages
- frontend refinement

This document is intended to be used as complete context for continuing development in a new chat without assumptions or hallucinations.

---

# Core Development Rules Followed

## 1. Work One Step at a Time

Always proceed step-by-step.

Never provide multiple implementation steps at once.

Each step must be completed and tested before moving forward.

---

## 2. Windows + WSL Development Environment

Project is developed using:
- Windows machine
- VS Code connected to WSL
- Laravel project hosted inside WSL
- MariaDB/MySQL inside WSL
- Vite + NPM inside WSL

All terminal commands must always be given accordingly.

Example:

```bash
php artisan migrate
composer run dev
npm install
```

No Mac/Linux assumptions outside WSL workflow.

---

## 3. Primary Brand Color

Primary CSS color used across admin and web:

```css
#ec1e20
```

This should remain the primary action/highlight color unless explicitly changed.

---

## 4. No Unnecessary Reusable Components

User explicitly requested:

Do not force unnecessary reusable abstractions.

Reusable components should only exist where genuinely helpful.

Avoid over-engineering.

---

## 5. Preserve Existing Frontend Design

Frontend design/layout should NOT be changed unless explicitly requested.

Only dynamic data wiring should be added.

No redesign assumptions allowed.

This is especially important for:

```text
resources/views/web/home.blade.php
resources/views/partials/web/header.blade.php
```

---

# Folder Structure Standards

## Controllers Separation

Strict separation maintained:

```text
app/Http/Controllers/Admin/
app/Http/Controllers/Web/
```

Rules:
- Admin controllers are only for admin panel
- Web controllers are only for public frontend
- Never mix admin/frontend responsibilities

Examples:
- Admin/CategoryController
- Web/CategoryController

These must remain separate.

---

## Views Separation

Strict separation maintained:

```text
resources/views/admin/
resources/views/web/
```

Supporting structure:

```text
resources/views/layouts/admin/
resources/views/layouts/web/
resources/views/partials/admin/
resources/views/partials/web/
resources/views/components/admin/
resources/views/components/web/
```

Do not mix admin views into web or vice versa.

---

# Major Implementations Completed

---

# 1. Article Module — Single Form Architecture

Chosen approach:

## Option A → Single Form

Instead of split workflows.

Meaning:
- one shared form for create/edit
- workflow controlled by status + permissions
- easier long-term maintainability

Files:

```text
resources/views/admin/articles/
    _form.blade.php
    create.blade.php
    edit.blade.php
    index.blade.php
```

---

# 2. Admin Article CRUD

Implemented in:

```text
app/Http/Controllers/Admin/ArticleController.php
```

Methods:
- index()
- create()
- store()
- edit()
- update()
- destroy() placeholder
- uploadImage()

Fields handled:
- category_id
- title
- slug
- sub_title
- short_article
- full_article
- banner
- meta_title
- meta_description
- status
- created_by
- updated_by

Slug uniqueness implemented.

Banner upload implemented.

---

# 3. Article Listing Page

Admin articles listing completed.

Features:
- pagination
- search
- sorting
- status display
- category display
- consistent design with Categories page

Uses:

```text
resources/views/components/admin/table.blade.php
```

Must visually match categories page.

---

# 4. Status Workflow Upgrade

Old:

```text
draft / published
```

Replaced with:

```text
draft / pending / approved / rejected
```

Updated in:
- validation
- dropdown UI
- controller logic
- article workflow

All `published` references removed.

---

# 5. RBAC Workflow Enforcement

Rules:

| Role | Allowed |
|---|---|
| Writer | draft, pending |
| Editor/Admin | approved, rejected |

Frontend dropdown:
- approved/rejected only visible if user has permission:

```text
approve_disapprove_news_article
```

Backend security:
If request is tampered manually and unauthorized user sends approved/rejected:

status is automatically forced to:

```text
pending
```

This must remain enforced.

---

# 6. Rich Text Editor (TipTap)

Replaced plain textarea HTML workflow with:

## TipTap editor

for:

```text
full_article
```

Reason:
- real publishing experience
- structured content
- media support
- future scalability

---

# 7. TipTap Features Implemented

Toolbar:
- bold
- italic
- H1
- H2
- unordered list
- ordered list

Also:
- keyboard shortcuts fixed
- active toolbar state highlighting
- selected buttons use primary red color

File:

```text
resources/js/app.js
```

---

# 8. Image Upload Inside Editor

Route:

```text
POST /admin/articles/upload-image
```

Method:

```text
uploadImage()
```

Supports:
- jpg
- jpeg
- png
- webp

Storage fix completed using:

```bash
php artisan storage:link
```

Public disk used correctly.

---

# 9. Video Embeds

Implemented:

## YouTube
Using official TipTap extension.

## Vimeo + Generic Embed
Using custom Embed Node.

Supports:
- YouTube
- Vimeo
- generic iframe-based embeds

Important architecture:

Do NOT use raw HTML iframe injection.

Use:

```js
Node.create()
```

for structured embeds.

---

# 10. Admin Menu Updated

File:

```text
config/admin_menu.php
```

Added:

```text
Articles
```

under Content section.

Permission mapping:

```text
submit_news_article
```

must match route middleware.

---

# 11. Admin Login Page Redesigned

File:

```text
resources/views/admin/auth/login.blade.php
```

Replaced raw HTML page with:
- proper Tailwind UI
- centered card
- branded styling
- validation display
- primary red color

---

# 12. Public Article Page

Route:

```text
/news/{slug}
```

Controller:

```text
app/Http/Controllers/Web/ArticleController.php
```

Rule:
Only articles with status:

```text
approved
```

are publicly visible.

Must render content using:

```blade
{!! $article->full_article !!}
```

for TipTap HTML output.

---

# 13. Homepage Dynamic Rendering

Homepage converted from static to dynamic.

Controller:

```text
app/Http/Controllers/Web/HomepageController.php
```

Uses category-driven rendering.

Hero section:
- latest article

Secondary stories:
- next article set

Breaking strip retained.

---

# 14. Category Model Relationships

In:

```text
app/Models/Category.php
```

Implemented:

```php
articles()
approvedArticles()
```

Important rule:

Do NOT override `articles()` with approved-only filtering.

Reason:
Admin would later break.

Correct architecture:

```php
articles() → all articles
approvedArticles() → frontend only
```

This must be preserved.

---

# 15. Dynamic Alternating Homepage Sections

Below Breaking News strip, homepage now loops categories dynamically.

Pattern:

| Section Position | Layout |
|---|---|
| 1 | Hero + Side |
| 2 | Black background 3-column |
| 3 | 3×3 Grid |
| 4 | Hero + Side |
| 5 | Black background |
| repeat | continues |

No design changes were made.
Only data injection.

---

# 16. Global Navigation Categories

Implemented in:

```text
app/Providers/AppServiceProvider.php
```

Using:

```php
View::composer('*')
```

Injected globally:

```php
$navCategories
```

for frontend navigation.

This powers dynamic menu generation.

---

# 17. Dynamic Header Navigation

File:

```text
resources/views/partials/web/header.blade.php
```

Replaced static navigation links with:

```blade
@foreach($navCategories as $category)
```

Categories now load directly from DB.

No design changes.

---

# 18. Dynamic Category Pages

Route:

```text
/category/{slug}
```

Controller:

```text
app/Http/Controllers/Web/CategoryController.php
```

Separate from admin controller.

Supports:
- slug lookup
- approved articles only
- pagination
- frontend category page rendering

Important:
Never use admin controller for frontend category page.

---

# 19. Active Navigation State

Implemented:

## Home active state

and

## Category active state

Behavior:
- active item becomes bold
- active underline remains visible
- hover behavior preserved

No design changes.

Professional frontend navigation UX completed.

---

# Current Temporary Reminder in routes/web.php

These temporary testing routes still exist as reminder and must be removed later:

```php
Route::get('/national', function () {
    return view('web.category');
});

Route::get('/article', function () {
    return view('web.article');
});
```

These must be removed when final dynamic routing fully replaces them.

Do not forget this.

---

# Current Project State at End of Phase 3

## Admin

Completed:
- login
- dashboard
- categories
- articles
- permissions
- workflow
- editor
- image upload
- video embeds
- admin navigation

## Web Frontend

Completed:
- homepage dynamic structure
- article detail page foundation
- category page routing
- dynamic navigation
- active navigation states

This is now a real CMS foundation, not CRUD.

---

# Phase 4 Direction (Confirmed)

Phase 4 will continue:

## Frontend Web Work

Specifically:
- category-wise list page refinement
- article/news detail page refinement
- full frontend reading experience

NOT SEO phase yet.

This is important context.

Do not incorrectly jump to SEO-first workflow.

Frontend reading experience comes first.


# 📘 Mahasagar – Laravel 12 Boilerplate Setup Report (UI + Environment + Architecture)

---

# 1. Development Environment (CRITICAL CONTEXT)

## System Setup

* OS: **Windows (host machine)**
* Development Environment: **WSL2 (Ubuntu 22.04)**
* Project Location:

  ```
  /home/alex/projects/mahasagar-v2
  ```

## Tooling

* Editor: **VS Code**
* Extension: **WSL (Remote - WSL by Microsoft)**
* Workflow:

  * Open project via WSL:

    ```
    code .
    ```
  * VS Code runs inside Linux environment

## Runtime Stack (inside WSL)

* PHP: **8.4.x**
* Composer: **2.8.x**
* Node.js: **v22.x**
* npm: **v10.x**
* Git: Installed and configured (WSL-specific identity)

## Database

* Engine: **MariaDB / MySQL**
* User: `mahasagar`
* Password: `mahasagar`
* Database: `mahasagar`

## Important Notes

* Development is **Linux-native (WSL)** → matches production behavior
* No reliance on Windows PHP/Node
* All commands executed inside WSL terminal

---

# 2. Project Execution Setup

## Unified Dev Command

Using:

```bash
composer run dev
```

Runs:

* Laravel server
* Queue listener (local)
* Vite dev server

## Important Decisions

* ❌ Removed Laravel Pail (pcntl issues in Windows earlier)
* ✅ Using `queue:listen` for local
* Future:

  * Production → `queue:work`

---

# 3. Project Structure Decisions

## Controllers

```
app/Http/Controllers/
    Web/
    Admin/
    Api/
    Mcp/
```

## Routes

```
routes/web.php
routes/admin.php
routes/api.php
routes/mcp.php
```

## Models

❌ NOT split into Web/Admin/Api

→ Kept standard Laravel model structure

---

## Important Rule

👉 **Traditional Laravel structure (NOT Domain Driven Design)**
👉 Avoid premature complexity

---

# 4. Frontend Stack

## CSS Framework

* Tailwind CSS (v4)
* Typography Plugin enabled via:

```css
@plugin "@tailwindcss/typography";
```

## Fonts

* Headline: **Playfair Display (Serif)**
* Body: **Inter (Sans-serif)**

---

# 5. Core UI Philosophy (VERY IMPORTANT)

## Mahasagar Design Direction

* Hybrid: **Indian + Global Editorial**
* Inspired by:

  * BBC
  * Loksatta

## Design Principles

* Mobile-first
* Clean editorial
* Minimal clutter
* Strong hierarchy
* No SaaS-style UI
* No over-animation
* No gimmicks

---

# 6. Homepage (FINALIZED – V1)

## Sections

1. Hero (featured + scrollable list)
2. Breaking Strip (red)
3. National
4. International
5. Business
6. Technology
7. Opinion (dark section)
8. Culture (grid layout)

## Key Features

* Alternating background rhythm
* Serif headlines
* Component-based layout
* Scrollable secondary stories (desktop)
* Editorial spacing

## Components Built

* `<x-cards.featured>`
* `<x-cards.horizontal>`
* `<x-cards.vertical>`
* `<x-section-header>`

---

# 7. Navigation (FINALIZED – V1)

## Structure

* Top utility bar
* Brand section
* Sticky navigation bar (only nav is sticky)

## Styling

* Background: **Red**
* Text: White
* Hover:

  * Text → Black
  * Underline → Black

## Behavior

* Header scrolls away
* Only nav sticks

---

# 8. Category Page (FINALIZED – V1)

## URL Pattern

```
/national
/international
...
```

## Layout

1. Category Header
2. Featured Article
3. Grid (2 columns desktop)
4. Pagination

## Key Decisions

* ❌ No sidebar
* Clean editorial layout
* Reuse vertical card component

---

# 9. Article Page (FINALIZED – V2)

## Style Direction

👉 NYT-style minimal long-form

## Structure

1. Category label
2. Headline
3. Subheadline
4. Author + Date
5. Hero image + caption
6. Divider
7. Article body (narrow column)
8. Related Articles

---

## Typography

Using:

```html
<div class="prose prose-lg">
```

---

## Advanced Styling Added

### ✅ Drop Cap (CSS-based)

```css
.prose p:first-of-type::first-letter
```

---

### ✅ Pull Quotes

```html
<blockquote data-type="pull-quote">
```

---

### ✅ Inline Images

```html
<figure>
  <img>
  <figcaption>
</figure>
```

---

### ✅ Highlight Blocks

```html
<div data-type="highlight">
```

---

### ✅ Horizontal Rules

Styled `<hr>`

---

## Important Rule

❌ Do NOT manually style paragraphs in Blade
✅ All content comes from editor → styled via CSS

---

# 10. Related Articles Section

* Placed below article
* Uses vertical cards
* Wider container (`max-w-5xl`)
* Clean separation via divider

---

# 11. 404 Page (FINALIZED – V1)

## Style

* Minimal
* Editorial
* Calm tone

## No:

* Emojis
* Illustrations
* Playful UX

---

# 12. Footer (REFINED – V1)

## Improvements

* Better hierarchy
* Newsletter inline form
* Clean typography
* Editorial tone

## Sections

* Brand
* Sections
* Company
* Newsletter
* Bottom copyright strip

---

# 13. Editor Decision (CRITICAL)

## Final Decision

👉 **TipTap (Modern Structured Editor)**

---

## Why NOT TinyMCE

* Messy HTML
* Hard to control
* Poor scalability

---

## TipTap Approach

### Store in DB:

```json
JSON (structured content)
```

### Render:

```blade
{!! rendered_html !!}
```

---

## Supported Content Blocks

* Paragraph
* Heading
* Image
* Pull Quote
* Highlight
* Divider
* List
* Link

---

## Important Rule

👉 UI must be **editor-driven, not hardcoded**

---

# 14. UI Completion Status

## DONE

* Homepage
* Navigation
* Category Page
* Article Page
* 404 Page
* Footer
* Typography system
* Component system

---

## NEXT (UI PHASE)

1. Logo integration
2. Favicon setup
3. Author page (optional)
4. Search page (optional)
5. Progress bar (optional)

---

## AFTER UI

👉 Admin Panel + TipTap integration

---

# 15. Critical “Remember This” Rules

## Architecture

* Do NOT use Domain Driven Design (for now)
* Keep Laravel structure simple

---

## UI

* No overdesign
* No SaaS patterns
* Editorial tone always

---

## Components

* Reusable Blade components mandatory
* No duplicated markup

---

## Typography

* Serif for headlines
* Sans for body
* Prose for article content

---

## Content

* Always dynamic-ready
* Never hardcode structure that breaks with real data

---

## Editor

* TipTap JSON → Render → Styled via CSS
* Never style content manually in Blade

---

## Layout

* No sidebar (V1)
* Clean reading experience first

---

## Dev Environment

* Always work inside WSL
* Linux-native stack only

---

# 16. Final State

You now have:

* Production-grade frontend foundation
* Editorially consistent UI
* Scalable component architecture
* TipTap-ready article system
* Clean Laravel structure
* Proper dev environment

---

# 17. How To Use This Report

Use this as:

* Context in new chats
* Base for backend development
* Reference for UI decisions
* Guardrail against bad architectural choices

---

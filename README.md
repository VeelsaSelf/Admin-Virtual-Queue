# Mau Kopi — Laravel Frontend

Laravel + Tailwind CSS implementation of the Mau Kopi POS dashboard UI.

## Tech Stack
- Laravel 11
- Tailwind CSS v3
- Alpine.js v3
- Vite

## Setup

```bash
# 1. Install PHP dependencies
composer install

# 2. Copy environment file
cp .env.example .env
php artisan key:generate

# 3. Install Node dependencies
npm install

# 4. Build assets (dev)
npm run dev

# 5. Serve
php artisan serve
```

## Pages & Routes

| URL | View | Description |
|-----|------|-------------|
| `/` | redirect | Redirects to `/login` |
| `/login` | `pages/login` | Login page (split layout) |
| `/dashboard` | `pages/dashboard` | Main dashboard with charts |

## File Structure

```
resources/views/
├── layouts/
│   └── app.blade.php          # Main authenticated layout (sidebar + header)
├── pages/
│   ├── login.blade.php        # Login page
│   └── dashboard.blade.php    # Dashboard page
└── components/
    ├── nav-item.blade.php     # Sidebar navigation item
    ├── stat-card.blade.php    # KPI stat card
    └── notification-item.blade.php  # Notification list item
```

## Features Implemented

- ✅ Login page — split layout with abstract art panel
- ✅ Password show/hide toggle (Alpine.js)
- ✅ Sidebar with active state indicator
- ✅ Top header with notification bell + user avatar
- ✅ Notification dropdown panel (4 items, unread badges)
- ✅ Sign Out confirmation modal
- ✅ 4 KPI stat cards (up/down badges)
- ✅ Peak Order Time bar chart (SVG, peak highlighted with tooltip)
- ✅ Weekly Revenue line chart (SVG with area fill + tooltip)
- ✅ Payment Method donut chart (SVG, 4 segments + legend)
- ✅ Order Status Distribution (progress bar + breakdown)
- ✅ Top Selling Menu (5 items with rank badges)
- ✅ Overlay click-to-close for all modals/dropdowns
- ✅ Responsive layout

## Color Palette

| Token | Hex | Usage |
|-------|-----|-------|
| `#8B5E1A` | Brown Primary | CTA buttons, active states, chart highlight |
| `#C49060` | Brown Light | Chart secondary bars |
| `#D4B08A` | Brown Muted | Progress in-progress bar |
| `#F0E8D8` | Cream | Active nav background |
| `#FAFAF8` | Off-white | Sidebar & header background |
| `#2c1a06` | Dark Brown | Chart tooltips, logo text |

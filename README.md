# Green Market

Green Market is a classic PHP/XAMPP marketplace project for Moroccan local products. It uses server-rendered PHP pages, MySQL/MariaDB, PHP sessions, and role-based dashboard screens for clients, producers, and admins.

## Requirements

- XAMPP with Apache and MySQL/MariaDB
- PHP 8.0 or newer
- phpMyAdmin, MySQL CLI, or another database client

## Local Setup

1. Put the project in your XAMPP web root:

```txt
C:/xampp/htdocs/green-market-project
```

2. Start Apache and MySQL from XAMPP.

3. Create/import the main database schema for `greenmarket` or `GreenMarket`.

The project config currently uses:

```php
$DB_HOST = 'localhost';
$DB_NAME = 'GreenMarket';
$DB_USER = 'root';
$DB_PASS = '';
```

If your database is named `greenmarket`, update `config/database.php` or rename the database to match.

4. Import demo content after the main schema:

```txt
database/seed_demo_data.sql
```

5. If your database already had old image paths before the asset rename cleanup, run:

```txt
database/update_image_paths.sql
```

6. Open the app through Apache:

```txt
http://localhost/green-market-project/
```

Do not open PHP files directly from the filesystem.

## Demo Accounts

The seed creates these demo users:

| Role | Email |
| --- | --- |
| Client | `client@test.com` |
| Producteur | `producteur@test.com` |
| Admin | `admin@test.com` |

All three seed users share the same hashed password value in `database/seed_demo_data.sql`. If you do not know the original password, reset it from phpMyAdmin using a new `password_hash()` value or create a new user from the admin dashboard.

## Project Structure

```txt
green-market-project/
  index.php
  actions/
    login.php
    logout.php
    register.php
  config/
    database.php
  database/
    seed_demo_data.sql
    update_image_paths.sql
  includes/
    permissions.php
    session.php
    view_helpers.php
  pages/
    auth.php
    about.php
    contact.php
    products.php
    product-details.php
    categories.php
    cart.php
    client-dashboard.php
    producer-dashboard.php
    admin-dashboard.php
    create-market.php
    admin/
      navbar.php
      sidebar.php
      footer.php
      sections/
    producer/
      navbar.php
      sidebar.php
      footer.php
      sections/
    client/
      navbar.php
      sidebar.php
      footer.php
      sections/
  assets/
    css/
    js/
      components/
    images/
```

## PHP Page Organization

The dashboard files in `pages/` are intentional entry pages. They are the URLs opened by the browser, for example `pages/admin-dashboard.php`, and they load their role-specific components from subfolders.

Keep this pattern:

- `pages/admin-dashboard.php` is the admin dashboard shell.
- `pages/admin/` contains admin navbar, sidebar, footer, and sections.
- `pages/producer-dashboard.php` is the producer dashboard shell.
- `pages/producer/` contains producer navbar, sidebar, footer, and sections.
- `pages/client-dashboard.php` is the client dashboard shell.
- `pages/client/` contains client navbar, sidebar, footer, and sections.

This keeps URLs simple while keeping each role's UI organized in its own folder.

## PHP File Guide

### Root Entry

| File | Purpose |
| --- | --- |
| `index.php` | Public home page and main marketplace landing page. |

### Public Pages

| File | Purpose |
| --- | --- |
| `pages/auth.php` | Login/register screen. |
| `pages/about.php` | Public about page with a short presentation of Green Market. |
| `pages/contact.php` | Public contact page with contact details and a simple message form UI. |
| `pages/products.php` | Product listing page using SQL products, categories, boutiques, reviews, traceability filters, and sorting. |
| `pages/product-details.php` | Product detail page with images, options, reviews, and traceability data. |
| `pages/categories.php` | Category listing page using SQL category data with live product, boutique, and rating counts. |
| `pages/cart.php` | Client cart page. |
| `pages/create-market.php` | Producer market/boutique creation page. |

### Dashboard Shell Pages

| File | Purpose |
| --- | --- |
| `pages/admin-dashboard.php` | Protected admin dashboard shell. Loads `pages/admin/*` components. |
| `pages/producer-dashboard.php` | Protected producer dashboard shell. Loads `pages/producer/*` components and handles producer profile updates. |
| `pages/client-dashboard.php` | Protected client dashboard shell. Loads `pages/client/*` components and handles client profile updates. |

### Actions

| File | Purpose |
| --- | --- |
| `actions/login.php` | Handles login POST, password verification, session creation, and role redirects. |
| `actions/register.php` | Handles registration POST and password hashing. |
| `actions/logout.php` | Clears the session and redirects to auth. |

### Config And Includes

| File | Purpose |
| --- | --- |
| `config/database.php` | Creates the PDO database connection. |
| `includes/session.php` | Starts sessions and provides login/role guard helpers. |
| `includes/permissions.php` | Defines permission names and allowed roles. |
| `includes/view_helpers.php` | Shared output helpers such as `e()`, `asset_url()`, date formatting, prices, and stars. |

### JavaScript Components

| File | Purpose |
| --- | --- |
| `assets/js/components/table-pagination.js` | Reusable client-side pagination for dashboard tables, with 5/10/20 rows per page. |

### Admin Components

| File | Purpose |
| --- | --- |
| `pages/admin/navbar.php` | Admin top navigation. |
| `pages/admin/sidebar.php` | Admin sidebar navigation. |
| `pages/admin/footer.php` | Admin footer. |
| `pages/admin/product-controller.php` | Handles admin product CRUD, stock updates, and shared product data queries. |
| `pages/admin/order-controller.php` | Handles admin order status actions, payment deletion, and shared order/payment data queries. |
| `pages/admin/sections.php` | Loads all admin section files. |

### Admin Sections

| File | Purpose |
| --- | --- |
| `pages/admin/sections/dashboard.php` | Admin overview cards, charts, and quick stats. |
| `pages/admin/sections/users.php` | Admin CRUD for users in `utilisateur`. |
| `pages/admin/sections/products.php` | Admin product management table. |
| `pages/admin/sections/product-add.php` | Admin add product form UI. |
| `pages/admin/sections/product-edit.php` | Admin edit product form UI. |
| `pages/admin/sections/product-view.php` | Admin product detail/admin review view. |
| `pages/admin/sections/stock.php` | Admin stock monitoring section. |
| `pages/admin/sections/orders.php` | Admin orders table. |
| `pages/admin/sections/order-view.php` | Admin single order details view. |
| `pages/admin/sections/payments.php` | Admin payments section. |
| `pages/admin/sections/reclamations.php` | Admin complaints/reclamations section. |
| `pages/admin/sections/reviews.php` | Admin review moderation section. |
| `pages/admin/sections/categories.php` | Admin category management section. |
| `pages/admin/sections/notifications.php` | Admin notifications section. |
| `pages/admin/sections/profile.php` | Admin profile section UI. |

### Producer Components

| File | Purpose |
| --- | --- |
| `pages/producer/navbar.php` | Producer top navigation. |
| `pages/producer/sidebar.php` | Producer sidebar, showing the logged-in producer data. |
| `pages/producer/footer.php` | Producer footer. |
| `pages/producer/sections.php` | Loads all producer section files. |

### Producer Sections

| File | Purpose |
| --- | --- |
| `pages/producer/sections/dashboard.php` | Producer overview, sales cards, and quick stats. |
| `pages/producer/sections/profile.php` | Producer profile update form. |
| `pages/producer/sections/products.php` | Producer product table. |
| `pages/producer/sections/product-add.php` | Producer add product form UI. |
| `pages/producer/sections/product-edit.php` | Producer edit product form UI. |
| `pages/producer/sections/product-view.php` | Producer product details view. |
| `pages/producer/sections/stock.php` | Producer stock management section. |
| `pages/producer/sections/orders.php` | Producer orders table. |
| `pages/producer/sections/order-view.php` | Producer single order details view. |
| `pages/producer/sections/payments.php` | Producer payments section. |
| `pages/producer/sections/reviews.php` | Producer customer reviews section. |
| `pages/producer/sections/categories.php` | Producer categories section. |
| `pages/producer/sections/notifications.php` | Producer notifications section. |

### Client Components

| File | Purpose |
| --- | --- |
| `pages/client/navbar.php` | Client top navigation. |
| `pages/client/sidebar.php` | Client sidebar, showing logged-in client data. |
| `pages/client/footer.php` | Client footer. |
| `pages/client/sections.php` | Loads all client section files. |

### Client Sections

| File | Purpose |
| --- | --- |
| `pages/client/sections/dashboard.php` | Client dashboard summary. |
| `pages/client/sections/profile.php` | Client profile update form. |
| `pages/client/sections/orders.php` | Client order history. |
| `pages/client/sections/reviews.php` | Client reviews list. |
| `pages/client/sections/favorites.php` | Client favorite products list. |

## Authentication And Permissions

- Login is handled by `actions/login.php`.
- Logout is handled by `actions/logout.php`.
- Session helpers live in `includes/session.php`.
- Role permissions live in `includes/permissions.php`.
- Password checks use `password_verify()`.
- New/updated passwords should be stored with `password_hash()`.

Role redirects after login:

| Role | Redirect |
| --- | --- |
| `client` | `pages/client-dashboard.php` |
| `producteur` | `pages/producer-dashboard.php` |
| `admin` | `pages/admin-dashboard.php` |

## Current Features

- Home, auth, products, categories, cart, and product details pages.
- Product/category/product detail content can be read from the database.
- Public products page uses SQL for product cards, category filters, boutique filters, price filters, traceability filters, ratings, and sorting.
- Public categories page uses SQL for category cards, product counts, boutique counts, ratings, images, descriptions, and product links.
- Client profile is split into dashboard, profile, orders, favorites, and reviews sections.
- Producer dashboard is split into reusable sections under `pages/producer/sections`.
- Admin dashboard is split into reusable sections under `pages/admin/sections`.
- Admin users section supports CRUD for the `utilisateur` table:
  - add user
  - edit user
  - delete user with confirmation modal
  - search/filter users
  - hashed passwords
  - protection against deleting the current admin account
- Admin products section supports CRUD for the `produit` table:
  - add product
  - edit product
  - delete product with confirmation modal
  - search/filter products
  - update stock from the stock section
- Admin orders and payments are connected to SQL data:
  - list orders from `commande`
  - update/cancel order status
  - list payments from `paiement`
  - delete payments with confirmation
- Dashboard tables use a reusable pagination component with 5, 10, or 20 rows per page.
- Image paths have been normalized to camelCase asset names.

## Admin SQL Status

These admin sections are currently connected to database data:

| Section | Status |
| --- | --- |
| Users | CRUD connected to `utilisateur`. |
| Products | CRUD connected to `produit`, with category and boutique selects from SQL. |
| Stock | Connected to `produit.Stock`; stock updates write to SQL. |
| Orders | Connected to `commande`, `ligne_commande`, `produit`, `utilisateur`, `boutique`, and `paiement`; status can be updated/cancelled. |
| Payments | Connected to `paiement` and related order/client/producer data; payments can be deleted. |

These admin sections are intentionally still static or partial for now:

| Section | Current State |
| --- | --- |
| Dashboard overview | Cards and best-producer table still use placeholder numbers. |
| Categories | Category list and stats are still placeholder UI. Next step is connecting to `categorie` and product counts from `produit`. |
| Admin profile | Form is still placeholder UI. Next step is reading/updating the logged-in admin from `utilisateur`. |
| Product detail view | Product list is SQL-backed, but the detailed admin view is still placeholder content. |
| Order detail view | Order list is SQL-backed, but the detailed admin view is still placeholder content. |
| Notifications | Kept as-is for now. |
| Reclamations | Kept as-is for now. |
| Reviews/Avis client | Kept as-is for now. |

## Database Notes

The seed script adds demo data for:

- users
- categories
- boutiques
- products
- product galleries
- product characteristics/options
- traceability steps
- favorites
- orders
- payments
- complaints
- reviews
- notifications
- cart rows

The seed also creates extra tables used by the product details page:

- `produit_image`
- `produit_caracteristique`
- `produit_option`
- `produit_option_valeur`
- `traceabilite`

It also adds these optional profile fields to `utilisateur`:

- `telephone`
- `adresse`

## Asset Naming

Image assets are now stored with camelCase file and folder names where possible. Database image columns store asset-relative paths, for example:

```txt
assets/images/products/savonBeldi.png
assets/images/product-details/savonBeldi/savonBeldiNila.jpeg
```

If an image does not load after importing older data, run:

```txt
database/update_image_paths.sql
```

## Development Notes

- Keep shared helpers in `includes/`.
- Keep role dashboard UI grouped under `pages/admin`, `pages/producer`, and `pages/client`.
- Keep page-specific JavaScript under `assets/js/pages` or the relevant role folder.
- Keep page-specific CSS under `assets/css/pages` or the relevant role folder.
- Use prepared PDO statements for database writes.
- Escape output with `e()` from `includes/view_helpers.php`.
- Store only asset-relative paths in the database, not absolute Windows paths.

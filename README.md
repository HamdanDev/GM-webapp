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
    products.php
    product-details.php
    categories.php
    cart.php
    client-profile.php
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
    images/
```

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
| `client` | `pages/client-profile.php` |
| `producteur` | `pages/producer-dashboard.php` |
| `admin` | `pages/admin-dashboard.php` |

## Current Features

- Home, auth, products, categories, cart, and product details pages.
- Product/category/product detail content can be read from the database.
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
- Image paths have been normalized to camelCase asset names.

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

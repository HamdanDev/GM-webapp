# Green Market PHP Tutorial

This file explains the main PHP ideas used in this project for a beginner student. The goal is to help you understand how the project is built, not only how to run it.

## 1. PHP Pages

Most pages in this project are normal PHP files that output HTML.

Examples:

- `index.php`
- `pages/products.php`
- `pages/categories.php`
- `pages/admin-dashboard.php`
- `pages/client-dashboard.php`
- `pages/producer-dashboard.php`

A PHP page can contain:

- HTML
- PHP variables
- database queries
- loops
- conditions
- included files

Example idea:

```php
<?php
$title = 'Green Market';
?>

<h1><?= $title ?></h1>
```

The `<?= ... ?>` syntax is a short way to print something in HTML.

## 2. Database Connection With PDO

The database connection is created in:

```txt
config/database.php
```

It uses PDO, which is a PHP tool for talking to databases.

```php
$pdo = new PDO(
    "mysql:host={$DB_HOST};dbname={$DB_NAME};charset=utf8mb4",
    $DB_USER,
    $DB_PASS
);
```

After this file is included, other PHP files can use `$pdo` to run SQL queries.

Example from public pages:

```php
$stmt = $pdo->query('SELECT ID_Categ, nom_Categ FROM categorie ORDER BY nom_Categ');
$categories = $stmt->fetchAll();
```

This means:

- run a SQL query
- get all rows
- store them in `$categories`

## 3. `require_once` And Includes

Instead of copying the same code into every page, we include shared files.

Example:

```php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/view_helpers.php';
```

`require_once` means:

- load this file
- if it was already loaded before, do not load it again
- if the file is missing, stop the page with an error

We use includes for:

- database connection
- session helpers
- permissions
- reusable HTML sections
- helper functions

Dashboard example:

```php
require __DIR__ . '/admin/sections.php';
```

That file loads the admin dashboard sections from `pages/admin/sections/`.

## 4. Helper Functions

Helper functions live in:

```txt
includes/view_helpers.php
```

They avoid repeating the same code.

### `e()`

```php
function e(?string $value): string {
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}
```

This protects HTML output.

Use:

```php
<?= e($product['nom_Prod']) ?>
```

Why? If a user enters dangerous HTML or JavaScript, `e()` displays it safely instead of executing it.

### `asset_url()`

This builds image paths.

```php
asset_url($product['Prod_img'])
```

If the image path is empty, it returns a placeholder image.

### `format_price()`

This formats prices:

```php
format_price(120)
```

Output:

```txt
120 MAD
```

### `format_date_fr()`

This formats dates in French.

```php
format_date_fr('2026-06-13 17:00:00')
```

Example output:

```txt
13 Juin 2026
```

## 5. Sessions

Sessions let PHP remember who is logged in.

Session helpers live in:

```txt
includes/session.php
```

A session stores data on the server. For example, after login we store user information in `$_SESSION`.

Example idea:

```php
$_SESSION['user'] = [
    'id' => $user['ID_utili'],
    'role' => $user['role'],
    'email' => $user['email'],
];
```

Then on another page, we can know who the current user is.

Example:

```php
$user = current_user();
```

Sessions are used for:

- login
- logout
- protecting dashboards
- knowing the current role
- showing the correct user profile

## 6. Login And Logout

Login is handled in:

```txt
actions/login.php
```

Important ideas used there:

- read email/password from `POST`
- find the user in `utilisateur`
- verify password with `password_verify()`
- save user data in session
- redirect based on role

Logout is handled in:

```txt
actions/logout.php
```

Logout clears the session so the user is no longer connected.

## 7. Permissions

Permissions are defined in:

```txt
includes/permissions.php
```

The idea is simple:

- admin can access admin dashboard
- producteur can access producer dashboard
- client can access client dashboard

Example permission style:

```php
require_permission('admin.dashboard');
```

This means:

```txt
Only users with permission admin.dashboard can open this page.
```

If the user does not have permission, they are redirected or blocked.

This keeps pages safer.

## 8. Forms And `$_POST`

Forms send data to PHP.

Example from an admin form:

```php
<form method="post">
    <input name="nom" type="text">
    <button type="submit">Enregistrer</button>
</form>
```

PHP receives it with:

```php
$nom = $_POST['nom'] ?? '';
```

The `?? ''` means:

```txt
If the value does not exist, use an empty string.
```

This avoids errors.

## 9. URL Parameters And `$_GET`

`$_GET` reads values from the URL.

Example URL:

```txt
products.php?categorie=2&prix=50-150
```

PHP can read it:

```php
$categoryFilter = $_GET['categorie'] ?? null;
$priceFilter = $_GET['prix'] ?? null;
```

In `pages/products.php`, this is used for filters:

- category
- boutique
- price
- traceability
- sorting

## 10. SQL Queries

The project uses SQL to read and update data.

### Simple Query

```php
$categories = $pdo->query('SELECT * FROM categorie')->fetchAll();
```

This is fine when there is no user input.

### Prepared Query

When user input is involved, use prepared statements:

```php
$stmt = $pdo->prepare('SELECT * FROM produit WHERE ID_Categ = ?');
$stmt->execute([$categoryId]);
$products = $stmt->fetchAll();
```

Prepared statements protect against SQL injection.

## 11. Loops

Loops are used to display many rows from the database.

Example:

```php
<?php foreach ($products as $product): ?>
    <h3><?= e($product['nom_Prod']) ?></h3>
    <p><?= e(format_price($product['Prix'])) ?></p>
<?php endforeach; ?>
```

This means:

- for each product in `$products`
- print a product card

The project uses loops for:

- product cards
- category cards
- dashboard tables
- user rows
- order rows
- payment rows

## 12. Conditions

Conditions choose what to show.

Example:

```php
<?php if ($products): ?>
    <p>Products found</p>
<?php else: ?>
    <p>No products found</p>
<?php endif; ?>
```

In this project, conditions are used for:

- showing empty states
- showing success/error messages
- showing selected filters
- checking user permissions
- checking product status

Example from a select:

```php
<option value="prix-asc" <?= $sortFilter === 'prix-asc' ? 'selected' : '' ?>>
    Prix croissant
</option>
```

This keeps the selected option active after the page reloads.

## 13. CRUD

CRUD means:

- Create
- Read
- Update
- Delete

Admin examples:

| Feature | Table |
| --- | --- |
| Users CRUD | `utilisateur` |
| Products CRUD | `produit` |
| Stock update | `produit.Stock` |
| Order status update | `commande.status_com` |
| Payment delete | `paiement` |

Example insert:

```php
$stmt = $pdo->prepare('INSERT INTO produit (nom_Prod, Prix) VALUES (:nom, :prix)');
$stmt->execute([
    'nom' => $name,
    'prix' => $price,
]);
```

Example update:

```php
$stmt = $pdo->prepare('UPDATE produit SET Stock = :stock WHERE ID_Prod = :id');
$stmt->execute([
    'stock' => $stock,
    'id' => $id,
]);
```

Example delete:

```php
$stmt = $pdo->prepare('DELETE FROM produit WHERE ID_Prod = :id');
$stmt->execute(['id' => $id]);
```

## 14. Redirects

PHP can redirect users with `header()`.

Example:

```php
header('Location: ../pages/auth.php');
exit;
```

Always call `exit` after a redirect so PHP stops running the rest of the page.

## 15. File Organization

The project is organized by role.

```txt
pages/admin/
pages/producer/
pages/client/
```

Each dashboard has:

- navbar
- sidebar
- footer
- sections

Example:

```txt
pages/admin/sections/users.php
pages/admin/sections/products.php
pages/admin/sections/orders.php
```

This makes the project easier to maintain.

## 16. Important Beginner Rules

1. Always escape output with `e()`.
2. Use prepared statements when user input goes into SQL.
3. Keep repeated code inside helpers or included files.
4. Use sessions for logged-in user data.
5. Use permissions to protect dashboards.
6. Keep database image paths relative, like `assets/images/products/savonBeldi.png`.
7. Do not put raw passwords in the database; use `password_hash()`.
8. Use `password_verify()` when logging in.

## 17. Suggested Learning Path

Read the project in this order:

1. `config/database.php`
2. `includes/view_helpers.php`
3. `includes/session.php`
4. `includes/permissions.php`
5. `actions/login.php`
6. `pages/products.php`
7. `pages/categories.php`
8. `pages/admin-dashboard.php`
9. `pages/admin/sections/users.php`
10. `pages/admin/product-controller.php`

After reading those files, most of the project structure will make sense.


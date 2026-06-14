<?php
require_once __DIR__ . '/../includes/session.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/view_helpers.php';
require_permission('client.profile');

$sessionUser = current_user();
$clientId = (int) $sessionUser['id'];

// Load the latest profile data from the database, not the login session snapshot.
$userStmt = $pdo->prepare('SELECT * FROM utilisateur WHERE ID_utili = ? LIMIT 1');
$userStmt->execute([$clientId]);
$profileUser = $userStmt->fetch() ?: $sessionUser;

// Load the client's orders with one display product per order for compact tables.
$ordersStmt = $pdo->prepare(
    'SELECT co.ID_Com, co.date_com, co.status_com, co.prix_total, MIN(p.nom_Prod) AS product_name
     FROM commande co
     LEFT JOIN ligne_commande lc ON lc.ID_Com = co.ID_Com
     LEFT JOIN produit p ON p.ID_Prod = lc.ID_Prod
     WHERE co.ID_utili = ?
     GROUP BY co.ID_Com, co.date_com, co.status_com, co.prix_total
     ORDER BY co.date_com DESC'
);
$ordersStmt->execute([$clientId]);
$clientOrders = $ordersStmt->fetchAll();

// Load reviews written by this client.
$reviewsStmt = $pdo->prepare(
    'SELECT a.note, a.commentaire, a.created_at, p.nom_Prod
     FROM avis a
     INNER JOIN produit p ON p.ID_Prod = a.ID_Prod
     WHERE a.ID_utili = ?
     ORDER BY a.created_at DESC'
);
$reviewsStmt->execute([$clientId]);
$clientReviews = $reviewsStmt->fetchAll();

// Load favorite products with review summary for favorite cards.
$favoritesStmt = $pdo->prepare(
    'SELECT p.ID_Prod, p.nom_Prod, p.Prix, p.Prod_img, c.nom_Categ, COALESCE(AVG(a.note), 0) AS average_rating, COUNT(a.ID_Avis) AS review_count
     FROM favoris f
     INNER JOIN produit p ON p.ID_Prod = f.ID_Prod
     INNER JOIN categorie c ON c.ID_Categ = p.ID_Categ
     LEFT JOIN avis a ON a.ID_Prod = p.ID_Prod
     WHERE f.ID_utili = ?
     GROUP BY p.ID_Prod, c.nom_Categ
     ORDER BY p.nom_Prod'
);
$favoritesStmt->execute([$clientId]);
$favoriteProducts = $favoritesStmt->fetchAll();

$totalSpent = array_sum(array_map(static fn($order) => (float) $order['prix_total'], $clientOrders));
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Profile-Client</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&amp;family=Lato:wght@300;400;700&amp;display=swap" rel="stylesheet" />
    <link href="../assets/css/base.css" rel="stylesheet" />
    <link href="../assets/css/client/profile.css" rel="stylesheet" />
    <link href="../assets/css/responsive.css" rel="stylesheet" />
</head>

<body>
    <?php require __DIR__ . '/client/navbar.php'; ?>
    <div class="container py-5">
        <div class="row g-4">
            <?php require __DIR__ . '/client/sidebar.php'; ?>
            <div class="col-12 col-md-9">
                <?php require __DIR__ . '/client/sections.php'; ?>
            </div>
        </div>
    </div>
    <?php require __DIR__ . '/client/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/client/profile.js"></script>
</body>

</html>

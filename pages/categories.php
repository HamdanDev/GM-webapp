<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/view_helpers.php';

// Load every category with live product/shop counts and average review score.
$stmt = $pdo->query(
    'SELECT
        c.ID_Categ,
        c.nom_Categ,
        c.description_Categ,
        c.Categ_img,
        COUNT(DISTINCT p.ID_Prod) AS product_count,
        COUNT(DISTINCT p.ID_boutique) AS shop_count,
        COALESCE(AVG(a.note), 0) AS average_rating
     FROM categorie c
     LEFT JOIN produit p ON p.ID_Categ = c.ID_Categ AND p.est_active = 1
     LEFT JOIN avis a ON a.ID_Prod = p.ID_Prod
     GROUP BY c.ID_Categ, c.nom_Categ, c.description_Categ, c.Categ_img
     ORDER BY c.ID_Categ'
);
$categories = $stmt->fetchAll();
?>
<!DOCTYPE html>

<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Catégories - Green Market</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&amp;family=Lato:wght@300;400;700&amp;display=swap" rel="stylesheet" />

    <link href="../assets/css/base.css" rel="stylesheet" />
    <link href="../assets/css/pages/categories.css" rel="stylesheet" />
    <link href="../assets/css/responsive.css" rel="stylesheet" />
</head>

<body>
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-md navbar-dark">
        <div class="container">
            <a class="navbar-brand fw-bold" href="../index.php">Green Market</a>
            <button class="navbar-toggler" data-bs-target="#navMenu" data-bs-toggle="collapse" type="button">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav mx-auto gap-3">
                    <li class="nav-item"><a class="nav-link" href="../index.php">Accueil</a></li>
                    <li class="nav-item"><a class="nav-link" href="products.php">Boutique</a></li>
                    <li class="nav-item"><a class="nav-link active" href="#">Catégories</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.php">À propos</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                </ul>
                <a class="text-white fs-5 m-3" href="auth.php"><i class="bi bi-person"></i></a>
                <a class="text-white fs-5 m-3" href="#"><i class="bi bi-search"></i></a>
                <a class="text-white fs-5 m-3 position-relative" href="#">
                    <i class="bi bi-bell"></i>
                    <span class="badge cart-badge" id="bell-count">0</span>
                </a>
                <a class="text-white fs-5 m-3 position-relative" href="cart.php">
                    <i class="bi bi-cart3"></i>
                    <span class="badge cart-badge" id="cart-count">0</span>
                </a>
            </div>
        </div>
    </nav>
    <!-- PAGE HEADER -->
    <section class="py-4 page-header">
        <div class="container text-center">
            <small class="text-uppercase label-orange">Découvrez</small>
            <h2 class="mt-1 mb-1">Nos Catégories Artisanales</h2>
            <p class="text-muted mb-0">Des produits authentiques, directement des coopératives marocaines</p>
        </div>
    </section>
    <!-- CATEGORIES GRID -->
    <div class="container my-5">
        <div class="row g-4 justify-content-center">
            <?php foreach ($categories as $category): ?>
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="category-card h-100">
                        <img alt="<?php echo e($category['nom_Categ']); ?>" class="category-img" src="<?php echo e(asset_url($category['Categ_img'])); ?>" />
                        <div class="category-body">
                            <h4 class="category-title"><?php echo e($category['nom_Categ']); ?></h4>
                            <div class="category-meta">
                                <span><i class="bi bi-star-fill text-warning"></i> <?php echo number_format((float) $category['average_rating'], 1); ?></span>
                                <span><i class="bi bi-grid"></i> <?php echo (int) $category['product_count']; ?> produits</span>
                                <span><i class="bi bi-shop"></i> <?php echo (int) $category['shop_count']; ?> boutiques</span>
                            </div>
                            <p class="category-desc"><?php echo e($category['description_Categ']); ?></p>
                            <a class="read-more" href="products.php?categorie=<?php echo (int) $category['ID_Categ']; ?>">Explorer →</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <!-- FOOTER -->
    <footer>
        <div class="footer-top">
            <div class="container">
                <div class="row g-4">
                    <div class="col-12 col-md-3">
                        <h5 class="footer-title mb-3">Green Market</h5>
                        <p class="footer-text small">Votre marketplace de produits artisanaux marocains, directs des coopératives.</p>
                        <div class="d-flex gap-3 mt-3">
                            <a class="footer-social" href="#"><i class="bi bi-facebook"></i></a>
                            <a class="footer-social" href="#"><i class="bi bi-instagram"></i></a>
                            <a class="footer-social" href="#"><i class="bi bi-twitter-x"></i></a>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <h6 class="footer-title mb-3">Liens utiles</h6>
                        <ul class="list-unstyled">
                            <li><a class="footer-link" href="../index.php">Accueil</a></li>
                            <li><a class="footer-link" href="products.php">Boutique</a></li>
                            <li><a class="footer-link" href="about.php">À propos</a></li>
                            <li><a class="footer-link" href="contact.php">Contact</a></li>
                        </ul>
                    </div>
                    <div class="col-6 col-md-3">
                        <h6 class="footer-title mb-3">Catégories</h6>
                        <ul class="list-unstyled">
                            <?php foreach (array_slice($categories, 0, 4) as $category): ?>
                                <li><a class="footer-link" href="products.php?categorie=<?php echo (int) $category['ID_Categ']; ?>"><?php echo e($category['nom_Categ']); ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="col-12 col-md-3" id="contact">
                        <h6 class="footer-title mb-3">Contact</h6>
                        <ul class="list-unstyled">
                            <li class="footer-text small mb-2"><i class="bi bi-envelope me-2"></i>contact@greenmarket.ma</li>
                            <li class="footer-text small mb-2"><i class="bi bi-telephone me-2"></i>+212 6 00 00 00 00</li>
                            <li class="footer-text small"><i class="bi bi-geo-alt me-2"></i>Marrakech, Maroc</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <p class="footer-bottom-text text-center">© 2024 Green Market. Tous droits réservés.</p>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="../assets/js/pages/categories.js"></script>
</body>

</html>

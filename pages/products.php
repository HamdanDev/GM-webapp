<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/view_helpers.php';

$categoryFilter = $_GET['categorie'] ?? null;
$shopFilter = $_GET['boutique'] ?? null;
$priceFilter = $_GET['prix'] ?? null;

// Load filter values from the database so the sidebar stays in sync with seeded categories/shops.
$categoriesStmt = $pdo->query('SELECT ID_Categ, nom_Categ FROM categorie ORDER BY nom_Categ');
$categories = $categoriesStmt->fetchAll();

$shopsStmt = $pdo->query('SELECT ID_boutique, nom_boutique FROM boutique ORDER BY nom_boutique');
$shops = $shopsStmt->fetchAll();

// Load active products with category, boutique, average rating, and review count.
$sql = 'SELECT
            p.ID_Prod,
            p.nom_Prod,
            p.Prix,
            p.Prod_img,
            p.created_at,
            c.ID_Categ,
            c.nom_Categ,
            b.nom_boutique,
            COALESCE(AVG(a.note), 0) AS average_rating,
            COUNT(a.ID_Avis) AS review_count
        FROM produit p
        INNER JOIN categorie c ON c.ID_Categ = p.ID_Categ
        INNER JOIN boutique b ON b.ID_boutique = p.ID_boutique
        LEFT JOIN avis a ON a.ID_Prod = p.ID_Prod
        WHERE p.est_active = 1';
$params = [];

if ($categoryFilter !== null && $categoryFilter !== '') {
    if (ctype_digit((string) $categoryFilter)) {
        $sql .= ' AND c.ID_Categ = ?';
        $params[] = (int) $categoryFilter;
    } else {
        $sql .= ' AND LOWER(c.nom_Categ) = LOWER(?)';
        $params[] = str_replace('-', ' ', (string) $categoryFilter);
    }
}

if ($shopFilter !== null && $shopFilter !== '' && ctype_digit((string) $shopFilter)) {
    $sql .= ' AND b.ID_boutique = ?';
    $params[] = (int) $shopFilter;
}

if ($priceFilter === 'moins-50') {
    $sql .= ' AND p.Prix < 50';
} elseif ($priceFilter === '50-150') {
    $sql .= ' AND p.Prix BETWEEN 50 AND 150';
} elseif ($priceFilter === '150-300') {
    $sql .= ' AND p.Prix BETWEEN 150 AND 300';
} elseif ($priceFilter === 'plus-300') {
    $sql .= ' AND p.Prix > 300';
}

$sql .= ' GROUP BY p.ID_Prod, p.nom_Prod, p.Prix, p.Prod_img, p.created_at, c.ID_Categ, c.nom_Categ, b.nom_boutique
          ORDER BY p.created_at DESC, p.ID_Prod DESC';

$productsStmt = $pdo->prepare($sql);
$productsStmt->execute($params);
$products = $productsStmt->fetchAll();
$productCount = count($products);
?>
<!DOCTYPE html>

<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Green Market - Produits</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&amp;family=Lato:wght@300;400;700&amp;display=swap" rel="stylesheet" />

    <link href="../assets/css/base.css" rel="stylesheet" />
    <link href="../assets/css/pages/products.css" rel="stylesheet" />
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
                    <li class="nav-item"><a class="nav-link active" href="#">Boutique</a></li>
                    <li class="nav-item"><a class="nav-link" href="categories.php">Catégories</a></li>
                    <li class="nav-item"><a class="nav-link" href="../index.php#contact">Contact</a></li>
                </ul>
                <a class="text-white fs-5 m-3" href="auth.php"><i class="bi bi-person"></i></a>
                <a class="text-white fs-5 m-3" href="#"><i class="bi bi-search"></i></a>
                <a class="text-white fs-5 m-3" href="cart.php"><i class="bi bi-cart3"></i>
                    <span class="badge cart-badge">0</span>
                </a>
            </div>
        </div>
    </nav>
    <!-- TITRE -->
    <section class="py-4 page-header">
        <div class="container">
            <h2 class="mb-0">Tous nos produits</h2>
            <small class="text-muted" id="product-count"><?php echo $productCount; ?> produits trouvés</small>
        </div>
    </section>
    <!-- CONTENU -->
    <section class="py-5">
        <div class="container">
            <div class="row g-4">
                <!-- SIDEBAR -->
                <div class="col-12 col-md-3">
                    <form class="sidebar p-3" id="filter-form" method="GET" action="products.php">
                        <div class="mb-4">
                            <h6 class="fw-bold sidebar-title">Catégories</h6>
                            <?php foreach ($categories as $category): ?>
                                <div class="form-check">
                                    <input class="form-check-input" id="cat<?php echo (int) $category['ID_Categ']; ?>" name="categorie" value="<?php echo (int) $category['ID_Categ']; ?>" type="radio" <?php echo (string) $categoryFilter === (string) $category['ID_Categ'] ? 'checked' : ''; ?> />
                                    <label class="form-check-label small" for="cat<?php echo (int) $category['ID_Categ']; ?>"><?php echo e($category['nom_Categ']); ?></label>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <hr />
                        <div class="mb-4">
                            <h6 class="fw-bold sidebar-title">Prix</h6>
                            <div class="form-check"><input class="form-check-input" id="prix1" name="prix" value="moins-50" type="radio" <?php echo $priceFilter === 'moins-50' ? 'checked' : ''; ?> /><label class="form-check-label small" for="prix1">Moins de 50 MAD</label></div>
                            <div class="form-check"><input class="form-check-input" id="prix2" name="prix" value="50-150" type="radio" <?php echo $priceFilter === '50-150' ? 'checked' : ''; ?> /><label class="form-check-label small" for="prix2">50 - 150 MAD</label></div>
                            <div class="form-check"><input class="form-check-input" id="prix3" name="prix" value="150-300" type="radio" <?php echo $priceFilter === '150-300' ? 'checked' : ''; ?> /><label class="form-check-label small" for="prix3">150 - 300 MAD</label></div>
                            <div class="form-check"><input class="form-check-input" id="prix4" name="prix" value="plus-300" type="radio" <?php echo $priceFilter === 'plus-300' ? 'checked' : ''; ?> /><label class="form-check-label small" for="prix4">Plus de 300 MAD</label></div>
                        </div>
                        <hr />
                        <div class="mb-4">
                            <h6 class="fw-bold sidebar-title">Coopérative</h6>
                            <?php foreach ($shops as $shop): ?>
                                <div class="form-check">
                                    <input class="form-check-input" id="shop<?php echo (int) $shop['ID_boutique']; ?>" name="boutique" value="<?php echo (int) $shop['ID_boutique']; ?>" type="radio" <?php echo (string) $shopFilter === (string) $shop['ID_boutique'] ? 'checked' : ''; ?> />
                                    <label class="form-check-label small" for="shop<?php echo (int) $shop['ID_boutique']; ?>"><?php echo e($shop['nom_boutique']); ?></label>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <hr />
                        <div class="mb-4">
                            <h6 class="fw-bold sidebar-title">Traçabilité</h6>
                            <div class="form-check">
                                <input class="form-check-input" id="trace" type="checkbox" />
                                <label class="form-check-label small" for="trace">Produits traçables uniquement</label>
                            </div>
                        </div>
                        <input class="btn w-100 btn-outline-white mb-2 btn-add" type="submit" value="Appliquer les filtres" />
                        <a class="btn w-100 btn-reset" href="products.php">Réinitialiser</a>
                    </form>
                </div>
                <div class="col-12 col-md-9">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <span class="text-muted small">Affichage <?php echo $productCount > 0 ? '1-' . $productCount : '0'; ?> sur <?php echo $productCount; ?> produits</span>
                        <select class="form-select form-select-sm w-auto trier">
                            <option selected="">Trier par défaut</option>
                            <option>Prix croissant</option>
                            <option>Prix décroissant</option>
                            <option>Mieux notés</option>
                        </select>
                    </div>
                    <div class="row g-3">
                        <?php foreach ($products as $product): ?>
                            <div class="col-6 col-md-4">
                                <div class="card border-0 shadow-sm h-100">
                                    <?php if (strtotime($product['created_at']) >= strtotime('-30 days')): ?>
                                        <span class="badge position-absolute m-2 badge-nouveau">Nouveau</span>
                                    <?php endif; ?>
                                    <img alt="<?php echo e($product['nom_Prod']); ?>" class="card-img-top product-img" src="<?php echo e(asset_url($product['Prod_img'])); ?>" />
                                    <div class="card-body">
                                        <small class="text-muted"><?php echo e($product['nom_Categ']); ?></small>
                                        <h6 class="card-title mt-1"><?php echo e($product['nom_Prod']); ?></h6>
                                        <div class="mb-1">
                                            <?php echo render_stars((float) $product['average_rating']); ?>
                                            <small class="text-muted">(<?php echo (int) $product['review_count']; ?>)</small>
                                        </div>
                                        <p class="text-success fw-bold mb-2"><?php echo e(format_price($product['Prix'])); ?></p>
                                        <div class="d-flex gap-2">
                                            <a class="btn btn-sm w-75 btn-voir" href="product-details.php?id=<?php echo (int) $product['ID_Prod']; ?>">Voir</a>
                                            <button class="btn btn-sm text-white btn-add w-25"><i class="bi bi-cart"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- FOOTER -->
    <footer class="py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-12 col-md-3">
                    <h5 class="fw-bold">Green Market</h5>
                    <p class="text-muted small">Votre marketplace de produits artisanaux marocains, directs des coopératives.</p>
                    <div class="d-flex gap-3 mt-3">
                        <a class="text-dark" href="#"><i class="bi bi-facebook"></i></a>
                        <a class="text-dark" href="#"><i class="bi bi-instagram"></i></a>
                        <a class="text-dark" href="#"><i class="bi bi-twitter-x"></i></a>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <h6 class="fw-bold mb-3">Liens utiles</h6>
                    <ul class="list-unstyled">
                        <li><a class="text-muted text-decoration-none small" href="../index.php">Accueil</a></li>
                        <li><a class="text-muted text-decoration-none small" href="products.php">Boutique</a></li>
                        <li><a class="text-muted text-decoration-none small" href="#">À propos</a></li>
                        <li><a class="text-muted text-decoration-none small" href="../index.php#contact">Contact</a></li>
                    </ul>
                </div>
                <div class="col-6 col-md-3">
                    <h6 class="fw-bold mb-3">Catégories</h6>
                    <ul class="list-unstyled">
                        <?php foreach (array_slice($categories, 0, 4) as $category): ?>
                            <li><a class="text-muted text-decoration-none small" href="products.php?categorie=<?php echo (int) $category['ID_Categ']; ?>"><?php echo e($category['nom_Categ']); ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="col-12 col-md-3">
                    <h6 class="fw-bold mb-3">Contact</h6>
                    <ul class="list-unstyled">
                        <li class="text-muted small"><i class="bi bi-envelope me-2"></i>contact@greenmarket.ma</li>
                        <li class="text-muted small"><i class="bi bi-telephone me-2"></i>+212 6 00 00 00 00</li>
                        <li class="text-muted small"><i class="bi bi-geo-alt me-2"></i>Marrakech, Maroc</li>
                    </ul>
                </div>
            </div>
            <hr class="mt-4" />
            <p class="text-center text-muted small mb-0">© 2024 Green Market. Tous droits réservés.</p>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="../assets/js/pages/products.js"></script>
</body>

</html>

<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/view_helpers.php';

$productId = isset($_GET['id']) ? (int) $_GET['id'] : 1;

// Load the selected product with category/shop and review summary.
$productStmt = $pdo->prepare(
  'SELECT
      p.*,
      c.nom_Categ,
      b.nom_boutique,
      COALESCE(AVG(a.note), 0) AS average_rating,
      COUNT(a.ID_Avis) AS review_count
   FROM produit p
   INNER JOIN categorie c ON c.ID_Categ = p.ID_Categ
   INNER JOIN boutique b ON b.ID_boutique = p.ID_boutique
   LEFT JOIN avis a ON a.ID_Prod = p.ID_Prod
   WHERE p.ID_Prod = ? AND p.est_active = 1
   GROUP BY p.ID_Prod, c.nom_Categ, b.nom_boutique'
);
$productStmt->execute([$productId]);
$product = $productStmt->fetch();

if (!$product) {
  http_response_code(404);
  die('Produit introuvable.');
}

// Load gallery images, falling back to the main product image if no gallery exists.
$imagesStmt = $pdo->prepare('SELECT image_path, is_main FROM produit_image WHERE ID_Prod = ? ORDER BY sort_order, ID_Image');
$imagesStmt->execute([$productId]);
$images = $imagesStmt->fetchAll();

if ($images === []) {
  $images[] = ['image_path' => $product['Prod_img'], 'is_main' => 1];
}

$mainImage = $images[0]['image_path'];
foreach ($images as $image) {
  if ((int) $image['is_main'] === 1) {
    $mainImage = $image['image_path'];
    break;
  }
}

// Load product characteristics shown in the tab content.
$characteristicsStmt = $pdo->prepare('SELECT texte FROM produit_caracteristique WHERE ID_Prod = ? ORDER BY sort_order, ID_Caract');
$characteristicsStmt->execute([$productId]);
$characteristics = $characteristicsStmt->fetchAll();

// Load selectable product options and their values.
$optionsStmt = $pdo->prepare('SELECT ID_Option, label FROM produit_option WHERE ID_Prod = ? ORDER BY sort_order, ID_Option');
$optionsStmt->execute([$productId]);
$options = $optionsStmt->fetchAll();

$optionValues = [];
if ($options !== []) {
  $optionIds = array_column($options, 'ID_Option');
  $placeholders = implode(',', array_fill(0, count($optionIds), '?'));
  $valuesStmt = $pdo->prepare("SELECT ID_Option, valeur FROM produit_option_valeur WHERE ID_Option IN ($placeholders) ORDER BY sort_order, ID_Valeur");
  $valuesStmt->execute($optionIds);
  foreach ($valuesStmt->fetchAll() as $value) {
    $optionValues[$value['ID_Option']][] = $value['valeur'];
  }
}

// Load traceability timeline rows for this product.
$traceStmt = $pdo->prepare('SELECT * FROM traceabilite WHERE ID_Prod = ? ORDER BY sort_order, ID_Trace');
$traceStmt->execute([$productId]);
$traceSteps = $traceStmt->fetchAll();

// Load customer reviews with reviewer names.
$reviewsStmt = $pdo->prepare(
  'SELECT a.note, a.commentaire, a.created_at, u.nom, u.prenom
   FROM avis a
   INNER JOIN utilisateur u ON u.ID_utili = a.ID_utili
   WHERE a.ID_Prod = ?
   ORDER BY a.created_at DESC
   LIMIT 5'
);
$reviewsStmt->execute([$productId]);
$reviews = $reviewsStmt->fetchAll();

// Recommend other active products from the same category first.
$recommendStmt = $pdo->prepare(
  'SELECT p.ID_Prod, p.nom_Prod, p.Prix, p.Prod_img, b.nom_boutique, COALESCE(AVG(a.note), 0) AS average_rating, COUNT(a.ID_Avis) AS review_count
   FROM produit p
   INNER JOIN boutique b ON b.ID_boutique = p.ID_boutique
   LEFT JOIN avis a ON a.ID_Prod = p.ID_Prod
   WHERE p.est_active = 1 AND p.ID_Prod <> ? AND p.ID_Categ = ?
   GROUP BY p.ID_Prod, b.nom_boutique
   ORDER BY p.created_at DESC
   LIMIT 3'
);
$recommendStmt->execute([$productId, $product['ID_Categ']]);
$recommendedProducts = $recommendStmt->fetchAll();
?>
<!DOCTYPE html>

<html lang="fr">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <title><?php echo e($product['nom_Prod']); ?> - Green Market</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&amp;family=Lato:wght@300;400;700&amp;display=swap" rel="stylesheet" />

  <link href="../assets/css/base.css" rel="stylesheet" />
  <link href="../assets/css/pages/product-details.css" rel="stylesheet" />
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
          <li class="nav-item"><a class="nav-link" href="categories.php">Catégories</a></li>
          <li class="nav-item"><a class="nav-link" href="../index.php#contact">Contact</a></li>
        </ul>
        <a class="text-white fs-5 m-3" href="auth.php"><i class="bi bi-person"></i></a>
        <a class="text-white fs-5 m-3" href="#"><i class="bi bi-search"></i></a>
        <a class="text-white fs-5 m-3 position-relative" href="#"><i class="bi bi-bell"></i><span class="badge cart-badge" id="bell-count">0</span></a>
        <a class="text-white fs-5 m-3 position-relative" href="cart.php"><i class="bi bi-cart3"></i><span class="badge cart-badge" id="cart-count">0</span></a>
      </div>
    </div>
  </nav>
  <!-- PRODUCT -->
  <section class="container py-5">
    <div class="row g-5">
      <div class="col-lg-5">
        <div class="product-image position-relative">
          <img class="img-fluid rounded-4" id="mainImage" src="<?php echo e(asset_url($mainImage)); ?>" alt="<?php echo e($product['nom_Prod']); ?>" />
        </div>
        <div class="small-images mt-3" id="SMI">
          <?php foreach ($images as $index => $image): ?>
            <img class="small-img <?php echo $index === 0 ? 'active-img' : ''; ?>" src="<?php echo e(asset_url($image['image_path'])); ?>" alt="<?php echo e($product['nom_Prod']); ?>" />
          <?php endforeach; ?>
        </div>
      </div>
      <div class="col-lg-7">
        <p class="category"><?php echo e($product['nom_Categ']); ?></p>
        <h1 class="product-title"><?php echo e($product['nom_Prod']); ?></h1>
        <div><?php echo render_stars((float) $product['average_rating']); ?> <small class="text-muted">(<?php echo (int) $product['review_count']; ?> avis)</small></div>
        <h2 class="price"><?php echo e(format_price($product['Prix'])); ?></h2>
        <p class="product-desc"><?php echo e($product['description']); ?></p>
        <?php foreach ($options as $option): ?>
          <div class="mb-4">
            <label class="form-label fw-bold"><?php echo e($option['label']); ?></label>
            <select class="form-select custom-select">
              <?php foreach ($optionValues[$option['ID_Option']] ?? [] as $value): ?>
                <option><?php echo e($value); ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        <?php endforeach; ?>
        <div class="quantity-box mb-4">
          <button id="minusBtn">-</button>
          <span id="quantity">1</span>
          <button id="plusBtn">+</button>
        </div>
        <div class="product-actions mb-4">
          <button class="cart-btn"><i class="bi bi-cart"></i> Ajouter au panier</button>
          <button class="buy-btn">Acheter maintenant</button>
          <button class="wishlist-btn"><i class="bi bi-heart"></i></button>
        </div>
        <div class="features">
          <div class="feature-item"><i class="bi bi-truck"></i><div><h6>Livraison gratuite</h6><p>dès 500 MAD</p></div></div>
          <div class="feature-item"><i class="bi bi-arrow-counterclockwise"></i><div><h6>Retour sous 14 jours</h6><p>Échange garanti</p></div></div>
          <div class="feature-item"><i class="bi bi-shield-check"></i><div><h6>Paiement sécurisé</h6><p>100% protégé</p></div></div>
        </div>
      </div>
    </div>
  </section>
  <!-- TRACEABILITE -->
  <?php if ($traceSteps !== []): ?>
    <section class="container mb-5">
      <div class="trace-wrapper">
        <div class="trace-box"><h3 class="mb-4"><i class="bi bi-shield-check"></i> Traçabilité - de l'artisan vers vous</h3></div>
        <div class="trace-boxx">
          <?php foreach ($traceSteps as $step): ?>
            <div class="trace-item">
              <div class="trace-dot"><i class="bi <?php echo e($step['icone']); ?>"></i></div>
              <div class="trace-card">
                <img src="<?php echo e(asset_url($step['image_path'])); ?>" alt="<?php echo e($step['titre']); ?>" />
                <div>
                  <div class="trace-meta"><i class="bi bi-calendar"></i> <?php echo e($step['date_trace']); ?> <i class="bi bi-geo-alt"></i> <?php echo e($step['lieu']); ?></div>
                  <h5><?php echo e($step['titre']); ?></h5>
                  <p><?php echo e($step['description']); ?></p>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </section>
  <?php endif; ?>
  <!-- TABS -->
  <section class="container mb-5">
    <ul class="nav nav-tabs custom-tabs">
      <li class="nav-item"><button class="nav-link active" data-bs-target="#caracteristiques" data-bs-toggle="tab">Caractéristiques</button></li>
      <li class="nav-item"><button class="nav-link" data-bs-target="#description" data-bs-toggle="tab">Description</button></li>
      <li class="nav-item"><button class="nav-link" data-bs-target="#livraison" data-bs-toggle="tab">Livraison</button></li>
    </ul>
    <div class="tab-content custom-tab-content">
      <div class="tab-pane fade show active" id="caracteristiques">
        <h6>Caractéristiques du produit</h6>
        <ul>
          <?php foreach ($characteristics as $characteristic): ?>
            <li><?php echo e($characteristic['texte']); ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
      <div class="tab-pane fade" id="description"><p><?php echo e($product['description']); ?></p></div>
      <div class="tab-pane fade" id="livraison">
        <h6>Livraison &amp; Retours</h6>
        <ul><li>Livraison gratuite dès 500 MAD</li><li>Délai: 2 à 5 jours ouvrés</li><li>Retour accepté sous 14 jours</li></ul>
      </div>
    </div>
  </section>
  <!-- AVIS CLIENTS -->
  <section class="container mb-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h4 class="fw-bold mb-0">Avis clients</h4>
      <div class="d-flex align-items-center">
        <span class="me-2 fs-5 fw-semibold"><?php echo number_format((float) $product['average_rating'], 1); ?></span>
        <div class="review-stars"><?php echo render_stars((float) $product['average_rating']); ?></div>
      </div>
    </div>
    <?php foreach ($reviews as $review): ?>
      <div class="review-box d-flex align-items-start">
        <div class="review-avatar me-3"><?php echo e(substr($review['prenom'], 0, 1)); ?></div>
        <div class="flex-grow-1">
          <div class="d-flex justify-content-between align-items-center mb-1">
            <div>
              <h6 class="mb-0"><?php echo e($review['prenom'] . ' ' . substr($review['nom'], 0, 1) . '.'); ?></h6>
              <small class="text-muted"><?php echo e(format_date_fr($review['created_at'])); ?></small>
            </div>
            <div class="review-stars"><?php echo render_stars((float) $review['note']); ?></div>
          </div>
          <p class="mb-0"><?php echo e($review['commentaire']); ?></p>
        </div>
      </div>
    <?php endforeach; ?>
  </section>
  <!-- VOUS AIMEREZ AUSSI -->
  <?php if ($recommendedProducts !== []): ?>
    <section class="container mt-5 mb-5">
      <h4 class="fw-bold mb-4">Vous aimerez aussi</h4>
      <div class="row">
        <?php foreach ($recommendedProducts as $recommended): ?>
          <div class="col-md-4 mb-4">
            <div class="card product-card">
              <img class="card-img-top product-img" src="<?php echo e(asset_url($recommended['Prod_img'])); ?>" alt="<?php echo e($recommended['nom_Prod']); ?>" />
              <div class="card-body">
                <span class="badge badge-tracable mb-2">Traçable</span>
                <p class="text-muted mb-1"><?php echo e($recommended['nom_boutique']); ?></p>
                <h6 class="fw-bold"><?php echo e($recommended['nom_Prod']); ?></h6>
                <div class="review-stars mb-2"><?php echo render_stars((float) $recommended['average_rating']); ?> <small class="text-muted ms-1"><?php echo number_format((float) $recommended['average_rating'], 1); ?> (<?php echo (int) $recommended['review_count']; ?>)</small></div>
                <p class="fw-semibold price-text"><?php echo e(format_price($recommended['Prix'])); ?></p>
                <div class="d-flex gap-2">
                  <a class="btn-voir w-75 text-center" href="product-details.php?id=<?php echo (int) $recommended['ID_Prod']; ?>">Voir</a>
                  <button class="btn-panier w-25"><i class="bi bi-cart"></i></button>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </section>
  <?php endif; ?>
  <!-- FOOTER -->
  <footer>
    <div class="footer-top py-5">
      <div class="container">
        <div class="row g-4">
          <div class="col-12 col-md-3"><h5 class="footer-title">Green Market</h5><p class="footer-text">Votre marketplace de produits artisanaux marocains, directs des coopératives.</p></div>
          <div class="col-6 col-md-3"><h6 class="footer-title">Liens utiles</h6><ul class="list-unstyled"><li><a class="footer-link" href="../index.php">Accueil</a></li><li><a class="footer-link" href="products.php">Boutique</a></li><li><a class="footer-link" href="categories.php">Catégories</a></li><li><a class="footer-link" href="../index.php#contact">Contact</a></li></ul></div>
          <div class="col-6 col-md-3"><h6 class="footer-title">Catégories</h6><ul class="list-unstyled"><li><a class="footer-link" href="products.php">Produits Bio</a></li><li><a class="footer-link" href="products.php">Cosmétiques</a></li><li><a class="footer-link" href="products.php">Artisanat</a></li><li><a class="footer-link" href="products.php">Mode Traditionnelle</a></li></ul></div>
          <div class="col-12 col-md-3"><h6 class="footer-title">Contact</h6><ul class="list-unstyled"><li class="footer-text small"><i class="bi bi-envelope me-2"></i>contact@greenmarket.ma</li><li class="footer-text small"><i class="bi bi-telephone me-2"></i>+212 6 00 00 00 00</li><li class="footer-text small"><i class="bi bi-geo-alt me-2"></i>Marrakech, Maroc</li></ul></div>
        </div>
      </div>
    </div>
    <div class="footer-bottom py-3"><div class="container"><p class="text-center mb-0 footer-bottom-text small">© 2024 Green Market. Tous droits réservés.</p></div></div>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/pages/product-details.js"></script>
</body>

</html>

<?php require_once __DIR__ . '/../includes/session.php'; ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>À propos - Green Market</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&amp;family=Lato:wght@300;400;700&amp;display=swap" rel="stylesheet" />
    <link href="../assets/css/base.css" rel="stylesheet" />
    <link href="../assets/css/pages/info.css" rel="stylesheet" />
    <link href="../assets/css/responsive.css" rel="stylesheet" />
</head>

<body>
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
                    <li class="nav-item"><a class="nav-link active" href="about.php">À propos</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                </ul>
                <a class="text-white fs-5 m-3" href="auth.php"><i class="bi bi-person"></i></a>
                <a class="text-white fs-5 m-3" href="#"><i class="bi bi-search"></i></a>
                <a class="text-white fs-5 m-3 position-relative" href="cart.php">
                    <i class="bi bi-cart3"></i>
                    <span class="badge cart-badge">0</span>
                </a>
            </div>
        </div>
    </nav>

    <section class="info-hero">
        <div class="container">
            <span class="eyebrow">Notre histoire</span>
            <h1 class="display-5 fw-bold mt-2">À propos de Green Market</h1>
            <p class="lead mb-0 col-lg-7">Nous connectons les clients avec des producteurs et artisans marocains pour rendre les produits locaux plus visibles, accessibles et traçables.</p>
        </div>
    </section>

    <main class="py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="info-card">
                        <div class="info-icon"><i class="bi bi-shop"></i></div>
                        <h5>Producteurs locaux</h5>
                        <p class="text-muted mb-0">La plateforme met en avant les coopératives, artisans et petits producteurs qui valorisent le savoir-faire marocain.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="info-card">
                        <div class="info-icon"><i class="bi bi-qr-code"></i></div>
                        <h5>Traçabilité simple</h5>
                        <p class="text-muted mb-0">Chaque produit peut présenter son origine, ses étapes de fabrication et les informations utiles au client.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="info-card">
                        <div class="info-icon"><i class="bi bi-heart"></i></div>
                        <h5>Achat responsable</h5>
                        <p class="text-muted mb-0">Nous encourageons une relation plus directe entre les acheteurs et les communautés qui créent les produits.</p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

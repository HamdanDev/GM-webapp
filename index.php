<?php require_once __DIR__ . '/includes/session.php'; ?>
<!DOCTYPE html>

<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Home Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&amp;family=Lato:wght@300;400;700&amp;display=swap" rel="stylesheet" />

    <link href="assets/css/base.css" rel="stylesheet" />
    <link href="assets/css/pages/home.css" rel="stylesheet" />
    <link href="assets/css/responsive.css" rel="stylesheet" />
</head>

<body>
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-md navbar-dark">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">Green Market</a>
            <button class="navbar-toggler" data-bs-target="#navMenu" data-bs-toggle="collapse" type="button">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav mx-auto gap-3">
                    <li class="nav-item"><a class="nav-link active" href="#">Accueil</a></li>
                    <li class="nav-item"><a class="nav-link" href="pages/products.php">Boutique</a></li>
                    <li class="nav-item"><a class="nav-link" href="pages/categories.php">Catégories</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                </ul>
                <a class="text-white fs-5 m-3" href="pages/auth.php"><i class="bi bi-person"></i></a>
                <a class="text-white fs-5 m-3" href="#"><i class="bi bi-search"></i></a>
                <a class="text-white fs-5 m-3 position-relative" href="#">
                    <i class="bi bi-bell"></i>
                    <span class="badge cart-badge" id="bell-count">0</span>
                </a>
                <a class="text-white fs-5 m-3 position-relative" href="pages/cart.php">
                    <i class="bi bi-cart3"></i>
                    <span class="badge cart-badge" id="cart-count">0</span>
                </a>
            </div>
        </div>
    </nav>
    <!-- HERO CAROUSEL -->
    <div class="carousel slide" data-bs-ride="carousel" id="heroCarousel">
        <div class="carousel-indicators">
            <button class="active" data-bs-slide-to="0" data-bs-target="#heroCarousel" type="button"></button>
            <button data-bs-slide-to="1" data-bs-target="#heroCarousel" type="button"></button>
            <button data-bs-slide-to="2" data-bs-target="#heroCarousel" type="button"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img alt="Désert" class="d-block w-100 hero-img" src="assets/images/home/tresorsDuDesert.jpg" />
                <div class="carousel-caption text-start">
                    <span class="badge rounded-pill mb-2 badge-nouveau">Berbère</span>
                    <h1 class="fw-bold">Trésors du Désert</h1>
                    <p>Découvrez des produits authentiques du Maroc</p>
                    <a class="btn btn-outline-light border-0 fw-bold btn-more" href="#">Savoir</a>
                </div>
            </div>
            <div class="carousel-item">
                <img alt="Tagine" class="d-block w-100 hero-img" src="assets/images/home/Tagine.png" />
                <div class="carousel-caption text-start">
                    <span class="badge rounded-pill mb-2 badge-nouveau">Artisanat</span>
                    <h1 class="fw-bold">Fait à la Main</h1>
                    <p>Des artisans marocains pour vous</p>
                    <a class="btn btn-outline-light border-0 fw-bold btn-more" href="#">Découvrir</a>
                </div>
            </div>
            <div class="carousel-item">
                <img alt="Naturel" class="d-block w-100 hero-img" src="assets/images/home/Belgha.png" />
                <div class="carousel-caption text-start">
                    <span class="badge rounded-pill mb-2 badge-nouveau">Naturel</span>
                    <h1 class="fw-bold">100% Naturel</h1>
                    <p>Produits bio directement de la nature</p>
                    <a class="btn btn-outline-light border-0 fw-bold btn-more" href="#">Explorer</a>
                </div>
            </div>
        </div>
    </div>
    <!-- LES PLUS ACHETES -->
    <section class="my-5 py-5">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <small class="text-success fw-bold">POPULAIRE</small>
                    <h2 class="mb-0">Les plus achetés</h2>
                </div>
                <a class="text-muted text-decoration-none" href="#">Voir tous les produits →</a>
            </div>
            <div class="row g-3">
                <!-- Card 1 -->
                <div class="col-6 col-md-3">
                    <div class="card border-0 shadow-sm h-100">
                        <span class="badge position-absolute m-2 badge-nouveau">Nouveau</span>
                        <img alt="Savon Beldi" class="card-img-top" src="https://placehold.co/300x200" />
                        <div class="card-body">
                            <h6 class="card-title">Savon Beldi</h6>
                            <div class="mb-1">
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star text-warning"></i>
                                <small class="text-muted">(24)</small>
                            </div>
                            <p class="text-success fw-bold mb-2">45 MAD</p>
                            <button class="btn btn-sm btn w-100 text-white btn-add">Ajouter</button>
                        </div>
                    </div>
                </div>
                <!-- Card 2 -->
                <div class="col-6 col-md-3">
                    <div class="card border-0 shadow-sm h-100">
                        <span class="badge bg-danger position-absolute m-2">Solde</span>
                        <img alt="Huile d'Argan" class="card-img-top" src="https://placehold.co/300x200" />
                        <div class="card-body">
                            <h6 class="card-title">Huile d'Argan</h6>
                            <div class="mb-1">
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <small class="text-muted">(58)</small>
                            </div>
                            <p class="text-success fw-bold mb-2">120 MAD</p>
                            <button class="btn btn-sm w-100 text-white btn-add">Ajouter</button>
                        </div>
                    </div>
                </div>
                <!-- Card 3 -->
                <div class="col-6 col-md-3">
                    <div class="card border-0 shadow-sm h-100">
                        <img alt="Tapis Berbère" class="card-img-top" src="https://placehold.co/300x200" />
                        <div class="card-body">
                            <h6 class="card-title">Tapis Berbère</h6>
                            <div class="mb-1">
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-half text-warning"></i>
                                <i class="bi bi-star text-warning"></i>
                                <small class="text-muted">(12)</small>
                            </div>
                            <p class="text-success fw-bold mb-2">350 MAD</p>
                            <button class="btn btn-sm w-100 text-white btn-add">Ajouter</button>
                        </div>
                    </div>
                </div>
                <!-- Card 4 -->
                <div class="col-6 col-md-3">
                    <div class="card border-0 shadow-sm h-100">
                        <span class="badge position-absolute m-2 badge-nouveau">Nouveau</span>
                        <img alt="Huile d'Olive" class="card-img-top" src="https://placehold.co/300x200" />
                        <div class="card-body">
                            <h6 class="card-title">Huile d'Olive</h6>
                            <div class="mb-1">
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-half text-warning"></i>
                                <small class="text-muted">(33)</small>
                            </div>
                            <p class="text-success fw-bold mb-2">80 MAD</p>
                            <button class="btn btn-sm w-100 text-white btn-add">Ajouter</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- NOS CATEGORIES -->
    <section class="py-5 categories-section">
        <div class="container">
            <div class="text-center mb-4">
                <small class="text-success fw-bold">EXPLORER</small>
                <h2>Nos Catégories</h2>
                <p class="text-muted">Découvrez notre sélection de produits artisanaux</p>
            </div>
            <div class="row g-3">
                <div class="col-6 col-md-3">
                    <div class="card border-0 rounded-3 overflow-hidden">
                        <img alt="Produits Bio" class="card-img" src="assets/images/home/produitsBio.jpg" />
                        <div class="card-img-overlay d-flex flex-column justify-content-end category-overlay">
                            <h5 class="card-title text-white mb-1">Produits Bio</h5>
                            <p class="text-white small mb-2">Huiles, miels, épices et saveurs authentiques</p>
                            <a class="category-link fw-bold text-decoration-none" href="#">Explorer →</a>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="card border-0 rounded-3 overflow-hidden">
                        <img alt="Cosmétiques" class="card-img" src="assets/images/home/cosmetiqueNaturelle.jpg" />
                        <div class="card-img-overlay d-flex flex-column justify-content-end category-overlay">
                            <h5 class="card-title text-white mb-1">Cosmétiques</h5>
                            <p class="text-white small mb-2">Soins naturels pour le corps et les cheveux</p>
                            <a class="category-link fw-bold text-decoration-none" href="#">Explorer →</a>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="card border-0 rounded-3 overflow-hidden">
                        <img alt="Artisanat" class="card-img" src="assets/images/home/artisanatCategorie.jpg" />
                        <div class="card-img-overlay d-flex flex-column justify-content-end category-overlay">
                            <h5 class="card-title text-white mb-1">Artisanat</h5>
                            <p class="text-white small mb-2">Tapis, poteries et objets décoratifs</p>
                            <a class="category-link fw-bold text-decoration-none" href="#">Explorer →</a>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="card border-0 rounded-3 overflow-hidden">
                        <img alt="Mode Traditionnelle" class="card-img" src="assets/images/home/modeTraditionnelle.jpg" />
                        <div class="card-img-overlay d-flex flex-column justify-content-end category-overlay">
                            <h5 class="card-title text-white mb-1">Mode Traditionnelle</h5>
                            <p class="text-white small mb-2">Kaftans, djellabas et accessoires</p>
                            <a class="category-link fw-bold text-decoration-none" href="#">Explorer →</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- DE LA COOPERATIVE -->
    <section class="my-5 py-5 steps">
        <div class="container">
            <div class="text-center mb-5">
                <small class="text-success fw-bold">PROCESSUS</small>
                <h2>De la coopérative à votre porte</h2>
                <p class="text-muted">Chaque produit passe par un processus soigneux avant d'arriver chez vous</p>
            </div>
            <div class="row g-4 text-center">
                <div class="col-6 col-md-3">
                    <img alt="Production" class="img-fluid rounded-3 mb-3" src="assets/images/home/Production.jpg" />
                    <div class="coop rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3">
                        <i class="bi bi-people text-white fs-4"></i>
                    </div>
                    <h6 class="fw-bold">Production</h6>
                    <p class="text-muted small">Nos coopératives locales récoltent et transforment avec soin</p>
                </div>
                <div class="col-6 col-md-3">
                    <img alt="Artisanat" class="img-fluid rounded-3 mb-3" src="assets/images/home/Artisanat.jpg" />
                    <div class="coop rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3">
                        <i class="bi bi-scissors text-white fs-4"></i>
                    </div>
                    <h6 class="fw-bold">Artisanat</h6>
                    <p class="text-muted small">Les artisans créent chaque pièce selon les traditions ancestrales</p>
                </div>
                <div class="col-6 col-md-3">
                    <img alt="Emballage" class="img-fluid rounded-3 mb-3" src="assets/images/home/Emballage.jpg" />
                    <div class="coop rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3">
                        <i class="bi bi-box-seam text-white fs-4"></i>
                    </div>
                    <h6 class="fw-bold">Emballage</h6>
                    <p class="text-muted small">Conditionnement soigné avec code QR de traçabilité</p>
                </div>
                <div class="col-6 col-md-3">
                    <img alt="Livraison" class="img-fluid rounded-3 mb-3" src="assets/images/home/Livraison.jpg" />
                    <div class="coop rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3">
                        <i class="bi bi-truck text-white fs-4"></i>
                    </div>
                    <h6 class="fw-bold">Livraison</h6>
                    <p class="text-muted small">Livré chez vous avec toute l'histoire du produit</p>
                </div>
            </div>
        </div>
    </section>
    <!-- NEWSLETTER -->
    <section class="my-5 py-5">
        <div class="container newsletter-section p-5 rounded-4">
            <div class="col-md-6 mx-auto text-center text-white">
                <span class="rounded-pill px-3 py-1 fw-bold newsletter-label">COMMUNAUTÉ</span>
                <h2 class="mt-2">Rejoignez notre communauté<br />d'amateurs d'artisanat marocain</h2>
                <p class="text-white-50 mb-4">Recevez nos offres exclusives et nouveautés directement dans votre boîte mail</p>
                <div class="input-group" id="newsletter-form">
                    <input class="form-control" placeholder="Votre adresse email" type="email" />
                    <button class="btn text-white ms-2 btn-subscribe">S'inscrire</button>
                </div>
                <p class="mt-3 text-white fw-bold d-none" id="newsletter-success">
                    Merci! Vous êtes maintenant inscrit.
                </p>
            </div>
        </div>
    </section>
    <!-- FOOTER -->
    <footer id="contact">
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
                            <li><a class="footer-link" href="#">Accueil</a></li>
                            <li><a class="footer-link" href="pages/products.php">Boutique</a></li>
                            <li><a class="footer-link" href="pages/categories.php">Catégories</a></li>
                            <li><a class="footer-link" href="#contact">Contact</a></li>
                        </ul>
                    </div>
                    <div class="col-6 col-md-3">
                        <h6 class="footer-title mb-3">Catégories</h6>
                        <ul class="list-unstyled">
                            <li><a class="footer-link" href="pages/categories.php">Produits Bio</a></li>
                            <li><a class="footer-link" href="pages/categories.php">Cosmétiques</a></li>
                            <li><a class="footer-link" href="pages/categories.php">Artisanat</a></li>
                            <li><a class="footer-link" href="pages/categories.php">Mode Traditionnelle</a></li>
                        </ul>
                    </div>
                    <div class="col-12 col-md-3">
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

    <script src="assets/js/pages/home.js"></script>
</body>

</html>
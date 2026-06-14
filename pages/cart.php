<?php require_once __DIR__ . '/../includes/session.php';
require_permission('client.cart'); ?>
<!DOCTYPE html>

<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Green Market - Panier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&amp;family=Lato:wght@300;400;700&amp;display=swap" rel="stylesheet" />

    <link href="../assets/css/base.css" rel="stylesheet" />
    <link href="../assets/css/pages/cart.css" rel="stylesheet" />
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
                    <li class="nav-item"><a class="nav-link" href="about.php">À propos</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                </ul>
                <a class="text-white fs-5 m-3" href="auth.php"><i class="bi bi-person"></i></a>
                <a class="text-white fs-5 m-3" href="#"><i class="bi bi-search"></i></a>
                <a class="text-white fs-5 m-3 position-relative" href="#">
                    <i class="bi bi-bell"></i>
                    <span class="badge cart-badge" id="bell-count">0</span>
                </a>
                <a class="text-white fs-5 m-3 position-relative" href="#">
                    <i class="bi bi-cart3"></i>
                    <span class="badge cart-badge" id="cart-count">0</span>
                </a>
            </div>
        </div>
    </nav>
    <!-- TITRE -->
    <section class="py-4 page-header">
        <div class="container">
            <h2 class="mb-0">Mon Panier</h2>
            <small class="text-muted" id="cart-count">3 articles</small>
        </div>
    </section>
    <!-- CONTENU -->
    <section class="py-5">
        <div class="container">
            <div class="row g-4">
                <!-- LISTE DES PRODUITS -->
                <div class="col-12 col-md-8">
                    <div class="content-card">
                        <!-- Item 1 -->
                        <div class="cart-item d-flex align-items-center gap-3">
                            <img alt="Savon Beldi" class="cart-img" src="../assets/images/products/savonBeldi.png" />
                            <div class="flex-grow-1">
                                <small class="text-muted">Cosmétiques</small>
                                <h6 class="mb-1">Savon Beldi Traditionnel</h6>
                                <p class="text-success fw-bold mb-0">35 MAD</p>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <button class="btn btn-sm btn-qty">−</button>
                                <span class="qty">1</span>
                                <button class="btn btn-sm btn-qty">+</button>
                            </div>
                            <button class="btn btn-sm text-danger btn-remove">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                        <hr />
                        <!-- Item 2 -->
                        <div class="cart-item d-flex align-items-center gap-3">
                            <img alt="Huile Argan" class="cart-img" src="../assets/images/products/huileArganBio.png" />
                            <div class="flex-grow-1">
                                <small class="text-muted">Produits Bio</small>
                                <h6 class="mb-1">Huile d'Argan Bio</h6>
                                <p class="text-success fw-bold mb-0">150 MAD</p>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <button class="btn btn-sm btn-qty">−</button>
                                <span class="qty">2</span>
                                <button class="btn btn-sm btn-qty">+</button>
                            </div>
                            <button class="btn btn-sm text-danger btn-remove">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                        <hr />
                        <!-- Item 3 -->
                        <div class="cart-item d-flex align-items-center gap-3">
                            <img alt="Tagine" class="cart-img" src="../assets/images/products/tagineTerracotta.png" />
                            <div class="flex-grow-1">
                                <small class="text-muted">Artisanat</small>
                                <h6 class="mb-1">Tagine Terracotta</h6>
                                <p class="text-success fw-bold mb-0">280 MAD</p>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <button class="btn btn-sm btn-qty">−</button>
                                <span class="qty">1</span>
                                <button class="btn btn-sm btn-qty">+</button>
                            </div>
                            <button class="btn btn-sm text-danger btn-remove">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- RÉSUMÉ -->
                <div class="col-12 col-md-4">
                    <div class="content-card">
                        <h5 class="fw-bold mb-4">Résumé de la commande</h5>
                        <!-- Détail prix -->
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted small">Savon Beldi x1</span>
                            <span class="small">35 MAD</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted small">Huile d'Argan x2</span>
                            <span class="small">300 MAD</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted small">Tagine Terracotta x1</span>
                            <span class="small">280 MAD</span>
                        </div>
                        <hr />
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted small">Sous-total</span>
                            <span class="small">615 MAD</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span class="text-muted small">Livraison</span>
                            <span class="small text-success">Gratuite</span>
                        </div>
                        <hr />
                        <div class="d-flex justify-content-between mb-4">
                            <span class="fw-bold">Total</span>
                            <span class="fw-bold text-success">615 MAD</span>
                        </div>
                        <!-- Code promo -->
                        <div class="input-group mb-3">
                            <input class="form-control form-control-sm" placeholder="Code promo" type="text" />
                            <button class="btn btn-sm text-white btn-add">Appliquer</button>
                        </div>
                        <!-- Bouton commander -->
                        <a class="btn w-100 text-white btn-add mb-2" href="#">Commander</a>
                        <a class="btn w-100 btn-retour" href="products.php">Continuer mes achats</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
                            <li><a class="footer-link" href="categories.php">Catégories</a></li>
                            <li><a class="footer-link" href="about.php">À propos</a></li>
                            <li><a class="footer-link" href="contact.php">Contact</a></li>
                        </ul>
                    </div>
                    <div class="col-6 col-md-3">
                        <h6 class="footer-title mb-3">Catégories</h6>
                        <ul class="list-unstyled">
                            <li><a class="footer-link" href="categories.php">Produits Bio</a></li>
                            <li><a class="footer-link" href="categories.php">Cosmétiques</a></li>
                            <li><a class="footer-link" href="categories.php">Artisanat</a></li>
                            <li><a class="footer-link" href="categories.php">Mode Traditionnelle</a></li>
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

    <script src="../assets/js/pages/cart.js"></script>
</body>

</html>

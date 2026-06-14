<?php require_once __DIR__ . '/../includes/session.php'; ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Contact - Green Market</title>
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
                    <li class="nav-item"><a class="nav-link" href="about.php">À propos</a></li>
                    <li class="nav-item"><a class="nav-link active" href="contact.php">Contact</a></li>
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
            <span class="eyebrow">Nous contacter</span>
            <h1 class="display-5 fw-bold mt-2">Contact</h1>
            <p class="lead mb-0 col-lg-7">Une question sur une commande, un produit ou une boutique ? Envoyez-nous un message.</p>
        </div>
    </section>

    <main class="py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-5">
                    <div class="contact-panel h-100">
                        <h4 class="mb-4">Informations</h4>
                        <div class="contact-item">
                            <i class="bi bi-envelope"></i>
                            <div>
                                <h6 class="mb-1">Email</h6>
                                <p class="text-muted mb-0">contact@greenmarket.ma</p>
                            </div>
                        </div>
                        <div class="contact-item">
                            <i class="bi bi-telephone"></i>
                            <div>
                                <h6 class="mb-1">Téléphone</h6>
                                <p class="text-muted mb-0">+212 6 00 00 00 00</p>
                            </div>
                        </div>
                        <div class="contact-item">
                            <i class="bi bi-geo-alt"></i>
                            <div>
                                <h6 class="mb-1">Adresse</h6>
                                <p class="text-muted mb-0">Marrakech, Maroc</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="info-card">
                        <form>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Nom</label>
                                    <input class="form-control" placeholder="Votre nom" type="text" />
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Email</label>
                                    <input class="form-control" placeholder="email@example.com" type="email" />
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Sujet</label>
                                    <input class="form-control" placeholder="Sujet du message" type="text" />
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Message</label>
                                    <textarea class="form-control" placeholder="Votre message..." rows="5"></textarea>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-info-send text-white" type="button">
                                        <i class="bi bi-send me-2"></i>Envoyer
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

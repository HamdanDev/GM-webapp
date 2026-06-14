<?php
require_once __DIR__ . '/../includes/session.php';
if (is_logged_in()) {
    $role = current_user()['role'];
    if ($role === 'admin') {
        header('Location: admin-dashboard.php');
        exit;
    }
    if ($role === 'producteur') {
        header('Location: producer-dashboard.php');
        exit;
    }
    header('Location: client-profile.php');
    exit;
}
$mode = $_GET['mode'] ?? 'login';
$error = $_GET['error'] ?? '';
$success = $_GET['success'] ?? '';
$messages = [
    'missing_fields' => 'Veuillez remplir tous les champs.',
    'invalid_email' => 'Email invalide.',
    'password_mismatch' => 'Les mots de passe ne correspondent pas.',
    'email_exists' => 'Cet email existe déjà.',
    'invalid_login' => 'Email ou mot de passe incorrect.',
    'login_required' => 'Veuillez vous connecter pour accéder à cette page.',
    'server_error' => 'Erreur serveur. Réessayez plus tard.',
];
$successMessages = [
    'account_created' => 'Compte créé avec succès. Vous pouvez vous connecter.',
    'logged_out' => 'Vous êtes déconnecté.',
];
?>
<!DOCTYPE html>

<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Green Market — Authentification</title>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&amp;family=Playfair+Display:wght@600;700&amp;display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet" />

    <link href="../assets/css/base.css" rel="stylesheet" />
    <link href="../assets/css/pages/auth.css" rel="stylesheet" />
    <link href="../assets/css/responsive.css" rel="stylesheet" />
</head>

<body>
    <div class="page">
        <a class="logo-top" href="../index.php">✦ GREEN MARKET</a>
        <!-- LEFT -->
        <div class="left-side">
            <h1>
                Produits Marocains Authentiques<br />
                <span class="text-highlight">Fait avec Tradition</span>
            </h1>
            <p>
                Green Market connecte les coopératives marocaines directement à vous —
                huile d'argan, poterie, belgha, textiles et cosmétiques naturels,
                fabriqués à la main avec soin.
            </p>
            <a class="btn btn-form" href="#">Explorer les produits →</a>
        </div>
        <!-- RIGHT -->
        <div class="right-side">
            <div class="form-card">
                <?php if ($error && isset($messages[$error])): ?>
                    <div class="alert alert-danger py-2"><?php echo htmlspecialchars($messages[$error]); ?></div>
                <?php endif; ?>
                <?php if ($success && isset($successMessages[$success])): ?>
                    <div class="alert alert-success py-2"><?php echo htmlspecialchars($successMessages[$success]); ?></div>
                <?php endif; ?>
                <!-- LOGIN -->
                <form class="form-panel <?php echo $mode === 'register' ? 'd-none' : ''; ?>" id="form-login" method="POST" action="../actions/login.php">
                    <h3>Connexion membre</h3>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                        <input class="form-control" name="email" placeholder="Email" required="" type="email" />
                    </div>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                        <input class="form-control" name="password" placeholder="Mot de passe" required="" type="password" />
                    </div>
                    <div class="form-row">
                        <label><input type="checkbox" /> Se souvenir de moi</label>
                        <a class="lien-form" href="#">Mot de passe oublié ?</a>
                    </div>
                    <button class="btn btn-form w-100" type="submit">Se connecter</button>
                    <p class="form-footer">
                        Pas encore membre ? <a class="lien-form" data-go="register">Créer un compte</a>
                    </p>
                </form>
                <!-- REGISTER -->
                <form class="form-panel <?php echo $mode === 'register' ? '' : 'd-none'; ?>" id="form-register" method="POST" action="../actions/register.php">
                    <h3>Créer un compte</h3>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                        <input class="form-control" name="nom" placeholder="Nom" required="" type="text" />
                    </div>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                        <input class="form-control" name="prenom" placeholder="Prénom" required="" type="text" />
                    </div>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                        <input class="form-control" name="email" placeholder="Email" required="" type="email" />
                    </div>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                        <input class="form-control" name="password" placeholder="Mot de passe" required="" type="password" />
                    </div>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-shield-lock"></i></span>
                        <input class="form-control" name="confirm_password" placeholder="Confirmer le mot de passe" required="" type="password" />
                    </div>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-briefcase"></i></span>
                        <select class="form-control" name="role" required="">
                            <option disabled="" selected="" value="">Choisir un rôle</option>
                            <option value="client">Client</option>
                            <option value="producteur">Producteur</option>
                        </select>
                    </div>
                    <button class="btn btn-form w-100 mt-2" type="submit">S'inscrire</button>
                    <p class="form-footer">
                        Déjà membre ? <a class="lien-form" data-go="login">Se connecter</a>
                    </p>
                </form>
            </div>
        </div>
    </div>

    <script src="../assets/js/pages/auth.js"></script>
</body>

</html>
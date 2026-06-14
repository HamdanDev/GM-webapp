<?php
require_once __DIR__ . '/../includes/session.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/view_helpers.php';
require_permission('client.profile');

$sessionUser = current_user();
$clientId = (int) $sessionUser['id'];
$profileMessage = null;
$profileError = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['profile_action'] ?? '') === 'update_profile') {
    $nom = trim($_POST['nom'] ?? '');
    $prenom = trim($_POST['prenom'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $telephone = trim($_POST['telephone'] ?? '');
    $adresse = trim($_POST['adresse'] ?? '');
    $oldPassword = (string) ($_POST['old_password'] ?? '');
    $newPassword = (string) ($_POST['new_password'] ?? '');
    $confirmPassword = (string) ($_POST['confirm_password'] ?? '');

    try {
        if ($nom === '' || $prenom === '' || $email === '') {
            throw new RuntimeException('Nom, prénom et email sont obligatoires.');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new RuntimeException('Adresse email invalide.');
        }

        // Reload the current password hash before allowing an optional password change.
        $passwordStmt = $pdo->prepare('SELECT mot_de_passe FROM utilisateur WHERE ID_utili = ? LIMIT 1');
        $passwordStmt->execute([$clientId]);
        $currentPasswordHash = (string) ($passwordStmt->fetchColumn() ?: '');

        $params = [
            'ID_utili' => $clientId,
            'nom' => $nom,
            'prenom' => $prenom,
            'email' => $email,
            'telephone' => $telephone !== '' ? $telephone : null,
            'adresse' => $adresse !== '' ? $adresse : null,
        ];
        $passwordSql = '';

        if ($oldPassword !== '' || $newPassword !== '' || $confirmPassword !== '') {
            if ($oldPassword === '' || $newPassword === '' || $confirmPassword === '') {
                throw new RuntimeException('Remplissez les trois champs pour changer le mot de passe.');
            }

            if (!password_verify($oldPassword, $currentPasswordHash)) {
                throw new RuntimeException('Ancien mot de passe incorrect.');
            }

            if ($newPassword !== $confirmPassword) {
                throw new RuntimeException('La confirmation du mot de passe ne correspond pas.');
            }

            if (strlen($newPassword) < 6) {
                throw new RuntimeException('Le nouveau mot de passe doit contenir au moins 6 caractères.');
            }

            $passwordSql = ', mot_de_passe = :mot_de_passe';
            $params['mot_de_passe'] = password_hash($newPassword, PASSWORD_DEFAULT);
        }

        $updateStmt = $pdo->prepare(
            "UPDATE utilisateur
             SET nom = :nom, prenom = :prenom, email = :email, telephone = :telephone, adresse = :adresse {$passwordSql}
             WHERE ID_utili = :ID_utili"
        );
        $updateStmt->execute($params);

        $_SESSION['user']['nom'] = $nom;
        $_SESSION['user']['prenom'] = $prenom;
        $_SESSION['user']['email'] = $email;

        $profileMessage = 'Profil mis à jour avec succès.';
    } catch (PDOException $e) {
        $profileError = $e->getCode() === '23000'
            ? 'Cette adresse email est déjà utilisée.'
            : 'Erreur base de données: ' . $e->getMessage();
    } catch (RuntimeException $e) {
        $profileError = $e->getMessage();
    }
}

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
    <title>Green Market - Client</title>
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
    <script src="../assets/js/components/table-pagination.js"></script>
    <script src="../assets/js/client/profile.js"></script>
</body>

</html>

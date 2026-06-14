<?php
require_once __DIR__ . '/../includes/session.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/view_helpers.php';
require_permission('producer.dashboard');

$sessionUser = current_user();
$producerId = (int) $sessionUser['id'];
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

        // Reload the current hash before allowing an optional password change.
        $passwordStmt = $pdo->prepare('SELECT mot_de_passe FROM utilisateur WHERE ID_utili = ? LIMIT 1');
        $passwordStmt->execute([$producerId]);
        $currentPasswordHash = (string) ($passwordStmt->fetchColumn() ?: '');

        $params = [
            'ID_utili' => $producerId,
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

// Load the latest producer profile data after any update.
$producerStmt = $pdo->prepare('SELECT * FROM utilisateur WHERE ID_utili = ? LIMIT 1');
$producerStmt->execute([$producerId]);
$profileUser = $producerStmt->fetch() ?: $sessionUser;
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Green Market - Producteur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&amp;family=Lato:wght@300;400;700&amp;display=swap" rel="stylesheet" />
    <link href="../assets/css/base.css" rel="stylesheet" />
    <link href="../assets/css/producer/dashboard.css" rel="stylesheet" />
    <link href="../assets/css/responsive.css" rel="stylesheet" />
</head>

<body>
    <?php require __DIR__ . '/producer/navbar.php'; ?>
    <div class="container py-4">
        <div class="row g-4">
            <?php require __DIR__ . '/producer/sidebar.php'; ?>
            <div class="col-12 col-md-9">
                <?php require __DIR__ . '/producer/sections.php'; ?>
            </div>
        </div>
    </div>
    <?php require __DIR__ . '/producer/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/components/table-pagination.js"></script>
    <script src="../assets/js/producer/dashboard.js"></script>
</body>

</html>

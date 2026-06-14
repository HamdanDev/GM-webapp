<?php
session_start();
require_once __DIR__ . '/../config/database.php';

$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

if ($email === '' || $password === '') {
    header('Location: ../pages/auth.php?error=missing_fields');
    exit;
}

$stmt = $pdo->prepare('SELECT * FROM Utilisateur WHERE email = ? AND est_active = 1 LIMIT 1');
$stmt->execute([$email]);
$user = $stmt->fetch();

$validPassword = false;

if ($user) {
    $storedPassword = $user['mot_de_passe'];

    if (password_verify($password, $storedPassword)) {
        $validPassword = true;
    }
}

if (!$user || !$validPassword) {
    header('Location: ../pages/auth.php?error=invalid_login');
    exit;
}

session_regenerate_id(true);

$_SESSION['user'] = [
    'id' => $user['ID_utili'],
    'nom' => $user['nom'],
    'prenom' => $user['prenom'],
    'email' => $user['email'],
    'role' => $user['role'],
];

if ($user['role'] === 'admin') {
    header('Location: ../pages/admin-dashboard.php');
} elseif ($user['role'] === 'producteur') {
    header('Location: ../pages/producer-dashboard.php');
} else {
    header('Location: ../pages/client-dashboard.php');
}
exit;

<?php
session_start();
require_once __DIR__ . '/../config/database.php';

$nom = trim($_POST['nom'] ?? '');
$prenom = trim($_POST['prenom'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';
$confirmPassword = $_POST['confirm_password'] ?? '';
$role = $_POST['role'] ?? 'client';

$allowedRoles = ['client', 'producteur'];

if ($nom === '' || $prenom === '' || $email === '' || $password === '' || $confirmPassword === '') {
    header('Location: ../pages/auth.php?mode=register&error=missing_fields');
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header('Location: ../pages/auth.php?mode=register&error=invalid_email');
    exit;
}

if ($password !== $confirmPassword) {
    header('Location: ../pages/auth.php?mode=register&error=password_mismatch');
    exit;
}

if (!in_array($role, $allowedRoles, true)) {
    $role = 'client';
}

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

try {
    $stmt = $pdo->prepare('INSERT INTO Utilisateur (nom, prenom, email, mot_de_passe, role) VALUES (?, ?, ?, ?, ?)');
    $stmt->execute([$nom, $prenom, $email, $hashedPassword, $role]);

    header('Location: ../pages/auth.php?success=account_created');
    exit;
} catch (PDOException $e) {
    if ($e->getCode() === '23000') {
        header('Location: ../pages/auth.php?mode=register&error=email_exists');
        exit;
    }

    header('Location: ../pages/auth.php?mode=register&error=server_error');
    exit;
}

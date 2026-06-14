<?php
// includes/session.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Pragma: no-cache');
header('Expires: 0');

function is_logged_in(): bool {
    return isset($_SESSION['user']);
}

function current_user(): ?array {
    return $_SESSION['user'] ?? null;
}

function require_login(): void {
    if (!is_logged_in()) {
        header('Location: ../pages/auth.php?error=login_required');
        exit;
    }
}

function require_role(array $roles): void {
    require_login();
    $user = current_user();
    if (!$user || !in_array($user['role'], $roles, true)) {
        header('Location: ../index.php?error=forbidden');
        exit;
    }
}

require_once __DIR__ . '/permissions.php';

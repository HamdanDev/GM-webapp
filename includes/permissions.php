<?php

const PERMISSION_ROLES = [
    'admin.dashboard' => ['admin'],
    'producer.dashboard' => ['producteur', 'admin'],
    'producer.create_market' => ['producteur', 'admin'],
    'client.profile' => ['client', 'admin'],
    'client.cart' => ['client', 'admin'],
];

function roles_for_permission(string $permission): array {
    return PERMISSION_ROLES[$permission] ?? [];
}

function require_permission(string $permission): void {
    $roles = roles_for_permission($permission);

    if ($roles === []) {
        header('Location: ../index.php?error=forbidden');
        exit;
    }

    require_role($roles);
}

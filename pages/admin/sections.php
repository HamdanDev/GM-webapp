<?php
require __DIR__ . '/product-controller.php';
require __DIR__ . '/order-controller.php';

$adminSections = [
    'dashboard',
    'users',
    'product-add',
    'product-edit',
    'product-view',
    'order-view',
    'profile',
    'products',
    'stock',
    'orders',
    'payments',
    'reclamations',
    'reviews',
    'categories',
    'notifications',
];

foreach ($adminSections as $adminSection) {
    require __DIR__ . '/sections/' . $adminSection . '.php';
}
?>

<?php
$producerSections = [
    'dashboard',
    'profile',
    'product-add',
    'product-edit',
    'product-view',
    'order-view',
    'products',
    'stock',
    'orders',
    'payments',
    'reviews',
    'categories',
    'notifications',
];

foreach ($producerSections as $producerSection) {
    require __DIR__ . '/sections/' . $producerSection . '.php';
}
?>

<?php
$clientSections = [
    'dashboard',
    'profile',
    'orders',
    'reviews',
    'favorites',
];

foreach ($clientSections as $clientSection) {
    require __DIR__ . '/sections/' . $clientSection . '.php';
}
?>

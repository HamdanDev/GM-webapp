<?php

function e(?string $value): string {
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function asset_url(?string $path, string $prefix = '../'): string {
    $path = trim((string) $path);

    if ($path === '') {
        return $prefix . 'assets/images/placeholder-logo.png';
    }

    return $prefix . ltrim($path, '/');
}

function render_stars(float $rating): string {
    $html = '';

    for ($i = 1; $i <= 5; $i++) {
        if ($i <= floor($rating)) {
            $html .= '<i class="bi bi-star-fill text-warning"></i>';
        } elseif ($i - $rating < 1) {
            $html .= '<i class="bi bi-star-half text-warning"></i>';
        } else {
            $html .= '<i class="bi bi-star text-warning"></i>';
        }
    }

    return $html;
}

function format_price($price): string {
    return number_format((float) $price, 0, ',', ' ') . ' MAD';
}

function format_date_fr(?string $date): string {
    if (!$date) {
        return '';
    }

    $months = [
        '01' => 'Janvier',
        '02' => 'Février',
        '03' => 'Mars',
        '04' => 'Avril',
        '05' => 'Mai',
        '06' => 'Juin',
        '07' => 'Juillet',
        '08' => 'Août',
        '09' => 'Septembre',
        '10' => 'Octobre',
        '11' => 'Novembre',
        '12' => 'Décembre',
    ];

    $timestamp = strtotime($date);

    if ($timestamp === false) {
        return $date;
    }

    return date('j', $timestamp) . ' ' . $months[date('m', $timestamp)] . ' ' . date('Y', $timestamp);
}

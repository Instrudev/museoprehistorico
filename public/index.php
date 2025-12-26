<?php
$config = require __DIR__ . '/../config/config.php';
$whatsappNumber = $config['whatsapp_number'] ?? '';
$status = $_GET['status'] ?? null;
$statusMessage = null;
$statusClass = '';

if ($status === 'invalid') {
    $statusMessage = 'Por favor completa todos los campos obligatorios con datos válidos.';
    $statusClass = 'bg-red-600';
} elseif ($status === 'error') {
    $statusMessage = 'No fue posible registrar tu reserva. Inténtalo nuevamente.';
    $statusClass = 'bg-red-600';
}

$allowedPages = [
    'inicio',
    'reservas',
    'dinosaurios',
    'experiencias',
    'mapa',
    'tarifas',
    'eventos',
];

$page = $_GET['page'] ?? 'inicio';
$page = in_array($page, $allowedPages, true) ? $page : 'inicio';

require __DIR__ . '/../views/header.php';
require __DIR__ . '/../views/' . $page . '.php';
require __DIR__ . '/../views/footer.php';

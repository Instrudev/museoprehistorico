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

require __DIR__ . '/../views/header.php';
require __DIR__ . '/../views/inicio.php';
require __DIR__ . '/../views/reservas.php';
require __DIR__ . '/../views/dinosaurios.php';
require __DIR__ . '/../views/experiencias.php';
require __DIR__ . '/../views/mapa.php';
require __DIR__ . '/../views/tarifas.php';
require __DIR__ . '/../views/eventos.php';
require __DIR__ . '/../views/footer.php';

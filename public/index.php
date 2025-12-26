<?php
define('BASE_PATH', dirname(__DIR__));

$config = require BASE_PATH . '/config/config.php';
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

$viewsPath = BASE_PATH . '/views';
$headerPath = $viewsPath . '/header.php';
$footerPath = $viewsPath . '/footer.php';
$viewPath = $viewsPath . '/' . $page . '.php';

require_once $headerPath;
if (is_file($viewPath)) {
    require_once $viewPath;
} else {
    echo '<section class="section-panel py-16 px-6">';
    echo '<div class="max-w-5xl mx-auto">';
    echo '<div class="bg-white rounded-3xl card-shadow p-8 text-center">';
    echo '<h3 class="text-3xl font-bold mb-3" style="color: #68420F;">Contenido no disponible</h3>';
    echo '<p style="color: #68420F;">No pudimos cargar esta sección. Por favor intenta nuevamente.</p>';
    echo '</div></div></section>';
}
require_once $footerPath;

<?php
declare(strict_types=1);

/**
 * Raíz real del proyecto MUSEO
 */
define('BASE_PATH', realpath(__DIR__ . '/..'));

if (!BASE_PATH) {
    die('Error crítico: no se pudo resolver la ruta base del proyecto.');
}

/**
 * Configuración
 */
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$configPath = BASE_PATH . '/config/config.php';
if (!file_exists($configPath)) {
    die('Archivo de configuración no encontrado.');
}

$config = require $configPath;

/**
 * Router por whitelist
 */
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

/**
 * Rutas absolutas a vistas
 */
$viewsDir  = BASE_PATH . '/views';
$header    = $viewsDir . '/header.php';
$footer    = $viewsDir . '/footer.php';
$viewFile  = $viewsDir . '/' . $page . '.php';

/**
 * Render
 */
require_once $header;

if (is_file($viewFile)) {
    require_once $viewFile;
} else {
    ?>
    <section class="section-panel py-16 px-6">
        <div class="max-w-5xl mx-auto">
            <div class="bg-white rounded-3xl card-shadow p-8 text-center">
                <h3 class="text-3xl font-bold mb-3" style="color:#68420F;">
                    Sección no disponible
                </h3>
                <p style="color:#68420F;">
                    La página solicitada no existe.
                </p>
            </div>
        </div>
    </section>
    <?php
}

require_once $footer;

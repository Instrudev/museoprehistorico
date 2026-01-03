<?php
declare(strict_types=1);

define('BASE_PATH', realpath(__DIR__ . '/../..'));

if (!BASE_PATH) {
    die('Error crítico: no se pudo resolver la ruta base del proyecto.');
}

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once BASE_PATH . '/models/Reserva.php';

$allowedPages = [
    'login',
    'dashboard',
    'reservas',
    'reserva-ver',
    'reserva-crear',
    'reserva-editar',
];

$page = $_GET['page'] ?? '';
$page = in_array($page, $allowedPages, true) ? $page : '';

$isAuthenticated = !empty($_SESSION['admin_authenticated']);

if (!$isAuthenticated && $page !== 'login') {
    header('Location: /admin/index.php?page=login');
    exit;
}

if ($isAuthenticated && $page === 'login') {
    header('Location: /admin/index.php?page=dashboard');
    exit;
}

if ($page === '') {
    $page = $isAuthenticated ? 'dashboard' : 'login';
}

$viewsDir = BASE_PATH . '/views/admin';

if ($page === 'login') {
    require_once $viewsDir . '/login.php';
    exit;
}

$reservationModel = new Reserva();
$pageTitle = 'Panel administrativo';
$contentView = '';

switch ($page) {
    case 'dashboard':
        $pageTitle = 'Dashboard';
        $totalReservations = $reservationModel->countAll();
        $contentView = $viewsDir . '/dashboard.php';
        break;
    case 'reservas':
        $pageTitle = 'Reservas';
        $reservations = $reservationModel->all();
        $contentView = $viewsDir . '/reservas-list.php';
        break;
    case 'reserva-ver':
        $pageTitle = 'Detalle de reserva';
        $reservationId = (int) filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $reservationDetail = $reservationId > 0 ? $reservationModel->find($reservationId) : null;
        $contentView = $viewsDir . '/reservas-view.php';
        break;
    case 'reserva-crear':
        $pageTitle = 'Crear reserva';
        $reservationDetail = null;
        $isEditing = false;
        $contentView = $viewsDir . '/reservas-form.php';
        break;
    case 'reserva-editar':
        $pageTitle = 'Editar reserva';
        $reservationId = (int) filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $reservationDetail = $reservationId > 0 ? $reservationModel->find($reservationId) : null;
        $isEditing = true;
        $contentView = $viewsDir . '/reservas-form.php';
        break;
    default:
        $pageTitle = 'Panel administrativo';
        $contentView = $viewsDir . '/dashboard.php';
        $totalReservations = $reservationModel->countAll();
        break;
}

require_once $viewsDir . '/layout.php';

<?php
declare(strict_types=1);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$configPath = __DIR__ . '/../config/admin.php';
if (!file_exists($configPath)) {
    // CORRECCIÓN: Apuntar a /MUSEO/views/admin/login.php
    header('Location: /MUSEO/views/admin/login.php?status=error');
    exit;
}

$adminConfig = require $configPath;
$usernameHash = $adminConfig['username_hash'] ?? '';
$passwordHash = $adminConfig['password_hash'] ?? '';

$action = $_GET['action'] ?? null;

if ($action === 'logout') {
    $_SESSION = [];
    session_destroy();
    // CORRECCIÓN: Al salir, volver al login correcto
    header('Location: /MUSEO/views/admin/login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    // CORRECCIÓN: Si no es POST, devolver al login correcto
    header('Location: /MUSEO/views/admin/login.php');
    exit;
}

$username = trim((string) filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
$password = (string) filter_input(INPUT_POST, 'password', FILTER_UNSAFE_RAW);

$usernameMatches = hash('sha256', $username) === $usernameHash;
$passwordMatches = password_verify($password, $passwordHash);

if (!$usernameMatches || !$passwordMatches) {
    // CORRECCIÓN: Si falla, devolver al login con el error
    header('Location: /MUSEO/views/admin/login.php?status=invalid');
    exit;
}

$_SESSION['admin_authenticated'] = true;

// CORRECCIÓN: Si es exitoso, ir al Dashboard real
header('Location: /MUSEO/views/admin/dashboard.php');
exit;
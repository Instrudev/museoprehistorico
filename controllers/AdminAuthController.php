<?php
declare(strict_types=1);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$configPath = __DIR__ . '/../config/admin.php';
if (!file_exists($configPath)) {
    header('Location: /admin/index.php?page=login&status=error');
    exit;
}

$adminConfig = require $configPath;
$usernameHash = $adminConfig['username_hash'] ?? '';
$passwordHash = $adminConfig['password_hash'] ?? '';

$action = $_GET['action'] ?? null;

if ($action === 'logout') {
    $_SESSION = [];
    session_destroy();
    header('Location: /admin/index.php?page=login');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /admin/index.php?page=login');
    exit;
}

$username = trim((string) filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
$password = (string) filter_input(INPUT_POST, 'password', FILTER_UNSAFE_RAW);

$usernameMatches = hash('sha256', $username) === $usernameHash;
$passwordMatches = password_verify($password, $passwordHash);

if (!$usernameMatches || !$passwordMatches) {
    header('Location: /admin/index.php?page=login&status=invalid');
    exit;
}

$_SESSION['admin_authenticated'] = true;
header('Location: /admin/index.php?page=dashboard');
exit;

<?php

declare(strict_types=1);

define('BASE_PATH', realpath(__DIR__ . '/../..'));

if (!BASE_PATH) {
    die('Error crítico: no se pudo resolver la ruta base del proyecto.');
}

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once BASE_PATH . '/config/database.php';
require_once BASE_PATH . '/models/Reserva.php';
require_once BASE_PATH . '/models/User.php';

function admin_redirect(string $path): void
{
    header('Location: ' . $path);
    exit;
}

function admin_csrf_token(): string
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }

    return (string) $_SESSION['csrf_token'];
}

function admin_csrf_validate(?string $token): bool
{
    if (!$token || empty($_SESSION['csrf_token'])) {
        return false;
    }

    return hash_equals((string) $_SESSION['csrf_token'], $token);
}

function admin_flash_set(string $key, string $message): void
{
    $_SESSION['flash'][$key] = $message;
}

function admin_flash_get(string $key): ?string
{
    if (!isset($_SESSION['flash'][$key])) {
        return null;
    }

    $message = (string) $_SESSION['flash'][$key];
    unset($_SESSION['flash'][$key]);

    return $message;
}

<?php

declare(strict_types=1);

require_once __DIR__ . '/../config/database.php';

$adminEmail = getenv('ADMIN_EMAIL') ?: '';
$adminPassword = getenv('ADMIN_PASSWORD') ?: '';

if ($adminEmail === '' || $adminPassword === '') {
    echo "Faltan variables de entorno ADMIN_EMAIL y ADMIN_PASSWORD.\n";
    echo "Ejemplo: ADMIN_EMAIL=usuario@example.com ADMIN_PASSWORD=Secreto123 php scripts/setup.php\n";
    exit(1);
}

$pdo = getDatabaseConnection();

function tableExists(PDO $pdo, string $table): bool
{
    $statement = $pdo->prepare('SHOW TABLES LIKE :table');
    $statement->execute([':table' => $table]);
    return $statement->fetchColumn() !== false;
}

function runSqlFile(PDO $pdo, string $path): void
{
    if (!file_exists($path)) {
        echo "Archivo no encontrado: {$path}\n";
        exit(1);
    }

    $sql = file_get_contents($path);
    if ($sql === false) {
        echo "No se pudo leer el archivo: {$path}\n";
        exit(1);
    }

    $pdo->exec($sql);
}

if (!tableExists($pdo, 'users')) {
    runSqlFile($pdo, __DIR__ . '/../database/migrations/001_create_users.sql');
    echo "Tabla users creada.\n";
} else {
    runSqlFile($pdo, __DIR__ . '/../database/migrations/002_alter_users.sql');
    echo "Tabla users actualizada.\n";
}

$countStatement = $pdo->query("SELECT COUNT(*) AS total FROM users WHERE role = 'admin'");
$totalAdmins = (int) ($countStatement->fetchColumn() ?? 0);

if ($totalAdmins === 0) {
    $passwordHash = password_hash($adminPassword, PASSWORD_BCRYPT);
    $statement = $pdo->prepare('INSERT INTO users (name, email, password_hash, role, is_active) VALUES (:name, :email, :password_hash, :role, :is_active)');
    $statement->execute([
        ':name' => 'Administrador',
        ':email' => $adminEmail,
        ':password_hash' => $passwordHash,
        ':role' => 'admin',
        ':is_active' => 1,
    ]);
    echo "Usuario administrador creado.\n";
} else {
    echo "Ya existe un administrador registrado.\n";
}

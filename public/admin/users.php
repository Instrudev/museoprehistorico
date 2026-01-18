<?php

declare(strict_types=1);

require_once __DIR__ . '/guard.php';

$userModel = new User();
$pageTitle = 'Usuarios';
$activePage = 'users';

$users = [];
$tableName = $userModel->getTableName();

if ($tableName) {
    $pdo = getDatabaseConnection();
    $selectColumns = array_filter(
        ['id', 'name', 'email', 'role', 'is_active', 'created_at'],
        static fn (string $column): bool => $userModel->hasColumn($column)
    );

    $columnsSql = $selectColumns ? implode(', ', $selectColumns) : '*';
    $statement = $pdo->query("SELECT {$columnsSql} FROM {$tableName} ORDER BY created_at DESC");
    $users = $statement->fetchAll(PDO::FETCH_ASSOC);
}

ob_start();
?>
<?php if (!$tableName) { ?>
  <div class="alert alert-warning">
    No se encontró la tabla de usuarios. Ejecuta las migraciones para crearla.
  </div>
<?php } ?>

<div class="card">
  <div class="card-header">
    <h3 class="card-title">Listado de usuarios administrativos</h3>
  </div>
  <div class="card-body table-responsive">
    <table class="table table-bordered table-hover">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Email</th>
          <th>Rol</th>
          <th>Activo</th>
          <th>Creado en</th>
        </tr>
      </thead>
      <tbody>
        <?php if (empty($users)) { ?>
          <tr>
            <td colspan="6" class="text-center">No hay usuarios para mostrar.</td>
          </tr>
        <?php } ?>
        <?php foreach ($users as $user) { ?>
          <tr>
            <td><?php echo htmlspecialchars((string) ($user['id'] ?? ''), ENT_QUOTES, 'UTF-8'); ?></td>
            <td><?php echo htmlspecialchars((string) ($user['name'] ?? ''), ENT_QUOTES, 'UTF-8'); ?></td>
            <td><?php echo htmlspecialchars((string) ($user['email'] ?? ''), ENT_QUOTES, 'UTF-8'); ?></td>
            <td><?php echo htmlspecialchars((string) ($user['role'] ?? ''), ENT_QUOTES, 'UTF-8'); ?></td>
            <td><?php echo htmlspecialchars(isset($user['is_active']) ? (string) $user['is_active'] : '', ENT_QUOTES, 'UTF-8'); ?></td>
            <td><?php echo htmlspecialchars((string) ($user['created_at'] ?? ''), ENT_QUOTES, 'UTF-8'); ?></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>
<?php
$content = ob_get_clean();

require __DIR__ . '/layout.php';

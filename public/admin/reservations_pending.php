<?php

declare(strict_types=1);

require_once __DIR__ . '/guard.php';

$reservationModel = new Reserva();
$statusColumn = $reservationModel->getStatusColumn();
$columns = $reservationModel->getColumns();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = (string) filter_input(INPUT_POST, 'csrf_token', FILTER_UNSAFE_RAW);

    if (!admin_csrf_validate($token)) {
        admin_flash_set('error', 'La sesión expiró. Inténtalo nuevamente.');
        admin_redirect('/admin/reservations_pending.php');
    }

    if ($statusColumn === null) {
        admin_flash_set('error', 'No se pudo actualizar el estado porque la tabla no tiene un campo de estado.');
        admin_redirect('/admin/reservations_pending.php');
    }

    $action = (string) filter_input(INPUT_POST, 'action', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $reservationId = (int) filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

    $statusMap = [
        'confirm' => 'confirmada',
        'cancel' => 'cancelada',
    ];

    if ($reservationId > 0 && isset($statusMap[$action])) {
        $reservationModel->updateStatus($reservationId, $statusMap[$action]);
        admin_flash_set('success', 'Estado actualizado correctamente.');
    } else {
        admin_flash_set('error', 'Acción inválida.');
    }

    admin_redirect('/admin/reservations_pending.php');
}

$reservations = $reservationModel->pending();
$pageTitle = 'Reservas Pendientes';
$activePage = 'reservations_pending';
$csrfToken = admin_csrf_token();

$successMessage = admin_flash_get('success');
$errorMessage = admin_flash_get('error');

ob_start();
?>
<?php if ($successMessage) { ?>
  <div class="alert alert-success"><?php echo htmlspecialchars($successMessage, ENT_QUOTES, 'UTF-8'); ?></div>
<?php } ?>
<?php if ($errorMessage) { ?>
  <div class="alert alert-danger"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES, 'UTF-8'); ?></div>
<?php } ?>

<?php if ($statusColumn === null) { ?>
  <div class="alert alert-info">
    La tabla de reservas no tiene un campo de estado. Las acciones de confirmación/cancelación están deshabilitadas.
  </div>
<?php } ?>

<div class="card">
  <div class="card-header">
    <h3 class="card-title">Listado de pendientes</h3>
  </div>
  <div class="card-body table-responsive">
    <table class="table table-bordered table-hover">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Fecha visita</th>
          <th>Contacto</th>
          <th>Estado</th>
          <th>Creado en</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php if (empty($reservations)) { ?>
          <tr>
            <td colspan="7" class="text-center">No hay reservas pendientes.</td>
          </tr>
        <?php } ?>
        <?php foreach ($reservations as $reservation) { ?>
          <tr>
            <td><?php echo htmlspecialchars((string) ($reservation['id'] ?? ''), ENT_QUOTES, 'UTF-8'); ?></td>
            <td><?php echo htmlspecialchars((string) ($reservation['full_name'] ?? ''), ENT_QUOTES, 'UTF-8'); ?></td>
            <td><?php echo htmlspecialchars((string) ($reservation['visit_date'] ?? ''), ENT_QUOTES, 'UTF-8'); ?></td>
            <td>
              <?php
                $contactParts = [];
                if (in_array('phone', $columns, true) && !empty($reservation['phone'])) {
                    $contactParts[] = htmlspecialchars((string) $reservation['phone'], ENT_QUOTES, 'UTF-8');
                }
                if (in_array('email', $columns, true) && !empty($reservation['email'])) {
                    $contactParts[] = htmlspecialchars((string) $reservation['email'], ENT_QUOTES, 'UTF-8');
                }
                echo $contactParts ? implode('<br>', $contactParts) : 'Sin contacto';
              ?>
            </td>
            <td>
              <?php
                $statusValue = $statusColumn ? ($reservation[$statusColumn] ?? 'pendiente') : 'pendiente';
                echo htmlspecialchars((string) $statusValue, ENT_QUOTES, 'UTF-8');
              ?>
            </td>
            <td><?php echo htmlspecialchars((string) ($reservation['created_at'] ?? ''), ENT_QUOTES, 'UTF-8'); ?></td>
            <td>
              <?php if ($statusColumn !== null) { ?>
                <form method="post" action="/admin/reservations_pending.php" class="d-inline">
                  <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrfToken, ENT_QUOTES, 'UTF-8'); ?>">
                  <input type="hidden" name="id" value="<?php echo htmlspecialchars((string) ($reservation['id'] ?? ''), ENT_QUOTES, 'UTF-8'); ?>">
                  <input type="hidden" name="action" value="confirm">
                  <button class="btn btn-success btn-sm" type="submit">Confirmar</button>
                </form>
                <form method="post" action="/admin/reservations_pending.php" class="d-inline">
                  <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrfToken, ENT_QUOTES, 'UTF-8'); ?>">
                  <input type="hidden" name="id" value="<?php echo htmlspecialchars((string) ($reservation['id'] ?? ''), ENT_QUOTES, 'UTF-8'); ?>">
                  <input type="hidden" name="action" value="cancel">
                  <button class="btn btn-danger btn-sm" type="submit">Cancelar</button>
                </form>
              <?php } else { ?>
                <span class="text-muted">No disponible</span>
              <?php } ?>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>
<?php
$content = ob_get_clean();

require __DIR__ . '/layout.php';

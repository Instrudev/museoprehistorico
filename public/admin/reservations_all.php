<?php

declare(strict_types=1);

require_once __DIR__ . '/guard.php';

$reservationModel = new Reserva();
$reservations = $reservationModel->all();
$statusColumn = $reservationModel->getStatusColumn();
$columns = $reservationModel->getColumns();

$pageTitle = 'Reservas (todas)';
$activePage = 'reservations_all';

ob_start();
?>
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Listado completo de reservas</h3>
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
        </tr>
      </thead>
      <tbody>
        <?php if (empty($reservations)) { ?>
          <tr>
            <td colspan="6" class="text-center">No hay reservas registradas.</td>
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
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>
<?php
$content = ob_get_clean();

require __DIR__ . '/layout.php';

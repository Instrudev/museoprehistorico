<?php

declare(strict_types=1);

require_once __DIR__ . '/guard.php';

$reservationModel = new Reserva();
$pendingCount = $reservationModel->countPending();
$statusColumn = $reservationModel->getStatusColumn();

$pageTitle = 'Dashboard';
$activePage = 'dashboard';

ob_start();
?>
<div class="row">
  <div class="col-lg-4 col-12">
    <div class="small-box bg-warning">
      <div class="inner">
        <h3><?php echo htmlspecialchars((string) $pendingCount, ENT_QUOTES, 'UTF-8'); ?></h3>
        <p>Reservas pendientes</p>
      </div>
      <div class="icon">
        <i class="fas fa-clock"></i>
      </div>
      <a href="/admin/reservations_pending.php" class="small-box-footer">
        Ver pendientes <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>
</div>

<?php if ($statusColumn === null) { ?>
  <div class="alert alert-info">
    No se encontró un campo de estado en la tabla de reservas. Todas las reservas se consideran pendientes.
  </div>
<?php } ?>
<?php
$content = ob_get_clean();

require __DIR__ . '/layout.php';

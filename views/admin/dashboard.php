<?php
$totalReservations = $totalReservations ?? 0;
?>
<div class="row">
  <div class="col-lg-4 col-12">
    <div class="small-box bg-info">
      <div class="inner">
        <h3><?php echo (int) $totalReservations; ?></h3>
        <p>Reservas registradas</p>
      </div>
      <div class="icon">
        <i class="fas fa-calendar-check"></i>
      </div>
      <a href="/admin/index.php?page=reservas" class="small-box-footer">
        Ver reservas <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>
</div>

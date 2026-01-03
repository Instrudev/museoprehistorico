<?php
$status = $_GET['status'] ?? '';
$alertMessage = '';
$alertClass = 'success';

if ($status === 'created') {
    $alertMessage = 'La reserva fue creada correctamente.';
} elseif ($status === 'updated') {
    $alertMessage = 'La reserva fue actualizada correctamente.';
} elseif ($status === 'deleted') {
    $alertMessage = 'La reserva fue eliminada correctamente.';
}
?>

<?php if ($alertMessage !== '') { ?>
  <div class="alert alert-<?php echo $alertClass; ?>" role="alert">
    <?php echo htmlspecialchars($alertMessage, ENT_QUOTES, 'UTF-8'); ?>
  </div>
<?php } ?>

<div class="card">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h3 class="card-title">Listado de reservas</h3>
    <a href="/admin/index.php?page=reserva-crear" class="btn btn-primary">
      <i class="fas fa-plus"></i> Nueva reserva
    </a>
  </div>
  <div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Fecha visita</th>
          <th>Personas</th>
          <th>Recorrido</th>
          <th>Pago</th>
          <th>Creado</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($reservations)) { ?>
          <?php foreach ($reservations as $item) { ?>
            <tr>
              <td><?php echo (int) $item['id']; ?></td>
              <td><?php echo htmlspecialchars($item['full_name'], ENT_QUOTES, 'UTF-8'); ?></td>
              <td><?php echo htmlspecialchars($item['visit_date'], ENT_QUOTES, 'UTF-8'); ?></td>
              <td><?php echo htmlspecialchars($item['num_people'], ENT_QUOTES, 'UTF-8'); ?></td>
              <td><?php echo htmlspecialchars($item['tour_type'], ENT_QUOTES, 'UTF-8'); ?></td>
              <td><?php echo htmlspecialchars($item['payment_method'], ENT_QUOTES, 'UTF-8'); ?></td>
              <td><?php echo htmlspecialchars($item['created_at'], ENT_QUOTES, 'UTF-8'); ?></td>
              <td>
                <a class="btn btn-sm btn-info" href="/admin/index.php?page=reserva-ver&id=<?php echo (int) $item['id']; ?>">
                  Ver
                </a>
                <a class="btn btn-sm btn-warning" href="/admin/index.php?page=reserva-editar&id=<?php echo (int) $item['id']; ?>">
                  Editar
                </a>
                <form action="/controllers/AdminReservaController.php" method="post" class="d-inline" onsubmit="return confirm('¿Deseas eliminar esta reserva?');">
                  <input type="hidden" name="action" value="delete">
                  <input type="hidden" name="id" value="<?php echo (int) $item['id']; ?>">
                  <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                </form>
              </td>
            </tr>
          <?php } ?>
        <?php } else { ?>
          <tr>
            <td colspan="8" class="text-center">No hay reservas registradas.</td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>

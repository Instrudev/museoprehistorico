<?php
$reservationDetail = $reservationDetail ?? null;
$isEditing = $isEditing ?? false;
$status = $_GET['status'] ?? '';
$allowedPeople = Reserva::allowedPeople();
$allowedTours = Reserva::allowedTours();
$allowedPayments = Reserva::allowedPayments();
$actionValue = $isEditing ? 'update' : 'create';

$value = static function (string $key, string $default = '') use ($reservationDetail): string {
    if (!$reservationDetail || !isset($reservationDetail[$key])) {
        return $default;
    }
    return (string) $reservationDetail[$key];
};
?>

<?php if ($status === 'invalid') { ?>
  <div class="alert alert-danger">Completa todos los campos obligatorios con datos válidos.</div>
<?php } ?>

<div class="card">
  <div class="card-body">
    <?php if ($isEditing && !$reservationDetail) { ?>
      <div class="alert alert-warning">No se encontró la reserva solicitada.</div>
    <?php } else { ?>
      <form action="/controllers/AdminReservaController.php" method="post">
        <input type="hidden" name="action" value="<?php echo $actionValue; ?>">
        <?php if ($isEditing && $reservationDetail) { ?>
          <input type="hidden" name="id" value="<?php echo (int) $reservationDetail['id']; ?>">
        <?php } ?>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label>Nombre completo *</label>
            <input type="text" class="form-control" name="full_name" required value="<?php echo htmlspecialchars($value('full_name'), ENT_QUOTES, 'UTF-8'); ?>">
          </div>
          <div class="form-group col-md-6">
            <label>Teléfono *</label>
            <input type="text" class="form-control" name="phone" required value="<?php echo htmlspecialchars($value('phone'), ENT_QUOTES, 'UTF-8'); ?>">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-4">
            <label>Fecha de visita *</label>
            <input type="date" class="form-control" name="visit_date" required value="<?php echo htmlspecialchars($value('visit_date'), ENT_QUOTES, 'UTF-8'); ?>">
          </div>
          <div class="form-group col-md-4">
            <label>Número de personas *</label>
            <select class="form-control" name="num_people" required>
              <option value="">Selecciona</option>
              <?php foreach ($allowedPeople as $option) { ?>
                <option value="<?php echo htmlspecialchars($option, ENT_QUOTES, 'UTF-8'); ?>" <?php echo $value('num_people') === $option ? 'selected' : ''; ?>>
                  <?php echo htmlspecialchars($option, ENT_QUOTES, 'UTF-8'); ?>
                </option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group col-md-4">
            <label>Tipo de recorrido *</label>
            <select class="form-control" name="tour_type" required>
              <option value="">Selecciona</option>
              <?php foreach ($allowedTours as $option) { ?>
                <option value="<?php echo htmlspecialchars($option, ENT_QUOTES, 'UTF-8'); ?>" <?php echo $value('tour_type') === $option ? 'selected' : ''; ?>>
                  <?php echo htmlspecialchars($option, ENT_QUOTES, 'UTF-8'); ?>
                </option>
              <?php } ?>
            </select>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-4">
            <label>Método de pago *</label>
            <select class="form-control" name="payment" required>
              <option value="">Selecciona</option>
              <?php foreach ($allowedPayments as $option) { ?>
                <option value="<?php echo htmlspecialchars($option, ENT_QUOTES, 'UTF-8'); ?>" <?php echo $value('payment_method') === $option ? 'selected' : ''; ?>>
                  <?php echo htmlspecialchars($option, ENT_QUOTES, 'UTF-8'); ?>
                </option>
              <?php } ?>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label>Accesibilidad</label>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="accessibility_wheelchair" id="wheelchair" <?php echo $value('accessibility_wheelchair') ? 'checked' : ''; ?>>
            <label class="form-check-label" for="wheelchair">Acceso para silla de ruedas</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="accessibility_sign_language" id="sign-language" <?php echo $value('accessibility_sign_language') ? 'checked' : ''; ?>>
            <label class="form-check-label" for="sign-language">Intérprete de lengua de señas</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="accessibility_visual_impairment" id="visual-impairment" <?php echo $value('accessibility_visual_impairment') ? 'checked' : ''; ?>>
            <label class="form-check-label" for="visual-impairment">Asistencia para discapacidad visual</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="accessibility_autism" id="autism" <?php echo $value('accessibility_autism') ? 'checked' : ''; ?>>
            <label class="form-check-label" for="autism">Recorrido adaptado para autismo</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="accessibility_senior" id="senior" <?php echo $value('accessibility_senior') ? 'checked' : ''; ?>>
            <label class="form-check-label" for="senior">Recorrido para adultos mayores</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="accessibility_cognitive" id="cognitive" <?php echo $value('accessibility_cognitive') ? 'checked' : ''; ?>>
            <label class="form-check-label" for="cognitive">Discapacidad cognitiva</label>
          </div>
        </div>
        <div class="form-group">
          <label>Notas adicionales</label>
          <textarea class="form-control" name="special_notes" rows="3"><?php echo htmlspecialchars($value('special_notes'), ENT_QUOTES, 'UTF-8'); ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">
          <?php echo $isEditing ? 'Actualizar reserva' : 'Crear reserva'; ?>
        </button>
        <a href="/admin/index.php?page=reservas" class="btn btn-secondary">Cancelar</a>
      </form>
    <?php } ?>
  </div>
</div>

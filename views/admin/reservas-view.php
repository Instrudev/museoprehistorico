<?php
$reservationDetail = $reservationDetail ?? null;
?>

<div class="card">
  <div class="card-body">
    <?php if (!$reservationDetail) { ?>
      <div class="alert alert-warning">No se encontró la reserva solicitada.</div>
    <?php } else { ?>
      <dl class="row">
        <dt class="col-sm-4">Nombre completo</dt>
        <dd class="col-sm-8"><?php echo htmlspecialchars($reservationDetail['full_name'], ENT_QUOTES, 'UTF-8'); ?></dd>

        <dt class="col-sm-4">Teléfono</dt>
        <dd class="col-sm-8"><?php echo htmlspecialchars($reservationDetail['phone'], ENT_QUOTES, 'UTF-8'); ?></dd>

        <dt class="col-sm-4">Fecha de visita</dt>
        <dd class="col-sm-8"><?php echo htmlspecialchars($reservationDetail['visit_date'], ENT_QUOTES, 'UTF-8'); ?></dd>

        <dt class="col-sm-4">Número de personas</dt>
        <dd class="col-sm-8"><?php echo htmlspecialchars($reservationDetail['num_people'], ENT_QUOTES, 'UTF-8'); ?></dd>

        <dt class="col-sm-4">Tipo de recorrido</dt>
        <dd class="col-sm-8"><?php echo htmlspecialchars($reservationDetail['tour_type'], ENT_QUOTES, 'UTF-8'); ?></dd>

        <dt class="col-sm-4">Método de pago</dt>
        <dd class="col-sm-8"><?php echo htmlspecialchars($reservationDetail['payment_method'], ENT_QUOTES, 'UTF-8'); ?></dd>

        <dt class="col-sm-4">Accesibilidad</dt>
        <dd class="col-sm-8">
          <ul class="mb-0">
            <?php if ($reservationDetail['accessibility_wheelchair']) { ?><li>Silla de ruedas</li><?php } ?>
            <?php if ($reservationDetail['accessibility_sign_language']) { ?><li>Intérprete de señas</li><?php } ?>
            <?php if ($reservationDetail['accessibility_visual_impairment']) { ?><li>Discapacidad visual</li><?php } ?>
            <?php if ($reservationDetail['accessibility_autism']) { ?><li>Autismo</li><?php } ?>
            <?php if ($reservationDetail['accessibility_senior']) { ?><li>Adulto mayor</li><?php } ?>
            <?php if ($reservationDetail['accessibility_cognitive']) { ?><li>Discapacidad cognitiva</li><?php } ?>
            <?php if (
                !$reservationDetail['accessibility_wheelchair'] &&
                !$reservationDetail['accessibility_sign_language'] &&
                !$reservationDetail['accessibility_visual_impairment'] &&
                !$reservationDetail['accessibility_autism'] &&
                !$reservationDetail['accessibility_senior'] &&
                !$reservationDetail['accessibility_cognitive']
            ) { ?>
              <li>Sin necesidades especiales</li>
            <?php } ?>
          </ul>
        </dd>

        <dt class="col-sm-4">Notas adicionales</dt>
        <dd class="col-sm-8"><?php echo htmlspecialchars($reservationDetail['special_notes'] ?? 'Sin notas', ENT_QUOTES, 'UTF-8'); ?></dd>

        <dt class="col-sm-4">Creada</dt>
        <dd class="col-sm-8"><?php echo htmlspecialchars($reservationDetail['created_at'], ENT_QUOTES, 'UTF-8'); ?></dd>

        <dt class="col-sm-4">Última actualización</dt>
        <dd class="col-sm-8"><?php echo htmlspecialchars($reservationDetail['updated_at'], ENT_QUOTES, 'UTF-8'); ?></dd>
      </dl>
    <?php } ?>
  </div>
  <div class="card-footer">
    <a href="/admin/index.php?page=reservas" class="btn btn-secondary">Volver</a>
    <?php if ($reservationDetail) { ?>
      <a href="/admin/index.php?page=reserva-editar&id=<?php echo (int) $reservationDetail['id']; ?>" class="btn btn-warning">
        Editar
      </a>
    <?php } ?>
  </div>
</div>

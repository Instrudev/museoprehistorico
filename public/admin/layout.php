<?php

declare(strict_types=1);

$pageTitle = $pageTitle ?? 'Panel administrativo';
$content = $content ?? '';
$activePage = $activePage ?? '';

function admin_nav_active(string $current, string $target): string
{
    return $current === $target ? 'active' : '';
}
?>
<!doctype html>
<html lang="es">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8'); ?> | Museo Prehistórico</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  </head>
  <body class="hold-transition sidebar-mini">
    <div class="wrapper">
      <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button" aria-label="Alternar menú">
              <i class="fas fa-bars"></i>
            </a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
            <a href="/admin/dashboard.php" class="nav-link">Inicio</a>
          </li>
        </ul>
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a href="/admin/logout.php" class="nav-link">
              <i class="fas fa-sign-out-alt"></i> Cerrar sesión
            </a>
          </li>
        </ul>
      </nav>

      <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="/admin/dashboard.php" class="brand-link">
          <span class="brand-text font-weight-light">Museo Prehistórico</span>
        </a>
        <div class="sidebar">
          <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
              <li class="nav-item">
                <a href="/admin/dashboard.php" class="nav-link <?php echo admin_nav_active($activePage, 'dashboard'); ?>">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>Dashboard</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/reservations_pending.php" class="nav-link <?php echo admin_nav_active($activePage, 'reservations_pending'); ?>">
                  <i class="nav-icon fas fa-clock"></i>
                  <p>Reservas Pendientes</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/reservations_all.php" class="nav-link <?php echo admin_nav_active($activePage, 'reservations_all'); ?>">
                  <i class="nav-icon fas fa-calendar-check"></i>
                  <p>Reservas (todas)</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/users.php" class="nav-link <?php echo admin_nav_active($activePage, 'users'); ?>">
                  <i class="nav-icon fas fa-users"></i>
                  <p>Usuarios</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/logout.php" class="nav-link">
                  <i class="nav-icon fas fa-sign-out-alt"></i>
                  <p>Salir</p>
                </a>
              </li>
            </ul>
          </nav>
        </div>
      </aside>

      <div class="content-wrapper">
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1><?php echo htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8'); ?></h1>
              </div>
            </div>
          </div>
        </section>

        <section class="content">
          <div class="container-fluid">
            <?php echo $content; ?>
          </div>
        </section>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
  </body>
</html>

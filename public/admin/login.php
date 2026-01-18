<?php

declare(strict_types=1);

require_once __DIR__ . '/bootstrap.php';

if (!empty($_SESSION['admin_user_id'])) {
    admin_redirect('/admin/dashboard.php');
}

$errorMessage = admin_flash_get('error');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = (string) filter_input(INPUT_POST, 'csrf_token', FILTER_UNSAFE_RAW);

    if (!admin_csrf_validate($token)) {
        admin_flash_set('error', 'La sesión expiró. Inténtalo nuevamente.');
        admin_redirect('/admin/login.php');
    }

    $identifier = trim((string) filter_input(INPUT_POST, 'identifier', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $password = (string) filter_input(INPUT_POST, 'password', FILTER_UNSAFE_RAW);

    if ($identifier === '' || $password === '') {
        admin_flash_set('error', 'Completa todos los campos.');
        admin_redirect('/admin/login.php');
    }

    $userModel = new User();

    if (!$userModel->exists()) {
        admin_flash_set('error', 'No se encontró la tabla de usuarios. Ejecuta las migraciones.');
        admin_redirect('/admin/login.php');
    }

    $user = $userModel->findByIdentifier($identifier);

    if (!$user || !$userModel->verifyPassword($user, $password)) {
        admin_flash_set('error', 'Las credenciales no son válidas.');
        admin_redirect('/admin/login.php');
    }

    $_SESSION['admin_user_id'] = $user['id'] ?? null;
    $_SESSION['admin_user_name'] = $user['name'] ?? $user['email'] ?? 'Administrador';

    admin_redirect('/admin/dashboard.php');
}

$csrfToken = admin_csrf_token();
?>
<!doctype html>
<html lang="es">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingreso administrativo | Museo Prehistórico</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  </head>
  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <b>Museo</b> Prehistórico
      </div>
      <div class="card">
        <div class="card-body login-card-body">
          <p class="login-box-msg">Ingresa con tus credenciales administrativas</p>

          <?php if ($errorMessage) { ?>
            <div class="alert alert-danger" role="alert">
              <?php echo htmlspecialchars($errorMessage, ENT_QUOTES, 'UTF-8'); ?>
            </div>
          <?php } ?>

          <form action="/admin/login.php" method="post">
            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrfToken, ENT_QUOTES, 'UTF-8'); ?>">
            <div class="input-group mb-3">
              <input type="text" name="identifier" class="form-control" placeholder="Email o usuario" required autocomplete="username">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-user"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="password" name="password" class="form-control" placeholder="Contraseña" required autocomplete="current-password">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
  </body>
</html>

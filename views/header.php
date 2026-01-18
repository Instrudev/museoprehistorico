<!doctype html>
<html lang="es" class="h-full">
<head>
  <meta charset="UTF-8">

  <?php
    /**
     * Ajusta BASE_URL UNA SOLA VEZ según tu entorno:
     * - Si abres tu sitio como: http://localhost/museo/
     *   entonces BASE_URL = "/museo"
     * - Si lo abres como: http://museo.test/
     *   entonces BASE_URL = ""
     */
    $BASE_URL = "/museo";  // <-- AJUSTA AQUÍ
  ?>

  <link rel="icon" type="image/x-icon" href="<?= $BASE_URL ?>/public/assets/img/logo.png">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Museo Prehistórico Huilassik Park para la Paz</title>

  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>

  <style>
    /* Base */
    html, body { height: 100%; }
    body {
      box-sizing: border-box;
      font-family: 'Montserrat', sans-serif;
    }

    /* HERO: SOLO IMAGEN (sin degradados, sin colores) */
    .gradient-hero{
      min-height: clamp(520px, 70vh, 860px);
      background-image: url("<?= $BASE_URL ?>/public/assets/img/fondo.png");
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
    }

    /* Utilidades visuales */
    .card-shadow { box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08); }

    .btn-primary {
      transition: all 0.3s ease;
    }
    .btn-primary:hover{
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(0,0,0,0.15);
    }

    /* Accesibilidad */
    .dark-mode { background-color: #1a1a1a; color: #ffffff; }
    .dark-mode .card-shadow{
      background-color: #2a2a2a;
      box-shadow: 0 4px 20px rgba(255, 255, 255, 0.1);
    }
    .high-contrast{ filter: contrast(1.5); }
    .easy-read{ font-size: 120%; line-height: 1.8; }

    /* Layout SPA */
    #spa-container { overflow-y: auto; overflow-x: hidden; }
    .section-panel { min-height: 100%; }

    .nav-btn { background: none; border: none; cursor: pointer; padding: 0; }
  </style>

  <style>
    @view-transition { navigation: auto; }
  </style>
</head>

<body class="h-full overflow-auto">
  <div id="main-wrapper" class="w-full h-full">

    <!-- Barra de Accesibilidad Fija -->
    <div id="accessibility-bar"
         class="fixed top-0 left-0 right-0 z-50 bg-white shadow-md py-3 px-6 border-b-2"
         style="border-color:#FADD66;">
      <div class="max-w-7xl mx-auto flex items-center justify-between">
        <div class="flex items-center space-x-2">
          <span class="font-semibold text-sm mr-2" style="color:#68420F;">Accesibilidad:</span>
          <button id="btn-font-increase" class="w-10 h-10 rounded-full font-bold text-sm transition hover:opacity-80"
                  style="background-color:#FADD66; color:#68420F;" aria-label="Aumentar tamaño de fuente">A+</button>
          <button id="btn-font-decrease" class="w-10 h-10 rounded-full font-bold text-sm transition hover:opacity-80"
                  style="background-color:#FADD66; color:#68420F;" aria-label="Disminuir tamaño de fuente">A-</button>
          <button id="btn-contrast" class="w-10 h-10 rounded-full font-bold text-sm transition hover:opacity-80"
                  style="background-color:#FADD66; color:#68420F;" aria-label="Alto contraste">◐</button>
          <button id="btn-easy-read" class="w-10 h-10 rounded-full font-bold text-sm transition hover:opacity-80"
                  style="background-color:#FADD66; color:#68420F;" aria-label="Lectura fácil">📖</button>
        </div>

        <div class="flex items-center space-x-2">
          <span class="font-semibold text-sm mr-2" style="color:#68420F;">Idioma:</span>
          <button id="btn-lang-es" class="px-4 py-2 rounded-full font-bold text-sm transition hover:opacity-80"
                  style="background-color:#F07F1A; color:white;" aria-label="Español">ES</button>
          <button id="btn-lang-en" class="px-4 py-2 rounded-full font-bold text-sm transition hover:opacity-80"
                  style="background-color:#FADD66; color:#68420F;" aria-label="English">EN</button>
          <button id="btn-lang-fr" class="px-4 py-2 rounded-full font-bold text-sm transition hover:opacity-80"
                  style="background-color:#FADD66; color:#68420F;" aria-label="Français">FR</button>
        </div>
      </div>
    </div>

    <!-- Header Superior con margen para barra fija -->
    <header class="w-full bg-white border-b-2 border-gray-100 py-4 px-6" style="margin-top:60px;">
      <div class="max-w-7xl mx-auto flex items-center justify-between">
        <div class="flex items-center space-x-8">
          <img
            id="museum-name"
            class="cursor-pointer"
            src="<?= $BASE_URL ?>/public/assets/img/Logo%20Letra.png"
            style="width:120px;"
            alt="Museo Prehistórico Huilassik Park para la Paz"
          >

          <nav class="hidden md:flex space-x-6">
            <a class="nav-btn font-medium hover:text-orange-500 transition" style="color:#68420F;"
               href="<?= $BASE_URL ?>/public/index.php?page=inicio">Inicio</a>

            <a class="nav-btn font-medium hover:text-orange-500 transition" style="color:#68420F;"
               href="<?= $BASE_URL ?>/public/index.php?page=reservas">Reservas</a>

            <a class="nav-btn font-medium hover:text-orange-500 transition" style="color:#68420F;"
               href="<?= $BASE_URL ?>/public/index.php?page=dinosaurios">Dinosaurios</a>

            <a class="nav-btn font-medium hover:text-orange-500 transition" style="color:#68420F;"
               href="<?= $BASE_URL ?>/public/index.php?page=experiencias">Experiencias</a>

            <a class="nav-btn font-medium hover:text-orange-500 transition" style="color:#68420F;"
               href="<?= $BASE_URL ?>/public/index.php?page=mapa">Mapa</a>

            <a class="nav-btn font-medium hover:text-orange-500 transition" style="color:#68420F;"
               href="<?= $BASE_URL ?>/public/index.php?page=eventos">Eventos</a>
          </nav>
        </div>

        <div class="flex items-center">
          <a href="<?= $BASE_URL ?>/views/admin/login.php"
             class="px-4 py-2 rounded-full font-bold text-sm transition hover:opacity-80"
             style="background-color:#F07F1A; color:white;">
            Ingresar
          </a>
        </div>
      </div>
    </header>

    <!-- Contenedor SPA -->
    <main id="spa-container" class="w-full" style="height: calc(100% - 60px - 72px);">

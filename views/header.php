<!doctype html>
<html lang="es" class="h-full">
 <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Museo Prehistórico Huilassik Park para la Paz</title>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&amp;display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="/_sdk/element_sdk.js"></script>
  <style>
    body {
      box-sizing: border-box;
      font-family: 'Montserrat', sans-serif;
    }
    
    .gradient-hero {
      background: linear-gradient(135deg, #FADD66 0%, #F07F1A 100%);
    }
    
    .gradient-section {
      background: linear-gradient(180deg, #FFF9E6 0%, #FFFBF0 100%);
    }
    
    .card-shadow {
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    }
    
    .btn-primary {
      transition: all 0.3s ease;
    }
    
    .btn-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
    }
    
    .dark-mode {
      background-color: #1a1a1a;
      color: #ffffff;
    }
    
    .dark-mode .card-shadow {
      background-color: #2a2a2a;
      box-shadow: 0 4px 20px rgba(255, 255, 255, 0.1);
    }
    
    .high-contrast {
      filter: contrast(1.5);
    }
    
    .easy-read {
      font-size: 120%;
      line-height: 1.8;
    }
    
    #spa-container {
      overflow-y: auto;
      overflow-x: hidden;
    }
    
    .section-panel {
      min-height: 100%;
    }
    
    .nav-btn {
      background: none;
      border: none;
      cursor: pointer;
      padding: 0;
    }
  </style>
  <style>@view-transition { navigation: auto; }</style>
  <script src="/_sdk/data_sdk.js" type="text/javascript"></script>
 </head>
 <body class="h-full overflow-auto">
  <div id="main-wrapper" class="w-full h-full"><!-- Barra de Accesibilidad Fija -->
   <div id="accessibility-bar" class="fixed top-0 left-0 right-0 z-50 bg-white shadow-md py-3 px-6 border-b-2" style="border-color: #FADD66;">
    <div class="max-w-7xl mx-auto flex items-center justify-between">
     <div class="flex items-center space-x-2"><span class="font-semibold text-sm mr-2" style="color: #68420F;">Accesibilidad:</span> <button id="btn-font-increase" class="w-10 h-10 rounded-full font-bold text-sm transition hover:opacity-80" style="background-color: #FADD66; color: #68420F;" aria-label="Aumentar tamaño de fuente">A+</button> <button id="btn-font-decrease" class="w-10 h-10 rounded-full font-bold text-sm transition hover:opacity-80" style="background-color: #FADD66; color: #68420F;" aria-label="Disminuir tamaño de fuente">A-</button> <button id="btn-contrast" class="w-10 h-10 rounded-full font-bold text-sm transition hover:opacity-80" style="background-color: #FADD66; color: #68420F;" aria-label="Alto contraste">◐</button> <button id="btn-easy-read" class="w-10 h-10 rounded-full font-bold text-sm transition hover:opacity-80" style="background-color: #FADD66; color: #68420F;" aria-label="Lectura fácil">📖</button>
     </div>
     <div class="flex items-center space-x-2"><span class="font-semibold text-sm mr-2" style="color: #68420F;">Idioma:</span> <button id="btn-lang-es" class="px-4 py-2 rounded-full font-bold text-sm transition hover:opacity-80" style="background-color: #F07F1A; color: white;" aria-label="Español">ES</button> <button id="btn-lang-en" class="px-4 py-2 rounded-full font-bold text-sm transition hover:opacity-80" style="background-color: #FADD66; color: #68420F;" aria-label="English">EN</button> <button id="btn-lang-fr" class="px-4 py-2 rounded-full font-bold text-sm transition hover:opacity-80" style="background-color: #FADD66; color: #68420F;" aria-label="Français">FR</button>
     </div>
    </div>
   </div><!-- Header Superior con margen para barra fija -->
   <header class="w-full bg-white border-b-2 border-gray-100 py-4 px-6" style="margin-top: 60px;">
    <div class="max-w-7xl mx-auto flex items-center justify-between">
     <div class="flex items-center space-x-8">
      <h1 id="museum-name" class="text-2xl font-bold cursor-pointer" style="color: #68420F;">Museo Prehistórico</h1>
      <nav class="hidden md:flex space-x-6"><button class="nav-btn font-medium hover:text-orange-500 transition" style="color: #68420F;" data-section="inicio">Inicio</button> <button class="nav-btn font-medium hover:text-orange-500 transition" style="color: #68420F;" data-section="reservas">Reservas</button> <button class="nav-btn font-medium hover:text-orange-500 transition" style="color: #68420F;" data-section="dinosaurios">Dinosaurios</button> <button class="nav-btn font-medium hover:text-orange-500 transition" style="color: #68420F;" data-section="experiencias">Experiencias</button> <button class="nav-btn font-medium hover:text-orange-500 transition" style="color: #68420F;" data-section="mapa">Mapa</button> <button class="nav-btn font-medium hover:text-orange-500 transition" style="color: #68420F;" data-section="tarifas">Tarifas</button> <button class="nav-btn font-medium hover:text-orange-500 transition" style="color: #68420F;" data-section="eventos">Eventos</button>
      </nav>
     </div>
    </div>
   </header><!-- Contenedor SPA -->
   <main id="spa-container" class="w-full" style="height: calc(100% - 60px - 72px);">

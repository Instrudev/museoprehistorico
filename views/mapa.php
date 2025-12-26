<section id="mapa" class="section-panel py-16 px-6 gradient-section">
     <div class="max-w-6xl mx-auto">
      <h3 class="text-4xl font-bold mb-4 text-center" style="color: #68420F;">🌍 Línea del Tiempo: La Evolución de la Vida</h3>
      <p class="text-center text-lg mb-10" style="color: #68420F;">Desde los primeros seres vivos hasta el ser humano</p><!-- Línea del tiempo horizontal interactiva -->
      <div class="bg-white rounded-3xl card-shadow p-8 mb-8">
       <div class="relative" style="padding: 40px 0;"><!-- Línea principal -->
        <div class="absolute left-0 right-0 h-2 top-1/2 transform -translate-y-1/2 rounded-full" style="background: linear-gradient(90deg, #68420F 0%, #F07F1A 50%, #FADD66 100%);"></div><!-- Etapas evolutivas -->
        <div class="relative grid grid-cols-7 gap-2"><!-- Invertebrados --> <button class="evolution-stage flex flex-col items-center" data-stage="invertebrados">
          <div class="w-16 h-16 rounded-full flex items-center justify-center text-3xl mb-3 transition hover:scale-110 cursor-pointer shadow-lg" style="background-color: #68420F;">
           🦠
          </div><span class="text-xs font-bold text-center" style="color: #68420F;">Invertebrados</span> <span class="text-xs text-center" style="color: #F07F1A;">600 M años</span> </button> <!-- Vertebrados --> <button class="evolution-stage flex flex-col items-center" data-stage="vertebrados">
          <div class="w-16 h-16 rounded-full flex items-center justify-center text-3xl mb-3 transition hover:scale-110 cursor-pointer shadow-lg" style="background-color: #8B5A2B;">
           🐟
          </div><span class="text-xs font-bold text-center" style="color: #68420F;">Vertebrados</span> <span class="text-xs text-center" style="color: #F07F1A;">530 M años</span> </button> <!-- Anfibios --> <button class="evolution-stage flex flex-col items-center" data-stage="anfibios">
          <div class="w-16 h-16 rounded-full flex items-center justify-center text-3xl mb-3 transition hover:scale-110 cursor-pointer shadow-lg" style="background-color: #A67C52;">
           🐸
          </div><span class="text-xs font-bold text-center" style="color: #68420F;">Anfibios</span> <span class="text-xs text-center" style="color: #F07F1A;">370 M años</span> </button> <!-- Reptiles --> <button class="evolution-stage flex flex-col items-center" data-stage="reptiles">
          <div class="w-16 h-16 rounded-full flex items-center justify-center text-3xl mb-3 transition hover:scale-110 cursor-pointer shadow-lg" style="background-color: #C4944E;">
           🦎
          </div><span class="text-xs font-bold text-center" style="color: #68420F;">Reptiles</span> <span class="text-xs text-center" style="color: #F07F1A;">320 M años</span> </button> <!-- Dinosaurios --> <button class="evolution-stage flex flex-col items-center" data-stage="dinosaurios">
          <div class="w-16 h-16 rounded-full flex items-center justify-center text-3xl mb-3 transition hover:scale-110 cursor-pointer shadow-lg" style="background-color: #F07F1A;">
           🦖
          </div><span class="text-xs font-bold text-center" style="color: #68420F;">Dinosaurios</span> <span class="text-xs text-center" style="color: #F07F1A;">230 M años</span> </button> <!-- Aves y Mamíferos --> <button class="evolution-stage flex flex-col items-center" data-stage="aves-mamiferos">
          <div class="w-16 h-16 rounded-full flex items-center justify-center text-3xl mb-3 transition hover:scale-110 cursor-pointer shadow-lg" style="background-color: #FADD66;">
           🦅
          </div><span class="text-xs font-bold text-center" style="color: #68420F;">Aves/Mamíferos</span> <span class="text-xs text-center" style="color: #F07F1A;">200 M años</span> </button> <!-- Humanos --> <button class="evolution-stage flex flex-col items-center" data-stage="humanos">
          <div class="w-16 h-16 rounded-full flex items-center justify-center text-3xl mb-3 transition hover:scale-110 cursor-pointer shadow-lg" style="background-color: #FFE87C;">
           👨
          </div><span class="text-xs font-bold text-center" style="color: #68420F;">Humanos</span> <span class="text-xs text-center" style="color: #F07F1A;">2.5 M años</span> </button>
        </div>
       </div>
      </div><!-- Panel de información detallada -->
      <div id="evolution-info-panel" class="bg-white rounded-3xl card-shadow p-8">
       <div class="text-center mb-6">
        <div id="evolution-icon" class="text-8xl mb-4">
         🦖
        </div>
        <h4 id="evolution-title" class="text-3xl font-bold mb-2" style="color: #68420F;">Dinosaurios</h4>
        <p id="evolution-period" class="text-lg font-semibold" style="color: #F07F1A;">Era Mesozoica (230-66 millones de años)</p>
       </div>
       <div class="mb-6">
        <p id="evolution-description" class="text-lg mb-4 text-center" style="color: #68420F;">Los dinosaurios dominaron la Tierra durante más de 160 millones de años. Fueron los animales terrestres más exitosos de todos los tiempos.</p>
       </div>
       <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="rounded-2xl p-6" style="background-color: #FFF9E6;">
         <h5 class="font-bold text-lg mb-3 flex items-center gap-2" style="color: #F07F1A;">🔍 Características Principales</h5>
         <ul id="evolution-characteristics" class="space-y-2 text-sm" style="color: #68420F;">
          <li>• Patas ubicadas debajo del cuerpo</li>
          <li>• Piel escamosa o con plumas</li>
          <li>• Ponían huevos</li>
          <li>• Sangre caliente en muchas especies</li>
         </ul>
        </div>
        <div class="rounded-2xl p-6" style="background-color: #FFF9E6;">
         <h5 class="font-bold text-lg mb-3 flex items-center gap-2" style="color: #F07F1A;">🌟 Ejemplos Destacados</h5>
         <ul id="evolution-examples" class="space-y-2 text-sm" style="color: #68420F;">
          <li>• Tiranosaurio Rex (carnívoro)</li>
          <li>• Triceratops (herbívoro)</li>
          <li>• Velociraptor (cazador)</li>
          <li>• Brachiosaurus (gigante)</li>
         </ul>
        </div>
       </div>
       <div class="mt-6 rounded-2xl p-6" style="background: linear-gradient(135deg, #FADD66 0%, #F07F1A 100%);">
        <div class="flex items-start gap-4">
         <div class="text-4xl">
          💡
         </div>
         <div class="flex-1">
          <h5 class="font-bold text-lg mb-2 text-white">Dato Importante</h5>
          <p id="evolution-fact" class="text-white text-sm">Los dinosaurios no se extinguieron completamente: las aves modernas son descendientes directos de dinosaurios terópodos, por lo que técnicamente los dinosaurios aún viven entre nosotros.</p>
         </div>
        </div>
       </div>
      </div>
     </div>
    </section><!-- Tarifas Accesibles - ACTUALIZADO -->

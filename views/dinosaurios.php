<section id="dinosaurios" class="section-panel py-16 px-6 gradient-section">
     <div class="max-w-6xl mx-auto">
      <h3 class="text-4xl font-bold mb-10 text-center" style="color: #68420F;">🦕 Nuestros Dinosaurios</h3><!-- Tarjeta principal del dinosaurio -->
      <div class="bg-white rounded-3xl card-shadow p-8 mb-8">
       <div class="grid grid-cols-1 md:grid-cols-2 gap-8"><!-- Lado izquierdo: Visual y audio -->
        <div class="text-center">
         <div id="dino-emoji" class="text-9xl mb-4">
          🦖
         </div>
         <div class="flex gap-4 justify-center mb-6 flex-wrap"><button id="btn-dino-sound" class="btn-primary px-6 py-3 rounded-full text-white font-semibold flex items-center gap-2" style="background-color: #F07F1A;" aria-label="Reproducir sonido del dinosaurio"> 🔊 Escuchar Rugido </button> <button id="btn-audio-description" class="btn-primary px-6 py-3 rounded-full text-white font-semibold flex items-center gap-2" style="background-color: #25D366;" aria-label="Descripción de audio"> 🎧 Descripción </button>
         </div><!-- Comparación de tamaño -->
         <div class="rounded-2xl p-6" style="background-color: #FFF9E6;">
          <h5 class="font-bold mb-4" style="color: #68420F;">📏 Comparación de Tamaño</h5>
          <div class="flex items-end justify-center gap-4">
           <div class="text-center">
            <div class="text-4xl mb-2">
             🧍
            </div>
            <p class="text-xs font-semibold" style="color: #68420F;">Humano<br>
             1.7m</p>
           </div>
           <div class="text-center">
            <div id="dino-size-emoji" class="text-6xl mb-2">
             🦖
            </div>
            <p id="dino-size-text" class="text-xs font-semibold" style="color: #F07F1A;">T-Rex<br>
             12m</p>
           </div>
          </div>
         </div>
        </div><!-- Lado derecho: Información -->
        <div>
         <h4 id="dino-name" class="text-4xl font-bold mb-2" style="color: #68420F;">Tiranosaurio Rex</h4>
         <p id="dino-period" class="text-lg font-semibold mb-4" style="color: #F07F1A;">🕐 Cretácico Superior (68-66 millones de años)</p>
         <p id="dino-description" class="text-lg mb-6" style="color: #68420F;">El rey de los dinosaurios carnívoros. Con más de 12 metros de largo y dientes de hasta 30 centímetros, este depredador dominó el período Cretácico.</p><!-- Ficha técnica -->
         <div class="grid grid-cols-2 gap-4 mb-6">
          <div class="rounded-xl p-4" style="background-color: #FFF9E6;">
           <p class="text-sm font-semibold mb-1" style="color: #F07F1A;">Longitud</p>
           <p id="dino-length" class="text-2xl font-bold" style="color: #68420F;">12 metros</p>
          </div>
          <div class="rounded-xl p-4" style="background-color: #FFF9E6;">
           <p class="text-sm font-semibold mb-1" style="color: #F07F1A;">Peso</p>
           <p id="dino-weight" class="text-2xl font-bold" style="color: #68420F;">8 toneladas</p>
          </div>
          <div class="rounded-xl p-4" style="background-color: #FFF9E6;">
           <p class="text-sm font-semibold mb-1" style="color: #F07F1A;">Dieta</p>
           <p id="dino-diet" class="text-2xl font-bold" style="color: #68420F;">🥩 Carnívoro</p>
          </div>
          <div class="rounded-xl p-4" style="background-color: #FFF9E6;">
           <p class="text-sm font-semibold mb-1" style="color: #F07F1A;">Velocidad</p>
           <p id="dino-speed" class="text-2xl font-bold" style="color: #68420F;">40 km/h</p>
          </div>
         </div><!-- Dato curioso -->
         <div class="rounded-2xl p-6 mb-4" style="background-color: #FADD66;">
          <div class="flex items-start gap-3">
           <div class="text-3xl">
            💡
           </div>
           <div class="flex-1">
            <h5 class="font-bold mb-2" style="color: #68420F;">Dato Curioso</h5>
            <p id="dino-fact" class="text-sm" style="color: #68420F;">El T-Rex tenía una de las mordidas más poderosas de todos los animales terrestres, con una fuerza de hasta 6 toneladas por centímetro cuadrado.</p>
           </div>
          </div>
         </div><button id="btn-random-fact" class="btn-primary px-6 py-3 rounded-full text-white font-semibold flex items-center gap-2" style="background-color: #E52621;"> 🎲 Otro Dato Curioso </button>
        </div>
       </div>
      </div><!-- Controles de navegación -->
      <div class="flex flex-col sm:flex-row justify-center items-center gap-4 mb-6"><button id="btn-prev-dino" class="btn-primary px-8 py-4 rounded-full text-white font-bold text-lg flex items-center gap-2" style="background-color: #F07F1A;"> ← Anterior </button>
       <div id="dino-counter" class="px-6 py-3 rounded-full font-bold" style="background-color: #FADD66; color: #68420F;">
        1 / 8
       </div><button id="btn-next-dino" class="btn-primary px-8 py-4 rounded-full text-white font-bold text-lg flex items-center gap-2" style="background-color: #F07F1A;"> Siguiente → </button>
      </div><!-- Indicadores visuales -->
      <div class="flex justify-center gap-3">
       <div class="dino-indicator w-3 h-3 rounded-full transition" data-index="0" style="background-color: #F07F1A;"></div>
       <div class="dino-indicator w-3 h-3 rounded-full transition" data-index="1" style="background-color: #FADD66;"></div>
       <div class="dino-indicator w-3 h-3 rounded-full transition" data-index="2" style="background-color: #FADD66;"></div>
       <div class="dino-indicator w-3 h-3 rounded-full transition" data-index="3" style="background-color: #FADD66;"></div>
       <div class="dino-indicator w-3 h-3 rounded-full transition" data-index="4" style="background-color: #FADD66;"></div>
       <div class="dino-indicator w-3 h-3 rounded-full transition" data-index="5" style="background-color: #FADD66;"></div>
       <div class="dino-indicator w-3 h-3 rounded-full transition" data-index="6" style="background-color: #FADD66;"></div>
       <div class="dino-indicator w-3 h-3 rounded-full transition" data-index="7" style="background-color: #FADD66;"></div>
      </div>
     </div>
    </section><!-- Experiencias Únicas -->

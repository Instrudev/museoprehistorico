<section id="inicio" class="section-panel gradient-hero py-20 px-6">
     <div class="max-w-5xl mx-auto text-center">
          <div class="text-8xl mb-6">
               🦕
          </div>
          <h2 id="hero-title" class="text-5xl md:text-6xl font-bold mb-4" style="color: #68420F;">Descubre el Pasado Prehistórico en Neiva</h2>
          <p id="hero-subtitle" class="text-xl md:text-2xl mb-8 font-medium" style="color: #68420F;">Una experiencia educativa única que combina ciencia, paz y el fascinante mundo de los dinosaurios en un entorno accesible para todos.</p>
          <div class="flex flex-col sm:flex-row gap-4 justify-center"><a id="btn-hero-reservar" class="btn-primary px-8 py-4 rounded-full text-white font-bold text-lg" style="background-color: #E52621;" href="index.php?page=reservas">Reservar Visita</a> <a id="btn-hero-explorar" class="btn-primary px-8 py-4 rounded-full font-bold text-lg" style="background-color: #FADD66; color: #68420F; border: 2px solid #68420F;" href="/public/index.php?page=mapa">Explorar Parque</a>
          </div>
     </div><!-- Vive la Experiencia Video Section -->
    <div class="max-w-4xl mx-auto mt-20">
  <div class="max-w-4xl mx-auto mt-20">
    <h3 class="text-4xl font-bold mb-8 text-center" style="color: #68420F;">🎬 Vive la Experiencia</h3>

    <div class="bg-white rounded-3xl card-shadow p-8">
        <div class="relative rounded-2xl overflow-hidden bg-cover bg-center" 
             style="background-image: url('https://img.youtube.com/vi/lFcXsHrOfgg/hqdefault.jpg'); min-height: 400px;">
            
            <div class="absolute inset-0 bg-black bg-opacity-40"></div>

            <div id="custom-video-overlay" class="absolute inset-0 flex flex-col items-center justify-center z-10">
                <button id="btn-play-custom" class="w-24 h-24 rounded-full text-white text-5xl flex items-center justify-center mb-6 transition hover:scale-110 shadow-lg" 
                        style="background-color: #E52621; border: 4px solid white;" 
                        aria-label="Reproducir video"> ▶ </button>
                <p class="text-white text-xl font-semibold px-6 text-center drop-shadow-lg">Descubre la magia del mundo prehistórico</p>
            </div>

            <div id="custom-video-player" class="absolute inset-0 bg-black z-20" style="display: none;">
                <iframe id="custom-iframe" class="w-full h-full" 
                    src="" 
                    title="Museo Prehistórico Video" 
                    frameborder="0" 
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                    referrerpolicy="strict-origin-when-cross-origin" 
                    allowfullscreen>
                </iframe>
                
                <button id="btn-close-custom" class="absolute top-4 right-4 w-10 h-10 rounded-full bg-black bg-opacity-70 text-white text-xl flex items-center justify-center hover:bg-red-600 transition"> ✕ </button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Usamos IDs únicos para no chocar con otros scripts (como el de Rick Astley)
        const playBtn = document.getElementById('btn-play-custom');
        const closeBtn = document.getElementById('btn-close-custom');
        const playerDiv = document.getElementById('custom-video-player');
        const iframe = document.getElementById('custom-iframe');

        // URL EXACTA de tu video (ID: lFcXsHrOfgg)
        // El 'rel=0' evita que salgan videos de otros canales al final
        const myVideoUrl = "https://www.youtube.com/embed/lFcXsHrOfgg?autoplay=1&rel=0";

        playBtn.addEventListener('click', function() {
            // 1. Mostrar el contenedor negro
            playerDiv.style.display = 'block';
            // 2. Inyectar la URL correcta AHORA (esto evita que cargue Rick Astley antes)
            iframe.src = myVideoUrl;
        });

        closeBtn.addEventListener('click', function() {
            // 1. Ocultar contenedor
            playerDiv.style.display = 'none';
            // 2. Limpiar el src para detener el sonido
            iframe.src = "";
        });
    });
</script>
</section><!-- Módulo de Reserva -->
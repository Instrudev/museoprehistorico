<section id="inicio" class="section-panel gradient-hero py-10 px-6">
    <div class="max-w-6xl mx-auto">
        
        <div class="flex flex-col-reverse lg:flex-row items-center justify-between gap-12">
            
            <div class="w-full lg:w-1/2 text-center lg:text-left space-y-8">
                
                <p id="hero-subtitle" class="text-xl md:text-2xl font-medium leading-relaxed" style="color: #68420F; text-align: justify;">
                    Una experiencia educativa única que combina ciencia, paz y el fascinante mundo de los dinosaurios en un entorno accesible para todos.
                </p>

                <div class="hero-cta-group flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                    <a id="btn-hero-reservar" class="btn-primary hero-cta text-white font-bold text-lg" href="index.php?page=reservas" aria-label="Reservar visita">
                       <img src="<?= $BASE_URL ?>/public/assets/img/reserva.png" alt="Reservar visita">
                    </a> 
                    <a id="btn-hero-explorar" class="btn-primary hero-cta font-bold text-lg"  href="/public/index.php?page=mapa" aria-label="Explorar el parque">
                        <img src="<?= $BASE_URL ?>/public/assets/img/explorar.png" alt="Explorar parque">
                    </a>
                </div>
            </div>

            <div class="w-full lg:w-1/2 flex justify-center lg:justify-end">
                <div class="bg-white rounded-3xl card-shadow p-2 w-fit">
                    <div class="relative rounded-2xl overflow-hidden bg-cover bg-center shadow-inner" 
                         style="background-image: url('https://img.youtube.com/vi/lFcXsHrOfgg/hqdefault.jpg'); width: 100%; min-width: 300px; max-width: 550px; height: 320px;">
                        
                        <div class="absolute inset-0 bg-black bg-opacity-40"></div>

                        <div id="custom-video-overlay" class="absolute inset-0 flex flex-col items-center justify-center z-10">
                            <button id="btn-play-custom" class="w-20 h-20 rounded-full text-white text-4xl flex items-center justify-center mb-4 transition hover:scale-110 shadow-lg hover:bg-red-700" 
                                    style="background-color: #E52621; border: 4px solid white;" 
                                    aria-label="Reproducir video"> ▶ </button>
                            <p class="text-white text-lg font-semibold px-4 text-center drop-shadow-md">Descubre la magia</p>
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
                            
                            <button id="btn-close-custom" class="absolute top-4 right-4 w-10 h-10 rounded-full bg-black bg-opacity-70 text-white text-xl flex items-center justify-center hover:bg-red-600 transition z-30"> ✕ </button>
                        </div>
                    </div>
                </div>
            </div>
            
        </div> </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const playBtn = document.getElementById('btn-play-custom');
            const closeBtn = document.getElementById('btn-close-custom');
            const playerDiv = document.getElementById('custom-video-player');
            const iframe = document.getElementById('custom-iframe');

            // URL del video con autoplay
            const myVideoUrl = "https://www.youtube.com/embed/lFcXsHrOfgg?autoplay=1&rel=0";

            playBtn.addEventListener('click', function() {
                playerDiv.style.display = 'block';
                iframe.src = myVideoUrl;
            });

            closeBtn.addEventListener('click', function() {
                playerDiv.style.display = 'none';
                iframe.src = "";
            });
        });
    </script>
</section>

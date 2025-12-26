document.addEventListener('DOMContentLoaded', () => {
const defaultConfig = {
      museum_name: "Museo Prehistórico",
      hero_title: "Descubre el Pasado Prehistórico en Neiva",
      hero_subtitle: "Una experiencia educativa única que combina ciencia, paz y el fascinante mundo de los dinosaurios en un entorno accesible para todos.",
      footer_description: "Un espacio dedicado a la conservación y difusión del patrimonio paleontológico, promoviendo la educación y la paz a través del conocimiento.",
      contact_email: "info@museohuilassik.com",
      contact_phone: "+57 314 213 9674",
      contact_address: "Calle Principal #123, Ciudad",
      background_color: "#FFF9E6",
      primary_color: "#68420F",
      secondary_color: "#FADD66",
      accent_color: "#F07F1A",
      button_color: "#E52621"
    };

    async function onConfigChange(config) {
      document.getElementById('museum-name').textContent = config.museum_name || defaultConfig.museum_name;
      document.getElementById('hero-title').textContent = config.hero_title || defaultConfig.hero_title;
      document.getElementById('hero-subtitle').textContent = config.hero_subtitle || defaultConfig.hero_subtitle;
      document.getElementById('footer-description').textContent = config.footer_description || defaultConfig.footer_description;
      document.getElementById('contact-email').textContent = config.contact_email || defaultConfig.contact_email;
      document.getElementById('contact-phone').textContent = config.contact_phone || defaultConfig.contact_phone;
      document.getElementById('contact-address').textContent = config.contact_address || defaultConfig.contact_address;
    }

    function mapToCapabilities(config) {
      return {
        recolorables: [
          {
            get: () => config.background_color || defaultConfig.background_color,
            set: (value) => {
              config.background_color = value;
              window.elementSdk.setConfig({ background_color: value });
            }
          },
          {
            get: () => config.primary_color || defaultConfig.primary_color,
            set: (value) => {
              config.primary_color = value;
              window.elementSdk.setConfig({ primary_color: value });
            }
          },
          {
            get: () => config.secondary_color || defaultConfig.secondary_color,
            set: (value) => {
              config.secondary_color = value;
              window.elementSdk.setConfig({ secondary_color: value });
            }
          },
          {
            get: () => config.accent_color || defaultConfig.accent_color,
            set: (value) => {
              config.accent_color = value;
              window.elementSdk.setConfig({ accent_color: value });
            }
          },
          {
            get: () => config.button_color || defaultConfig.button_color,
            set: (value) => {
              config.button_color = value;
              window.elementSdk.setConfig({ button_color: value });
            }
          }
        ],
        borderables: [],
        fontEditable: undefined,
        fontSizeable: undefined
      };
    }

    function mapToEditPanelValues(config) {
      return new Map([
        ["museum_name", config.museum_name || defaultConfig.museum_name],
        ["hero_title", config.hero_title || defaultConfig.hero_title],
        ["hero_subtitle", config.hero_subtitle || defaultConfig.hero_subtitle],
        ["footer_description", config.footer_description || defaultConfig.footer_description],
        ["contact_email", config.contact_email || defaultConfig.contact_email],
        ["contact_phone", config.contact_phone || defaultConfig.contact_phone],
        ["contact_address", config.contact_address || defaultConfig.contact_address]
      ]);
    }

    // Initialize Element SDK
    if (window.elementSdk) {
      window.elementSdk.init({
        defaultConfig,
        onConfigChange,
        mapToCapabilities,
        mapToEditPanelValues
      });
    }

    // SPA Navigation
    let currentSection = 'inicio';
    
    function navigateToSection(sectionId) {
      // Hide all sections
      document.querySelectorAll('.section-panel').forEach(section => {
        section.style.display = 'none';
      });
      
      // Show selected section
      const targetSection = document.getElementById(sectionId);
      if (targetSection) {
        targetSection.style.display = 'block';
        currentSection = sectionId;
        
        // Update active nav button
        document.querySelectorAll('.nav-btn').forEach(btn => {
          if (btn.dataset.section === sectionId) {
            btn.style.color = '#F07F1A';
            btn.style.fontWeight = '700';
          } else {
            btn.style.color = '#68420F';
            btn.style.fontWeight = '500';
          }
        });
        
        // Scroll to top of container
        document.getElementById('spa-container').scrollTop = 0;
      }
    }
    
    // Add click handlers to navigation buttons
    document.querySelectorAll('.nav-btn').forEach(btn => {
      btn.addEventListener('click', () => {
        navigateToSection(btn.dataset.section);
      });
    });
    
    // Museum name click handler
    document.getElementById('museum-name').addEventListener('click', () => {
      navigateToSection('inicio');
    });
    
    // Hero buttons functionality
    document.getElementById('btn-hero-reservar').addEventListener('click', () => {
      navigateToSection('reservas');
    });
    
    document.getElementById('btn-hero-explorar').addEventListener('click', () => {
      navigateToSection('mapa');
    });
    
    // Video player functionality
    document.getElementById('btn-play-video').addEventListener('click', () => {
      const videoPlayer = document.getElementById('video-player');
      const videoIframe = document.getElementById('video-iframe');
      
      // You can replace this URL with an actual video URL (YouTube, Vimeo, etc.)
      videoIframe.src = 'https://www.youtube.com/embed/dQw4w9WgXcQ?autoplay=1';
      
      videoPlayer.style.display = 'block';
    });
    
    document.getElementById('btn-close-video').addEventListener('click', () => {
      const videoPlayer = document.getElementById('video-player');
      const videoIframe = document.getElementById('video-iframe');
      
      videoIframe.src = '';
      videoPlayer.style.display = 'none';
    });

    // Accessibility features
    let fontSize = 100;
    let isHighContrast = false;
    let isEasyRead = false;
    let currentLang = 'es';

    document.getElementById('btn-font-increase').addEventListener('click', () => {
      fontSize = Math.min(fontSize + 10, 150);
      document.documentElement.style.fontSize = fontSize + '%';
      
      // Show notification
      const notification = document.createElement('div');
      notification.className = 'fixed bottom-24 right-6 px-6 py-4 rounded-full text-white font-semibold shadow-lg z-50';
      notification.style.backgroundColor = '#25D366';
      notification.textContent = '✓ Texto más grande: ' + fontSize + '%';
      document.body.appendChild(notification);
      setTimeout(() => notification.remove(), 2000);
    });

    document.getElementById('btn-font-decrease').addEventListener('click', () => {
      fontSize = Math.max(fontSize - 10, 80);
      document.documentElement.style.fontSize = fontSize + '%';
      
      // Show notification
      const notification = document.createElement('div');
      notification.className = 'fixed bottom-24 right-6 px-6 py-4 rounded-full text-white font-semibold shadow-lg z-50';
      notification.style.backgroundColor = '#25D366';
      notification.textContent = '✓ Texto más pequeño: ' + fontSize + '%';
      document.body.appendChild(notification);
      setTimeout(() => notification.remove(), 2000);
    });

    document.getElementById('btn-contrast').addEventListener('click', () => {
      isHighContrast = !isHighContrast;
      document.body.classList.toggle('high-contrast', isHighContrast);
      
      // Show notification
      const notification = document.createElement('div');
      notification.className = 'fixed bottom-24 right-6 px-6 py-4 rounded-full text-white font-semibold shadow-lg z-50';
      notification.style.backgroundColor = '#25D366';
      notification.textContent = isHighContrast ? '✓ Alto contraste activado' : '✓ Contraste normal';
      document.body.appendChild(notification);
      setTimeout(() => notification.remove(), 2000);
    });

    document.getElementById('btn-easy-read').addEventListener('click', () => {
      isEasyRead = !isEasyRead;
      document.body.classList.toggle('easy-read', isEasyRead);
      
      // Show notification
      const notification = document.createElement('div');
      notification.className = 'fixed bottom-24 right-6 px-6 py-4 rounded-full text-white font-semibold shadow-lg z-50';
      notification.style.backgroundColor = '#25D366';
      notification.textContent = isEasyRead ? '✓ Lectura fácil activada' : '✓ Lectura normal';
      document.body.appendChild(notification);
      setTimeout(() => notification.remove(), 2000);
    });

    // Language translations
    const translations = {
      es: {
        museum_name: "Museo Prehistórico",
        hero_title: "Descubre el Pasado Prehistórico en Neiva",
        hero_subtitle: "Una experiencia educativa única que combina ciencia, paz y el fascinante mundo de los dinosaurios en un entorno accesible para todos.",
        btn_reserve: "Reservar Visita",
        btn_explore: "Explorar Parque",
        nav_inicio: "Inicio",
        nav_reservas: "Reservas",
        nav_dinosaurios: "Dinosaurios",
        nav_experiencias: "Experiencias",
        nav_mapa: "Mapa",
        nav_tarifas: "Tarifas",
        nav_eventos: "Eventos",
        accessibility: "Accesibilidad:",
        language: "Idioma:",
        live_experience: "🎬 Vive la Experiencia",
        click_video: "Haz clic para ver el video",
        discover_magic: "Descubre la magia del mundo prehistórico"
      },
      en: {
        museum_name: "Prehistoric Museum",
        hero_title: "Discover the Prehistoric Past in Neiva",
        hero_subtitle: "A unique educational experience that combines science, peace and the fascinating world of dinosaurs in an accessible environment for everyone.",
        btn_reserve: "Book Visit",
        btn_explore: "Explore Park",
        nav_inicio: "Home",
        nav_reservas: "Reservations",
        nav_dinosaurios: "Dinosaurs",
        nav_experiencias: "Experiences",
        nav_mapa: "Map",
        nav_tarifas: "Rates",
        nav_eventos: "Events",
        accessibility: "Accessibility:",
        language: "Language:",
        live_experience: "🎬 Live the Experience",
        click_video: "Click to watch the video",
        discover_magic: "Discover the magic of the prehistoric world"
      },
      fr: {
        museum_name: "Musée Préhistorique",
        hero_title: "Découvrez le Pass�� Préhistorique �� Neiva",
        hero_subtitle: "Une expérience éducative unique qui combine science, paix et le monde fascinant des dinosaures dans un environnement accessible à tous.",
        btn_reserve: "Réserver une Visite",
        btn_explore: "Explorer le Parc",
        nav_inicio: "Accueil",
        nav_reservas: "Réservations",
        nav_dinosaurios: "Dinosaures",
        nav_experiencias: "Expériences",
        nav_mapa: "Carte",
        nav_tarifas: "Tarifs",
        nav_eventos: "Événements",
        accessibility: "Accessibilité:",
        language: "Langue:",
        live_experience: "🎬 Vivez l'Expérience",
        click_video: "Cliquez pour voir la vidéo",
        discover_magic: "Découvrez la magie du monde préhistorique"
      }
    };

    // Language switcher
    function setActiveLanguage(lang) {
      currentLang = lang;
      
      // Reset all buttons
      document.getElementById('btn-lang-es').style.backgroundColor = '#FADD66';
      document.getElementById('btn-lang-es').style.color = '#68420F';
      document.getElementById('btn-lang-en').style.backgroundColor = '#FADD66';
      document.getElementById('btn-lang-en').style.color = '#68420F';
      document.getElementById('btn-lang-fr').style.backgroundColor = '#FADD66';
      document.getElementById('btn-lang-fr').style.color = '#68420F';
      
      // Set active button
      const activeBtn = document.getElementById(`btn-lang-${lang}`);
      activeBtn.style.backgroundColor = '#F07F1A';
      activeBtn.style.color = 'white';
      
      // Translation content based on language
      const content = {
        es: {
          // Hero section
          museum_name: "Museo Prehistórico",
          hero_title: "Descubre el Pasado Prehistórico en Neiva",
          hero_subtitle: "Una experiencia educativa única que combina ciencia, paz y el fascinante mundo de los dinosaurios en un entorno accesible para todos.",
          btn_reserve: "Reservar Visita",
          btn_explore: "Explorar Parque",
          
          // Navigation
          nav_inicio: "Inicio",
          nav_reservas: "Reservas",
          nav_dinosaurios: "Dinosaurios",
          nav_experiencias: "Experiencias",
          nav_mapa: "Mapa",
          nav_tarifas: "Tarifas",
          nav_eventos: "Eventos",
          
          // Accessibility bar
          accessibility: "Accesibilidad:",
          language: "Idioma:",
          
          // Video section
          live_experience: "🎬 Vive la Experiencia",
          discover_magic: "Descubre la magia del mundo prehistórico",
          click_video: "Haz clic para ver el video",
          
          // Dinosaur section
          our_dinosaurs: "🦕 Nuestros Dinosaurios",
          btn_hear_roar: "🔊 Escuchar Rugido",
          btn_description: "🎧 Descripción",
          size_comparison: "📏 Comparación de Tamaño",
          human: "Humano",
          curious_fact: "Dato Curioso",
          btn_another_fact: "🎲 Otro Dato Curioso",
          btn_previous: "← Anterior",
          btn_next: "Siguiente →",
          
          // Common words
          length: "Longitud",
          weight: "Peso",
          diet: "Dieta",
          speed: "Velocidad"
        },
        en: {
          // Hero section
          museum_name: "Prehistoric Museum",
          hero_title: "Discover the Prehistoric Past in Neiva",
          hero_subtitle: "A unique educational experience that combines science, peace and the fascinating world of dinosaurs in an accessible environment for everyone.",
          btn_reserve: "Book Visit",
          btn_explore: "Explore Park",
          
          // Navigation
          nav_inicio: "Home",
          nav_reservas: "Reservations",
          nav_dinosaurios: "Dinosaurs",
          nav_experiencias: "Experiences",
          nav_mapa: "Map",
          nav_tarifas: "Rates",
          nav_eventos: "Events",
          
          // Accessibility bar
          accessibility: "Accessibility:",
          language: "Language:",
          
          // Video section
          live_experience: "🎬 Live the Experience",
          discover_magic: "Discover the magic of the prehistoric world",
          click_video: "Click to watch the video",
          
          // Dinosaur section
          our_dinosaurs: "🦕 Our Dinosaurs",
          btn_hear_roar: "🔊 Hear Roar",
          btn_description: "🎧 Description",
          size_comparison: "📏 Size Comparison",
          human: "Human",
          curious_fact: "Curious Fact",
          btn_another_fact: "🎲 Another Fact",
          btn_previous: "← Previous",
          btn_next: "Next →",
          
          // Common words
          length: "Length",
          weight: "Weight",
          diet: "Diet",
          speed: "Speed"
        },
        fr: {
          // Hero section
          museum_name: "Musée Préhistorique",
          hero_title: "Découvrez le Passé Préhistorique à Neiva",
          hero_subtitle: "Une expérience éducative unique qui combine science, paix et le monde fascinant des dinosaures dans un environnement accessible à tous.",
          btn_reserve: "Réserver une Visite",
          btn_explore: "Explorer le Parc",
          
          // Navigation
          nav_inicio: "Accueil",
          nav_reservas: "Réservations",
          nav_dinosaurios: "Dinosaures",
          nav_experiencias: "Expériences",
          nav_mapa: "Carte",
          nav_tarifas: "Tarifs",
          nav_eventos: "Événements",
          
          // Accessibility bar
          accessibility: "Accessibilité:",
          language: "Langue:",
          
          // Video section
          live_experience: "🎬 Vivez l'Expérience",
          discover_magic: "Découvrez la magie du monde préhistorique",
          click_video: "Cliquez pour voir la vidéo",
          
          // Dinosaur section
          our_dinosaurs: "🦕 Nos Dinosaures",
          btn_hear_roar: "🔊 Écouter le Rugissement",
          btn_description: "🎧 Description",
          size_comparison: "📏 Comparaison de Taille",
          human: "Humain",
          curious_fact: "Fait Curieux",
          btn_another_fact: "🎲 Un Autre Fait",
          btn_previous: "← Précédent",
          btn_next: "Suivant →",
          
          // Common words
          length: "Longueur",
          weight: "Poids",
          diet: "Régime",
          speed: "Vitesse"
        }
      };
      
      const t = content[lang];
      
      // Update hero section
      document.getElementById('museum-name').textContent = t.museum_name;
      document.getElementById('hero-title').textContent = t.hero_title;
      document.getElementById('hero-subtitle').textContent = t.hero_subtitle;
      document.getElementById('btn-hero-reservar').textContent = t.btn_reserve;
      document.getElementById('btn-hero-explorar').textContent = t.btn_explore;
      
      // Update navigation buttons
      const navButtons = document.querySelectorAll('.nav-btn');
      navButtons[0].textContent = t.nav_inicio;
      navButtons[1].textContent = t.nav_reservas;
      navButtons[2].textContent = t.nav_dinosaurios;
      navButtons[3].textContent = t.nav_experiencias;
      navButtons[4].textContent = t.nav_mapa;
      navButtons[5].textContent = t.nav_tarifas;
      navButtons[6].textContent = t.nav_eventos;
      
      // Update accessibility bar
      document.querySelector('#accessibility-bar .flex span:first-child').textContent = t.accessibility;
      document.querySelector('#accessibility-bar .flex:last-child span:first-child').textContent = t.language;
      
      // Update video section
      const videoSection = document.querySelector('#inicio .max-w-4xl');
      if (videoSection) {
        const videoTitle = videoSection.querySelector('h3');
        if (videoTitle) videoTitle.textContent = t.live_experience;
        
        const videoSubtitle = videoSection.querySelector('.absolute p:first-of-type');
        if (videoSubtitle) videoSubtitle.textContent = t.discover_magic;
        
        const videoClick = videoSection.querySelector('.absolute p:last-of-type');
        if (videoClick) videoClick.textContent = t.click_video;
      }
      
      // Update dinosaur section
      const dinoSection = document.querySelector('#dinosaurios h3');
      if (dinoSection) dinoSection.textContent = t.our_dinosaurs;
      
      const btnHearRoar = document.getElementById('btn-dino-sound');
      if (btnHearRoar) btnHearRoar.innerHTML = t.btn_hear_roar;
      
      const btnDescription = document.getElementById('btn-audio-description');
      if (btnDescription) btnDescription.innerHTML = t.btn_description;
      
      const sizeComparisonTitle = document.querySelector('#dinosaurios h5');
      if (sizeComparisonTitle && sizeComparisonTitle.textContent.includes('Comparación') || sizeComparisonTitle && sizeComparisonTitle.textContent.includes('Comparison') || sizeComparisonTitle && sizeComparisonTitle.textContent.includes('Comparaison')) {
        sizeComparisonTitle.textContent = t.size_comparison;
      }
      
      const curiousFact = document.querySelector('#dinosaurios .flex-1 h5');
      if (curiousFact && (curiousFact.textContent.includes('Dato') || curiousFact.textContent.includes('Curious') || curiousFact.textContent.includes('Fait'))) {
        curiousFact.textContent = t.curious_fact;
      }
      
      const btnAnotherFact = document.getElementById('btn-random-fact');
      if (btnAnotherFact) btnAnotherFact.textContent = t.btn_another_fact;
      
      const btnPrevDino = document.getElementById('btn-prev-dino');
      if (btnPrevDino) btnPrevDino.textContent = t.btn_previous;
      
      const btnNextDino = document.getElementById('btn-next-dino');
      if (btnNextDino) btnNextDino.textContent = t.btn_next;
      
      // Update dino stats labels
      const statsLabels = document.querySelectorAll('#dinosaurios .rounded-xl p.text-sm');
      if (statsLabels.length >= 4) {
        statsLabels[0].textContent = t.length;
        statsLabels[1].textContent = t.weight;
        statsLabels[2].textContent = t.diet;
        statsLabels[3].textContent = t.speed;
      }
      
      // Show language notification
      const notification = document.createElement('div');
      notification.className = 'fixed bottom-24 right-6 px-6 py-4 rounded-full text-white font-semibold shadow-lg z-50';
      notification.style.backgroundColor = '#25D366';
      notification.textContent = lang === 'es' ? '✓ Idioma: Español' : lang === 'en' ? '✓ Language: English' : '✓ Langue: Français';
      document.body.appendChild(notification);
      setTimeout(() => notification.remove(), 3000);
    }

    document.getElementById('btn-lang-es').addEventListener('click', () => setActiveLanguage('es'));
    document.getElementById('btn-lang-en').addEventListener('click', () => setActiveLanguage('en'));
    document.getElementById('btn-lang-fr').addEventListener('click', () => setActiveLanguage('fr'));

    // Form submission
    // ============= DINOSAUR CAROUSEL WITH EXPANDED FEATURES =============
    const dinosaurs = [
      { 
        name: 'Tiranosaurio Rex', 
        emoji: '🦖', 
        period: 'Cretácico Superior (68-66 millones de años)',
        description: 'El rey de los dinosaurios carnívoros. Con más de 12 metros de largo y dientes de hasta 30 centímetros, este depredador dominó el período Cretácico.',
        length: '12 metros',
        weight: '8 toneladas',
        diet: '🥩 Carnívoro',
        speed: '40 km/h',
        facts: [
          'El T-Rex tenía una de las mordidas más poderosas de todos los animales terrestres, con una fuerza de hasta 6 toneladas por centímetro cuadrado.',
          'Sus brazos eran sorprendentemente pequeños, midiendo solo 1 metro de largo, pero podían levantar hasta 200 kilogramos.',
          'Tenía un sentido del olfato excepcional, superior incluso al de los perros de rastreo modernos.',
          'Sus dientes se reemplazaban constantemente durante toda su vida, como los tiburones modernos.'
        ]
      },
      { 
        name: 'Triceratops', 
        emoji: '🦕', 
        period: 'Cretácico Superior (68-66 millones de años)',
        description: 'Herbívoro majestuoso con tres cuernos distintivos y una gran gola ósea. Vivió en manadas y se defendía valientemente de los depredadores.',
        length: '9 metros',
        weight: '6 toneladas',
        diet: '🌿 Herbívoro',
        speed: '25 km/h',
        facts: [
          'Su gola ósea podía medir hasta 2 metros de ancho y servía tanto para defensa como para atraer pareja.',
          'Tenía hasta 800 dientes que usaba para masticar plantas duras y fibrosas.',
          'Los cuernos más grandes podían alcanzar 1 metro de longitud y eran armas formidables.',
          'Vivían en manadas familiares que protegían a sus crías del centro del grupo.'
        ]
      },
      { 
        name: 'Velociraptor', 
        emoji: '🦖', 
        period: 'Cretácico Superior (75-71 millones de años)',
        description: 'Pequeño pero feroz cazador que trabajaba en manadas. Conocido por su inteligencia y su característica garra en forma de hoz.',
        length: '2 metros',
        weight: '15 kilogramos',
        diet: '🥩 Carnívoro',
        speed: '60 km/h',
        facts: [
          'Contrario a las películas, los Velociraptors reales tenían plumas y eran del tamaño de un pavo grande.',
          'Su garra curva en cada pata trasera podía girar 180 grados y medir hasta 6.5 centímetros.',
          'Cazaban en grupos coordinados, demostrando comportamiento social complejo.',
          'Tenían uno de los cerebros más grandes en proporción a su cuerpo entre todos los dinosaurios.'
        ]
      },
      { 
        name: 'Brachiosaurus', 
        emoji: '🦕', 
        period: 'Jurásico Superior (154-153 millones de años)',
        description: 'Uno de los dinosaurios más grandes que jamás existió, con un cuello extenso que le permitía alcanzar las copas más altas de los árboles.',
        length: '26 metros',
        weight: '56 toneladas',
        diet: '🌿 Herbívoro',
        speed: '15 km/h',
        facts: [
          'Su cuello medía 9 metros de largo y tenía un sistema especial de bombeo de sangre para llegar al cerebro.',
          'Consumía hasta 400 kilogramos de plantas diariamente para mantener su enorme cuerpo.',
          'Sus fosas nasales estaban en la parte superior de la cabeza, posiblemente para mejorar su sentido del olfato.',
          'A diferencia de otros saurópodos, sus patas delanteras eran más largas que las traseras, dándole una postura única.'
        ]
      },
      { 
        name: 'Stegosaurus', 
        emoji: '🦕', 
        period: 'Jurásico Superior (155-150 millones de años)',
        description: 'Herbívoro distintivo con placas óseas en su espalda y peligrosas púas en su cola. Un dinosaurio icónico del Jurásico.',
        length: '9 metros',
        weight: '5 toneladas',
        diet: '🌿 Herbívoro',
        speed: '7 km/h',
        facts: [
          'Las placas en su espalda podían medir hasta 60 cm de altura y posiblemente servían para regular temperatura.',
          'Su cola armada con púas (llamada "thagomizer") era un arma defensiva mortal que podía perforar huesos.',
          'Tenía un cerebro del tamaño de una nuez, uno de los más pequeños en proporción a su cuerpo.',
          'Las placas dorsales estaban dispuestas en dos filas alternas, no apareadas como se pensaba originalmente.'
        ]
      },
      { 
        name: 'Pteranodon', 
        emoji: '🦅', 
        period: 'Cretácico Superior (86-84 millones de años)',
        description: 'Reptil volador gigante con una envergadura impresionante. Dominaba los cielos prehistóricos cazando peces en océanos antiguos.',
        length: '2 metros',
        weight: '25 kilogramos',
        diet: '🐟 Piscívoro',
        speed: '80 km/h',
        facts: [
          'Su envergadura alar alcanzaba los 7 metros, similar a un avión pequeño moderno.',
          'La cresta en su cabeza podía medir hasta 1 metro y servía como timón durante el vuelo.',
          'No tenía dientes; usaba su largo pico para atrapar peces mientras volaba sobre el agua.',
          'Técnicamente no era un dinosaurio, sino un pterosaurio, pariente volador de los dinosaurios.'
        ]
      },
      { 
        name: 'Ankylosaurus', 
        emoji: '🦕', 
        period: 'Cretácico Superior (68-66 millones de años)',
        description: 'El tanque prehistórico. Totalmente blindado con placas óseas y una cola terminada en una poderosa maza que usaba para defenderse.',
        length: '10 metros',
        weight: '8 toneladas',
        diet: '🌿 Herbívoro',
        speed: '10 km/h',
        facts: [
          'Su armadura era tan gruesa que ni siquiera un T-Rex podía atravesarla con sus poderosas mandíbulas.',
          'La maza en su cola pesaba más de 50 kilogramos y podía romper huesos con un solo golpe.',
          'Tenía párpados blindados con placas óseas para proteger sus ojos durante combates.',
          'Su nombre significa "lagarto fusionado" por las placas óseas fusionadas que cubrían su cuerpo.'
        ]
      },
      { 
        name: 'Spinosaurus', 
        emoji: '🦖', 
        period: 'Cretácico Medio (112-97 millones de años)',
        description: 'El carnívoro más grande conocido, incluso más grande que el T-Rex. Tenía una vela distintiva en su espalda y era semi-acuático.',
        length: '15 metros',
        weight: '10 toneladas',
        diet: '🥩 Carnívoro',
        speed: '24 km/h',
        facts: [
          'Su vela dorsal medía hasta 1.8 metros de altura y podría haber servido para regular temperatura o atraer pareja.',
          'Era semi-acuático y pasaba mucho tiempo en el agua cazando peces gigantes y otros animales acuáticos.',
          'Tenía dientes cónicos perfectos para atrapar peces resbaladizos, diferentes a los dientes de sierra de otros carnívoros.',
          'Sus patas traseras eran más cortas que las de otros ter��podos, adaptadas para nadar eficientemente.'
        ]
      }
    ];

    let currentDinoIndex = 0;

    function updateDinosaur() {
      const dino = dinosaurs[currentDinoIndex];
      
      // Update main info
      document.getElementById('dino-emoji').textContent = dino.emoji;
      document.getElementById('dino-name').textContent = dino.name;
      document.getElementById('dino-period').textContent = '🕐 ' + dino.period;
      document.getElementById('dino-description').textContent = dino.description;
      
      // Update technical specs
      document.getElementById('dino-length').textContent = dino.length;
      document.getElementById('dino-weight').textContent = dino.weight;
      document.getElementById('dino-diet').textContent = dino.diet;
      document.getElementById('dino-speed').textContent = dino.speed;
      
      // Update size comparison
      document.getElementById('dino-size-emoji').textContent = dino.emoji;
      document.getElementById('dino-size-text').innerHTML = dino.name.split(' ')[0] + '<br>' + dino.length;
      
      // Update fact (show first fact by default)
      document.getElementById('dino-fact').textContent = dino.facts[0];
      
      // Update counter
      document.getElementById('dino-counter').textContent = `${currentDinoIndex + 1} / ${dinosaurs.length}`;
      
      // Update indicators
      document.querySelectorAll('.dino-indicator').forEach((indicator, index) => {
        if (index === currentDinoIndex) {
          indicator.style.backgroundColor = '#F07F1A';
        } else {
          indicator.style.backgroundColor = '#FADD66';
        }
      });
    }

    document.getElementById('btn-prev-dino').addEventListener('click', () => {
      currentDinoIndex = (currentDinoIndex - 1 + dinosaurs.length) % dinosaurs.length;
      updateDinosaur();
    });

    document.getElementById('btn-next-dino').addEventListener('click', () => {
      currentDinoIndex = (currentDinoIndex + 1) % dinosaurs.length;
      updateDinosaur();
    });

    // Random fact button
    document.getElementById('btn-random-fact').addEventListener('click', () => {
      const dino = dinosaurs[currentDinoIndex];
      const randomFact = dino.facts[Math.floor(Math.random() * dino.facts.length)];
      document.getElementById('dino-fact').textContent = randomFact;
    });

    // Sound button (creates accessibility-friendly notification)
    document.getElementById('btn-dino-sound').addEventListener('click', () => {
      const dino = dinosaurs[currentDinoIndex];
      const notification = document.createElement('div');
      notification.className = 'fixed top-24 left-1/2 transform -translate-x-1/2 px-8 py-4 rounded-2xl text-white font-bold text-lg shadow-2xl z-50';
      notification.style.backgroundColor = '#F07F1A';
      notification.innerHTML = `🔊 Rugido de ${dino.name}<br><span class="text-sm font-normal">¡ROAAAAAR!</span>`;
      document.body.appendChild(notification);
      setTimeout(() => notification.remove(), 2500);
    });

    // Audio description button (accessibility feature)
    document.getElementById('btn-audio-description').addEventListener('click', () => {
      const dino = dinosaurs[currentDinoIndex];
      const notification = document.createElement('div');
      notification.className = 'fixed top-24 left-1/2 transform -translate-x-1/2 px-8 py-6 rounded-2xl text-white shadow-2xl z-50 max-w-md';
      notification.style.backgroundColor = '#25D366';
      notification.innerHTML = `
        <div class="font-bold text-lg mb-2">🎧 Descripción de Audio</div>
        <div class="text-sm">${dino.description}</div>
        <div class="text-xs mt-2 opacity-90">Período: ${dino.period}</div>
      `;
      document.body.appendChild(notification);
      setTimeout(() => notification.remove(), 5000);
    });

    // Interactive evolution timeline
    const evolutionData = {
      invertebrados: {
        title: 'Invertebrados',
        icon: '🦠',
        period: 'Era Paleozoica (600-540 millones de años)',
        description: 'Los primeros animales multicelulares sin columna vertebral. Surgieron en los océanos primitivos y desarrollaron estructuras corporales cada vez más complejas.',
        characteristics: [
          '• Sin columna vertebral ni esqueleto interno',
          '• Cuerpos blandos o con exoesqueletos',
          '• Vivían principalmente en océanos',
          '• Desarrollaron sistemas nerviosos simples'
        ],
        examples: [
          '• Trilobites (artrópodos marinos)',
          '• Medusas y anémonas',
          '• Gusanos marinos',
          '• Moluscos primitivos'
        ],
        fact: 'Los invertebrados representan el 97% de todas las especies animales que han existido. Los trilobites dominaron los océanos durante 270 millones de años antes de extinguirse.'
      },
      vertebrados: {
        title: 'Vertebrados Primitivos',
        icon: '🐟',
        period: 'Era Paleozoica (530-360 millones de años)',
        description: 'Los primeros animales con columna vertebral aparecieron en el océano. Los peces fueron los primeros vertebrados y revolucionaron la vida marina.',
        characteristics: [
          '• Columna vertebral y cráneo',
          '• Sistema nervioso central protegido',
          '• Branquias para respirar bajo el agua',
          '• Aletas para nadar eficientemente'
        ],
        examples: [
          '• Peces acorazados (placodermos)',
          '• Primeros tiburones',
          '• Peces óseos primitivos',
          '• Celacantos'
        ],
        fact: 'Los primeros peces no tenían mandíbulas. Las mandíbulas evolucionaron más tarde y permitieron a los peces cazar presas más grandes, cambiando completamente los ecosistemas marinos.'
      },
      anfibios: {
        title: 'Anfibios',
        icon: '🐸',
        period: 'Era Paleozoica (370-300 millones de años)',
        description: 'Los primeros vertebrados que conquistaron la tierra firme. Podían vivir tanto en agua como en tierra, representando un paso evolutivo crucial.',
        characteristics: [
          '• Piel húmeda y permeable',
          '• Metamorfosis de larva acuática a adulto terrestre',
          '• Cuatro patas para caminar en tierra',
          '• Dependientes del agua para reproducirse'
        ],
        examples: [
          '• Ichthyostega (anfibio primitivo)',
          '• Eryops (anfibio gigante)',
          '• Diplocaulus (cabeza en forma de bumerán)',
          '• Ancestros de ranas y salamandras'
        ],
        fact: 'El Ichthyostega fue uno de los primeros tetrápodos (animales de cuatro patas). Tenía hasta 7 dedos en cada pata y aún conservaba una cola de pez con aleta.'
      },
      reptiles: {
        title: 'Reptiles',
        icon: '🦎',
        period: 'Era Paleozoica-Mesozoica (320-200 millones de años)',
        description: 'Los reptiles desarrollaron huevos con cáscara dura que podían ponerse en tierra, liberándose completamente del agua. Conquistaron todos los ambientes terrestres.',
        characteristics: [
          '• Piel escamosa e impermeable',
          '• Huevos con cáscara (amnióticos)',
          '• Respiración pulmonar desde el nacimiento',
          '• Regulación térmica mediante el sol'
        ],
        examples: [
          '• Dimetrodon (reptil con vela dorsal)',
          '• Primeros cocodrilos',
          '• Tortugas primitivas',
          '• Ancestros de dinosaurios'
        ],
        fact: 'Los reptiles fueron los primeros animales que pusieron huevos en tierra firme. Esto les permitió vivir lejos del agua y colonizar desiertos y montañas.'
      },
      dinosaurios: {
        title: 'Dinosaurios',
        icon: '🦖',
        period: 'Era Mesozoica (230-66 millones de años)',
        description: 'Los dinosaurios dominaron la Tierra durante más de 160 millones de años. Fueron los animales terrestres más exitosos de todos los tiempos.',
        characteristics: [
          '• Patas ubicadas debajo del cuerpo',
          '• Piel escamosa o con plumas',
          '• Ponían huevos',
          '• Sangre caliente en muchas especies'
        ],
        examples: [
          '• Tiranosaurio Rex (carnívoro)',
          '• Triceratops (herbívoro)',
          '• Velociraptor (cazador)',
          '• Brachiosaurus (gigante)'
        ],
        fact: 'Los dinosaurios no se extinguieron completamente: las aves modernas son descendientes directos de dinosaurios terópodos, por lo que técnicamente los dinosaurios aún viven entre nosotros.'
      },
      'aves-mamiferos': {
        title: 'Aves y Mamíferos',
        icon: '🦅',
        period: 'Era Mesozoica-Cenozoica (200 millones de años - presente)',
        description: 'Las aves evolucionaron de dinosaurios terópodos y los mamíferos se diversificaron enormemente después de la extinción de los dinosaurios.',
        characteristics: [
          '• Aves: plumas, vuelo, huesos huecos',
          '• Mamíferos: pelo, sangre caliente',
          '• Amamantan a sus crías',
          '• Alta inteligencia y comportamiento social'
        ],
        examples: [
          '• Archaeopteryx (ave primitiva)',
          '• Mamuts y mastodontes',
          '• Tigres dientes de sable',
          '• Primeros primates'
        ],
        fact: 'Después de la extinción de los dinosaurios hace 66 millones de años, los mamíferos crecieron en tamaño y diversidad, ocupando los nichos ecológicos que dejaron vacantes los dinosaurios.'
      },
      humanos: {
        title: 'Evolución Humana',
        icon: '👨',
        period: 'Era Cenozoica (2.5 millones de años - presente)',
        description: 'Los humanos modernos evolucionaron en África. Nuestra especie, Homo sapiens, apareció hace solo 300,000 años pero ha transformado completamente el planeta.',
        characteristics: [
          '• Bipedalismo (caminar en dos patas)',
          '• Cerebro grande y complejo',
          '• Lenguaje articulado',
          '• Uso de herramientas avanzadas'
        ],
        examples: [
          '• Australopithecus (ancestro bípedo)',
          '• Homo habilis (primer fabricante de herramientas)',
          '• Homo erectus (primero en usar fuego)',
          '• Homo sapiens (humano moderno)'
        ],
        fact: 'Los humanos modernos (Homo sapiens) compartimos el 98.8% de nuestro ADN con los chimpancés. Todos los humanos actuales descendemos de un pequeño grupo que vivió en África hace unos 200,000 años.'
      }
    };

    const evolutionInfoPanel = document.getElementById('evolution-info-panel');
    const evolutionIcon = document.getElementById('evolution-icon');
    const evolutionTitle = document.getElementById('evolution-title');
    const evolutionPeriod = document.getElementById('evolution-period');
    const evolutionDescription = document.getElementById('evolution-description');
    const evolutionCharacteristics = document.getElementById('evolution-characteristics');
    const evolutionExamples = document.getElementById('evolution-examples');
    const evolutionFact = document.getElementById('evolution-fact');

    function updateEvolutionStage(stageName) {
      const stage = evolutionData[stageName];
      
      evolutionIcon.textContent = stage.icon;
      evolutionTitle.textContent = stage.title;
      evolutionPeriod.textContent = stage.period;
      evolutionDescription.textContent = stage.description;
      
      evolutionCharacteristics.innerHTML = stage.characteristics.map(c => `<li>${c}</li>`).join('');
      evolutionExamples.innerHTML = stage.examples.map(e => `<li>${e}</li>`).join('');
      evolutionFact.textContent = stage.fact;
      
      // Smooth scroll to panel
      evolutionInfoPanel.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }

    document.querySelectorAll('.evolution-stage').forEach(button => {
      button.addEventListener('click', function() {
        const stageName = this.dataset.stage;
        updateEvolutionStage(stageName);
        
        // Visual feedback
        document.querySelectorAll('.evolution-stage div').forEach(div => {
          div.style.transform = 'scale(1)';
        });
        this.querySelector('div').style.transform = 'scale(1.2)';
      });
    });

    // Load default stage (dinosaurs)
    updateEvolutionStage('dinosaurios');
});

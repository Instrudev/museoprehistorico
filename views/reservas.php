<?php
// Asegurarnos de que la sesión esté iniciada para leer los mensajes de éxito
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Definir número de WhatsApp por defecto si no está definido (Cámbialo por el real del museo)
if (!isset($whatsappNumber)) {
    $whatsappNumber = "573142139674"; 
}

$status = $_GET['status'] ?? null;
$statusMessage = '';
$statusClass = '';
$whatsappRedirectUrl = null;

if ($status === 'success') {
    $statusMessage = "✅ ¡Reserva registrada con éxito!\n"
        . "Tu solicitud fue enviada correctamente.\n"
        . "En este momento serás redirigido(a) a WhatsApp para confirmar tu reserva con el Museo Prehistórico Huilassik Park para la Paz.";
    $statusClass = 'bg-green-600';

    if (!empty($_SESSION['reservation_whatsapp_url'])) {
        $whatsappRedirectUrl = $_SESSION['reservation_whatsapp_url'];
        // Limpiamos la variable de sesión para que no persista
        unset($_SESSION['reservation_whatsapp_url']);
    }
}
?>

<style>
  #spa-container {
    height: auto;
    overflow-y: visible;
  }
</style>

<section id="reservas" class="section-panel py-16 px-6" style="background-color: #FFF9E6;">
    <div class="max-w-5xl mx-auto">
        <div class="bg-white rounded-3xl card-shadow p-8">
            <h3 class="text-3xl font-bold mb-3 text-center" style="color: #68420F;">Reserva tu Visita</h3>
            <p class="text-center mb-8" style="color: #68420F;">Espacios accesibles e inclusivos para todos</p>
            
            <form id="reservation-form" class="space-y-6" action="/MUSEO/controllers/ReservaController.php" method="post" novalidate>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="visitor-name" class="block font-semibold mb-2" style="color: #68420F;">Nombre Completo *</label> 
                        <input type="text" id="visitor-name" name="full_name" required class="w-full px-4 py-3 rounded-xl border-2 focus:outline-none focus:border-orange-400" style="border-color: #FADD66;" placeholder="Ingresa tu nombre">
                    </div>
                    <div>
                        <label for="visitor-phone" class="block font-semibold mb-2" style="color: #68420F;">Teléfono / WhatsApp *</label> 
                        <input type="tel" id="visitor-phone" name="phone" required class="w-full px-4 py-3 rounded-xl border-2 focus:outline-none focus:border-orange-400" style="border-color: #FADD66;" placeholder="+57 314 213 9674">
                    </div>
                    <div>
                        <label for="visit-date" class="block font-semibold mb-2" style="color: #68420F;">Fecha de Visita *</label> 
                        <input type="date" id="visit-date" name="visit_date" required class="w-full px-4 py-3 rounded-xl border-2 focus:outline-none focus:border-orange-400" style="border-color: #FADD66;">
                    </div>
                    <div>
                        <label for="num-people" class="block font-semibold mb-2" style="color: #68420F;">Número de Personas *</label> 
                        <select id="num-people" name="num_people" required class="w-full px-4 py-3 rounded-xl border-2 focus:outline-none focus:border-orange-400" style="border-color: #FADD66;"> 
                            <option value="">Seleccionar</option> 
                            <option>1 persona</option> 
                            <option>2-4 personas</option> 
                            <option>5-10 personas</option> 
                            <option>Más de 10 personas</option> 
                        </select>
                    </div>
                    <div>
                        <label for="tour-type" class="block font-semibold mb-2" style="color: #68420F;">Tipo de Recorrido *</label> 
                        <select id="tour-type" name="tour_type" required class="w-full px-4 py-3 rounded-xl border-2 focus:outline-none focus:border-orange-400" style="border-color: #FADD66;"> 
                            <option value="">Seleccionar</option> 
                            <option>Recorrido Guiado</option> 
                            <option>Recorrido Libre</option> 
                            <option>Recorrido Nocturno</option> 
                            <option>Experiencia Premium</option> 
                        </select>
                    </div>
                </div>

                <div class="border-t-2 pt-6" style="border-color: #FADD66;">
                    <h4 class="text-xl font-bold mb-4 flex items-center gap-2" style="color: #68420F;"><span>♿</span> Necesidades de Accesibilidad e Inclusión</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <label class="flex items-center gap-3 p-4 rounded-xl border-2 cursor-pointer transition hover:bg-gray-50" style="border-color: #FADD66;"> <input type="checkbox" id="wheelchair" name="accessibility_wheelchair" value="1" class="w-5 h-5 rounded" style="accent-color: #F07F1A;"> <span style="color: #68420F;">♿ Acceso para silla de ruedas</span> </label> 
                        <label class="flex items-center gap-3 p-4 rounded-xl border-2 cursor-pointer transition hover:bg-gray-50" style="border-color: #FADD66;"> <input type="checkbox" id="sign-language" name="accessibility_sign_language" value="1" class="w-5 h-5 rounded" style="accent-color: #F07F1A;"> <span style="color: #68420F;">🤟 Intérprete de lengua de señas</span> </label> 
                        <label class="flex items-center gap-3 p-4 rounded-xl border-2 cursor-pointer transition hover:bg-gray-50" style="border-color: #FADD66;"> <input type="checkbox" id="visual-impairment" name="accessibility_visual_impairment" value="1" class="w-5 h-5 rounded" style="accent-color: #F07F1A;"> <span style="color: #68420F;">👁️ Asistencia para discapacidad visual</span> </label> 
                        <label class="flex items-center gap-3 p-4 rounded-xl border-2 cursor-pointer transition hover:bg-gray-50" style="border-color: #FADD66;"> <input type="checkbox" id="autism" name="accessibility_autism" value="1" class="w-5 h-5 rounded" style="accent-color: #F07F1A;"> <span style="color: #68420F;">🧩 Recorrido adaptado para autismo</span> </label> 
                        <label class="flex items-center gap-3 p-4 rounded-xl border-2 cursor-pointer transition hover:bg-gray-50" style="border-color: #FADD66;"> <input type="checkbox" id="senior" name="accessibility_senior" value="1" class="w-5 h-5 rounded" style="accent-color: #F07F1A;"> <span style="color: #68420F;">👴 Recorrido para adultos mayores</span> </label> 
                        <label class="flex items-center gap-3 p-4 rounded-xl border-2 cursor-pointer transition hover:bg-gray-50" style="border-color: #FADD66;"> <input type="checkbox" id="cognitive" name="accessibility_cognitive" value="1" class="w-5 h-5 rounded" style="accent-color: #F07F1A;"> <span style="color: #68420F;">🧠 Discapacidad cognitiva</span> </label>
                    </div>
                    <div>
                        <label for="special-notes" class="block font-semibold mb-2" style="color: #68420F;">Notas Adicionales</label> 
                        <textarea id="special-notes" name="special_notes" rows="3" class="w-full px-4 py-3 rounded-xl border-2 focus:outline-none focus:border-orange-400" style="border-color: #FADD66;" placeholder="Cuéntanos sobre cualquier otra necesidad especial o preferencia..."></textarea>
                    </div>
                </div>

                <div class="border-t-2 pt-6" style="border-color: #FADD66;">
                    <h4 class="text-xl font-bold mb-4" style="color: #68420F;">💳 Método de Pago</h4>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        
                        
                        <label class="relative"> 
                            <input type="radio" name="payment" value="onsite" class="peer sr-only">
                            <div class="p-6 rounded-xl border-2 cursor-pointer transition peer-checked:border-4 peer-checked:shadow-lg text-center" style="border-color: #FADD66;">
                                <div class="text-4xl mb-2">🏛️</div>
                                <div class="font-bold" style="color: #68420F;">En el museo</div>
                                <div class="text-sm" style="color: #68420F;">Efectivo o transferencia</div>
                            </div>
                        </label>
                    </div>
                </div>

                <?php if ($statusMessage !== '') { ?>
                    <div class="p-4 rounded-xl text-white font-semibold text-center <?php echo $statusClass; ?>" role="status" aria-live="polite">
                        <?php echo nl2br(htmlspecialchars($statusMessage, ENT_QUOTES, 'UTF-8')); ?>
                    </div>
                <?php } ?>

                <?php if ($whatsappRedirectUrl) { ?>
                    <script>
                        window.setTimeout(function () {
                            window.location.href = <?php echo json_encode($whatsappRedirectUrl, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>;
                        }, 1500);
                    </script>
                <?php } ?>

                <div class="flex gap-4">
                    <button type="submit" class="flex-1 btn-primary px-8 py-4 rounded-full text-white font-bold text-lg" style="background-color: #F07F1A;"> Confirmar Reserva </button> 
                    <a href="https://api.whatsapp.com/send?phone=<?php echo urlencode($whatsappNumber); ?>" target="_blank" rel="noopener noreferrer" id="btn-whatsapp-reserve" class="btn-primary px-8 py-4 rounded-full text-white font-bold text-lg flex items-center gap-2" style="background-color: #25D366;"> 
                        <span class="text-2xl">💬</span> Reservar por WhatsApp 
                    </a>
                </div>
            </form>
        </div>
    </div>
</section>
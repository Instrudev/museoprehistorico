<?php

require_once __DIR__ . '/../models/Reservation.php';

$config = require __DIR__ . '/../config/config.php';
$whatsappNumber = $config['whatsapp_number'] ?? '';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /index.php');
    exit;
}

$fullName = trim((string) filter_input(INPUT_POST, 'full_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
$phone = trim((string) filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
$visitDate = trim((string) filter_input(INPUT_POST, 'visit_date', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
$numPeople = trim((string) filter_input(INPUT_POST, 'num_people', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
$tourType = trim((string) filter_input(INPUT_POST, 'tour_type', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
$paymentMethod = trim((string) filter_input(INPUT_POST, 'payment', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
$specialNotes = trim((string) filter_input(INPUT_POST, 'special_notes', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

$allowedPeople = [
    '1 persona',
    '2-4 personas',
    '5-10 personas',
    'Más de 10 personas',
];

$allowedTours = [
    'Recorrido Guiado',
    'Recorrido Libre',
    'Recorrido Nocturno',
    'Experiencia Premium',
];

$allowedPayments = ['pse', 'card', 'onsite'];

$dateObject = DateTime::createFromFormat('Y-m-d', $visitDate);
$dateIsValid = $dateObject && $dateObject->format('Y-m-d') === $visitDate;

if ($fullName === '' || $phone === '' || !$dateIsValid || !in_array($numPeople, $allowedPeople, true) || !in_array($tourType, $allowedTours, true) || !in_array($paymentMethod, $allowedPayments, true)) {
    header('Location: /index.php?status=invalid');
    exit;
}

$accessibilityWheelchair = isset($_POST['accessibility_wheelchair']) ? 1 : 0;
$accessibilitySignLanguage = isset($_POST['accessibility_sign_language']) ? 1 : 0;
$accessibilityVisualImpairment = isset($_POST['accessibility_visual_impairment']) ? 1 : 0;
$accessibilityAutism = isset($_POST['accessibility_autism']) ? 1 : 0;
$accessibilitySenior = isset($_POST['accessibility_senior']) ? 1 : 0;
$accessibilityCognitive = isset($_POST['accessibility_cognitive']) ? 1 : 0;

$reservation = new Reservation();

try {
    $saved = $reservation->create([
        'full_name' => $fullName,
        'phone' => $phone,
        'visit_date' => $visitDate,
        'num_people' => $numPeople,
        'tour_type' => $tourType,
        'payment_method' => $paymentMethod,
        'accessibility_wheelchair' => $accessibilityWheelchair,
        'accessibility_sign_language' => $accessibilitySignLanguage,
        'accessibility_visual_impairment' => $accessibilityVisualImpairment,
        'accessibility_autism' => $accessibilityAutism,
        'accessibility_senior' => $accessibilitySenior,
        'accessibility_cognitive' => $accessibilityCognitive,
        'special_notes' => $specialNotes,
    ]);
} catch (PDOException $exception) {
    $saved = false;
}

if (!$saved) {
    header('Location: /index.php?status=error');
    exit;
}

$message = "Hola 👋\n";
$message .= "He realizado una reserva en el Museo Prehistórico Huilassik Park para la Paz.\n\n";
$message .= "📌 Nombre: {$fullName}\n";
$message .= "📅 Fecha de visita: {$visitDate}\n";
$message .= "👥 Número de personas: {$numPeople}\n";
$message .= "🦕 Tipo de recorrido: {$tourType}\n\n";
$message .= "Quedo atento(a) a la confirmación.\n";
$message .= "¡Muchas gracias!";

$whatsappUrl = sprintf(
    'https://api.whatsapp.com/send?phone=%s&text=%s',
    urlencode($whatsappNumber),
    urlencode($message)
);

header('Location: ' . $whatsappUrl);
exit;

<?php

require_once __DIR__ . '/../models/Reserva.php';

$config = require __DIR__ . '/../config/config.php';
$whatsappNumber = $config['whatsapp_number'] ?? '';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /public/index.php');
    exit;
}

$isAjaxRequest = isset($_SERVER['HTTP_X_REQUESTED_WITH'])
    && strtolower((string) $_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';

$fullName = trim((string) filter_input(INPUT_POST, 'full_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
$phone = trim((string) filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
$visitDate = trim((string) filter_input(INPUT_POST, 'visit_date', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
$numPeople = trim((string) filter_input(INPUT_POST, 'num_people', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
$tourType = trim((string) filter_input(INPUT_POST, 'tour_type', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
$paymentMethod = trim((string) filter_input(INPUT_POST, 'payment', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
$specialNotes = trim((string) filter_input(INPUT_POST, 'special_notes', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

$allowedPeople = Reserva::allowedPeople();
$allowedTours = Reserva::allowedTours();
$allowedPayments = Reserva::allowedPayments();

$dateObject = DateTime::createFromFormat('Y-m-d', $visitDate);
$dateIsValid = $dateObject && $dateObject->format('Y-m-d') === $visitDate;

if ($fullName === '' || $phone === '' || !$dateIsValid || !in_array($numPeople, $allowedPeople, true) || !in_array($tourType, $allowedTours, true) || !in_array($paymentMethod, $allowedPayments, true)) {
    if ($isAjaxRequest) {
        http_response_code(422);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode([
            'status' => 'invalid',
            'message' => 'Algunos datos no son válidos. Revisa el formulario y vuelve a intentarlo.',
        ]);
        exit;
    }

    header('Location: /public/index.php?status=invalid');
    exit;
}

$accessibilityWheelchair = isset($_POST['accessibility_wheelchair']) ? 1 : 0;
$accessibilitySignLanguage = isset($_POST['accessibility_sign_language']) ? 1 : 0;
$accessibilityVisualImpairment = isset($_POST['accessibility_visual_impairment']) ? 1 : 0;
$accessibilityAutism = isset($_POST['accessibility_autism']) ? 1 : 0;
$accessibilitySenior = isset($_POST['accessibility_senior']) ? 1 : 0;
$accessibilityCognitive = isset($_POST['accessibility_cognitive']) ? 1 : 0;

$reservation = new Reserva();

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
    if ($isAjaxRequest) {
        http_response_code(500);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode([
            'status' => 'error',
            'message' => 'No pudimos guardar tu reserva en este momento. Inténtalo nuevamente.',
        ]);
        exit;
    }

    header('Location: /public/index.php?status=error');
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

$_SESSION['reservation_whatsapp_url'] = $whatsappUrl;

if ($isAjaxRequest) {
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode([
        'status' => 'success',
        'title' => "¡{$fullName}, tu reserva quedó lista!",
        'message' => "✅ Tu visita para el {$visitDate} ya está guardada.<br><strong>Ahora te enviaremos a WhatsApp</strong> para confirmar el último detalle.",
        'confirm_text' => 'Ir a WhatsApp',
        'whatsapp_url' => $whatsappUrl,
    ]);
    exit;
}

header('Location: /public/index.php?page=reservas&status=success');
exit;

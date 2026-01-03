<?php
declare(strict_types=1);

require_once __DIR__ . '/../models/Reserva.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (empty($_SESSION['admin_authenticated'])) {
    header('Location: /admin/index.php?page=login');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /admin/index.php?page=reservas');
    exit;
}

$action = $_POST['action'] ?? '';
$reservation = new Reserva();

if ($action === 'delete') {
    $id = (int) filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
    if ($id > 0) {
        $reservation->delete($id);
    }
    header('Location: /admin/index.php?page=reservas&status=deleted');
    exit;
}

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
    $redirectPage = $action === 'update' ? 'reserva-editar&id=' . (int) ($_POST['id'] ?? 0) : 'reserva-crear';
    header("Location: /admin/index.php?page={$redirectPage}&status=invalid");
    exit;
}

$accessibilityWheelchair = isset($_POST['accessibility_wheelchair']) ? 1 : 0;
$accessibilitySignLanguage = isset($_POST['accessibility_sign_language']) ? 1 : 0;
$accessibilityVisualImpairment = isset($_POST['accessibility_visual_impairment']) ? 1 : 0;
$accessibilityAutism = isset($_POST['accessibility_autism']) ? 1 : 0;
$accessibilitySenior = isset($_POST['accessibility_senior']) ? 1 : 0;
$accessibilityCognitive = isset($_POST['accessibility_cognitive']) ? 1 : 0;

$payload = [
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
];

if ($action === 'update') {
    $id = (int) filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
    if ($id > 0) {
        $reservation->update($id, $payload);
    }
    header('Location: /admin/index.php?page=reservas&status=updated');
    exit;
}

$reservation->create($payload);
header('Location: /admin/index.php?page=reservas&status=created');
exit;

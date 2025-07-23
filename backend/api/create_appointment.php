<?php
header('Content-Type: application/json');
require_once '../../config/db.php'; 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

try {
    $data = json_decode(file_get_contents("php://input"), true);

    $specialty = $data['specialty'] ?? '';
    $doctor = $data['doctor'] ?? '';
    $date = $data['date'] ?? '';
    $time = $data['time'] ?? '';
    $reason = $data['reason'] ?? '';
    $notes = $data['notes'] ?? '';
    $patient_id = 1;  

    if (empty($specialty) || empty($doctor) || empty($date) || empty($time) || empty($reason)) {
        echo json_encode(['success' => false, 'message' => 'All required fields must be filled.']);
        exit;
    }

    $appointmentDateTime = date('Y-m-d H:i:s', strtotime("$date $time"));

    // بدون hospital_id لأنك حذفته
    $stmt = $conn->prepare("INSERT INTO appointments (patient_id, doctor_id, appointment_date, notes) VALUES (?, ?, ?, ?)");
    if ($stmt === false) {
        throw new Exception('Prepare failed: ' . $conn->error);
    }

    if (!$stmt->bind_param("iiss", $patient_id, $doctor, $appointmentDateTime, $notes)) {
        throw new Exception('Bind param failed: ' . $stmt->error);
    }

    if (!$stmt->execute()) {
        throw new Exception('Execute failed: ' . $stmt->error);
    }

    echo json_encode(['success' => true, 'message' => 'Appointment scheduled successfully.']);

    $stmt->close();
    $conn->close();

} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Unexpected error occurred: ' . $e->getMessage()
    ]);
    exit;
}

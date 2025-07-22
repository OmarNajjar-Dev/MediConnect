<?php

header('Content-Type: application/json');
require_once __DIR__ . '/../../config/db.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    $data = json_decode(file_get_contents("php://input"), true);

    $specialty = $data['specialty'] ?? '';
    $doctor_id = (int)($data['doctor'] ?? 0);
    $date = $data['date'] ?? '';
    $time = $data['time'] ?? '';
    $reason = $data['reason'] ?? '';
    $notes = $data['notes'] ?? '';
    $patient_id = 1;  // Replace with $_SESSION['user_id'] in real implementation

    $missing = [];
    if (empty($specialty)) $missing[] = 'specialty';
    if (empty($doctor_id)) $missing[] = 'doctor_id';
    if (empty($date)) $missing[] = 'date';
    if (empty($time)) $missing[] = 'time';
    if (empty($reason)) $missing[] = 'reason';

    if (!empty($missing)) {
        echo json_encode([
            'success' => false,
            'message' => 'Missing required field(s): ' . implode(', ', $missing)
        ]);
        exit;
    }

    $appointmentDateTime = date('Y-m-d H:i:s', strtotime("$date $time"));

    // Step 1: Get hospital_id for the selected doctor
    $stmt = $conn->prepare("SELECT hospital_id FROM doctors WHERE doctor_id = ?");
    if (!$stmt) throw new Exception("Prepare failed: " . $conn->error);

    $stmt->bind_param("i", $doctor_id);
    $stmt->execute();
    $stmt->bind_result($hospital_id);
    if (!$stmt->fetch()) {
        echo json_encode(['success' => false, 'message' => 'Doctor not found.']);
        exit;
    }
    $stmt->close();

    // Step 2: Insert appointment with hospital_id
    $stmt = $conn->prepare("INSERT INTO appointments (patient_id, doctor_id, hospital_id, appointment_date, notes) VALUES (?, ?, ?, ?, ?)");
    if (!$stmt) throw new Exception("Prepare failed: " . $conn->error);

    $stmt->bind_param("iiiss", $patient_id, $doctor_id, $hospital_id, $appointmentDateTime, $notes);
    if (!$stmt->execute()) {
        throw new Exception("Execute failed: " . $stmt->error);
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

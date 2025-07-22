<?php

header('Content-Type: application/json');
require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../middleware/session-context.php';

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
    
    // Get patient_id from session
    $patient_id = $_SESSION['user_id'] ?? null;
    
    if (!$patient_id) {
        echo json_encode([
            'success' => false,
            'message' => 'User not authenticated. Please log in.'
        ]);
        exit;
    }

    // Validate required fields
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

    // Convert date and time to MySQL datetime format
    $appointmentDateTime = date('Y-m-d H:i:s', strtotime("$date $time"));
    
    // Validate that the appointment is not in the past
    if (strtotime($appointmentDateTime) <= time()) {
        echo json_encode([
            'success' => false,
            'message' => 'Appointment date and time must be in the future.'
        ]);
        exit;
    }

    // Step 1: Get hospital_id for the selected doctor
    $stmt = $conn->prepare("SELECT hospital_id FROM doctors WHERE doctor_id = ?");
    if (!$stmt) {
        throw new Exception("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("i", $doctor_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 0) {
        echo json_encode(['success' => false, 'message' => 'Doctor not found.']);
        exit;
    }
    
    $doctorData = $result->fetch_assoc();
    $hospital_id = $doctorData['hospital_id'];
    $stmt->close();

    // Step 2: Check if patient exists, if not create one
    $stmt = $conn->prepare("SELECT patient_id FROM patients WHERE user_id = ?");
    $stmt->bind_param("i", $patient_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 0) {
        // Create patient record
        $stmt = $conn->prepare("INSERT INTO patients (user_id) VALUES (?)");
        $stmt->bind_param("i", $patient_id);
        $stmt->execute();
        $patient_id = $conn->insert_id;
    } else {
        $patientData = $result->fetch_assoc();
        $patient_id = $patientData['patient_id'];
    }
    $stmt->close();

    // Step 3: Check for conflicting appointments
    $stmt = $conn->prepare("SELECT appointment_id FROM appointments WHERE doctor_id = ? AND appointment_date = ? AND status != 'Cancelled'");
    $stmt->bind_param("is", $doctor_id, $appointmentDateTime);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        echo json_encode(['success' => false, 'message' => 'This time slot is already booked. Please select another time.']);
        exit;
    }
    $stmt->close();

    // Step 4: Insert appointment
    $stmt = $conn->prepare("INSERT INTO appointments (patient_id, doctor_id, hospital_id, appointment_date, notes, status) VALUES (?, ?, ?, ?, ?, 'Scheduled')");
    if (!$stmt) {
        throw new Exception("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("iiiss", $patient_id, $doctor_id, $hospital_id, $appointmentDateTime, $notes);
    if (!$stmt->execute()) {
        throw new Exception("Execute failed: " . $stmt->error);
    }

    $appointment_id = $conn->insert_id;

    echo json_encode([
        'success' => true, 
        'message' => 'Appointment scheduled successfully.',
        'appointment_id' => $appointment_id
    ]);
    
    $stmt->close();
    $conn->close();
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Unexpected error occurred: ' . $e->getMessage()
    ]);
    exit;
}

?>

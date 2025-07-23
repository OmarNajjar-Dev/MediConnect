<?php

require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../helpers/doctor-appointment-helper.php';

header('Content-Type: application/json');

// Check if user is logged in and is a doctor
session_start();
if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

$userId = $_SESSION['user_id'];
$doctorId = getDoctorIdFromUserId($userId);

if (!$doctorId) {
    http_response_code(403);
    echo json_encode(['success' => false, 'message' => 'Access denied. Doctor profile not found.']);
    exit;
}

try {
    // Get query parameters
    $status = $_GET['status'] ?? null;
    $date = $_GET['date'] ?? null;
    
    // Validate status if provided
    if ($status && !in_array($status, ['Scheduled', 'Completed', 'Cancelled'])) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Invalid status parameter']);
        exit;
    }
    
    // Validate date if provided
    if ($date && !DateTime::createFromFormat('Y-m-d', $date)) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Invalid date format. Use YYYY-MM-DD']);
        exit;
    }
    
    // Get appointments
    $appointments = getDoctorAppointments($doctorId, $status, $date);
    
    // Get statistics
    $stats = getDoctorAppointmentStats($doctorId, $date);
    
    // Format appointments for frontend
    $formattedAppointments = [];
    foreach ($appointments as $appointment) {
        $formattedAppointments[] = [
            'id' => $appointment['appointment_id'],
            'patient_name' => $appointment['patient_name'],
            'appointment_date' => $appointment['appointment_date'],
            'formatted_time' => formatAppointmentDateTime($appointment['appointment_date']),
            'status' => $appointment['status'],
            'status_text' => getAppointmentStatusText($appointment['status']),
            'status_classes' => getAppointmentStatusClasses($appointment['status']),
            'notes' => $appointment['notes'],
            'hospital_name' => $appointment['hospital_name'],
            'patient_gender' => $appointment['patient_gender'],
            'patient_birthdate' => $appointment['patient_birthdate']
        ];
    }
    
    echo json_encode([
        'success' => true,
        'appointments' => $formattedAppointments,
        'stats' => [
            'total' => (int)$stats['total'],
            'scheduled' => (int)$stats['scheduled'],
            'completed' => (int)$stats['completed'],
            'cancelled' => (int)$stats['cancelled']
        ]
    ]);
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Failed to fetch appointments: ' . $e->getMessage()
    ]);
} 
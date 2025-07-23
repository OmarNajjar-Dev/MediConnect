<?php

require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../helpers/doctor-appointment-helper.php';

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

// Check if it's a POST request
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

try {
    // Get JSON input
    $input = json_decode(file_get_contents('php://input'), true);
    
    if (!$input) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Invalid JSON input']);
        exit;
    }
    
    $appointmentId = $input['appointment_id'] ?? null;
    $status = $input['status'] ?? null;
    
    // Validate required fields
    if (!$appointmentId || !$status) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Appointment ID and status are required']);
        exit;
    }
    
    // Validate status
    if (!in_array($status, ['Scheduled', 'Completed', 'Cancelled'])) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Invalid status. Must be Scheduled, Completed, or Cancelled']);
        exit;
    }
    
    // Validate appointment ID is numeric
    if (!is_numeric($appointmentId)) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Invalid appointment ID']);
        exit;
    }
    
    // Update appointment status
    $success = updateAppointmentStatus($appointmentId, $status, $doctorId);
    
    if ($success) {
        echo json_encode([
            'success' => true,
            'message' => 'Appointment status updated successfully',
            'appointment_id' => $appointmentId,
            'new_status' => $status
        ]);
    } else {
        http_response_code(404);
        echo json_encode([
            'success' => false,
            'message' => 'Appointment not found or you do not have permission to update it'
        ]);
    }
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Failed to update appointment status: ' . $e->getMessage()
    ]);
} 
<?php

/**
 * Doctor Appointment Helper Functions
 * Handles fetching and managing appointments for doctors
 */

require_once __DIR__ . '/../config/db.php';

/**
 * Get appointments for a specific doctor
 * 
 * @param int $doctorId The doctor's ID
 * @param string|null $status Filter by appointment status (optional)
 * @param string|null $date Filter by specific date (optional)
 * @return array Array of appointments with patient and hospital information
 */
function getDoctorAppointments($doctorId, $status = null, $date = null) {
    global $conn;
    
    $sql = "
        SELECT 
            a.appointment_id,
            a.appointment_date,
            a.status,
            a.notes,
            CONCAT(u.first_name, ' ', u.last_name) AS patient_name,
            p.birthdate AS patient_birthdate,
            p.gender AS patient_gender,
            h.name AS hospital_name,
            h.address AS hospital_address
        FROM appointments a
        LEFT JOIN patients p ON a.patient_id = p.patient_id
        LEFT JOIN users u ON p.user_id = u.user_id
        LEFT JOIN hospitals h ON a.hospital_id = h.hospital_id
        WHERE a.doctor_id = ?
    ";
    
    $params = [$doctorId];
    $types = "i";
    
    if ($status) {
        $sql .= " AND a.status = ?";
        $params[] = $status;
        $types .= "s";
    }
    
    if ($date) {
        $sql .= " AND DATE(a.appointment_date) = ?";
        $params[] = $date;
        $types .= "s";
    } else {
        // If no specific date, show upcoming appointments (today and future)
        $sql .= " AND DATE(a.appointment_date) >= CURDATE()";
    }
    
    $sql .= " ORDER BY a.appointment_date ASC";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param($types, ...$params);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $appointments = [];
    while ($row = $result->fetch_assoc()) {
        $appointments[] = $row;
    }
    
    return $appointments;
}

/**
 * Get appointment statistics for a doctor
 * 
 * @param int $doctorId The doctor's ID
 * @param string|null $date Filter by specific date (optional)
 * @return array Array with appointment counts
 */
function getDoctorAppointmentStats($doctorId, $date = null) {
    global $conn;
    
    $dateFilter = $date ? "AND DATE(a.appointment_date) = ?" : "";
    $params = $date ? [$doctorId, $date] : [$doctorId];
    $types = $date ? "is" : "i";
    
    $sql = "
        SELECT 
            COUNT(*) as total,
            SUM(CASE WHEN a.status = 'Scheduled' THEN 1 ELSE 0 END) as scheduled,
            SUM(CASE WHEN a.status = 'Completed' THEN 1 ELSE 0 END) as completed,
            SUM(CASE WHEN a.status = 'Cancelled' THEN 1 ELSE 0 END) as cancelled
        FROM appointments a
        WHERE a.doctor_id = ? $dateFilter
    ";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param($types, ...$params);
    $stmt->execute();
    $result = $stmt->get_result();
    
    return $result->fetch_assoc();
}

/**
 * Update appointment status
 * 
 * @param int $appointmentId The appointment ID
 * @param string $status The new status
 * @param int $doctorId The doctor's ID (for security)
 * @return bool Success status
 */
function updateAppointmentStatus($appointmentId, $status, $doctorId) {
    global $conn;
    
    $sql = "
        UPDATE appointments 
        SET status = ? 
        WHERE appointment_id = ? AND doctor_id = ?
    ";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sii", $status, $appointmentId, $doctorId);
    
    return $stmt->execute() && $stmt->affected_rows > 0;
}

/**
 * Get doctor ID from user ID
 * 
 * @param int $userId The user's ID
 * @return int|null The doctor's ID or null if not found
 */
function getDoctorIdFromUserId($userId) {
    global $conn;
    
    $sql = "SELECT doctor_id FROM doctors WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($row = $result->fetch_assoc()) {
        return $row['doctor_id'];
    }
    
    return null;
}

/**
 * Format appointment date for display
 * 
 * @param string $datetime The datetime string
 * @return string Formatted date string
 */
function formatAppointmentDateTime($datetime) {
    $date = new DateTime($datetime);
    return $date->format('H:i');
}

/**
 * Get appointment status classes for styling
 * 
 * @param string $status The appointment status
 * @return string Tailwind CSS classes
 */
function getAppointmentStatusClasses($status) {
    switch (strtolower($status)) {
        case 'scheduled':
            return 'bg-neutral-100 text-gray-800';
        case 'completed':
            return 'bg-green-100 text-green-800';
        case 'cancelled':
            return 'bg-red-100 text-red-800';
        default:
            return 'bg-gray-100 text-gray-800';
    }
}

/**
 * Get appointment status display text
 * 
 * @param string $status The appointment status
 * @return string Display text
 */
function getAppointmentStatusText($status) {
    switch (strtolower($status)) {
        case 'scheduled':
            return 'scheduled';
        case 'completed':
            return 'completed';
        case 'cancelled':
            return 'cancelled';
        default:
            return $status;
    }
} 
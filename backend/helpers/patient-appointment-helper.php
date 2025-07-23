<?php

/**
 * Get appointments for a specific patient
 * 
 * @param int $patientId The patient's user ID
 * @param string $status Optional status filter (upcoming, completed, etc.)
 * @return array Array of appointments
 */
function getPatientAppointments($patientId, $status = null) {
    global $conn;
    
    $sql = "
        SELECT 
            a.appointment_id,
            a.appointment_date,
            a.status,
            a.notes,
            CONCAT(u.first_name, ' ', u.last_name) AS doctor_name,
            d.bio AS doctor_bio,
            s.name AS specialty_name,
            h.name AS hospital_name,
            h.address AS hospital_address
        FROM appointments a
        LEFT JOIN doctors d ON a.doctor_id = d.doctor_id
        LEFT JOIN users u ON d.user_id = u.user_id
        LEFT JOIN specialties s ON d.specialty_id = s.specialty_id
        LEFT JOIN hospitals h ON d.hospital_id = h.hospital_id
        WHERE a.patient_id = ?
    ";
    
    $params = [$patientId];
    $types = "i";
    
    if ($status) {
        $sql .= " AND a.status = ?";
        $params[] = $status;
        $types .= "s";
    }
    
    $sql .= " ORDER BY a.appointment_date DESC";
    
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
 * Get appointment statistics for a patient
 * 
 * @param int $patientId The patient's user ID
 * @return array Array with appointment counts
 */
function getPatientAppointmentStats($patientId) {
    global $conn;
    
    $stats = [
        'upcoming' => 0,
        'completed' => 0,
        'this_month' => 0
    ];
    
    // Get upcoming appointments
    $stmt = $conn->prepare("
        SELECT COUNT(*) as count 
        FROM appointments 
        WHERE patient_id = ? AND appointment_date >= CURDATE() AND status IN ('Scheduled')
    ");
    $stmt->bind_param("i", $patientId);
    $stmt->execute();
    $result = $stmt->get_result();
    $stats['upcoming'] = $result->fetch_assoc()['count'];
    
    // Get completed appointments
    $stmt = $conn->prepare("
        SELECT COUNT(*) as count 
        FROM appointments 
        WHERE patient_id = ? AND status = 'Completed'
    ");
    $stmt->bind_param("i", $patientId);
    $stmt->execute();
    $result = $stmt->get_result();
    $stats['completed'] = $result->fetch_assoc()['count'];
    
    // Get this month's appointments
    $stmt = $conn->prepare("
        SELECT COUNT(*) as count 
        FROM appointments 
        WHERE patient_id = ? AND MONTH(appointment_date) = MONTH(CURDATE()) AND YEAR(appointment_date) = YEAR(CURDATE())
    ");
    $stmt->bind_param("i", $patientId);
    $stmt->execute();
    $result = $stmt->get_result();
    $stats['this_month'] = $result->fetch_assoc()['count'];
    
    return $stats;
}

/**
 * Format appointment date and time for display
 * 
 * @param string $datetime The appointment datetime
 * @return string Formatted date and time
 */
function formatAppointmentDateTime($datetime) {
    $dateObj = new DateTime($datetime);
    return $dateObj->format('Y-m-d \a\t H:i');
}

/**
 * Get status badge classes for appointment status
 * 
 * @param string $status The appointment status
 * @return string CSS classes for the status badge
 */
function getAppointmentStatusClasses($status) {
    switch (strtolower($status)) {
        case 'confirmed':
            return 'bg-green-100 text-green-800';
        case 'scheduled':
            return 'bg-blue-100 text-blue-800';
        case 'completed':
            return 'bg-purple-100 text-purple-800';
        case 'cancelled':
            return 'bg-red-100 text-red-800';
        default:
            return 'bg-gray-100 text-gray-800';
    }
} 
<?php

require_once __DIR__ . '/../../config/db.php';

header('Content-Type: application/json');

try {
    $sql = "SELECT 
                u.user_id,
                u.email,
                u.first_name,
                u.last_name,
                u.city,
                u.address_line,
                u.profile_image,
                GROUP_CONCAT(r.role_name) as roles,
                h.name as hospital_name,
                s.label_for_doctor as specialty,
                d.is_verified as doctor_verified,
                at.team_name as ambulance_team_name,
                ah.name as ambulance_hospital_name
            FROM users u
            LEFT JOIN user_roles ur ON u.user_id = ur.user_id
            LEFT JOIN roles r ON ur.role_id = r.role_id
            LEFT JOIN doctors d ON u.user_id = d.user_id
            LEFT JOIN hospitals h ON d.hospital_id = h.hospital_id
            LEFT JOIN specialties s ON d.specialty_id = s.specialty_id
            LEFT JOIN ambulance_teams at ON u.user_id = at.user_id
            LEFT JOIN hospitals ah ON at.hospital_id = ah.hospital_id
            WHERE r.role_name != 'Super Admin' OR r.role_name IS NULL
            GROUP BY u.user_id
            HAVING GROUP_CONCAT(r.role_name) NOT LIKE '%Super Admin%'
            ORDER BY u.first_name, u.last_name";

    $result = $conn->query($sql);

    $users = [];
    while ($row = $result->fetch_assoc()) {
        $row['roles'] = $row['roles'] ? explode(',', $row['roles']) : [];
        $users[] = $row;
    }

    echo json_encode([
        'success' => true,
        'users' => $users
    ]);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Failed to fetch users: ' . $e->getMessage()
    ]);
}

$conn->close(); 
<?php
require_once 'db.php';

$sql = "SELECT 
            d.doctor_id,
            d.is_verified,
            d.rating,
            d.reviews_count,
            d.image_url,
            d.bio,
            u.first_name,
            u.last_name,
            u.city,
            h.name AS hospital_name,
            s.label_for_doctor AS specialty
        FROM doctors d
        INNER JOIN users u ON d.user_id = u.user_id
        LEFT JOIN specialties s ON d.specialty_id = s.specialty_id
        LEFT JOIN hospitals h ON d.hospital_id = h.hospital_id";

$result = $conn->query($sql);

$doctors = [];

while ($row = $result->fetch_assoc()) {
    $doctors[] = $row;
}

header('Content-Type: application/json');
echo json_encode($doctors);

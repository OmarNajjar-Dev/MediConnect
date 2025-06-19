<?php
require_once 'db.php';

$sql = "SELECT h.*, GROUP_CONCAT(s.label_for_hospital) AS specialties
        FROM hospitals h
        LEFT JOIN hospital_specialties hs ON h.hospital_id = hs.hospital_id
        LEFT JOIN specialties s ON hs.specialty_id = s.specialty_id
        GROUP BY h.hospital_id";

$result = $conn->query($sql);

$hospitals = [];

while ($row = $result->fetch_assoc()) {
    $row['specialties'] = explode(',', $row['specialties']);
    $hospitals[] = $row;
}

header('Content-Type: application/json');
echo json_encode($hospitals);

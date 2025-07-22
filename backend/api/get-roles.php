<?php

require_once __DIR__ . '/../config/db.php';

// SECURITY: Exclude Super Admin role from dropdown
$sql = "SELECT role_name FROM roles WHERE role_name != 'Super Admin'";
$result = $conn->query($sql);

$roles = [];

while ($row = $result->fetch_assoc()) {
    $roles[] = $row['role_name'];
}

header('Content-Type: application/json');
echo json_encode($roles);

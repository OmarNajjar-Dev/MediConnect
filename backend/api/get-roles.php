<?php

require_once __DIR__ . '/../config/db.php';

$sql = "SELECT role_name FROM roles";
$result = $conn->query($sql);

$roles = [];

while ($row = $result->fetch_assoc()) {
    $roles[] = $row['role_name'];
}

header('Content-Type: application/json');
echo json_encode($roles);

<?php

require_once ROOT . '/src/config/db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'] ?? '';
    $stmt = $conn->prepare("SELECT user_id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    echo json_encode(['exists' => $stmt->num_rows > 0]);
    $stmt->close();
}

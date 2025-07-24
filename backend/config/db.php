<?php

$host = 'sql100.infinityfree.com';
$db   = 'if0_39548800_mediconnect';
$user = 'if0_39548800';
$pass = 'mediconnectWeb3';

// Create connection using MySQLi
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

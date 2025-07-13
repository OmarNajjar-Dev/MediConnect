<?php

$host = 'localhost';
$db   = 'mediconnect';
$user = 'root';
$pass = '';

// Create connection using MySQLi
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

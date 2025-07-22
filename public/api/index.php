<?php

// Enable full error reporting (for development)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Always return JSON
header('Content-Type: application/json');

// Define the root directory
if (!defined('ROOT')) {
    define('ROOT', dirname(__DIR__, 2));
}

// Get the route from the query string, e.g., ?route=Api/Doctors/get-doctors
$route = $_GET['route'] ?? '';

if (!$route) {
    http_response_code(400);
    echo json_encode([
        "success" => false,
        "message" => "Missing API route"
    ]);
    exit;
}

// Determine the full path to the target PHP file
$apiFile = ROOT . '/src/' . $route . '.php';

// Check if the target file exists and include it
if (file_exists($apiFile)) {
    require_once $apiFile;
} else {
    http_response_code(404);
    echo json_encode([
        "success" => false,
        "message" => "API route not found"
    ]);
}

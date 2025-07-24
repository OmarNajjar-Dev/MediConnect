<?php

/**
 * Get EmailJS Configuration
 * 
 * Returns EmailJS configuration values for frontend use
 */

require_once __DIR__ . '/../../config/apis.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

try {
    // Return EmailJS configuration
    echo json_encode([
        'success' => true,
        'data' => [
            'public_key' => EMAILJS_PUBLIC_KEY,
            'service_id' => EMAILJS_SERVICE_ID,
            'template_id' => EMAILJS_TEMPLATE_ID
        ]
    ]);
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false, 
        'message' => 'Failed to load EmailJS configuration: ' . $e->getMessage()
    ]);
}

?> 
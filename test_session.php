<?php
// Test script to verify session functionality
// This should be accessed after login to check if session data is preserved

// Load session configuration
require_once __DIR__ . '/backend/config/session-config.php';

// Start secure session
startSecureSession();

echo "<h2>Session Test Results</h2>";
echo "<pre>";

// Check if user is logged in
$userId = safeSessionRetrieve('user_id');
$userRole = safeSessionRetrieve('user_role');

echo "User ID: " . ($userId ? $userId : 'NOT SET') . "\n";
echo "User Role: " . ($userRole ? $userRole : 'NOT SET') . "\n";

// Display all session data
echo "\nAll Session Data:\n";
foreach ($_SESSION as $key => $value) {
    echo "$key: " . var_export($value, true) . "\n";
}

// Test session persistence
echo "\nTesting session persistence...\n";
safeSessionStore('test_key', 'test_value_' . time());
echo "Test value stored: " . safeSessionRetrieve('test_key') . "\n";

// Display session configuration
echo "\nSession Configuration:\n";
$debug = debugSession();
foreach ($debug as $key => $value) {
    if ($key !== 'session_data') {
        echo "$key: " . var_export($value, true) . "\n";
    }
}

echo "</pre>";

// Provide navigation links
echo "<h3>Navigation</h3>";
echo "<p><a href='pages/dashboard/'>Go to Dashboard</a></p>";
echo "<p><a href='pages/auth/login.php'>Go to Login</a></p>";
echo "<p><a href='backend/auth/logout.php'>Logout</a></p>";
?> 
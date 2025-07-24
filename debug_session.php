<?php
// Debug session issues on InfinityFree
// Place this file in your root directory and access it via browser

// Start session
session_start();

// Display session information
echo "<h2>Session Debug Information</h2>";
echo "<pre>";

echo "Session ID: " . session_id() . "\n";
echo "Session Name: " . session_name() . "\n";
echo "Session Status: " . session_status() . "\n";
echo "Session Save Path: " . session_save_path() . "\n";

// Check if session is writable
$sessionPath = session_save_path();
if (is_dir($sessionPath)) {
    echo "Session directory exists: Yes\n";
    echo "Session directory writable: " . (is_writable($sessionPath) ? "Yes" : "No") . "\n";
} else {
    echo "Session directory exists: No\n";
}

// Display current session data
echo "\nCurrent Session Data:\n";
if (empty($_SESSION)) {
    echo "Session is empty\n";
} else {
    foreach ($_SESSION as $key => $value) {
        echo "$key: " . var_export($value, true) . "\n";
    }
}

// Test setting session data
echo "\nTesting session write...\n";
$_SESSION['test_timestamp'] = time();
$_SESSION['test_string'] = 'Hello from InfinityFree';

echo "Test data set:\n";
echo "test_timestamp: " . $_SESSION['test_timestamp'] . "\n";
echo "test_string: " . $_SESSION['test_string'] . "\n";

// Check PHP session configuration
echo "\nPHP Session Configuration:\n";
echo "session.gc_maxlifetime: " . ini_get('session.gc_maxlifetime') . "\n";
echo "session.cookie_lifetime: " . ini_get('session.cookie_lifetime') . "\n";
echo "session.use_cookies: " . ini_get('session.use_cookies') . "\n";
echo "session.use_only_cookies: " . ini_get('session.use_only_cookies') . "\n";
echo "session.cookie_secure: " . ini_get('session.cookie_secure') . "\n";
echo "session.cookie_httponly: " . ini_get('session.cookie_httponly') . "\n";
echo "session.cookie_samesite: " . ini_get('session.cookie_samesite') . "\n";

// Check server information
echo "\nServer Information:\n";
echo "PHP Version: " . PHP_VERSION . "\n";
echo "Server Software: " . $_SERVER['SERVER_SOFTWARE'] . "\n";
echo "Document Root: " . $_SERVER['DOCUMENT_ROOT'] . "\n";

echo "</pre>";

// Test session persistence across requests
if (isset($_GET['test_persistence'])) {
    echo "<h3>Session Persistence Test</h3>";
    echo "<p>If you see the test data above, session writing works.</p>";
    echo "<p><a href='?test_persistence=1'>Refresh to test persistence</a></p>";
    echo "<p><a href='?clear_session=1'>Clear session</a></p>";
}

if (isset($_GET['clear_session'])) {
    session_destroy();
    echo "<h3>Session Cleared</h3>";
    echo "<p><a href='debug_session.php'>Start over</a></p>";
}
?> 
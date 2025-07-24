<?php
// Simple session test for InfinityFree
session_start();

echo "<h2>Simple Session Test</h2>";
echo "<pre>";

// Check if session is working
echo "Session ID: " . session_id() . "\n";
echo "Session Status: " . session_status() . "\n";

// Test setting and reading session data
$_SESSION['test_key'] = 'test_value_' . time();
echo "Test value set: " . $_SESSION['test_key'] . "\n";

// Display all session data
echo "\nAll Session Data:\n";
foreach ($_SESSION as $key => $value) {
    echo "$key: " . var_export($value, true) . "\n";
}

// Test if we can read the test value
echo "\nReading test value: " . ($_SESSION['test_key'] ?? 'NOT FOUND') . "\n";

echo "</pre>";

// Test persistence
if (isset($_GET['test_persistence'])) {
    echo "<h3>Persistence Test</h3>";
    echo "<p>If you see the test value above, session is working.</p>";
    echo "<p><a href='?test_persistence=1'>Refresh to test persistence</a></p>";
    echo "<p><a href='?clear=1'>Clear session</a></p>";
}

if (isset($_GET['clear'])) {
    session_destroy();
    echo "<h3>Session Cleared</h3>";
    echo "<p><a href='simple_session_test.php'>Start over</a></p>";
}

// Navigation
echo "<h3>Navigation</h3>";
echo "<p><a href='pages/auth/login.php'>Go to Login</a></p>";
echo "<p><a href='debug_session.php'>Full Debug</a></p>";
?> 
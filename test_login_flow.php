<?php
// Comprehensive login flow test
// This tests the entire process from login to dashboard access

// Start session
session_start();

echo "<h2>Login Flow Test</h2>";
echo "<pre>";

// Step 1: Check current session state
echo "=== STEP 1: Current Session State ===\n";
echo "Session ID: " . session_id() . "\n";
echo "User ID: " . ($_SESSION['user_id'] ?? 'NOT SET') . "\n";
echo "User Role: " . ($_SESSION['user_role'] ?? 'NOT SET') . "\n";

// Step 2: Simulate login process
echo "\n=== STEP 2: Simulating Login Process ===\n";

// Simulate setting user data
$_SESSION['user_id'] = 1;
echo "Set user_id = 1\n";

// Simulate setting role with fallback
require_once __DIR__ . '/backend/helpers/session-fallback.php';
setUserRoleWithFallback('patient');
echo "Set user_role = 'patient' with fallback\n";

// Step 3: Test role retrieval
echo "\n=== STEP 3: Testing Role Retrieval ===\n";

// Test direct session access
$sessionRole = $_SESSION['user_role'] ?? null;
echo "Role from session: " . ($sessionRole ? $sessionRole : 'NULL') . "\n";

// Test cookie fallback
$cookieRole = $_COOKIE['user_role_backup'] ?? null;
echo "Role from cookie: " . ($cookieRole ? $cookieRole : 'NULL') . "\n";

// Step 4: Test dashboard logic
echo "\n=== STEP 4: Testing Dashboard Logic ===\n";

$userId = $_SESSION['user_id'] ?? null;
if (!$userId) {
    echo "ERROR: No user ID in session\n";
} else {
    echo "User ID found: $userId\n";
    
    // Simulate the dashboard role checking
    $role = $_SESSION['user_role'] ?? null;
    if (!$role) {
        echo "WARNING: No role in session, checking cookie...\n";
        $role = $_COOKIE['user_role_backup'] ?? null;
    }
    
    if (!$role) {
        echo "ERROR: No role found in session or cookie\n";
    } else {
        echo "Role found: $role\n";
        
        // Test role-based routing
        switch ($role) {
            case 'patient':
                echo "✓ Would redirect to patient dashboard\n";
                break;
            case 'doctor':
                echo "✓ Would redirect to doctor dashboard\n";
                break;
            case 'super_admin':
                echo "✓ Would redirect to super admin dashboard\n";
                break;
            case 'hospital_admin':
                echo "✓ Would redirect to hospital admin dashboard\n";
                break;
            case 'ambulance_team':
                echo "✓ Would redirect to ambulance dashboard\n";
                break;
            default:
                echo "✗ Unknown role: $role\n";
        }
    }
}

// Step 5: Test session persistence
echo "\n=== STEP 5: Testing Session Persistence ===\n";
session_write_close();
session_start();
echo "After session restart:\n";
echo "User ID: " . ($_SESSION['user_id'] ?? 'NOT SET') . "\n";
echo "User Role: " . ($_SESSION['user_role'] ?? 'NOT SET') . "\n";

// Step 6: Display all session and cookie data
echo "\n=== STEP 6: All Data ===\n";
echo "Session data:\n";
foreach ($_SESSION as $key => $value) {
    echo "  $key: " . var_export($value, true) . "\n";
}

echo "Cookie data:\n";
foreach ($_COOKIE as $key => $value) {
    if (strpos($key, 'user_role') !== false) {
        echo "  $key: " . var_export($value, true) . "\n";
    }
}

echo "</pre>";

// Test scenarios
echo "<h3>Test Scenarios</h3>";
echo "<p><a href='?test=login'>Test Login Process</a></p>";
echo "<p><a href='?test=dashboard'>Test Dashboard Access</a></p>";
echo "<p><a href='?test=fallback'>Test Fallback System</a></p>";
echo "<p><a href='?clear=1'>Clear All Data</a></p>";

if (isset($_GET['test'])) {
    echo "<h3>Test Results</h3>";
    echo "<pre>";
    
    switch ($_GET['test']) {
        case 'login':
            echo "=== Login Process Test ===\n";
            
            // Simulate login
            $_SESSION['user_id'] = 1;
            setUserRoleWithFallback('patient');
            
            echo "Login completed:\n";
            echo "User ID: " . $_SESSION['user_id'] . "\n";
            echo "User Role: " . ($_SESSION['user_role'] ?? 'NOT SET') . "\n";
            echo "Cookie Role: " . ($_COOKIE['user_role_backup'] ?? 'NOT SET') . "\n";
            break;
            
        case 'dashboard':
            echo "=== Dashboard Access Test ===\n";
            
            $userId = $_SESSION['user_id'] ?? null;
            $role = $_SESSION['user_role'] ?? $_COOKIE['user_role_backup'] ?? null;
            
            if (!$userId) {
                echo "FAIL: No user ID\n";
            } elseif (!$role) {
                echo "FAIL: No role found\n";
            } else {
                echo "PASS: User ID = $userId, Role = $role\n";
                echo "Would access dashboard successfully\n";
            }
            break;
            
        case 'fallback':
            echo "=== Fallback System Test ===\n";
            
            // Clear session role but keep user ID
            unset($_SESSION['user_role']);
            echo "Cleared session role\n";
            
            // Check if cookie fallback works
            $role = $_COOKIE['user_role_backup'] ?? null;
            if ($role) {
                echo "PASS: Role found in cookie: $role\n";
            } else {
                echo "FAIL: No role in cookie\n";
            }
            break;
    }
    
    echo "</pre>";
}

if (isset($_GET['clear'])) {
    // Clear session
    session_destroy();
    
    // Clear cookies
    setcookie('user_role_backup', '', time() - 3600, '/');
    
    echo "<h3>All Data Cleared</h3>";
    echo "<p><a href='test_login_flow.php'>Start over</a></p>";
}

echo "<h3>Navigation</h3>";
echo "<p><a href='pages/auth/login.php'>Go to Login</a></p>";
echo "<p><a href='pages/dashboard/'>Go to Dashboard</a></p>";
echo "<p><a href='simple_session_test.php'>Simple Session Test</a></p>";
echo "<p><a href='login_debug.php'>Login Debug</a></p>";
?> 
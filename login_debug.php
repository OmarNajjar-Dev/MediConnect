<?php
// Comprehensive login debugging script
// This will help identify where the session issue occurs

// Start session
session_start();

echo "<h2>Login Process Debug</h2>";
echo "<pre>";

// Step 1: Check initial session state
echo "=== STEP 1: Initial Session State ===\n";
echo "Session ID: " . session_id() . "\n";
echo "Session Status: " . session_status() . "\n";
echo "User ID in session: " . ($_SESSION['user_id'] ?? 'NOT SET') . "\n";
echo "User Role in session: " . ($_SESSION['user_role'] ?? 'NOT SET') . "\n";

// Step 2: Simulate login process
echo "\n=== STEP 2: Simulating Login Process ===\n";

// Simulate setting user ID
$_SESSION['user_id'] = 1;
echo "Set user_id to 1\n";

// Simulate setting user role
$_SESSION['user_role'] = 'patient';
echo "Set user_role to 'patient'\n";

// Step 3: Check session after setting values
echo "\n=== STEP 3: Session After Setting Values ===\n";
echo "User ID in session: " . ($_SESSION['user_id'] ?? 'NOT SET') . "\n";
echo "User Role in session: " . ($_SESSION['user_role'] ?? 'NOT SET') . "\n";

// Step 4: Test session persistence
echo "\n=== STEP 4: Testing Session Persistence ===\n";
session_write_close();
session_start();
echo "After session_write_close() and session_start():\n";
echo "User ID in session: " . ($_SESSION['user_id'] ?? 'NOT SET') . "\n";
echo "User Role in session: " . ($_SESSION['user_role'] ?? 'NOT SET') . "\n";

// Step 5: Display all session data
echo "\n=== STEP 5: All Session Data ===\n";
foreach ($_SESSION as $key => $value) {
    echo "$key: " . var_export($value, true) . "\n";
}

// Step 6: Test role checking logic
echo "\n=== STEP 6: Testing Role Checking Logic ===\n";
$userRole = $_SESSION['user_role'] ?? null;
$requiredRole = 'patient';

echo "User Role: " . ($userRole ? $userRole : 'NULL') . "\n";
echo "Required Role: " . $requiredRole . "\n";
echo "Roles match: " . ($userRole === $requiredRole ? 'YES' : 'NO') . "\n";

if (!$userRole) {
    echo "ERROR: User role is missing!\n";
}

if ($userRole !== $requiredRole) {
    echo "ERROR: Role mismatch!\n";
}

echo "</pre>";

// Test different scenarios
echo "<h3>Test Scenarios</h3>";
echo "<p><a href='?test=1'>Test 1: Basic session</a></p>";
echo "<p><a href='?test=2'>Test 2: Role checking</a></p>";
echo "<p><a href='?test=3'>Test 3: Dashboard simulation</a></p>";
echo "<p><a href='?clear=1'>Clear session</a></p>";

if (isset($_GET['test'])) {
    echo "<h3>Test Results</h3>";
    echo "<pre>";
    
    switch ($_GET['test']) {
        case '1':
            echo "Test 1: Basic session functionality\n";
            $_SESSION['test1'] = 'value1';
            echo "Set test1 = value1\n";
            session_write_close();
            session_start();
            echo "After restart: test1 = " . ($_SESSION['test1'] ?? 'NOT FOUND') . "\n";
            break;
            
        case '2':
            echo "Test 2: Role checking\n";
            $_SESSION['user_id'] = 1;
            $_SESSION['user_role'] = 'patient';
            echo "Set user_id=1, user_role=patient\n";
            
            $role = $_SESSION['user_role'] ?? null;
            echo "Retrieved role: " . ($role ? $role : 'NULL') . "\n";
            echo "Role check result: " . ($role === 'patient' ? 'PASS' : 'FAIL') . "\n";
            break;
            
        case '3':
            echo "Test 3: Dashboard simulation\n";
            // Simulate the dashboard logic
            if (!isset($_SESSION['user_id'])) {
                echo "ERROR: No user_id in session\n";
            } else {
                echo "User ID found: " . $_SESSION['user_id'] . "\n";
                
                $userRole = $_SESSION['user_role'] ?? null;
                if (!$userRole) {
                    echo "ERROR: No user_role in session\n";
                } else {
                    echo "User role found: " . $userRole . "\n";
                    
                    switch ($userRole) {
                        case 'patient':
                            echo "Would redirect to patient dashboard\n";
                            break;
                        case 'doctor':
                            echo "Would redirect to doctor dashboard\n";
                            break;
                        default:
                            echo "Unknown role: " . $userRole . "\n";
                    }
                }
            }
            break;
    }
    
    echo "</pre>";
}

if (isset($_GET['clear'])) {
    session_destroy();
    echo "<h3>Session Cleared</h3>";
    echo "<p><a href='login_debug.php'>Start over</a></p>";
}

echo "<h3>Navigation</h3>";
echo "<p><a href='pages/auth/login.php'>Go to Login</a></p>";
echo "<p><a href='pages/dashboard/'>Go to Dashboard</a></p>";
echo "<p><a href='simple_session_test.php'>Simple Session Test</a></p>";
?> 
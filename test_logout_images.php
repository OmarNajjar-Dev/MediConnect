<?php
// Load session configuration
require_once __DIR__ . "/backend/config/session-config.php";

// Start session
startSecureSession();

// Simulate a logged-in user for testing
if (!isset($_SESSION['user_id'])) {
    $_SESSION['user_id'] = 1;
    $_SESSION['user_name'] = 'Test User';
    $_SESSION['user_email'] = 'test@example.com';
    $_SESSION['user_role'] = 'superadmin';
    $_SESSION['user_profile_image'] = '/uploads/profile_images/test.jpg';
}

// Load avatar helper
require_once __DIR__ . "/backend/helpers/avatar-helper.php";

echo "<h1>Test Logout and Images</h1>";

if (isset($_SESSION['user_id'])) {
    echo "<p>✅ User is logged in. User ID: " . $_SESSION['user_id'] . "</p>";
    echo "<p>User Name: " . ($_SESSION['user_name'] ?? 'Not set') . "</p>";
    echo "<p>User Role: " . ($_SESSION['user_role'] ?? 'Not set') . "</p>";
    echo "<p>Profile Image: " . ($_SESSION['user_profile_image'] ?? 'Not set') . "</p>";
    
    echo "<h2>Test Avatar Display</h2>";
    echo "<p>Avatar with image:</p>";
    echo generateAvatar($_SESSION['user_profile_image'], $_SESSION['user_name'], 'w-16 h-16', 'text-lg');
    
    echo "<p>Avatar without image (fallback):</p>";
    echo generateAvatar('', $_SESSION['user_name'], 'w-16 h-16', 'text-lg');
    
    echo "<h2>Test Logout</h2>";
    echo "<p><a href='/backend/auth/logout.php' style='background: red; color: white; padding: 10px; text-decoration: none; border-radius: 5px; display: inline-block;'>Logout</a></p>";
    
} else {
    echo "<p>❌ User is not logged in.</p>";
    echo "<p><a href='/pages/auth/login.php'>Go to login page</a></p>";
}

echo "<h2>Session Data</h2>";
echo "<pre>";
print_r($_SESSION);
echo "</pre>";

echo "<h2>Cookies</h2>";
echo "<pre>";
print_r($_COOKIE);
echo "</pre>";

echo "<h2>Uploads Directory Check</h2>";
$uploadsDir = __DIR__ . '/uploads';
$profileImagesDir = __DIR__ . '/uploads/profile_images';

echo "<p>Uploads directory exists: " . (is_dir($uploadsDir) ? '✅ Yes' : '❌ No') . "</p>";
echo "<p>Profile images directory exists: " . (is_dir($profileImagesDir) ? '✅ Yes' : '❌ No') . "</p>";

if (is_dir($profileImagesDir)) {
    echo "<p>Files in profile_images directory:</p>";
    $files = scandir($profileImagesDir);
    echo "<ul>";
    foreach ($files as $file) {
        if ($file !== '.' && $file !== '..') {
            echo "<li>$file</li>";
        }
    }
    echo "</ul>";
}
?> 
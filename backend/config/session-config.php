<?php

/**
 * Session Configuration for InfinityFree
 * Handles common session issues on shared hosting environments
 */

// Set session configuration before starting session
function configureSession() {
    // Set session timeout to 30 minutes
    ini_set('session.gc_maxlifetime', 1800);
    ini_set('session.cookie_lifetime', 0); // Session cookie (expires when browser closes)
    
    // Ensure cookies are used for sessions
    ini_set('session.use_cookies', 1);
    ini_set('session.use_only_cookies', 1);
    
    // Security settings
    ini_set('session.cookie_httponly', 1);
    ini_set('session.cookie_samesite', 'Lax');
    
    // For InfinityFree, we need to be careful with secure cookies
    // Only set secure if we're on HTTPS
    if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
        ini_set('session.cookie_secure', 1);
    } else {
        ini_set('session.cookie_secure', 0);
    }
    
    // Set session name
    session_name('MediConnect_Session');
    
    // Don't try to change session save path on InfinityFree
    // Let it use the default system path
}

// Enhanced session start function
function startSecureSession() {
    // Configure session before starting
    configureSession();
    
    // Start session if not already started
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    // Regenerate session ID periodically for security (but not too often)
    if (!isset($_SESSION['last_regeneration'])) {
        $_SESSION['last_regeneration'] = time();
    } elseif (time() - $_SESSION['last_regeneration'] > 600) { // 10 minutes
        session_regenerate_id(true);
        $_SESSION['last_regeneration'] = time();
    }
}

// Function to safely store session data
function safeSessionStore($key, $value) {
    if (session_status() === PHP_SESSION_NONE) {
        startSecureSession();
    }
    
    $_SESSION[$key] = $value;
    
    // Force session write
    session_write_close();
    session_start();
}

// Function to safely retrieve session data
function safeSessionRetrieve($key, $default = null) {
    if (session_status() === PHP_SESSION_NONE) {
        startSecureSession();
    }
    
    return $_SESSION[$key] ?? $default;
}

// Function to check if session is valid
function isSessionValid() {
    if (session_status() === PHP_SESSION_NONE) {
        return false;
    }
    
    return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
}

// Function to debug session issues
function debugSession() {
    $debug = [
        'session_id' => session_id(),
        'session_status' => session_status(),
        'session_save_path' => session_save_path(),
        'session_data' => $_SESSION,
        'php_version' => PHP_VERSION,
        'server_software' => $_SERVER['SERVER_SOFTWARE'] ?? 'Unknown',
        'https' => isset($_SERVER['HTTPS']) ? $_SERVER['HTTPS'] : 'off'
    ];
    
    return $debug;
}

?> 
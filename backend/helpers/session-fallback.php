<?php

/**
 * Session Fallback Helper
 * Provides fallback methods when session-based role storage fails
 */

/**
 * Get user role from database as fallback
 * 
 * @param mysqli $conn Database connection
 * @param int $userId User ID
 * @return string|null Role name in snake_case format or null if not found
 */
function getUserRoleFromDatabase($conn, $userId) {
    if (!$userId) {
        return null;
    }
    
    $stmt = $conn->prepare("
        SELECT r.role_name 
        FROM user_roles ur
        JOIN roles r ON ur.role_id = r.role_id
        WHERE ur.user_id = ?
        LIMIT 1
    ");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $roleName = trim($row['role_name']);
        $stmt->close();
        
        // Convert to snake_case
        return strtolower(str_replace([' ', '-'], '_', $roleName));
    }
    
    $stmt->close();
    return null;
}

/**
 * Enhanced role retrieval that tries session first, then database
 * 
 * @param mysqli $conn Database connection
 * @param int $userId User ID
 * @return string|null Role name or null if not found
 */
function getCurrentUserRole($conn, $userId) {
    // First try to get from session
    if (isset($_SESSION['user_role']) && !empty($_SESSION['user_role'])) {
        return $_SESSION['user_role'];
    }
    
    // Fallback to database
    return getUserRoleFromDatabase($conn, $userId);
}

/**
 * Enhanced user authentication check
 * 
 * @param mysqli $conn Database connection
 * @param string $requiredRole Required role for access
 * @return bool True if user has required role, false otherwise
 */
function checkUserRole($conn, $requiredRole) {
    // Check if user is logged in
    if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
        return false;
    }
    
    $userId = $_SESSION['user_id'];
    $userRole = getCurrentUserRole($conn, $userId);
    
    // Debug logging
    if (!$userRole) {
        error_log("Role check failed - User ID: $userId, Required Role: $requiredRole");
        error_log("Session data: " . print_r($_SESSION, true));
    }
    
    return $userRole === $requiredRole;
}

/**
 * Set user role in session with fallback to cookie
 * 
 * @param string $role Role name to store
 * @return bool True if stored successfully
 */
function setUserRoleWithFallback($role) {
    // Try session first
    $_SESSION['user_role'] = $role;
    
    // Also set as cookie as backup (less secure but more reliable)
    $secure = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on';
    setcookie('user_role_backup', $role, time() + 3600, '/', '', $secure, true);
    
    return true;
}

/**
 * Get user role with multiple fallbacks
 * 
 * @param mysqli $conn Database connection
 * @param int $userId User ID
 * @return string|null Role name or null if not found
 */
function getUserRoleWithFallbacks($conn, $userId) {
    // 1. Try session
    if (isset($_SESSION['user_role']) && !empty($_SESSION['user_role'])) {
        return $_SESSION['user_role'];
    }
    
    // 2. Try cookie backup
    if (isset($_COOKIE['user_role_backup']) && !empty($_COOKIE['user_role_backup'])) {
        return $_COOKIE['user_role_backup'];
    }
    
    // 3. Try database
    return getUserRoleFromDatabase($conn, $userId);
}

?> 
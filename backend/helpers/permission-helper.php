<?php

/**
 * Check if the current user can access the appointments page
 * Only patients can access appointments
 * 
 * @return bool
 */
function canAccessAppointments() {
    // If not logged in, cannot access appointments
    if (!isset($_SESSION['user_id'])) {
        return false;
    }
    
    // Only patients can access appointments
    return $_SESSION['user_role'] === 'patient';
}

/**
 * Check if the current user can access the emergency page
 * Patients and guests can access emergency
 * 
 * @return bool
 */
function canAccessEmergency() {
    // If not logged in (guest), can access emergency
    if (!isset($_SESSION['user_id'])) {
        return true;
    }
    
    // Patients can access emergency
    if ($_SESSION['user_role'] === 'patient') {
        return true;
    }
    
    // Other roles cannot access emergency
    return false;
}

/**
 * Get the appropriate CSS classes for disabled navigation links
 * 
 * @param bool $isDisabled Whether the link should be disabled
 * @param string $baseClasses Base CSS classes for the link
 * @return string CSS classes string
 */
function getDisabledNavClasses($isDisabled, $baseClasses = '') {
    if ($isDisabled) {
        return $baseClasses . ' opacity-50 cursor-not-allowed pointer-events-none';
    }
    return $baseClasses;
}

/**
 * Get the appropriate CSS classes for disabled mobile navigation links
 * 
 * @param bool $isDisabled Whether the link should be disabled
 * @param string $baseClasses Base CSS classes for the link
 * @return string CSS classes string
 */
function getDisabledMobileNavClasses($isDisabled, $baseClasses = '') {
    if ($isDisabled) {
        return $baseClasses . ' opacity-50 cursor-not-allowed pointer-events-none';
    }
    return $baseClasses;
} 
<?php

/**
 * Generate avatar HTML with profile image or initials fallback
 * 
 * @param string $profileImage - URL to profile image (can be null/empty)
 * @param string $fullName - Full name for initials
 * @param string $size - Size class (default: 'w-8 h-8')
 * @param string $textSize - Text size class (default: 'text-sm')
 * @return string - HTML for avatar
 */
function generateAvatar($profileImage, $fullName, $size = 'w-8 h-8', $textSize = 'text-sm')
{
    if (!empty($profileImage)) {
        // Use profile image
        return '<img src="' . htmlspecialchars($profileImage) . '" alt="' . htmlspecialchars($fullName) . '" class="' . $size . ' rounded-full object-cover">';
    } else {
        // Use initials
        $initials = generateInitials($fullName);
        return "<div class=\"{$size} rounded-full bg-medical-100 flex items-center justify-center text-medical-700 {$textSize} font-medium\">{$initials}</div>";
    }
}

/**
 * Generate initials from full name
 * 
 * @param string $fullName - Full name
 * @return string - Initials (max 2 characters)
 */
function generateInitials($fullName)
{
    $nameParts = explode(' ', trim($fullName));
    $initials = '';

    // Get first letter of first name
    if (isset($nameParts[0]) && strlen($nameParts[0]) > 0) {
        $initials .= strtoupper(substr($nameParts[0], 0, 1));
    }

    // Get first letter of last name
    if (isset($nameParts[1]) && strlen($nameParts[1]) > 0) {
        $initials .= strtoupper(substr($nameParts[1], 0, 1));
    } else if (strlen($initials) === 0 && isset($nameParts[0])) {
        // If no last name, use first two letters of first name
        $initials = strtoupper(substr($nameParts[0], 0, 2));
    }

    return $initials ?: '?';
}

/**
 * Fetch user profile data (city and address)
 * 
 * @param int $userId - User ID to fetch data for
 * @param mysqli $conn - Database connection
 * @return array - Array with 'city' and 'address' keys
 */
function getUserProfileData($userId, $conn)
{
    $profileData = [
        'city' => '',
        'address' => ''
    ];

    if (!$userId || !$conn) {
        return $profileData;
    }

    try {
        $stmt = $conn->prepare("SELECT city, address_line FROM users WHERE user_id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($user = $result->fetch_assoc()) {
            $profileData['city'] = $user['city'] ?? '';
            $profileData['address'] = trim($user['address_line'] ?? '');
        }

        $stmt->close();
    } catch (Exception $e) {
        // Log error if needed, but return empty data gracefully
        error_log("Error fetching user profile data: " . $e->getMessage());
    }

    return $profileData;
}

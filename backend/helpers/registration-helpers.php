<?php

/**
 * Registration Helper Functions
 * Contains all utility functions used in the registration process
 */

require_once __DIR__ . '/auth-helpers.php';
require_once __DIR__ . '/../config/apis.php';

/**
 * Get coordinates from address using OpenCage API
 * 
 * @param string $address The address to geocode
 * @return array [latitude, longitude] or [null, null] if failed
 */
function getCoordinatesFromOpenCage($address)
{
    $url = OPENCAGE_BASE_URL . "?" . http_build_query([
        'q' => $address,
        'key' => OPENCAGE_API_KEY,
        'language' => 'en',
        'limit' => 1,
        'no_annotations' => 1
    ]);

    $response = file_get_contents($url);
    $data = json_decode($response, true);

    if ($data && isset($data['results'][0]['geometry'])) {
        $location = $data['results'][0]['geometry'];
        return [$location['lat'], $location['lng']];
    }

    return [null, null];
}

/**
 * Validate email format
 * 
 * @param string $email Email to validate
 * @return bool True if valid, false otherwise
 */
function validateEmail($email): bool
{
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

/**
 * Check if email already exists in database
 * 
 * @param mysqli $conn Database connection
 * @param string $email Email to check
 * @return bool True if exists, false otherwise
 */
function emailExists($conn, $email): bool
{
    $stmt = $conn->prepare("SELECT user_id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $exists = $result->num_rows > 0;
    $stmt->close();
    
    return $exists;
}

/**
 * Get role ID from role name
 * 
 * @param mysqli $conn Database connection
 * @param string $roleName Role name to look up
 * @return int|null Role ID or null if not found
 */
function getRoleId($conn, $roleName): ?int
{
    $stmt = $conn->prepare("SELECT role_id FROM roles WHERE role_name = ?");
    $stmt->bind_param("s", $roleName);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $roleId = $row["role_id"];
        $stmt->close();
        return $roleId;
    }
    
    $stmt->close();
    return null;
}

/**
 * Validate role is in allowed list
 * 
 * @param string $roleName Role name to validate
 * @param array $allowedRoles Array of allowed roles
 * @return bool True if allowed, false otherwise
 */
function validateRole($roleName, $allowedRoles = ['Patient', 'Doctor', 'Ambulance Team', 'Staff']): bool
{
    return in_array($roleName, $allowedRoles);
}

/**
 * Create user account with role
 * 
 * @param mysqli $conn Database connection
 * @param array $userData User data array
 * @param string $roleName Role name
 * @return array ['success' => bool, 'user_id' => int|null, 'error' => string|null]
 */
function createUserAccount($conn, $userData, $roleName): array
{
    try {
        // Get role ID
        $roleId = getRoleId($conn, $roleName);
        if (!$roleId) {
            return ['success' => false, 'user_id' => null, 'error' => 'Invalid role'];
        }

        // Start transaction
        $conn->begin_transaction();

        // Insert user
        $hashedPassword = password_hash($userData['password'], PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO users (email, password, first_name, last_name, city, address_line) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", 
            $userData['email'], 
            $hashedPassword, 
            $userData['first_name'], 
            $userData['last_name'], 
            $userData['city'], 
            $userData['address']
        );

        if (!$stmt->execute()) {
            $conn->rollback();
            return ['success' => false, 'user_id' => null, 'error' => 'Failed to create user'];
        }

        $userId = $conn->insert_id;
        $stmt->close();

        // Link user to role
        $stmt = $conn->prepare("INSERT INTO user_roles (user_id, role_id) VALUES (?, ?)");
        $stmt->bind_param("ii", $userId, $roleId);
        
        if (!$stmt->execute()) {
            $conn->rollback();
            return ['success' => false, 'user_id' => null, 'error' => 'Failed to link user to role'];
        }
        $stmt->close();

        // Create role-specific records
        $roleResult = createRoleSpecificRecord($conn, $userId, $roleName, $userData);
        if (!$roleResult['success']) {
            $conn->rollback();
            return $roleResult;
        }

        $conn->commit();
        return ['success' => true, 'user_id' => $userId, 'error' => null];

    } catch (Exception $e) {
        $conn->rollback();
        return ['success' => false, 'user_id' => null, 'error' => $e->getMessage()];
    }
}

/**
 * Create role-specific database records
 * 
 * @param mysqli $conn Database connection
 * @param int $userId User ID
 * @param string $roleName Role name
 * @param array $userData User data
 * @return array ['success' => bool, 'error' => string|null]
 */
function createRoleSpecificRecord($conn, $userId, $roleName, $userData): array
{
    try {
        switch ($roleName) {
            case 'Patient':
                $stmt = $conn->prepare("INSERT INTO patients (user_id) VALUES (?)");
                $stmt->bind_param("i", $userId);
                $stmt->execute();
                $stmt->close();
                break;

            case 'Doctor':
                if (empty($userData['hospital_id']) || empty($userData['specialty_id'])) {
                    return ['success' => false, 'error' => 'Hospital and specialty required for doctors'];
                }
                $stmt = $conn->prepare("INSERT INTO doctors (user_id, hospital_id, specialty_id, is_verified) VALUES (?, ?, ?, 0)");
                $stmt->bind_param("iii", $userId, $userData['hospital_id'], $userData['specialty_id']);
                $stmt->execute();
                $stmt->close();
                break;

            case 'Ambulance Team':
                $teamName = $userData['team_name'] ?? ($userData['first_name'] . "'s Team");
                $stmt = $conn->prepare("INSERT INTO ambulance_teams (user_id, team_name) VALUES (?, ?)");
                $stmt->bind_param("is", $userId, $teamName);
                $stmt->execute();
                $teamId = $conn->insert_id;
                $stmt->close();

                // Create location record if address provided
                if (!empty($userData['address'])) {
                    list($lat, $lng) = getCoordinatesFromOpenCage($userData['address']);
                    if ($lat && $lng) {
                        $updatedAt = date("Y-m-d H:i:s");
                        $stmt = $conn->prepare("INSERT INTO ambulance_locations (team_id, latitude, longitude, updated_at) VALUES (?, ?, ?, ?)");
                        $stmt->bind_param("idds", $teamId, $lat, $lng, $updatedAt);
                        $stmt->execute();
                        $stmt->close();
                    }
                }
                break;

            case 'Staff':
                // Staff doesn't need additional records
                break;

            default:
                return ['success' => false, 'error' => 'Unsupported role'];
        }

        return ['success' => true, 'error' => null];

    } catch (Exception $e) {
        return ['success' => false, 'error' => $e->getMessage()];
    }
}

/**
 * Initialize user session after successful registration
 * 
 * @param int $userId User ID
 * @param string $roleName Role name
 */
function initializeUserSession($userId, $roleName): void
{
    $_SESSION["user_id"] = $userId;
    storeUserRoleInSession($roleName);
} 
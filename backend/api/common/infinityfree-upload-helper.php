<?php
// backend/api/common/infinityfree-upload-helper.php
// Comprehensive solution for image upload issues on InfinityFree hosting

class InfinityFreeUploadHelper {
    
    /**
     * Attempts to upload an image using multiple methods for InfinityFree compatibility
     */
    public static function uploadImage($file, $userId) {
        global $conn;
        
        // Validate file
        if (!$file || $file['error'] !== UPLOAD_ERR_OK) {
            return ['success' => false, 'message' => 'File upload error'];
        }
        
        // Validate file type
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        if (!in_array($file['type'], $allowedTypes)) {
            return ['success' => false, 'message' => 'Invalid file type. Only JPEG, PNG, GIF, and WebP are allowed.'];
        }
        
        // Validate file size (5MB max)
        if ($file['size'] > 5 * 1024 * 1024) {
            return ['success' => false, 'message' => 'File too large. Maximum size is 5MB.'];
        }
        
        // Method 1: Try file upload to various directories
        $result = self::tryFileUpload($file, $userId);
        if ($result['success']) {
            return $result;
        }
        
        // Method 2: Save as base64 in database
        $result = self::saveAsBase64($file, $userId);
        if ($result['success']) {
            return $result;
        }
        
        // Method 3: Try alternative directories
        $result = self::tryAlternativeDirectories($file, $userId);
        if ($result['success']) {
            return $result;
        }
        
        return ['success' => false, 'message' => 'Failed to upload image. Please try again.'];
    }
    
    /**
     * Attempts to upload file to various possible directories
     */
    private static function tryFileUpload($file, $userId) {
        $uploadDirs = [
            __DIR__ . '/../../../uploads/profile_images/',
            __DIR__ . '/../../../public_html/uploads/profile_images/',
            __DIR__ . '/../../../htdocs/uploads/profile_images/',
            __DIR__ . '/../../../www/uploads/profile_images/',
            __DIR__ . '/../../../profile_images/',
            __DIR__ . '/../../profile_images/',
            __DIR__ . '/../profile_images/',
            __DIR__ . '/profile_images/'
        ];
        
        foreach ($uploadDirs as $uploadDir) {
            // Try to create directory if it doesn't exist
            if (!is_dir($uploadDir)) {
                if (!@mkdir($uploadDir, 0755, true)) {
                    continue;
                }
            }
            
            // Check if directory is writable
            if (!is_writable($uploadDir)) {
                continue;
            }
            
            // Delete old image
            self::deleteOldImage($userId, $uploadDir);
            
            // Generate unique filename
            $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
            $newFileName = 'profile_' . $userId . '_' . time() . '.' . $extension;
            $uploadPath = $uploadDir . $newFileName;
            
            // Upload file
            if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
                // Update database
                $imageUrl = '/uploads/profile_images/' . $newFileName;
                if (self::updateDatabase($userId, $imageUrl)) {
                    return [
                        'success' => true,
                        'imageUrl' => $imageUrl,
                        'method' => 'file_upload',
                        'path' => $uploadPath
                    ];
                }
            }
        }
        
        return ['success' => false, 'message' => 'File upload failed'];
    }
    
    /**
     * Saves image as base64 in database
     */
    private static function saveAsBase64($file, $userId) {
        global $conn;
        
        try {
            // Read file content
            $imageData = file_get_contents($file['tmp_name']);
            if ($imageData === false) {
                return ['success' => false, 'message' => 'Failed to read file'];
            }
            
            // Convert to base64
            $base64Image = 'data:' . $file['type'] . ';base64,' . base64_encode($imageData);
            
            // Update database
            if (self::updateDatabase($userId, $base64Image)) {
                return [
                    'success' => true,
                    'imageUrl' => $base64Image,
                    'method' => 'base64_storage'
                ];
            }
            
        } catch (Exception $e) {
            return ['success' => false, 'message' => 'Error saving image: ' . $e->getMessage()];
        }
        
        return ['success' => false, 'message' => 'Failed to save as base64'];
    }
    
    /**
     * Tries alternative directories including temp directory
     */
    private static function tryAlternativeDirectories($file, $userId) {
        // Try using temp directory
        $tempDir = sys_get_temp_dir() . '/mediconnect_uploads/';
        
        if (!is_dir($tempDir)) {
            if (!@mkdir($tempDir, 0755, true)) {
                return ['success' => false, 'message' => 'Cannot create temp directory'];
            }
        }
        
        if (is_writable($tempDir)) {
            $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
            $newFileName = 'profile_' . $userId . '_' . time() . '.' . $extension;
            $uploadPath = $tempDir . $newFileName;
            
            if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
                // In this case, we save the full path
                $imageUrl = $uploadPath;
                if (self::updateDatabase($userId, $imageUrl)) {
                    return [
                        'success' => true,
                        'imageUrl' => $imageUrl,
                        'method' => 'temp_directory'
                    ];
                }
            }
        }
        
        return ['success' => false, 'message' => 'Alternative directories failed'];
    }
    
    /**
     * Deletes old image file
     */
    private static function deleteOldImage($userId, $uploadDir) {
        global $conn;
        
        try {
            $stmt = $conn->prepare("SELECT profile_image FROM users WHERE user_id = ?");
            $stmt->bind_param("i", $userId);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($row = $result->fetch_assoc()) {
                $oldImage = $row['profile_image'];
                
                if ($oldImage && !str_starts_with($oldImage, 'data:')) {
                    // Only delete if it's a file path, not base64
                    $oldImagePath = $uploadDir . basename($oldImage);
                    if (file_exists($oldImagePath)) {
                        @unlink($oldImagePath);
                    }
                }
            }
        } catch (Exception $e) {
            // Ignore errors when deleting old image
        }
    }
    
    /**
     * Updates database with new image URL
     */
    private static function updateDatabase($userId, $imageUrl) {
        global $conn;
        
        try {
            $stmt = $conn->prepare("UPDATE users SET profile_image = ? WHERE user_id = ?");
            $stmt->bind_param("si", $imageUrl, $userId);
            return $stmt->execute();
        } catch (Exception $e) {
            return false;
        }
    }
    
    /**
     * Gets image URL for display
     */
    public static function getImageUrl($imageUrl) {
        if (str_starts_with($imageUrl, 'data:')) {
            // If image is stored as base64
            return $imageUrl;
        } elseif (file_exists($imageUrl)) {
            // If image is a local file
            return $imageUrl;
        } else {
            // Try to find image in various directories
            $possiblePaths = [
                __DIR__ . '/../../../uploads/profile_images/' . basename($imageUrl),
                __DIR__ . '/../../../public_html/uploads/profile_images/' . basename($imageUrl),
                __DIR__ . '/../../../htdocs/uploads/profile_images/' . basename($imageUrl),
                __DIR__ . '/../../../www/uploads/profile_images/' . basename($imageUrl),
                __DIR__ . '/../../../profile_images/' . basename($imageUrl),
                __DIR__ . '/../../profile_images/' . basename($imageUrl),
                __DIR__ . '/../profile_images/' . basename($imageUrl),
                __DIR__ . '/profile_images/' . basename($imageUrl)
            ];
            
            foreach ($possiblePaths as $path) {
                if (file_exists($path)) {
                    return $path;
                }
            }
            
            // If image not found, return default avatar
            return '/assets/images/default-avatar.png';
        }
    }
}

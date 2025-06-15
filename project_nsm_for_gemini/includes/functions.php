<?php
/**
 * Core Functions
 * Contains general utility functions used throughout the application
 */

/**
 * Get user information
 *
 * @param PDO $conn Database connection
 * @param int $userId User ID
 * @return array|false User information or false if not found
 */
function getUserInfo($conn, $userId) {
    try {
        $stmt = $conn->prepare("SELECT * FROM users WHERE user_id = ?");
        $stmt->execute([$userId]);
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Error getting user info: " . $e->getMessage());
        return false;
    }
}

/**
 * Log user activity
 *
 * @param PDO $conn Database connection
 * @param int|null $userId User ID (can be null for non-authenticated actions)
 * @param string $action Action performed
 * @param string|null $entityType Type of entity affected (e.g., 'user', 'post')
 * @param int|null $entityId ID of the entity affected
 * @param array|null $details Additional details about the action
 * @return bool Success/failure
 */
function logActivity($conn, $userId, $action, $entityType = null, $entityId = null, $details = null) {
    try {
        $stmt = $conn->prepare("
            INSERT INTO activity_log (user_id, action, entity_type, entity_id, details, ip_address, user_agent)
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ");
        
        $detailsJson = $details ? json_encode($details) : null;
        $ip = $_SERVER['REMOTE_ADDR'] ?? null;
        $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? null;
        
        return $stmt->execute([
            $userId,
            $action,
            $entityType,
            $entityId,
            $detailsJson,
            $ip,
            $userAgent
        ]);
    } catch (PDOException $e) {
        error_log("Error logging activity: " . $e->getMessage());
        return false;
    }
}

/**
 * Generate a CSRF token
 *
 * @return string CSRF token
 */
function generateCSRFToken() {
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

/**
 * Verify a CSRF token
 *
 * @param string $token Token to verify
 * @return bool True if valid, false otherwise
 */
function verifyCsrfToken($token) {
    return (isset($_SESSION['csrf_token']) && !empty($token) && hash_equals($_SESSION['csrf_token'], $token));
}

/**
 * Format a date for display
 *
 * @param string $datetime MySQL datetime
 * @param bool $includeTime Whether to include time
 * @return string Formatted date
 */
function formatDate($datetime, $includeTime = false) {
    if (!$datetime) {
        return '';
    }
    
    try {
        $date = new DateTime($datetime);
        $format = 'M j, Y';
        
        if ($includeTime) {
            $format .= ' h:i A';
        }
        
        return $date->format($format);
    } catch (Exception $e) {
        error_log("Error formatting date: " . $e->getMessage());
        return $datetime; // Return original value if there's an error
    }
}

/**
 * Get a user by ID
 *
 * @param PDO $conn Database connection
 * @param int $userId User ID
 * @return array|false User data or false if not found
 */
function getUser($conn, $userId) {
    try {
        $stmt = $conn->prepare("SELECT * FROM users WHERE user_id = ?");
        $stmt->execute([$userId]);
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Error getting user: " . $e->getMessage());
        return false;
    }
}

/**
 * Get users with pagination
 *
 * @param PDO $conn Database connection
 * @param int $limit Number of records per page
 * @param int $offset Offset for pagination
 * @return array Array of users
 */
function getUsers($conn, $limit = 10, $offset = 0) {
    try {
        $stmt = $conn->prepare("
            SELECT * FROM users
            ORDER BY created_at DESC
            LIMIT ? OFFSET ?
        ");
        $stmt->bindValue(1, $limit, PDO::PARAM_INT);
        $stmt->bindValue(2, $offset, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Error getting users: " . $e->getMessage());
        return [];
    }
}

/**
 * Count total number of users
 *
 * @param PDO $conn Database connection
 * @return int Total number of users
 */
function countUsers($conn) {
    try {
        $stmt = $conn->prepare("SELECT COUNT(*) FROM users");
        $stmt->execute();
        
        return (int)$stmt->fetchColumn();
    } catch (PDOException $e) {
        error_log("Error counting users: " . $e->getMessage());
        return 0;
    }
}

/**
 * Get filtered users based on search criteria
 *
 * @param PDO $conn Database connection
 * @param array $filters Filter criteria
 * @param int $limit Number of records per page
 * @param int $offset Offset for pagination
 * @return array Filtered users
 */
function getFilteredUsers($conn, $filters = [], $limit = 10, $offset = 0) {
    try {
        $conditions = [];
        $params = [];
        
        // Apply filters
        if (!empty($filters['search'])) {
            $conditions[] = "(username LIKE ? OR email LIKE ? OR bio LIKE ?)";
            $searchParam = "%{$filters['search']}%";
            $params[] = $searchParam;
            $params[] = $searchParam;
            $params[] = $searchParam;
        }
        
        if (!empty($filters['role'])) {
            $conditions[] = "role = ?";
            $params[] = $filters['role'];
        }
        
        // Build WHERE clause
        $whereClause = empty($conditions) ? "" : "WHERE " . implode(" AND ", $conditions);
        
        // Build query
        $query = "
            SELECT * FROM users
            {$whereClause}
            ORDER BY created_at DESC
            LIMIT ? OFFSET ?
        ";
        
        // Prepare statement
        $stmt = $conn->prepare($query);
        
        // Bind parameters
        $paramCount = count($params);
        for ($i = 0; $i < $paramCount; $i++) {
            $stmt->bindValue($i + 1, $params[$i]);
        }
        
        // Bind limit and offset
        $stmt->bindValue($paramCount + 1, $limit, PDO::PARAM_INT);
        $stmt->bindValue($paramCount + 2, $offset, PDO::PARAM_INT);
        
        // Execute and return results
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        
    } catch (PDOException $e) {
        error_log("Error getting filtered users: " . $e->getMessage());
        return [];
    }
}

/**
 * Count filtered users
 *
 * @param PDO $conn Database connection
 * @param array $filters Filter criteria
 * @return int Number of filtered users
 */
function countFilteredUsers($conn, $filters = []) {
    try {
        $conditions = [];
        $params = [];
        
        // Apply filters (same as in getFilteredUsers)
        if (!empty($filters['search'])) {
            $conditions[] = "(username LIKE ? OR email LIKE ? OR bio LIKE ?)";
            $searchParam = "%{$filters['search']}%";
            $params[] = $searchParam;
            $params[] = $searchParam;
            $params[] = $searchParam;
        }
        
        if (!empty($filters['role'])) {
            $conditions[] = "role = ?";
            $params[] = $filters['role'];
        }
        
        // Build WHERE clause
        $whereClause = empty($conditions) ? "" : "WHERE " . implode(" AND ", $conditions);
        
        // Build query
        $query = "SELECT COUNT(*) FROM users {$whereClause}";
        
        // Prepare and execute
        $stmt = $conn->prepare($query);
        
        // Bind parameters
        for ($i = 0; $i < count($params); $i++) {
            $stmt->bindValue($i + 1, $params[$i]);
        }
        
        $stmt->execute();
        return (int)$stmt->fetchColumn();
        
    } catch (PDOException $e) {
        error_log("Error counting filtered users: " . $e->getMessage());
        return 0;
    }
}

/**
 * Get notification count for a user
 *
 * @param PDO $conn Database connection
 * @param int $userId User ID
 * @return int Number of unread notifications
 */
function getNotificationCount($conn, $userId) {
    // In a real application, this would query a notifications table
    // For now, we'll return a placeholder value
    return 3;
}

/**
 * Generate a slug from a string
 *
 * @param string $string String to convert to slug
 * @return string Slug
 */
function generateSlug($string) {
    // Transliterate non-ASCII characters
    $string = transliterator_transliterate('Any-Latin; Latin-ASCII', $string);
    
    // Convert to lowercase
    $string = strtolower($string);
    
    // Remove special characters
    $string = preg_replace('/[^a-z0-9\s]/', '', $string);
    
    // Replace spaces with hyphens
    $string = preg_replace('/\s+/', '-', $string);
    
    // Remove duplicate hyphens
    $string = preg_replace('/-+/', '-', $string);
    
    // Trim hyphens from beginning and end
    $string = trim($string, '-');
    
    return $string;
}

/**
 * Check if a username already exists
 *
 * @param PDO $conn Database connection
 * @param string $username Username to check
 * @param int|null $excludeId User ID to exclude (for updates)
 * @return bool True if exists, false otherwise
 */
function usernameExists($conn, $username, $excludeId = null) {
    try {
        $query = "SELECT COUNT(*) FROM users WHERE username = ?";
        $params = [$username];
        
        if ($excludeId) {
            $query .= " AND user_id != ?";
            $params[] = $excludeId;
        }
        
        $stmt = $conn->prepare($query);
        $stmt->execute($params);
        
        return $stmt->fetchColumn() > 0;
    } catch (PDOException $e) {
        error_log("Error checking if username exists: " . $e->getMessage());
        return true; // Assume it exists in case of error
    }
}

/**
 * Check if an email already exists
 *
 * @param PDO $conn Database connection
 * @param string $email Email to check
 * @param int|null $excludeId User ID to exclude (for updates)
 * @return bool True if exists, false otherwise
 */
function emailExists($conn, $email, $excludeId = null) {
    try {
        $query = "SELECT COUNT(*) FROM users WHERE email = ?";
        $params = [$email];
        
        if ($excludeId) {
            $query .= " AND user_id != ?";
            $params[] = $excludeId;
        }
        
        $stmt = $conn->prepare($query);
        $stmt->execute($params);
        
        return $stmt->fetchColumn() > 0;
    } catch (PDOException $e) {
        error_log("Error checking if email exists: " . $e->getMessage());
        return true; // Assume it exists in case of error
    }
}

/**
 * Ensure a slug is unique by adding a number suffix if needed
 *
 * @param PDO $conn Database connection
 * @param string $slug Base slug
 * @param string $table Table to check (e.g., 'posts')
 * @param string $column Column name (e.g., 'slug')
 * @param int|null $excludeId ID to exclude (for updates)
 * @param string $idColumn ID column name (e.g., 'post_id')
 * @return string Unique slug
 */
function ensureUniqueSlug($conn, $slug, $table, $column, $excludeId = null, $idColumn = null) {
    $originalSlug = $slug;
    $counter = 1;
    
    while (true) {
        try {
            $query = "SELECT COUNT(*) FROM {$table} WHERE {$column} = ?";
            $params = [$slug];
            
            if ($excludeId !== null && $idColumn !== null) {
                $query .= " AND {$idColumn} != ?";
                $params[] = $excludeId;
            }
            
            $stmt = $conn->prepare($query);
            $stmt->execute($params);
            
            if ($stmt->fetchColumn() == 0) {
                // Slug is unique
                break;
            }
            
            // Slug exists, try a new one
            $slug = $originalSlug . '-' . $counter;
            $counter++;
            
        } catch (PDOException $e) {
            error_log("Error ensuring unique slug: " . $e->getMessage());
            // Return the original with a timestamp to make it unique
            return $originalSlug . '-' . time();
        }
    }
    
    return $slug;
}

/**
 * Redirect to a URL
 *
 * @param string $url URL to redirect to
 * @return void
 */
function redirect($url) {
    header("Location: {$url}");
    exit;
}

/**
 * Sanitize output for HTML
 *
 * @param mixed $data Data to sanitize
 * @return mixed Sanitized data
 */
function sanitizeOutput($data) {
    if (is_array($data)) {
        foreach ($data as $key => $value) {
            $data[$key] = sanitizeOutput($value);
        }
    } else {
        $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    }
    
    return $data;
}
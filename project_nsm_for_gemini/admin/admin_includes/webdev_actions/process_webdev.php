<?php 
require_once('../../../config.php');

// Enable error reporting for debugging 
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Log submission for debugging
$logFile = __DIR__ . '/webdev_debug.log';
$logData = [
    'timestamp' => date('Y-m-d H:i:s'),
    'POST' => $_POST,
    'FILES' => isset($_FILES) ? print_r($_FILES, true) : 'No files',
    'SESSION' => isset($_SESSION) ? $_SESSION : 'No session'
];
file_put_contents($logFile, print_r($logData, true) . "\n\n", FILE_APPEND);

// Make sure session is started 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if user is logged in and has 'admin' role
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true || $_SESSION['role'] !== 'admin') {
    // Return JSON error for AJAX requests, redirect for normal requests
    if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'error' => 'Unauthorized access']);
        exit;
    } else {
        // Use relative path for reliability
        header('Location: ../../../index.php');
        exit;
    }
}

// Handle different actions
$action = $_POST['action'] ?? '';
file_put_contents($logFile, "Action received: $action\n\n", FILE_APPEND);

switch ($action) {
    case 'create':
        createProject();
        break;
    case 'update':
        updateProject();
        break;
    case 'delete':
        deleteProject();
        break;
    default: 
        // Invalid action - use relative path for redirect
        file_put_contents($logFile, "Invalid action: $action\n\n", FILE_APPEND);
        header('Location: ../../admin.php?page=manage_webdev&status=error&message=Invalid action');
        exit;
}

/**
 * Create a new web development project
 */
function createProject() {
    global $conn, $logFile;

    file_put_contents($logFile, "Starting createProject function\n", FILE_APPEND);

    // Validate required fields
    $requiredFields = ['title', 'category', 'short_description', 'description', 'client', 'technologies'];
    foreach($requiredFields as $field) {
        if (empty($_POST[$field])) {
            file_put_contents($logFile, "Missing required field: $field\n", FILE_APPEND);
            header('Location: ../../admin.php?page=manage_webdev&status=error&message=All fields are required');
            exit;
        }
    }

    // Check if an image was uploaded
    if (!isset($_FILES['image']) || $_FILES['image']['error'] === UPLOAD_ERR_NO_FILE) {
        file_put_contents($logFile, "No image uploaded\n", FILE_APPEND);
        header('Location: ../../admin.php?page=manage_webdev&status=error&message=Project image is required');
        exit;
    }

    // Handle image upload
    $imageUrl = uploadImage();
    if ($imageUrl === false) {
        // Error message already set by uploadImage function
        exit;
    } 

    // Prepare data for insertion
    $title = trim($_POST['title']);
    $category = trim($_POST['category']);
    $shortDescription = trim($_POST['short_description']);
    $description = trim($_POST['description']);
    $client = trim($_POST['client']);
    $technologies = trim($_POST['technologies']);
    $liveUrl = !empty($_POST['live_url']) ? trim($_POST['live_url']) : null;

    // Insert project into database
    $stmt = $conn->prepare("
        INSERT INTO webdev_projects (title, category, short_description, description, client, technologies, image_url, live_url)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)
    ");

    if (!$stmt) {
        file_put_contents($logFile, "Database prepare error: " . $conn->error . "\n", FILE_APPEND);
        header('Location: ../../admin.php?page=manage_webdev&status=error&message=Database error: ' . $conn->error);
        exit;
    }

    $stmt->bind_param("ssssssss", $title, $category, $shortDescription, $description, $client, $technologies, $imageUrl, $liveUrl);

    file_put_contents($logFile, "About to execute insert query\n", FILE_APPEND);

    if ($stmt->execute()) {
        file_put_contents($logFile, "Insert successful\n", FILE_APPEND);
        header('Location: ../../admin.php?page=manage_webdev&status=success&message=Project created successfully');
    } else {
        file_put_contents($logFile, "Insert failed: " . $stmt->error . "\n", FILE_APPEND);
        header('Location: ../../admin.php?page=manage_webdev&status=error&message=Failed to create project: ' . $stmt->error);
    }

    $stmt->close();
}

/**
 * Update an existing web development project 
 */
function updateProject() {
    global $conn, $logFile;
    
    file_put_contents($logFile, "Starting updateProject function\n", FILE_APPEND);
    
    // Validate required fields
    $requiredFields = ['project_id', 'title', 'category', 'short_description', 'description', 'client', 'technologies'];
    foreach($requiredFields as $field) {
        if (empty($_POST[$field])) {
            file_put_contents($logFile, "Missing required field: $field\n", FILE_APPEND);
            header('Location: ../../admin.php?page=manage_webdev&status=error&message=All fields are required');
            exit;
        }
    }

    $projectId = (int)$_POST['project_id'];
    $title = trim($_POST['title']);
    $category = trim($_POST['category']);
    $shortDescription = trim($_POST['short_description']);
    $description = trim($_POST['description']);
    $client = trim($_POST['client']);
    $technologies = trim($_POST['technologies']);
    $liveUrl = !empty($_POST['live_url']) ? trim($_POST['live_url']) : null;

    // Initialize imageUrl variable
    $imageUrl = '';
    
    // Check if a new image was uploaded
    if (isset($_FILES['image']) && $_FILES['image']['error'] !== UPLOAD_ERR_NO_FILE) {
        // Upload new image
        $imageUrl = uploadImage();
        if ($imageUrl === false) {
            // Error message already set by uploadImage function
            exit;
        }
    } elseif (!empty($_POST['current_image'])) {
        // Keep current image
        $imageUrl = $_POST['current_image'];
    } else {
        file_put_contents($logFile, "No image provided\n", FILE_APPEND);
        header('Location: ../../admin.php?page=manage_webdev&status=error&message=Project image is required');
        exit;
    }
    
    // Update project in database
    $stmt = $conn->prepare("
        UPDATE webdev_projects
        SET title = ?, category = ?, short_description = ?, description = ?, client = ?, 
            technologies = ?, image_url = ?, live_url = ?
        WHERE project_id = ?
    ");
    
    if (!$stmt) {
        file_put_contents($logFile, "Database prepare error: " . $conn->error . "\n", FILE_APPEND);
        header('Location: ../../admin.php?page=manage_webdev&status=error&message=Database error: ' . $conn->error);
        exit;
    }

    $stmt->bind_param("ssssssssi", $title, $category, $shortDescription, $description, $client, 
                     $technologies, $imageUrl, $liveUrl, $projectId);
    
    file_put_contents($logFile, "About to execute update query\n", FILE_APPEND);
    
    if ($stmt->execute()) {
        file_put_contents($logFile, "Update successful\n", FILE_APPEND);
        header('Location: ../../admin.php?page=manage_webdev&status=success&message=Project updated successfully');
    } else {
        file_put_contents($logFile, "Update failed: " . $stmt->error . "\n", FILE_APPEND);
        header('Location: ../../admin.php?page=manage_webdev&status=error&message=Failed to update project: ' . $stmt->error);
    }
    
    $stmt->close();
}

/**
 * Delete a web development project
 */
function deleteProject() {
    global $conn, $logFile;
    
    file_put_contents($logFile, "Starting deleteProject function\n", FILE_APPEND);
    
    if (empty($_POST['project_id'])) {
        file_put_contents($logFile, "No project ID provided\n", FILE_APPEND);
        header('Location: ../../admin.php?page=manage_webdev&status=error&message=Project ID is required');
        exit;
    }
    
    $projectId = (int)$_POST['project_id'];
    
    // Get the image URL before deleting the project
    $stmt = $conn->prepare("SELECT image_url FROM webdev_projects WHERE project_id = ?");
    
    if (!$stmt) {
        file_put_contents($logFile, "Database prepare error: " . $conn->error . "\n", FILE_APPEND);
        header('Location: ../../admin.php?page=manage_webdev&status=error&message=Database error: ' . $conn->error);
        exit;
    }
    
    $stmt->bind_param("i", $projectId);
    $stmt->execute();
    
    // Initialize imageUrl to prevent undefined variable
    $imageUrl = '';
    
    $stmt->bind_result($imageUrl);
    $stmt->fetch();
    $stmt->close();
    
    file_put_contents($logFile, "Image URL to delete: $imageUrl\n", FILE_APPEND);
    
    // Delete the project
    $stmt = $conn->prepare("DELETE FROM webdev_projects WHERE project_id = ?");
    
    if (!$stmt) {
        file_put_contents($logFile, "Database prepare error: " . $conn->error . "\n", FILE_APPEND);
        header('Location: ../../admin.php?page=manage_webdev&status=error&message=Database error: ' . $conn->error);
        exit;
    }
    
    $stmt->bind_param("i", $projectId);
    
    if ($stmt->execute()) {
        // Delete the image file if it exists and is not a default image
        if (!empty($imageUrl) && file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $imageUrl) && !strpos($imageUrl, 'default')) {
            unlink($_SERVER['DOCUMENT_ROOT'] . '/' . $imageUrl);
            file_put_contents($logFile, "Deleted image file: $imageUrl\n", FILE_APPEND);
        }
        
        file_put_contents($logFile, "Delete successful\n", FILE_APPEND);
        header('Location: ../../admin.php?page=manage_webdev&status=success&message=Project deleted successfully');
    } else {
        file_put_contents($logFile, "Delete failed: " . $stmt->error . "\n", FILE_APPEND);
        header('Location: ../../admin.php?page=manage_webdev&status=error&message=Failed to delete project: ' . $stmt->error);
    }
    
    $stmt->close();
}

/**
 * Upload and process an image file
 * 
 * @return string|false The image URL on success, false on failure
 */
function uploadImage() {
    global $logFile;
    
    file_put_contents($logFile, "Starting uploadImage function\n", FILE_APPEND);
    
    // Validate the uploaded file
    if ($_FILES['image']['error'] !== UPLOAD_ERR_OK) {
        $errorMessages = [
            UPLOAD_ERR_INI_SIZE => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
            UPLOAD_ERR_FORM_SIZE => 'The uploaded file exceeds the MAX_FILE_SIZE directive in the HTML form',
            UPLOAD_ERR_PARTIAL => 'The uploaded file was only partially uploaded',
            UPLOAD_ERR_NO_FILE => 'No file was uploaded',
            UPLOAD_ERR_NO_TMP_DIR => 'Missing a temporary folder',
            UPLOAD_ERR_CANT_WRITE => 'Failed to write file to disk',
            UPLOAD_ERR_EXTENSION => 'A PHP extension stopped the file upload'
        ];
        
        $errorMessage = $errorMessages[$_FILES['image']['error']] ?? 'Unknown upload error';
        file_put_contents($logFile, "Upload error: $errorMessage\n", FILE_APPEND);
        header('Location: ../../admin.php?page=manage_webdev&status=error&message=' . urlencode($errorMessage));
        return false;
    }
    
    // Check file type
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    if (!in_array($_FILES['image']['type'], $allowedTypes)) {
        file_put_contents($logFile, "Invalid file type: " . $_FILES['image']['type'] . "\n", FILE_APPEND);
        header('Location: ../../admin.php?page=manage_webdev&status=error&message=Invalid file type. Only JPG, PNG, GIF, and WEBP images are allowed');
        return false;
    }
    
    // Check file size (max 5MB)
    if ($_FILES['image']['size'] > 5 * 1024 * 1024) {
        file_put_contents($logFile, "File too large: " . $_FILES['image']['size'] . " bytes\n", FILE_APPEND);
        header('Location: ../../admin.php?page=manage_webdev&status=error&message=File size exceeds the maximum limit of 5MB');
        return false;
    }
    
    // Create uploads directory if it doesn't exist
    $uploadsDir = $_SERVER['DOCUMENT_ROOT'] . '/static/images/webdev_projects';
    if (!file_exists($uploadsDir)) {
        mkdir($uploadsDir, 0755, true);
        file_put_contents($logFile, "Created directory: $uploadsDir\n", FILE_APPEND);
    }
    
    // Generate unique filename
    $filename = uniqid() . '_' . preg_replace('/[^a-zA-Z0-9.]/', '_', $_FILES['image']['name']);
    $destination = $uploadsDir . '/' . $filename;
    
    file_put_contents($logFile, "Attempting to move uploaded file to: $destination\n", FILE_APPEND);
    
    // Move uploaded file
    if (move_uploaded_file($_FILES['image']['tmp_name'], $destination)) {
        $relativePath = 'static/images/webdev_projects/' . $filename;
        file_put_contents($logFile, "File uploaded successfully to: $relativePath\n", FILE_APPEND);
        return $relativePath;
    } else {
        file_put_contents($logFile, "Failed to move uploaded file\n", FILE_APPEND);
        header('Location: ../../admin.php?page=manage_webdev&status=error&message=Failed to save the uploaded file');
        return false;
    }
}
?>
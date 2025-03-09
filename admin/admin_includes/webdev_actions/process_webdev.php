<?php

require_once('../../../config.php');

// check if user is logged in and has 'admin' role
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true || $_SESSION['role'] !== 'admin') {
    // return JSON error for AJAX request, redirect for normal requests
    if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'error' => 'Unauthorized access']);
        exit;
    } else {
        header('Location: ../../../index.php');
        exit;
    }
}

// handle different actions
$action = $_POST['action'] ?? '';

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
        // invalid action
        header('Location: ../../admin.php?page=manage_webdev&status=error&message=Invalid action');
        exit;
}

function createProject() {
    global $conn;
    
    // Validate required fields
    $requiredFields = ['title', 'category', 'short_description', 'description', 'client', 'technologies'];
    foreach ($requiredFields as $field) {
        if (empty($_POST[$field])) {
            header('Location: ../../admin.php?page=manage_webdev&status=error&message=All fields are required');
            exit;
        }
    }
    
    // Check if an image was uploaded
    if (!isset($_FILES['image']) || $_FILES['image']['error'] === UPLOAD_ERR_NO_FILE) {
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
    
    $stmt->bind_param("ssssssss", $title, $category, $shortDescription, $description, $client, $technologies, $imageUrl, $liveUrl);
    
    if ($stmt->execute()) {
        header('Location: ../../admin.php?page=manage_webdev&status=success&message=Project created successfully');
    } else {
        header('Location: ../../admin.php?page=manage_webdev&status=error&message=Failed to create project: ' . $stmt->error);
    }
    
    $stmt->close();
}

// update an exisitng web dev project
function updateProject() {
    global $conn;
    
    // Validate required fields
    $requiredFields = ['project_id', 'title', 'category', 'short_description', 'description', 'client', 'technologies'];
    foreach ($requiredFields as $field) {
        if (empty($_POST[$field])) {
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
    
    // Check if a new image was uploaded
    $imageUrl = '';
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
    
    $stmt->bind_param("ssssssssi", $title, $category, $shortDescription, $description, $client, 
                     $technologies, $imageUrl, $liveUrl, $projectId);
    
    if ($stmt->execute()) {
        header('Location: ../../admin.php?page=manage_webdev&status=success&message=Project updated successfully');
    } else {
        header('Location: ../../admin.php?page=manage_webdev&status=error&message=Failed to update project: ' . $stmt->error);
    }
    
    $stmt->close();
}

// function to delete project
function deleteProject() {
    global $conn;

    if (empty($_POST['project_id'])) {
        header('Location: ../../admin.php?page=manage_webdev&status=error&message=Project ID is required');
        exit;
    }

    $projectId = (int)$_POST['project_id'];

    // get the image url before deleting the project
    $stmt = $conn->prepare("SELECT image_url FROM webdev_projects WHERE project_id = ?");
    $stmt->bind_param("i", $projectId);
    $stmt->execute();
    $stmt->bind_result($imageUrl);
    $stmt->fetch();
    $stmt->close();

    // delete the project 
    $stmt = $conn->prepare("DELETE FROM webdev_projects WHERE project_id = ?");
    $stmt->bind_param("i", $projectId);

    if ($stmt->execute()) {
        // Delete the image file if it exists and is not a default image
        if (!empty($imageUrl) && file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $imageUrl) && !strpos($imageUrl, 'default')) {
            unlink($_SERVER['DOCUMENT_ROOT'] . '/' . $imageUrl);
        }
        
        header('Location: ../../admin.php?page=manage_webdev&status=success&message=Project deleted successfully');
    } else {
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
        header('Location: ../../admin.php?page=manage_webdev&status=error&message=' . urlencode($errorMessage));
        return false;
    }
    
    // Check file type
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    if (!in_array($_FILES['image']['type'], $allowedTypes)) {
        header('Location: ../../admin.php?page=manage_webdev&status=error&message=Invalid file type. Only JPG, PNG, GIF, and WEBP images are allowed');
        return false;
    }
    
    // Check file size (max 5MB)
    if ($_FILES['image']['size'] > 5 * 1024 * 1024) {
        header('Location: ../../admin.php?page=manage_webdev&status=error&message=File size exceeds the maximum limit of 5MB');
        return false;
    }
    
    // Create uploads directory if it doesn't exist
    $uploadsDir = $_SERVER['DOCUMENT_ROOT'] . '/static/images/webdev_projects';
    if (!file_exists($uploadsDir)) {
        mkdir($uploadsDir, 0755, true);
    }
    
    // Generate unique filename
    $filename = uniqid() . '_' . preg_replace('/[^a-zA-Z0-9.]/', '_', $_FILES['image']['name']);
    $destination = $uploadsDir . '/' . $filename;
    
    // Move uploaded file
    if (move_uploaded_file($_FILES['image']['tmp_name'], $destination)) {
        return 'static/images/webdev_projects/' . $filename;
    } else {
        header('Location: ../../admin.php?page=manage_webdev&status=error&message=Failed to save the uploaded file');
        return false;
    }
}
?>
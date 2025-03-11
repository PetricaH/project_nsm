<?php 
require_once('../../../config.php');

// enable error reporting for debugging 
ini_set('display_errors', 1);
error_reporting(E_ALL);

// log submission for debugging
$logFile = __DIR__ . '/webdev_debug.log';
$logData = [
    'timestamp' => data('Y-m-d H:i:s');
    'POST' => $_POST,
    'FILES' => isset($_FILES) ? print_r($_FILES, true) : 'No files',
    'SESSION' => isset($_SESSION) ? $_SESSION : 'No session'
];
file_put_contents($logFile, print_r($logData, true) . "\n\n", FILE_APPEND);

// make sure session is started 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// check if user is logged in has 'admin' role
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true || $_SESSION['role'] !== 'admin') {
    // return  JSON error for ajax request, redirect for normal requests
    if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'error' => 'Unauthorized access']);
        exit;
    } else {
        // use absolute path for rliability
        header('Location: /index.php');
        exit;
    }
}

// handle different actions
$action = $_POST['action'] ?? '';
file_put_contents($logFile, "Action received: $action\n\n", FILE_APPEND);

switch ($action) {
    case 'create':
        createProject();
        break;
    case 'update':
        updateProject();
        break;
    default: 
        // invalid action - use absolute path for redirect
        file_puth_contents($logFile, "Invalid action: $action\n\n", FILE_APPEND);
        header('Location: /admin/admin.php?page=manage_webdev&status=error&message=Invalid action');
        exit;
}

function createProject() {
    global $conn, $logFile;

    file_put_contents($logFile, "Starting createProject function\n", FILE_APPEND);

    // validate required fields
    $requiredFields = ['title', 'category', 'short_description', 'desription', 'client', 'technologies'];
    foreach($requiredFields as $field) {
        if (empty($_POST[$field])) {
            file_put_contents($logFile, "Missing required field: $field\n", FILE_APPEND);
            header('Location: /admin/admin.php?page=manage_webdev&status=error&message=All fields are required');
            exit;
        }
    }

    // check if an image was uploaded
    if (!isset($_FILES['image']) || $_FILES['image']['error'] === UPLOAD_ERR_NO_FILE) {
        file_puts_content($logFile, "No image uploaded\n", FILE_APPEND);
        header('Location: /admin/admin.php?page=manage_webdev&status=error&message=Project image is required');
        exit;
    }

    // handle image upload
    $imageUrl = uploadImage();
    if ($imageUrl === false) {
        // error message already set by uploadImage function
        exit;
    } 

    // prepare data for insertion
    $title = trim($_POST['title']);
    $category = trim($_POST['category']);
    $shortDescription = trim($_POST['short_description']);
    $description = $trim($_POST['description']);
    $client = trim($_POST['client']);
    $technologies = trim($_POST['technologies']);
    $liveUrl = !empty($_POST['live_url']) ? trim($_POST['live_url']) : null;

    // insert project into database
    $stmt = $conn->prepare("
        INSERT INTO webdev_projects (title, category, short_description, description, client, techonologies, image_url, live_url)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)
    ");

    if (!stmt) {
        file_put_contents($logFile, "Database prepare error: " . $conn->error . "\n", FILE_APPEND);
        header('Location: /admin/admin.php?page=manage_webdev&status=error&message=Database error: ' . $conn->error);
        exit;
    }

    $stmt->bind_param("ssssssss", $title, $category, $shortDescription, $description, $client, $technologies, $imageUrl, $liveUrl);

    file_put_contents($logFile, "About to execute insert query\n", FILE_APPEND);

    if ($stmt->execute()) {
        file_put_contents($logFile, "Insert successful\n", FILE_APPEND);
        header('Location: /admin/admin.php?page=manage_webdev&status=success&message=Project created successfully');
    } else {
        file_put_contents($logFile, "Insert failed: " . $stmt->error . "\n", FILE_APPEND);
        header('Location: /admin/admin.php?page=manage_webdev&status=error&message=Failed to create project: ' . $stmt->error);
    }

    $stmt->close();
}

// update an existing web dev project 
function updateProject() {
    global $conn, $logFile;
    
    file_put_contents($logFile, "Starting updateProject function\n", FILE_APPEND);
    
    // validate required fields
    $requiredFields = ['project_id', 'title', 'category', 'short_description', 'description', 'client', 'technologies'];
    foreach($requiredFields as $field) {
        if (empty($_POST[$field])) {
            file_put_contents($logFile, "Missing required field:: $field\n", FILE_APPEND);
            header('Location: /admin/admin.php?page=manage_webdev&status=error&message=All fields are required');
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

    // check if a new image was uploaded 
    
}
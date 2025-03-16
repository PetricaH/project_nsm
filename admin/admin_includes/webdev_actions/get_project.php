<?php
require_once('../../../config.php');

// Log request for debugging
$logFile = __DIR__ . '/webdev_debug.log';
file_put_contents($logFile, "Get project request received: " . date('Y-m-d H:i:s') . "\nGET: " . print_r($_GET, true) . "\n\n", FILE_APPEND);

// Make sure session is started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if the user is logged in and has the 'admin' role
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true || $_SESSION['role'] !== 'admin') {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'error' => 'Unauthorized access']);
    exit;
}

// Set response header
header('Content-Type: application/json');

// Check if project ID is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo json_encode(['success' => false, 'error' => 'Project ID is required']);
    exit;
}

$projectId = (int)$_GET['id'];

// Fetch project details
$stmt = $conn->prepare("
    SELECT project_id, title, category, short_description, description, client,
            technologies, image_url, live_url, created_at, updated_at
    FROM webdev_projects
    WHERE project_id = ? ");

if (!$stmt) {
    file_put_contents($logFile, "Database prepare error: " . $conn->error . "\n", FILE_APPEND);
    echo json_encode(['success' => false, 'error' => 'Database error: ' . $conn->error]);
    exit;
}

$stmt->bind_param("i", $projectId);

if (!$stmt->execute()) {
    file_put_contents($logFile, "Execute error: " . $stmt->error . "\n", FILE_APPEND);
    echo json_encode(['success' => false, 'error' => 'Failed to fetch project details: ' . $stmt->error]);
    exit;
}

$result = $stmt->get_result();

if ($result->num_rows === 0) {
    file_put_contents($logFile, "No project found with ID: $projectId\n", FILE_APPEND);
    echo json_encode(['success' => false, 'error' => 'Project not found']);
    exit;
}

$project = $result->fetch_assoc();

// Convert dates to readable format
$project['created_at'] = date('Y-m-d H:i:s', strtotime($project['created_at']));
if ($project['updated_at']) {
    $project['updated_at'] = date('Y-m-d H:i:s', strtotime($project['updated_at']));
}

file_put_contents($logFile, "Successfully fetched project: " . print_r($project, true) . "\n", FILE_APPEND);
echo json_encode(['success' => true, 'project' => $project]);
$stmt->close();
?>
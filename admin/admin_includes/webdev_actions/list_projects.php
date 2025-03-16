<?php
require_once('../../../config.php');

// Log request for debugging
$logFile = __DIR__ . '/webdev_debug.log';
file_put_contents($logFile, "List projects request received: " . date('Y-m-d H:i:s') . "\nGET: " . print_r($_GET, true) . "\n\n", FILE_APPEND);

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

// Optional filtering
$category = isset($_GET['category']) ? trim($_GET['category']) : '';
$searchTerm = isset($_GET['search']) ? trim($_GET['search']) : '';

// Build the query
$query = "
    SELECT project_id, title, category, short_description, image_url, created_at
    FROM webdev_projects
    WHERE 1=1 ";

$params = [];
$types = '';

if (!empty($category)) {
    $query .= " AND category = ?";
    $params[] = $category;
    $types .= 's';
}

if (!empty($searchTerm)) {
    $query .= " AND (
        title LIKE ? OR 
        short_description LIKE ? OR
        description LIKE ? OR
        client LIKE ? OR
        technologies LIKE ?
    )";
    
    $searchPattern = "%$searchTerm%";
    $params[] = $searchPattern;
    $params[] = $searchPattern;
    $params[] = $searchPattern;
    $params[] = $searchPattern;
    $params[] = $searchPattern;
    
    $types .= 'sssss';
}

// Add ordering
$query .= " ORDER BY created_at DESC";

// Prepare and execute the query
$stmt = $conn->prepare($query);

if (!$stmt) {
    file_put_contents($logFile, "Database prepare error: " . $conn->error . "\n", FILE_APPEND);
    echo json_encode(['success' => false, 'error' => 'Database error: ' . $conn->error]);
    exit;
}

// Bind parameters if any
if (!empty($params)) {
    $bindParams = array_merge([$types], $params);
    $stmt->bind_param(...$bindParams);
}

if (!$stmt->execute()) {
    file_put_contents($logFile, "Execute error: " . $stmt->error . "\n", FILE_APPEND);
    echo json_encode(['success' => false, 'error' => 'Failed to fetch projects: ' . $stmt->error]);
    exit;
}

$result = $stmt->get_result();
$projects = [];

while ($row = $result->fetch_assoc()) {
    // Format the created_at date
    $row['created_at'] = date('Y-m-d', strtotime($row['created_at']));
    
    // Truncate the description if it's too long
    if (isset($row['short_description']) && strlen($row['short_description']) > 150) {
        $row['short_description'] = substr($row['short_description'], 0, 147) . '...';
    }
    
    $projects[] = $row;
}

file_put_contents($logFile, "Successfully fetched " . count($projects) . " projects\n", FILE_APPEND);
echo json_encode(['success' => true, 'projects' => $projects]);
$stmt->close();
?>
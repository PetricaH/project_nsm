<?php
// This file should be placed in admin/admin_includes/webdev_actions/get_project.php

require_once('../../../config.php');

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
    WHERE project_id = ?
");

$stmt->bind_param("i", $projectId);

if (!$stmt->execute()) {
    echo json_encode(['success' => false, 'error' => 'Failed to fetch project details: ' . $stmt->error]);
    exit;
}

$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo json_encode(['success' => false, 'error' => 'Project not found']);
    exit;
}

$project = $result->fetch_assoc();

// Convert dates to readable format
$project['created_at'] = date('Y-m-d H:i:s', strtotime($project['created_at']));
if ($project['updated_at']) {
    $project['updated_at'] = date('Y-m-d H:i:s', strtotime($project['updated_at']));
}

echo json_encode(['success' => true, 'project' => $project]);
$stmt->close();
?>
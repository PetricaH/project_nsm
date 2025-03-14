<?php
// This file should be placed in includes/get_project_details.php

require_once('../config.php');

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
$project['created_at'] = date('Y-m-d', strtotime($project['created_at']));
if ($project['updated_at']) {
    $project['updated_at'] = date('Y-m-d', strtotime($project['updated_at']));
}

// Map category to display name
$categoryDisplay = [
    'ecommerce' => 'E-commerce',
    'business' => 'Business Website',
    'dashboard' => 'Dashboard/Admin',
    'portfolio' => 'Portfolio',
    'other' => 'Other'
];

$project['category_display'] = $categoryDisplay[$project['category']] ?? $project['category'];

echo json_encode(['success' => true, 'project' => $project]);
$stmt->close();
?>
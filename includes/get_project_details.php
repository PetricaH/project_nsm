<?php
require_once(dirname(__DIR__) . '/config.php');

// Check if project ID is provided
if(isset($_GET['id']) && is_numeric($_GET['id'])) {
    $project_id = intval($_GET['id']);
    
    // Prepare SQL query to get project details
    $sql = "SELECT * FROM webdev_projects WHERE project_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $project_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        // Fetch project data
        $project = $result->fetch_assoc();
        
        // Format data for response
        $response = [
            'success' => true,
            'project' => $project
        ];
        
        // Output as JSON
        header('Content-Type: application/json');
        echo json_encode($response);
    } else {
        // Project not found
        $response = [
            'success' => false,
            'message' => 'Project not found'
        ];
        
        // Output as JSON
        header('Content-Type: application/json');
        echo json_encode($response);
    }
} else {
    // Invalid or missing project ID
    $response = [
        'success' => false,
        'message' => 'Invalid project ID'
    ];
    
    // Output as JSON
    header('Content-Type: application/json');
    echo json_encode($response);
}
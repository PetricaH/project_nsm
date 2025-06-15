<?php
// upload_endpoint.php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

// Start session to verify user is admin
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if the user is logged in and has the 'admin' role
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true || $_SESSION['role'] !== 'admin') {
    http_response_code(403);
    echo json_encode(['error' => 'Unauthorized. Admin access only.']);
    exit;
}

// Enable error logging
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/upload_errors.log');

// Configuration
$uploadDirectory = __DIR__ . '/static/blog_featured_img/'; // Fixed the directory path
$maxFileSize = 5 * 1024 * 1024; // 5MB
$allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
$allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['image'])) {
        $file = $_FILES['image'];

        // Check for upload errors
        if ($file['error'] !== UPLOAD_ERR_OK) {
            error_log("Upload error code: " . $file['error']);
            http_response_code(400);
            echo json_encode(['error' => 'File upload error.']);
            exit;
        }

        // Validate file size
        if ($file['size'] > $maxFileSize) {
            http_response_code(400);
            echo json_encode(['error' => 'File size exceeds the limit of 5MB.']);
            exit;
        }

        // Validate file extension
        $fileExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (!in_array($fileExtension, $allowedExtensions)) {
            http_response_code(400);
            echo json_encode(['error' => 'Invalid file type. Only JPG, JPEG, PNG, and GIF are allowed.']);
            exit;
        }

        // Validate MIME type
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        if (!$finfo) {
            error_log("Failed to open finfo.");
            http_response_code(500);
            echo json_encode(['error' => 'Server error.']);
            exit;
        }
        $mimeType = finfo_file($finfo, $file['tmp_name']);
        finfo_close($finfo);
        if (!in_array($mimeType, $allowedMimeTypes)) {
            http_response_code(400);
            echo json_encode(['error' => 'Invalid file MIME type.']);
            exit;
        }

        // Ensure the target directory exists
        if (!is_dir($uploadDirectory)) {
            if (!mkdir($uploadDirectory, 0755, true)) {
                error_log("Failed to create directory: {$uploadDirectory}");
                http_response_code(500);
                echo json_encode(['error' => 'Failed to create upload directory.']);
                exit;
            }
        }

        // Generate a unique and sanitized filename
        $filename = uniqid('img_', true) . '.' . $fileExtension;
        $targetFilePath = $uploadDirectory . $filename;

        // Additional check to ensure the file is an image
        if (!getimagesize($file['tmp_name'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Uploaded file is not a valid image.']);
            exit;
        }

        // Move the file to the upload directory
        if (move_uploaded_file($file['tmp_name'], $targetFilePath)) {
            // Construct the image URL
            $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
            $host = $_SERVER['HTTP_HOST'];
            // Assuming the script is in /admin/admin_includes/blog_actions/
            $baseUrl = $protocol . $host . '/admin/admin_includes/blog_actions/static/blog_featured_img/';
            $imageUrl = $baseUrl . $filename;

            echo json_encode(['url' => $imageUrl]);
            exit;
        } else {
            error_log("Failed to move uploaded file from {$file['tmp_name']} to {$targetFilePath}");
            http_response_code(500);
            echo json_encode(['error' => 'Failed to move uploaded file.']);
            exit;
        }
    } else {
        http_response_code(400);
        echo json_encode(['error' => 'No file uploaded.']);
        exit;
    }
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Invalid request method.']);
    exit;
}
?>

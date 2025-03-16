<?php
require_once('config.php');

// Initialize variables
$file = '';
$download_id = 0;
$download_token = '';
$error_message = '';

// Check if required parameters are provided
if (isset($_GET['file']) && isset($_GET['id'])) {
    $file = filter_var($_GET['file'], FILTER_SANITIZE_STRING);
    $download_id = filter_var($_GET['id'], FILTER_VALIDATE_INT);
    $download_token = isset($_GET['token']) ? filter_var($_GET['token'], FILTER_SANITIZE_STRING) : '';
    
    // Basic validation
    if (empty($file) || $download_id <= 0) {
        $error_message = "Invalid download parameters.";
    }
} else {
    $error_message = "Missing required parameters.";
}

// If there's no error so far, proceed with database validation
if (empty($error_message)) {
    // Verify the download record exists in the database
    $sql = "SELECT * FROM resource_downloads WHERE download_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $download_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 0) {
        $error_message = "Invalid download ID.";
    } else {
        $download = $result->fetch_assoc();
        
        // Verify token if token column exists and token parameter is provided
        $token_validation = true; // Default to true if we're not using tokens
        
        // Check if the download_token column exists in the table
        $check_token_column = "SHOW COLUMNS FROM `resource_downloads` LIKE 'download_token'";
        $token_column_result = $conn->query($check_token_column);
        
        if ($token_column_result && $token_column_result->num_rows > 0) {
            // Column exists, check if we have a token in the URL and in the database
            if (!empty($download_token) && isset($download['download_token']) && !empty($download['download_token'])) {
                // Verify the token matches
                $token_validation = ($download_token === $download['download_token']);
                if (!$token_validation) {
                    $error_message = "Invalid download token.";
                }
            }
        }
        
        // If token is valid or not being used, check the timestamp
        if ($token_validation && empty($error_message)) {
            // Check if the download has expired (48 hours)
            $download_time = strtotime($download['downloaded_at']);
            $current_time = time();
            $time_diff = $current_time - $download_time;
            $hours_diff = $time_diff / 3600; // Convert seconds to hours
            
            if ($hours_diff > 48) {
                $error_message = "This download link has expired. Please request a new one.";
            }
        }
    }
    $stmt->close();
}

// If there's still no error, verify the file exists and is in the allowed directory
if (empty($error_message)) {
    // Define allowed resources directory (make sure this is outside web root for security)
    $resources_dir = ROOT_PATH . '/static/resources/';
    
    // Define allowed files - this is important for security
    $allowed_files = [
        'website-conversion-framework-guide.pdf',
        'romanian-seo-checklist.pdf'
    ];
    
    // Validate file exists in allowed list
    if (!in_array($file, $allowed_files)) {
        $error_message = "Requested file is not available for download.";
    } else {
        // Build the full file path
        $file_path = $resources_dir . $file;
        
        // Check if file exists
        if (!file_exists($file_path)) {
            $error_message = "The requested file does not exist.";
        }
    }
}

// If there's an error, display it
if (!empty($error_message)) {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Download Error</title>
        <style>
            body {
                font-family: 'Poppins', sans-serif;
                background-color: #0F1013;
                color: #FFFFFF;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
                padding: 20px;
            }
            .error-container {
                background-color: #1A1A1D;
                padding: 40px;
                border-radius: 8px;
                max-width: 600px;
                text-align: center;
                box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
            }
            h1 {
                color: #FF6B6B;
                margin-bottom: 20px;
            }
            p {
                margin-bottom: 30px;
                line-height: 1.6;
            }
            .btn {
                display: inline-block;
                background-color: #4682B4;
                color: #FFFFFF;
                padding: 12px 24px;
                text-decoration: none;
                border-radius: 4px;
                font-weight: 500;
                transition: all 0.3s ease;
            }
            .btn:hover {
                background-color: #375F82;
                transform: translateY(-3px);
                box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            }
        </style>
    </head>
    <body>
        <div class="error-container">
            <h1>Download Error</h1>
            <p><?php echo $error_message; ?></p>
            <a href="index.php" class="btn">Return to Homepage</a>
        </div>
    </body>
    </html>
    <?php
    exit();
}

// Check if download_count column exists and update it if it does
$check_count_column = "SHOW COLUMNS FROM `resource_downloads` LIKE 'download_count'";
$count_column_result = $conn->query($check_count_column);

if ($count_column_result && $count_column_result->num_rows > 0) {
    // Update download count in the database
    $sql = "UPDATE resource_downloads SET download_count = download_count + 1, last_downloaded_at = NOW() WHERE download_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $download_id);
    $stmt->execute();
    $stmt->close();
} else {
    // Simpler update if download_count doesn't exist
    $sql = "UPDATE resource_downloads SET last_downloaded_at = NOW() WHERE download_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $download_id);
    $stmt->execute();
    $stmt->close();
}

// Get file information
$file_size = filesize($file_path);
$file_ext = strtolower(pathinfo($file_path, PATHINFO_EXTENSION));

// Set appropriate content type based on file extension
switch ($file_ext) {
    case 'pdf':
        $content_type = 'application/pdf';
        break;
    case 'zip':
        $content_type = 'application/zip';
        break;
    case 'doc':
        $content_type = 'application/msword';
        break;
    case 'docx':
        $content_type = 'application/vnd.openxmlformats-officedocument.wordprocessingml.document';
        break;
    case 'xls':
        $content_type = 'application/vnd.ms-excel';
        break;
    case 'xlsx':
        $content_type = 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';
        break;
    default:
        $content_type = 'application/octet-stream';
}

// Clean the output buffer
if (ob_get_length() > 0) {
    ob_clean();
    ob_end_flush();
}

// Set headers for download
header('Content-Description: File Transfer');
header('Content-Type: ' . $content_type);
header('Content-Disposition: attachment; filename="' . basename($file_path) . '"');
header('Content-Transfer-Encoding: binary');
header('Expires: 0');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Pragma: public');
header('Content-Length: ' . $file_size);

// Read the file and output it to the browser
readfile($file_path);
exit;
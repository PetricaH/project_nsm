<?php
require_once('../config.php');
require_once(ROOT_PATH . '/includes/email_utils.php');

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data and sanitize
    $email = isset($_POST['email']) ? mysqli_real_escape_string($conn, trim($_POST['email'])) : '';
    $consent = isset($_POST['consent']) ? 1 : 0;
    $resource_type = 'seo-checklist'; // This identifies which lead magnet was requested
    
    // Validate required fields
    $errors = [];
    
    if (empty($email)) {
        $errors[] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Valid email is required";
    }
    
    if (!$consent) {
        $errors[] = "You must consent to receive the checklist";
    }
    
    // If there are validation errors
    if (!empty($errors)) {
        // For AJAX response
        echo json_encode(['success' => false, 'errors' => $errors]);
        exit();
    }
    
    // Extract name from email (basic version - just use part before @)
    $name_parts = explode('@', $email);
    $name = ucfirst($name_parts[0]);
    
    // Collect additional data for tracking
    $ip_address = $_SERVER['REMOTE_ADDR'];
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    $source = 'exit_intent_popup';
    
    // Collect UTM parameters if available
    $utm_source = isset($_SESSION['utm_source']) ? $_SESSION['utm_source'] : null;
    $utm_medium = isset($_SESSION['utm_medium']) ? $_SESSION['utm_medium'] : null;
    $utm_campaign = isset($_SESSION['utm_campaign']) ? $_SESSION['utm_campaign'] : null;
    
    // All validation passed, insert into database
    $sql = "INSERT INTO resource_downloads (name, email, resource_type, consent, ip_address, user_agent, source, utm_source, utm_medium, utm_campaign) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssissssss", $name, $email, $resource_type, $consent, $ip_address, $user_agent, $source, $utm_source, $utm_medium, $utm_campaign);

    if ($stmt->execute()) {
    
    if ($stmt->execute()) {
        $download_id = $conn->insert_id;
        
        // Define resource details
        $resource_file = "romanian-seo-checklist.pdf";
        
        // Send email with download link
        $email_sent = send_download_email($email, $name, $resource_type, $download_id, $resource_file);
        
        // Send notification to admin
        $admin_subject = "New Resource Download: SEO Checklist";
        $admin_message = "A new download of the SEO Checklist has occurred:\n\n";
        $admin_message .= "Email: " . $email . "\n";
        $admin_message .= "Downloaded: " . date("Y-m-d H:i:s") . "\n";
        $admin_message .= "IP Address: " . $ip_address . "\n";
        $admin_message .= "Source: Exit Intent Popup\n";
        
        send_admin_notification($admin_subject, $admin_message);
        
        // For AJAX response
        echo json_encode([
            'success' => true, 
            'message' => "Your SEO checklist has been sent to " . $email . ". Please check your inbox!"
        ]);
        exit();
    } else {
        // Database error
        echo json_encode(['success' => false, 'errors' => ["Sorry, there was a problem processing your request. Please try again later."]]);
        exit();
    }
} else {
    // If accessed directly without form submission
    header("Location: ../../webdev.php");
    exit();
}}
<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once('../config.php');
require_once(ROOT_PATH . '/includes/email_utils.php');

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data and sanitize
    $name = isset($_POST['name']) ? mysqli_real_escape_string($conn, trim($_POST['name'])) : '';
    $email = isset($_POST['email']) ? mysqli_real_escape_string($conn, trim($_POST['email'])) : '';
    $consent = isset($_POST['consent']) ? 1 : 0;
    $resource_type = 'conversion-framework'; // This identifies which lead magnet was requested
    
    // Validate required fields
    $errors = [];
    
    if (empty($name)) {
        $errors[] = "Name is required";
    }
    
    if (empty($email)) {
        $errors[] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Valid email is required";
    }
    
    if (!$consent) {
        $errors[] = "You must consent to receive the guide";
    }
    
    // If there are validation errors
    if (!empty($errors)) {
        // Store errors in session
        $_SESSION['resource_errors'] = $errors;
        $_SESSION['resource_form_data'] = [
            'name' => $name,
            'email' => $email
        ];
        
        // Redirect back to the form
        header("Location: " . $_SERVER['HTTP_REFERER'] . "#free_resource_section");
        exit();
    }
    
    // Collect additional data for tracking
    $ip_address = $_SERVER['REMOTE_ADDR'];
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    $source = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'direct';
    
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
        $download_id = $conn->insert_id;
        
        // Define resource details
        $resource_file = "website-conversion-framework-guide.pdf";
        
        // Send email with download link
        $email_sent = send_download_email($email, $name, $resource_type, $download_id, $resource_file);
        
        // Send notification to admin
        $admin_subject = "New Resource Download: The 7-Step Website Conversion Framework";
        $admin_message = "A new download of the Conversion Framework guide has occurred:\n\n";
        $admin_message .= "Name: " . $name . "\n";
        $admin_message .= "Email: " . $email . "\n";
        $admin_message .= "Downloaded: " . date("Y-m-d H:i:s") . "\n";
        $admin_message .= "IP Address: " . $ip_address . "\n";
        $admin_message .= "Referrer: " . $source . "\n";
        
        send_admin_notification($admin_subject, $admin_message);
        
        // Set success message
        $_SESSION['resource_success'] = "Your guide has been sent to " . $email . ". Please check your inbox!";
        
        // Redirect to thank you page
        header("Location: ../../resource-thank-you.php?type=conversion-framework");
        exit();
    } else {
        // Database error
        $_SESSION['resource_errors'] = ["Sorry, there was a problem processing your download request. Please try again later."];
        
        // Redirect back to form
        header("Location: " . $_SERVER['HTTP_REFERER'] . "#free_resource_section");
        exit();
    }
} else {
    // If accessed directly without form submission
    header("Location: ../../webdev.php");
    exit();
}
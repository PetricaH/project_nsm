<?php
require_once('../config.php');

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data and sanitize
    $name = isset($_POST['name']) ? mysqli_real_escape_string($conn, trim($_POST['name'])) : '';
    $email = isset($_POST['email']) ? mysqli_real_escape_string($conn, trim($_POST['email'])) : '';
    $website = isset($_POST['website']) ? mysqli_real_escape_string($conn, trim($_POST['website'])) : '';
    $consent = isset($_POST['consent']) ? 1 : 0;
    
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
    
    if (empty($website)) {
        $errors[] = "Website URL is required";
    } elseif (!filter_var($website, FILTER_VALIDATE_URL)) {
        $website = 'https://' . $website; // Try adding https://
        if (!filter_var($website, FILTER_VALIDATE_URL)) {
            $errors[] = "Valid website URL is required";
        }
    }
    
    if (!$consent) {
        $errors[] = "You must consent to receive the audit report";
    }
    
    // If there are validation errors
    if (!empty($errors)) {
        // Store errors in session
        $_SESSION['audit_errors'] = $errors;
        $_SESSION['audit_form_data'] = [
            'name' => $name,
            'email' => $email,
            'website' => $website
        ];
        
        // Redirect back to the form
        header("Location: " . $_SERVER['HTTP_REFERER'] . "#free_audit_section");
        exit();
    }
    
    // All validation passed, insert into database
    $sql = "INSERT INTO audit_requests (name, email, website, consent, status) VALUES (?, ?, ?, ?, 'pending')";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $name, $email, $website, $consent);
    
    if ($stmt->execute()) {
        // Send email notification to admin
        $to = "mail@hreniucpetrica.ro"; // Your email
        $subject = "New Website Audit Request";
        $message = "A new website audit request has been submitted:\n\n";
        $message .= "Name: " . $name . "\n";
        $message .= "Email: " . $email . "\n";
        $message .= "Website: " . $website . "\n";
        $message .= "Submitted: " . date("Y-m-d H:i:s") . "\n\n";
        $message .= "Please log in to your admin panel to process this request.";
        
        $headers = "From: no-reply@hreniucpetrica.ro" . "\r\n";
        
        // Send admin notification
        mail($to, $subject, $message, $headers);
        
        // Send acknowledgment to user
        $to_user = $email;
        $subject_user = "Your Website Audit Request Received";
        $message_user = "Dear " . $name . ",\n\n";
        $message_user .= "Thank you for requesting a website audit. I've received your submission and will analyze your website shortly.\n\n";
        $message_user .= "Website submitted: " . $website . "\n\n";
        $message_user .= "You will receive your comprehensive audit report within 48 hours. In the meantime, if you have any questions, feel free to reply to this email.\n\n";
        $message_user .= "Best regards,\n";
        $message_user .= "Hreniuc Petrică\n";
        $message_user .= "Web Development & Automation Specialist\n";
        $message_user .= "mail@hreniucpetrica.ro";
        
        $headers_user = "From: Hreniuc Petrică <mail@hreniucpetrica.ro>" . "\r\n";
        
        mail($to_user, $subject_user, $message_user, $headers_user);
        
        // Set success message
        $_SESSION['audit_success'] = "Your website audit request has been submitted successfully! You will receive your report within 48 hours.";
        
        // Redirect to thank you page or back to form with success message
        header("Location: " . $_SERVER['HTTP_REFERER'] . "#free_audit_section");
        exit();
    } else {
        // Database error
        $_SESSION['audit_errors'] = ["Sorry, there was a problem processing your request. Please try again later."];
        
        // Redirect back to form
        header("Location: " . $_SERVER['HTTP_REFERER'] . "#free_audit_section");
        exit();
    }
} else {
    // If accessed directly without form submission
    header("Location: ../../webdev.php");
    exit();
}
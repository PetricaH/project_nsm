<?php
require_once('../config.php');
require_once(ROOT_PATH . '/includes/email_utils.php');

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data and sanitize
    $name = isset($_POST['name']) ? mysqli_real_escape_string($conn, trim($_POST['name'])) : '';
    $email = isset($_POST['email']) ? mysqli_real_escape_string($conn, trim($_POST['email'])) : '';
    $company = isset($_POST['company']) ? mysqli_real_escape_string($conn, trim($_POST['company'])) : '';
    $phone = isset($_POST['phone']) ? mysqli_real_escape_string($conn, trim($_POST['phone'])) : '';
    $service = isset($_POST['service']) ? mysqli_real_escape_string($conn, trim($_POST['service'])) : '';
    $service_type = isset($_POST['service_type']) ? mysqli_real_escape_string($conn, trim($_POST['service_type'])) : $service;
    $date = isset($_POST['date']) ? mysqli_real_escape_string($conn, trim($_POST['date'])) : '';
    $time = isset($_POST['time']) ? mysqli_real_escape_string($conn, trim($_POST['time'])) : '';
    $website = isset($_POST['website']) ? mysqli_real_escape_string($conn, trim($_POST['website'])) : '';
    $description = isset($_POST['description']) ? mysqli_real_escape_string($conn, trim($_POST['description'])) : '';
    $budget = isset($_POST['budget']) ? mysqli_real_escape_string($conn, trim($_POST['budget'])) : '';
    $timeline = isset($_POST['timeline']) ? mysqli_real_escape_string($conn, trim($_POST['timeline'])) : '';
    $privacy_policy = isset($_POST['privacy_policy']) ? 1 : 0;
    
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
    
    if (empty($phone)) {
        $errors[] = "Phone number is required";
    }
    
    if (empty($service)) {
        $errors[] = "Service selection is required";
    }
    
    if (empty($date)) {
        $errors[] = "Date is required";
    }
    
    if (empty($time)) {
        $errors[] = "Time is required";
    }
    
    if (empty($description)) {
        $errors[] = "Project description is required";
    }
    
    if (!$privacy_policy) {
        $errors[] = "You must agree to the privacy policy";
    }
    
    // If there are validation errors
    if (!empty($errors)) {
        // Store errors in session
        $_SESSION['booking_errors'] = $errors;
        $_SESSION['booking_form_data'] = [
            'name' => $name,
            'email' => $email,
            'company' => $company,
            'phone' => $phone,
            'service' => $service,
            'date' => $date,
            'time' => $time,
            'website' => $website,
            'description' => $description,
            'budget' => $budget,
            'timeline' => $timeline
        ];
        
        // Redirect back to the form
        header("Location: " . $_SERVER['HTTP_REFERER']);
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
    $sql = "INSERT INTO bookings (name, email, company, phone, service, service_type, booking_date, booking_time, 
            website, description, budget, timeline, privacy_policy, ip_address, user_agent, source, utm_source, utm_medium, utm_campaign, status) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'pending')";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssssssissssss", $name, $email, $company, $phone, $service, $service_type, 
                     $date, $time, $website, $description, $budget, $timeline, $privacy_policy, 
                     $ip_address, $user_agent, $source, $utm_source, $utm_medium, $utm_campaign);
    
    $time = date('H:i:s', strtotime($time));

    if ($stmt->execute()) {
        $booking_id = $conn->insert_id;
        
        // Format date and time for display
        $formatted_date = date('l, F j, Y', strtotime($date));
        $formatted_time = date('g:i A', strtotime($time));
        
        // Prepare booking details for email
        $booking_details = [
            'booking_id' => $booking_id,
            'service' => $service,
            'booking_date' => $date,
            'booking_time' => $time
        ];
        
        // Send confirmation to client
        $email_sent = send_booking_confirmation($email, $name, $booking_details);
        
        // Send email notification to admin
        $admin_subject = "New Strategy Session Booking";
        $admin_message = "A new strategy session has been booked:\n\n";
        $admin_message .= "Booking ID: " . $booking_id . "\n";
        $admin_message .= "Name: " . $name . "\n";
        $admin_message .= "Email: " . $email . "\n";
        $admin_message .= "Company: " . ($company ?: "Not provided") . "\n";
        $admin_message .= "Phone: " . $phone . "\n";
        $admin_message .= "Service: " . $service . "\n";
        $admin_message .= "Date & Time: " . $formatted_date . " at " . $formatted_time . "\n";
        $admin_message .= "Website: " . ($website ?: "Not provided") . "\n";
        $admin_message .= "Budget: " . ($budget ?: "Not provided") . "\n";
        $admin_message .= "Timeline: " . ($timeline ?: "Not provided") . "\n\n";
        $admin_message .= "Project Description:\n" . $description . "\n\n";
        $admin_message .= "Please confirm this booking with the client.";
        
        send_admin_notification($admin_subject, $admin_message);
        
        // Set success message
        $_SESSION['booking_success'] = "Your strategy session has been booked successfully! A confirmation email has been sent to " . $email;
        
        // Redirect to thank you page
        header("Location: booking-confirmation.php?id=" . $booking_id);
        exit();
    } else {
        // Database error
        $_SESSION['booking_errors'] = ["Sorry, there was a problem processing your booking. Please try again later."];
        
        // Redirect back to form
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }
} else {
    // If accessed directly without form submission
    header("Location: ../../webdev.php");
    exit();
}
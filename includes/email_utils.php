<?php
/**
 * Email Utility Functions
 * 
 * This file contains functions to standardize email sending throughout the site.
 * It uses PHP's native mail() function with proper headers and formatting.
 */

/**
 * Send a standardized email
 * 
 * @param string $to Recipient email address
 * @param string $subject Email subject
 * @param string $message Email body
 * @param array $attachments Optional array of attachments [name => path]
 * @param string $from_name Optional sender name
 * @param string $from_email Optional sender email
 * @param array $cc Optional CC recipients
 * @param array $bcc Optional BCC recipients
 * @return bool Whether the email was successfully sent
 */
function send_email($to, $subject, $message, $attachments = [], $from_name = 'Hreniuc Petrică', $from_email = 'mail@hreniucpetrica.ro', $cc = [], $bcc = []) {
    // Create unique boundary for MIME message
    $boundary = md5(time());
    
    // Set default headers
    $headers = "From: " . $from_name . " <" . $from_email . ">\r\n";
    $headers .= "Reply-To: " . $from_email . "\r\n";
    
    // Add CC if provided
    if (!empty($cc)) {
        $headers .= "Cc: " . implode(", ", $cc) . "\r\n";
    }
    
    // Add BCC if provided
    if (!empty($bcc)) {
        $headers .= "Bcc: " . implode(", ", $bcc) . "\r\n";
    }
    
    // Add required mail headers
    $headers .= "MIME-Version: 1.0\r\n";
    
    // If we have attachments, set up a multipart message
    if (!empty($attachments)) {
        $headers .= "Content-Type: multipart/mixed; boundary=\"" . $boundary . "\"\r\n";
        
        // Prepare the message body for a multipart message
        $message_body = "--" . $boundary . "\r\n";
        $message_body .= "Content-Type: text/plain; charset=UTF-8\r\n";
        $message_body .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
        $message_body .= $message . "\r\n\r\n";
        
        // Add each attachment
        foreach ($attachments as $filename => $filepath) {
            if (!file_exists($filepath)) {
                continue; // Skip if file doesn't exist
            }
            
            $file_content = file_get_contents($filepath);
            if ($file_content === false) {
                continue; // Skip if we can't read the file
            }
            
            $attachment = chunk_split(base64_encode($file_content));
            
            $message_body .= "--" . $boundary . "\r\n";
            $message_body .= "Content-Type: application/octet-stream; name=\"" . $filename . "\"\r\n";
            $message_body .= "Content-Transfer-Encoding: base64\r\n";
            $message_body .= "Content-Disposition: attachment; filename=\"" . $filename . "\"\r\n\r\n";
            $message_body .= $attachment . "\r\n\r\n";
        }
        
        // Close the MIME boundary
        $message_body .= "--" . $boundary . "--";
    } else {
        // Simple text email if no attachments
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
        $message_body = $message;
    }
    
    // Add additional headers to prevent email spoofing and improve deliverability
    $headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
    $headers .= "X-Priority: 3\r\n"; // Normal priority
    
    // Create logs directory if it doesn't exist
    if (!file_exists(ROOT_PATH . "/logs")) {
        mkdir(ROOT_PATH . "/logs", 0755, true);
    }
    
    // Log the email attempt
    $log_message = date('Y-m-d H:i:s') . " - Sending email to: " . $to . ", Subject: " . $subject . "\n";
    error_log($log_message, 3, ROOT_PATH . "/logs/email.log");
    
    // Send the email
    $success = mail($to, $subject, $message_body, $headers);
    
    // Log the result
    $log_result = date('Y-m-d H:i:s') . " - Result: " . ($success ? "Success" : "Failed") . "\n";
    error_log($log_result, 3, ROOT_PATH . "/logs/email.log");
    
    return $success;
}

/**
 * Send a download link email
 * 
 * @param string $to Recipient email address
 * @param string $name Recipient name
 * @param string $resource_type Type of resource being downloaded
 * @param int $download_id Download ID for tracking
 * @param string $filename Filename of the resource
 * @return bool Whether the email was successfully sent
 */
function send_download_email($to, $name, $resource_type, $download_id, $filename) {
    // Generate a unique download token for added security
    $download_token = md5($download_id . $to . time());
    
    // Store the token in the database (if the column exists)
    global $conn;
    
    // Check if the download_token column exists
    $column_exists = false;
    $check_sql = "SHOW COLUMNS FROM `resource_downloads` LIKE 'download_token'";
    $result = $conn->query($check_sql);
    if ($result && $result->num_rows > 0) {
        $column_exists = true;
    }
    
    // Update the token if the column exists
    if ($column_exists) {
        $sql = "UPDATE resource_downloads SET download_token = ? WHERE download_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $download_token, $download_id);
        $stmt->execute();
        $stmt->close();
    }
    
    // Determine resource details based on type
    switch ($resource_type) {
        case 'conversion-framework':
            $resource_title = "The 7-Step Website Conversion Framework";
            $resource_description = "strategies I use to increase website conversion rates by an average of 40% for my clients";
            break;
        case 'seo-checklist':
            $resource_title = "SEO Checklist for Romanian Businesses";
            $resource_description = "21 actionable tips to improve your local search rankings";
            break;
        default:
            $resource_title = "Your Requested Resource";
            $resource_description = "the resource you requested";
    }
    
    // Build the download URL (include token only if the column exists)
    $download_url = BASE_URL . "download.php?file=" . $filename . "&id=" . $download_id;
    if ($column_exists) {
        $download_url .= "&token=" . $download_token;
    }
    
    // Prepare the email subject
    $subject = "Your " . $resource_title . " Download";
    
    // Prepare the email body
    $message = "Dear " . $name . ",\n\n";
    $message .= "Thank you for your interest in " . $resource_title . ".\n\n";
    $message .= "You can download your guide by clicking the link below:\n\n";
    $message .= $download_url . "\n\n";
    $message .= "In this guide, you'll discover " . $resource_description . ".\n\n";
    $message .= "This download link will expire in 48 hours for security reasons.\n\n";
    $message .= "If you have any questions about implementing these strategies for your business, feel free to reply to this email or schedule a free strategy session on my website.\n\n";
    $message .= "Best regards,\n";
    $message .= "Hreniuc Petrică\n";
    $message .= "Web Development & Automation Specialist\n";
    $message .= "mail@hreniucpetrica.ro\n";
    
    // Send the email
    return send_email($to, $subject, $message);
}

/**
 * Send an admin notification email
 * 
 * @param string $subject Email subject
 * @param string $message Email body
 * @return bool Whether the email was successfully sent
 */
function send_admin_notification($subject, $message) {
    $admin_email = "mail@hreniucpetrica.ro";
    return send_email($admin_email, $subject, $message, [], 'System Notification', 'no-reply@hreniucpetrica.ro');
}

/**
 * Send a booking confirmation email
 * 
 * @param string $to Recipient email address
 * @param string $name Recipient name
 * @param array $booking_details Booking details array
 * @return bool Whether the email was successfully sent
 */
function send_booking_confirmation($to, $name, $booking_details) {
    // Format date and time for display
    $formatted_date = date('l, F j, Y', strtotime($booking_details['booking_date']));
    $formatted_time = date('g:i A', strtotime($booking_details['booking_time']));
    
    // Prepare the email subject
    $subject = "Your Strategy Session is Confirmed";
    
    // Prepare the email body
    $message = "Dear " . $name . ",\n\n";
    $message .= "Thank you for booking a free strategy session. Your appointment is confirmed for:\n\n";
    $message .= "Date: " . $formatted_date . "\n";
    $message .= "Time: " . $formatted_time . "\n\n";
    $message .= "Service: " . $booking_details['service'] . "\n\n";
    $message .= "I'll contact you shortly to confirm the meeting details and provide you with a video call link. In the meantime, please prepare any specific questions or challenges you'd like to discuss during our session.\n\n";
    $message .= "To make the most of our strategy session, I recommend the following:\n";
    $message .= "- Have your current website details accessible (if applicable)\n";
    $message .= "- Think about your top 3 business goals for your website\n";
    $message .= "- Consider what has or hasn't worked for you in the past\n\n";
    $message .= "If you need to reschedule, please reply to this email at least 24 hours before your scheduled time.\n\n";
    $message .= "I'm looking forward to our conversation!\n\n";
    $message .= "Best regards,\n";
    $message .= "Hreniuc Petrică\n";
    $message .= "Web Development & Automation Specialist\n";
    $message .= "mail@hreniucpetrica.ro";
    
    // Send the email
    return send_email($to, $subject, $message);
}
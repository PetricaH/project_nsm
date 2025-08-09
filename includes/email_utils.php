<?php
/**
 * Corrected Email Utility Functions
 * 
 * Final working version based on successful authentication test
 * Uses the CORRECT server: poseidon.b2b-server.net
 */

require_once __DIR__ . '/../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

/**
 * Send email using the correct SMTP configuration
 * 
 * UPDATE THESE SETTINGS BASED ON YOUR AUTHENTICATION TEST RESULTS:
 */
function send_email($to, $subject, $message, $attachments = [], $from_name = 'Hreniuc Petrică', $from_email = 'hello@notsomarketing.com', $cc = [], $bcc = []) {
    $mail = new PHPMailer(true);

    try {
        // SMTP Configuration - UPDATE THESE BASED ON TEST RESULTS
        $mail->isSMTP();
        $mail->Host = 'poseidon.b2b-server.net'; // CORRECT SERVER (not smtp.poseidon.b2b-server.net)
        $mail->SMTPAuth = true;
        $mail->Username = 'hello@notsomarketing.com'; // CHANGE IF TEST SHOWS 'hello' works better
        $mail->Password = 'YOUR_EMAIL_PASSWORD'; // Replace with actual password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // CHANGE TO ENCRYPTION_SMTPS if port 465 works
        $mail->Port = 587; // CHANGE TO 465 if SSL test succeeds
        
        // SSL certificate fix
        $mail->SMTPOptions = [
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            ]
        ];
        
        $mail->Timeout = 20;
        
        // Sender
        $mail->setFrom($from_email, $from_name);
        $mail->addReplyTo($from_email, $from_name);
        
        // Recipients
        $mail->addAddress($to);
        
        // Add CC and BCC
        foreach ($cc as $cc_email) {
            $mail->addCC($cc_email);
        }
        foreach ($bcc as $bcc_email) {
            $mail->addBCC($bcc_email);
        }

        // Attachments
        foreach ($attachments as $filename => $filepath) {
            if (file_exists($filepath)) {
                $mail->addAttachment($filepath, $filename);
            }
        }

        // Content
        $mail->isHTML(false);
        $mail->CharSet = 'UTF-8';
        $mail->Subject = $subject;
        $mail->Body = $message;

        // Create logs directory if it doesn't exist
        $log_dir = __DIR__ . '/../logs';
        if (!file_exists($log_dir)) {
            mkdir($log_dir, 0755, true);
        }
        
        // Log the email attempt
        $log_message = date('Y-m-d H:i:s') . " - Trimit email către: " . $to . ", Subiect: " . $subject . "\n";
        error_log($log_message, 3, $log_dir . "/email.log");

        // Send the email
        $success = $mail->send();
        
        // Log the result
        $log_result = date('Y-m-d H:i:s') . " - Rezultat: " . ($success ? "Succes SMTP Final" : "Eșuat SMTP Final") . "\n";
        error_log($log_result, 3, $log_dir . "/email.log");
        
        return true;
        
    } catch (Exception $e) {
        // Log the error
        $error_message = date('Y-m-d H:i:s') . " - Eroare SMTP Final: " . $mail->ErrorInfo . "\n";
        error_log($error_message, 3, $log_dir . "/email.log");
        
        return false;
    }
}

/**
 * Alternative configuration templates
 * Use the one that works from your authentication test
 */

// TEMPLATE 1: If Port 587 + TLS + Full Email works
function send_email_template_587($to, $subject, $message, $attachments = []) {
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'poseidon.b2b-server.net';
        $mail->SMTPAuth = true;
        $mail->Username = 'hello@notsomarketing.com';
        $mail->Password = 'Ns5423#$@';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
        
        $mail->SMTPOptions = ['ssl' => ['verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true]];
        
        $mail->setFrom('hello@notsomarketing.com', 'Hreniuc Petrică');
        $mail->addAddress($to);
        $mail->Subject = $subject;
        $mail->Body = $message;
        
        return $mail->send();
    } catch (Exception $e) {
        return false;
    }
}

// TEMPLATE 2: If Port 465 + SSL + Full Email works
function send_email_template_465($to, $subject, $message, $attachments = []) {
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'poseidon.b2b-server.net';
        $mail->SMTPAuth = true;
        $mail->Username = 'hello@notsomarketing.com';
        $mail->Password = 'YOUR_PASSWORD';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;
        
        $mail->SMTPOptions = ['ssl' => ['verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true]];
        
        $mail->setFrom('hello@notsomarketing.com', 'Hreniuc Petrică');
        $mail->addAddress($to);
        $mail->Subject = $subject;
        $mail->Body = $message;
        
        return $mail->send();
    } catch (Exception $e) {
        return false;
    }
}

// TEMPLATE 3: If Username Only (hello) works
function send_email_template_username_only($to, $subject, $message, $attachments = []) {
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'poseidon.b2b-server.net';
        $mail->SMTPAuth = true;
        $mail->Username = 'hello'; // Just username part
        $mail->Password = 'YOUR_PASSWORD';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
        
        $mail->SMTPOptions = ['ssl' => ['verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true]];
        
        $mail->setFrom('hello@notsomarketing.com', 'Hreniuc Petrică');
        $mail->addAddress($to);
        $mail->Subject = $subject;
        $mail->Body = $message;
        
        return $mail->send();
    } catch (Exception $e) {
        return false;
    }
}

/**
 * Romanian email functions using the working configuration
 */
function send_download_email($to, $name, $resource_type, $download_id, $filename) {
    global $conn;
    
    // Generate download token
    $download_token = md5($download_id . $to . time());
    
    // Check if download_token column exists
    $column_exists = false;
    $check_sql = "SHOW COLUMNS FROM `resource_downloads` LIKE 'download_token'";
    $result = $conn->query($check_sql);
    if ($result && $result->num_rows > 0) {
        $column_exists = true;
    }
    
    // Update token if column exists
    if ($column_exists) {
        $sql = "UPDATE resource_downloads SET download_token = ? WHERE download_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $download_token, $download_id);
        $stmt->execute();
    }
    
    // Get resource details
    $resource_title = "Resursă Gratuită";
    $resource_description = "informații valoroase pentru afacerea ta";
    
    switch ($resource_type) {
        case 'seo-checklist':
            $resource_title = "Checklist-ul de Optimizare SEO";
            $resource_description = "strategii pas cu pas pentru îmbunătățirea poziției site-ului tău în motoarele de căutare";
            break;
        case 'conversion-framework':
            $resource_title = "Framework-ul de Optimizare Conversii";
            $resource_description = "metode dovedite pentru creșterea ratei de conversie a site-ului tău";
            break;
    }
    
    // Create download URL
    $download_url = "https://hreniucpetrica.ro/download.php?file=" . $filename . "&id=" . $download_id;
    if ($column_exists) {
        $download_url .= "&token=" . $download_token;
    }
    
    // Email content in Romanian
    $subject = "Ghidul tău: " . $resource_title;
    
    $message = "Bună ziua " . $name . ",\n\n";
    $message .= "Mulțumim pentru interesul acordat ghidului: " . $resource_title . ".\n\n";
    $message .= "Poți descărca ghidul accesând link-ul de mai jos:\n\n";
    $message .= $download_url . "\n\n";
    $message .= "În acest ghid vei descoperi " . $resource_description . ".\n\n";
    $message .= "Acest link de download va expira în 48 de ore din motive de securitate.\n\n";
    $message .= "Dacă ai întrebări despre implementarea acestor strategii pentru afacerea ta, nu ezita să răspunzi la acest email sau să programezi o sesiune gratuită de strategie pe site-ul meu.\n\n";
    $message .= "Cu respect,\n";
    $message .= "Hreniuc Petrică\n";
    $message .= "Specialist în Dezvoltare Web & Automatizare\n";
    $message .= "hello@notsomarketing.com\n";
    
    return send_email($to, $subject, $message);
}

function send_booking_confirmation($to, $name, $booking_details) {
    // Format date and time
    $formatted_date = date('l, j F Y', strtotime($booking_details['booking_date']));
    $formatted_time = date('H:i', strtotime($booking_details['booking_time']));
    
    $subject = "Sesiunea ta de strategie este confirmată";
    
    $message = "Bună ziua " . $name . ",\n\n";
    $message .= "Mulțumim că ai programat o sesiune gratuită de strategie. Întâlnirea ta este confirmată pentru:\n\n";
    $message .= "Data: " . $formatted_date . "\n";
    $message .= "Ora: " . $formatted_time . "\n\n";
    $message .= "Serviciu: " . $booking_details['service'] . "\n\n";
    $message .= "Te voi contacta în scurt timp pentru a confirma detaliile întâlnirii și pentru a-ți oferi link-ul pentru apelul video.\n\n";
    $message .= "Între timp, te rog să pregătești:\n";
    $message .= "• URL-ul site-ului tău actual (dacă este cazul)\n";
    $message .= "• Obiectivele principale ale afacerii tale\n";
    $message .= "• Provocările specifice cu care te confrunți\n\n";
    $message .= "Dacă trebuie să reprogramezi sau ai întrebări, te rog să răspunzi la acest email.\n\n";
    $message .= "Aștept cu nerăbdare conversația noastră!\n\n";
    $message .= "Cu respect,\n";
    $message .= "Hreniuc Petrică\n";
    $message .= "Specialist în Dezvoltare Web & Automatizare\n";
    $message .= "hello@notsomarketing.com\n";
    
    return send_email($to, $subject, $message);
}

function send_admin_notification($subject, $message) {
    $admin_email = "hello@notsomarketing.com";
    return send_email($admin_email, $subject, $message, [], 'System Notification', 'noreply@hreniucpetrica.ro');
}

?>
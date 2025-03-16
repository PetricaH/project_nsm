<?php require_once('../config.php');?>
<?php require_once(ROOT_PATH . '/includes/heading.php'); ?>

<?php
// Check if booking ID is provided
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: webdev.php");
    exit();
}

$booking_id = intval($_GET['id']);

// Get booking details
$sql = "SELECT * FROM bookings WHERE booking_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $booking_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    header("Location: webdev.php");
    exit();
}

$booking = $result->fetch_assoc();

// Format date and time
$formatted_date = date('l, F j, Y', strtotime($booking['booking_date']));
$formatted_time = date('g:i A', strtotime($booking['booking_time']));
?>

<?php $page_css = 'confirmation.css';?>
<title>Booking Confirmation | Strategy Session | Hreniuc Petrică</title>
<meta name="robots" content="noindex, nofollow">
</head>

<body data-context="confirmation">

<?php include(ROOT_PATH . '/includes/navbar.php'); ?>

<main class="confirmation-page">
    <div class="container">
        <div class="confirmation-container">
            <div class="confirmation-header">
                <div class="check-icon">
                    <span class="material-symbols-outlined">check_circle</span>
                </div>
                <h1>Your Strategy Session is Confirmed!</h1>
                <p>Thank you for scheduling a free consultation. Check your email for all the details.</p>
            </div>
            
            <div class="confirmation-details">
                <div class="details-row">
                    <div class="detail-item">
                        <span class="detail-label">Your Name</span>
                        <span class="detail-value"><?php echo htmlspecialchars($booking['name']); ?></span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Email</span>
                        <span class="detail-value"><?php echo htmlspecialchars($booking['email']); ?></span>
                    </div>
                </div>
                
                <div class="details-row">
                    <div class="detail-item">
                        <span class="detail-label">Date</span>
                        <span class="detail-value"><?php echo $formatted_date; ?></span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Time</span>
                        <span class="detail-value"><?php echo $formatted_time; ?></span>
                    </div>
                </div>
                
                <div class="details-row">
                    <div class="detail-item">
                        <span class="detail-label">Service</span>
                        <span class="detail-value"><?php echo htmlspecialchars($booking['service']); ?></span>
                    </div>
                </div>
                
                <div class="add-to-calendar">
                    <h3>Add to Calendar</h3>
                    <div class="calendar-buttons">
                        <a href="#" class="calendar-button google-calendar" onclick="addToGoogleCalendar(); return false;">Google Calendar</a>
                        <a href="#" class="calendar-button outlook-calendar" onclick="addToOutlookCalendar(); return false;">Outlook</a>
                        <a href="#" class="calendar-button ical-calendar" onclick="addToiCalendar(); return false;">iCalendar</a>
                    </div>
                </div>
            </div>
            
            <div class="confirmation-next-steps">
                <h2>What's Next?</h2>
                <div class="steps-container">
                    <div class="step-item">
                        <div class="step-number">1</div>
                        <div class="step-content">
                            <h3>Check Your Email</h3>
                            <p>I've sent a confirmation email to <?php echo htmlspecialchars($booking['email']); ?> with all the session details and a video call link.</p>
                        </div>
                    </div>
                    
                    <div class="step-item">
                        <div class="step-number">2</div>
                        <div class="step-content">
                            <h3>Prepare for Our Call</h3>
                            <p>Think about your key business goals and website challenges. Prepare any specific questions you'd like to address during our session.</p>
                        </div>
                    </div>
                    
                    <div class="step-item">
                        <div class="step-number">3</div>
                        <div class="step-content">
                            <h3>Join the Video Call</h3>
                            <p>Click the video call link in your confirmation email at your scheduled time. Make sure your camera and microphone are working properly.</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="confirmation-resource">
                <h2>While You Wait</h2>
                <p>Get a head start by downloading my free guide to website conversion optimization:</p>
                <div class="resource-container">
                    <div class="resource-image">
                        <img src="static/images/resources/conversion-guide-preview.png" alt="Website Conversion Framework Guide">
                    </div>
                    <div class="resource-content">
                        <h3>The 7-Step Website Conversion Framework</h3>
                        <p>Discover the exact strategies I use to increase website conversion rates by an average of 40% for my clients.</p>
                        <a href="#" class="resource-button" onclick="showResourceForm(); return false;">Download Free Guide</a>
                    </div>
                </div>
            </div>
            
            <div class="resource-form-container" id="resourceFormContainer" style="display: none;">
                <form id="confirmationResourceForm" action="includes/download_resource.php" method="POST">
                    <div class="form-group">
                        <label for="resource-name">Your Name</label>
                        <input type="text" id="resource-name" name="name" value="<?php echo htmlspecialchars($booking['name']); ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="resource-email">Email to Send Guide</label>
                        <input type="email" id="resource-email" name="email" value="<?php echo htmlspecialchars($booking['email']); ?>" required>
                    </div>
                    
                    <div class="form-checkbox">
                        <input type="checkbox" id="resource-consent" name="consent" required>
                        <label for="resource-consent">I agree to receive the free guide and occasional valuable tips</label>
                    </div>
                    
                    <button type="submit" class="resource-submit">Download Free Guide</button>
                </form>
            </div>
            
            <div class="need-help">
                <h3>Need to Reschedule?</h3>
                <p>If you need to reschedule or have any questions, please email me at <a href="mailto:mail@hreniucpetrica.ro">mail@hreniucpetrica.ro</a></p>
            </div>
        </div>
    </div>
</main>

<script>
function showResourceForm() {
    document.getElementById('resourceFormContainer').style.display = 'block';
    document.getElementById('resourceFormContainer').scrollIntoView({behavior: 'smooth'});
}

// Calendar functions would actually need proper implementation with
// the booking details encoded for each calendar type
function addToGoogleCalendar() {
    // Implementation for adding to Google Calendar
    alert('Google Calendar integration coming soon!');
}

function addToOutlookCalendar() {
    // Implementation for adding to Outlook
    alert('Outlook Calendar integration coming soon!');
}

function addToiCalendar() {
    // Implementation for adding to iCalendar
    alert('iCalendar integration coming soon!');
}
</script>

<?php include(ROOT_PATH . '/includes/footer.php'); ?>
</body>
</html>
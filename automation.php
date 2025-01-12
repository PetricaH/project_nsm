<?php require_once('config.php'); ?>

<?php require_once(ROOT_PATH . '/includes/heading.php'); ?>

<title>Automation</title>
</head>

<body data-context="automation">

<?php include(ROOT_PATH . '/includes/navbar.php'); ?>

    <section class="hero_automation_section">
        <!-- gradient overlay -->
        <div class="gradient_overlay"></div>

        <!-- robotic arms -->
        <img src="static/images/automation_lp_imgs/left_arm.png" alt="">
        <img src="static/images/automation_lp_imgs/top_arm.png" alt="">
        <img src="static/images/automation_lp_imgs/right_arm.png" alt="">

        <!-- content in the hero section -->
        <div class="automation_hero_content">
            <h1>Automate It</h1>
            <div class="under_h1_text_container">
                <p>Save Time</p>
                <img src="static/images/automation_lp_imgs/arrow_left.svg" alt="">
                <p>Save Money</p>
                <img src="static/images/automation_lp_imgs/arrow_left.svg" alt="">
                <p>Do More</p>
                <img src="static/images/automation_lp_imgs/arrow_left.svg" alt="">
            </div>
            <button onclick="openBookingModal()">Schedule Your Free Consultation</button>
        </div>
    </section>


    <!-- Popup Modal Form -->
<div id="bookingModal" class="booking-modal hidden">
        <div class="booking-modal-content">
            <span class="booking-modal-close" onclick="closeBookingModal()">&times;</span>
            <h2>Book a Service</h2>
            <form action="includes/submit_booking.php" method="POST">
                <div class="booking-form-group">
                    <label for="booking-name">Name:</label>
                    <input type="text" id="booking-name" name="name" required>
                </div>
                <div class="booking-form-group">
                    <label for="booking-email">Email:</label>
                    <input type="email" id="booking-email" name="email" required>
                </div>
                <div class="booking-form-group">
                    <label for="booking-service">Service:</label>
                    <select id="booking-service" name="service" required>
                        <option value="Automation">Automation</option>
                        <option value="Web Development">Web Development</option>
                    </select>
                </div>
                <div class="booking-form-group">
                    <label for="booking-date">Pick a Date:</label>
                    <input type="date" id="booking-date" name="date" required>
                </div>
                <div class="booking-form-group">
                    <label for="booking-time">Pick a Time:</label>
                    <select id="booking-time" name="time" required>
                        <option value="16:30">4:30 PM</option>
                        <option value="17:00">5:00 PM</option>
                        <option value="17:30">5:30 PM</option>
                        <option value="18:00">6:00 PM</option>
                        <option value="18:30">6:30 PM</option>
                        <option value="19:00">7:00 PM</option>
                        <option value="19:30">7:30 PM</option>
                        <option value="20:00">8:00 PM</option>
                        <option value="20:30">8:30 PM</option>
                        <option value="21:00">9:00 PM</option>
                        <option value="21:30">9:30 PM</option>
                        <option value="22:00">10:00 PM</option>
                        <option value="22:30">10:30 PM</option>
                    </select>
                </div>
                <div class="booking-form-group">
                    <label for="booking-description">Description:</label>
                    <textarea id="booking-description" name="description" rows="4" placeholder="Provide a short description of your situation..." required></textarea>
                </div>
                <div class="booking-form-group">
                    <input type="checkbox" id="privacy-policy" name="privacy_policy" required>
                    <label for="privacy-policy">
                        I agree to the <a href="privacy-policy.php" target="_blank">privacy policy</a> and consent to marketing communication.
                    </label>
                </div>
                <div class="booking-form-group">
                    <button type="submit" class="booking-submit-btn">Submit Booking</button>
                </div>
            </form>
        </div>
    </div>


<!-- Notification Area -->
<div id="notification" class="hidden">
    <p id="notification-message"></p>
</div>

<?php include(ROOT_PATH . '/includes/footer.php'); ?>

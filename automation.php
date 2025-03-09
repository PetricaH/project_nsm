<?php require_once('config.php'); ?>
<?php require_once(ROOT_PATH . '/includes/heading.php'); ?>

<?php $page_css = 'automation.css';?>
<title>Business Automation Solutions | Hreniuc Petrică</title>
<meta name="description" content="Streamline your business processes with custom automation solutions. Save time, reduce costs, and improve efficiency with our tailored automation services.">
</head>

<body data-context="automation">

<?php include(ROOT_PATH . '/includes/navbar.php'); ?>

<main>
    <!-- Hero Section -->
    <section class="hero_automation_section">
        <!-- Gradient overlay -->
        <div class="gradient_overlay"></div>

        <!-- Robotic arms background -->
        <div class="arms_container">
            <img src="static/images/automation_lp_imgs/left_arm.png" alt="Robotic Arm Left" class="left_arm">
            <img src="static/images/automation_lp_imgs/top_arm.png" alt="Robotic Arm Top" class="top_arm">
            <img src="static/images/automation_lp_imgs/right_arm.png" alt="Robotic Arm Right" class="right_arm">
        </div>

        <!-- Hero content -->
        <div class="automation_hero_content">
            <h1>Automate Your Business</h1>
            <div class="under_h1_text_container">
                <p>Save Time</p>
                <img src="static/images/automation_lp_imgs/arrow_left.svg" alt="Arrow">
                <p>Reduce Costs</p>
                <img src="static/images/automation_lp_imgs/arrow_left.svg" alt="Arrow">
                <p>Maximize Efficiency</p>
            </div>
            <button onclick="openBookingModal()">Book a Free Consultation</button>
        </div>
    </section>

    <!-- Main Content Section -->
    <section id="automation_examples_section">
        <!-- Pain Points Section -->
        <div class="automation_examples_tease_group">
            <h2>Common Business <span>Challenges</span></h2>
            <span class="material-symbols-outlined arrow_animate">
                arrow_downward
            </span>
        </div>
        
        <!-- Pain Points Cards -->
        <div class="difficulties_group">
            <div>
                <span class="material-symbols-outlined difficulty_icon">
                    hourglass_empty
                </span>
                Wasting hours on repetitive manual tasks
            </div>
            <div>
                <span class="material-symbols-outlined difficulty_icon">
                    error_outline
                </span>
                Inconsistent workflows leading to errors
            </div>
            <div>
                <span class="material-symbols-outlined difficulty_icon">
                    integration_instructions
                </span>
                Difficulty integrating various software tools
            </div>
        </div>

        <!-- Solutions & Case Studies -->
        <div class="automation_case_studies_group">
            <!-- Solutions Description -->
            <div class="text_part_automation_case_studies_group">
                <h2>How I Can Help Solve These <span>Problems</span></h2>
                <p>
                    I create custom automation solutions using powerful tools like Zapier, Marketo, n8n, and more. 
                    My approach focuses on identifying your business's unique needs and developing tailored solutions 
                    that seamlessly integrate with your existing systems. By automating repetitive tasks, your team 
                    can focus on high-value activities while reducing errors and costs.
                </p>
                <button onclick="openBookingModal()">Schedule a Consultation</button>
            </div>
            
            <!-- Case Studies -->
            <div class="case_studies_cards_automation_group">
                <div class="automation_case_study_card">
                    <h3>E-commerce Order Processing</h3>
                    <p>
                        Reduced order processing time by 75% for an online retailer by automating inventory updates, 
                        order confirmations, and shipping notifications. The solution integrated their e-commerce 
                        platform with accounting and CRM systems, eliminating data entry errors.
                    </p>
                    <a href="#" class="download-button">View Case Study</a>
                </div>

                <div class="automation_case_study_card">
                    <h3>Marketing Campaign Automation</h3>
                    <p>
                        Created an automated lead nurturing system for a B2B service provider, integrating their 
                        website forms with email marketing platform and CRM. The solution increased qualified leads 
                        by 45% while reducing marketing team workload.
                    </p>
                    <a href="#" class="download-button">View Case Study</a>
                </div>
            </div>
        </div>
    </section>
</main>

<!-- Booking Modal -->
<div id="bookingModal" class="booking-modal hidden">
    <div class="booking-modal-content">
        <span class="booking-modal-close" onclick="closeBookingModal()">&times;</span>
        <h2>Book a Consultation</h2>
        <form action="includes/submit_booking.php" method="POST">
            <div class="booking-form-group">
                <label for="booking-name">Name</label>
                <input type="text" id="booking-name" name="name" required>
            </div>
            <div class="booking-form-group">
                <label for="booking-email">Email</label>
                <input type="email" id="booking-email" name="email" required>
            </div>
            <div class="booking-form-group">
                <label for="booking-service">Service</label>
                <select id="booking-service" name="service" required>
                    <option value="Automation" selected>Business Automation</option>
                    <option value="Web Development">Web Development</option>
                    <option value="Consulting">Technical Consulting</option>
                </select>
            </div>

            <!-- Date and Time Selection -->
            <div class="booking-form-row">
                <div class="booking-form-group">
                    <label for="booking-date">Preferred Date</label>
                    <input type="date" id="booking-date" name="date" required>
                </div>
                <div class="booking-form-group">
                    <label for="booking-time">Preferred Time</label>
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
                    </select>
                </div>
            </div>

            <div class="booking-form-group">
                <label for="booking-description">Tell me about your project</label>
                <textarea id="booking-description" name="description" rows="4" placeholder="Describe your business challenges or the processes you'd like to automate..." required></textarea>
            </div>
            
            <div class="booking-form-group">
                <input type="checkbox" id="privacy-policy" name="privacy_policy" required>
                <label for="privacy-policy">
                    I agree to the <a href="privacy-policy.php" target="_blank">privacy policy</a> and consent to being contacted about this request.
                </label>
            </div>
            
            <div class="booking-form-group">
                <button type="submit" class="booking-submit-btn">Submit Request</button>
            </div>
        </form>
    </div>
</div>

<!-- Notification Area -->
<div id="notification" class="hidden">
    <p id="notification-message"></p>
</div>

<!-- JavaScript for the booking modal -->
<script>
    // Open booking modal
    function openBookingModal() {
        document.getElementById('bookingModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden'; // Prevent scrolling
    }
    
    // Close booking modal
    function closeBookingModal() {
        document.getElementById('bookingModal').classList.add('hidden');
        document.body.style.overflow = 'auto'; // Enable scrolling
    }
    
    // Close modal when clicking outside
    window.addEventListener('click', function(event) {
        const modal = document.getElementById('bookingModal');
        if (event.target === modal) {
            closeBookingModal();
        }
    });
    
    // Set default date to tomorrow
    document.addEventListener('DOMContentLoaded', function() {
        const dateInput = document.getElementById('booking-date');
        if (dateInput) {
            const tomorrow = new Date();
            tomorrow.setDate(tomorrow.getDate() + 1);
            const formattedDate = tomorrow.toISOString().split('T')[0];
            dateInput.setAttribute('min', formattedDate);
            dateInput.value = formattedDate;
        }
    });
</script>

<?php include(ROOT_PATH . '/includes/footer.php'); ?>
</body>
</html>
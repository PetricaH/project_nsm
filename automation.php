<?php require_once('config.php'); ?>
<?php require_once(ROOT_PATH . '/includes/heading.php'); ?>

<?php $page_css = 'automation.css';?>
<title>Business Automation Solutions | Save Time & Reduce Costs | Hreniuc Petrică</title>
<meta name="description" content="Automate your business processes and save 10+ hours weekly. Reduce costs by 30-70% with custom automation solutions built for Romanian businesses.">
</head>

<body data-context="automation">

<?php include(ROOT_PATH . '/includes/navbar.php'); ?>

<main>
    <!-- Enhanced Hero Section -->
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
            <div class="hero-badge">
                <span>Save 10+ Hours Weekly With Business Automation</span>
            </div>
            <h1>Stop Doing Tasks Your Computer Should Do</h1>
            <div class="under_h1_text_container">
                <p>Eliminate Manual Data Entry</p>
                <img src="static/images/automation_lp_imgs/arrow_left.svg" alt="Arrow">
                <p>Reduce Costs by 30-70%</p>
                <img src="static/images/automation_lp_imgs/arrow_left.svg" alt="Arrow">
                <p>Free Your Team for Value-Add Work</p>
            </div>
            
            <div class="hero-cta-group">
                <button onclick="openBookingModal()" class="primary-cta-button">Book Your Free Automation Audit <span class="arrow-right">→</span></button>
                <button onclick="scrollToElement('automation_calculator_section')" class="secondary-cta-button">Calculate Your Savings</button>
            </div>
            
            <div class="hero-proof">
                <div class="proof-item">
                    <span class="proof-number">85%</span>
                    <span class="proof-text">Reduction in Manual Tasks</span>
                </div>
                <div class="proof-divider"></div>
                <div class="proof-item">
                    <span class="proof-number">45%</span>
                    <span class="proof-text">Cost Savings</span>
                </div>
                <div class="proof-divider"></div>
                <div class="proof-item">
                    <span class="proof-number">3x</span>
                    <span class="proof-text">ROI in First Year</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Automation ROI Calculator Section -->
    <section id="automation_calculator_section" class="calculator_section">
        <div class="container">
            <div class="section-header">
                <h2>Calculate Your Automation Savings</h2>
                <div class="section-divider"></div>
                <p class="section-description">See how much time and money your business could save through strategic automation</p>
            </div>
            
            <div class="calculator-container">
                <div class="calculator-form">
                    <h3>Enter Your Information</h3>
                    
                    <div class="calculator-input-group">
                        <label for="employees">Number of employees doing repetitive tasks:</label>
                        <input type="number" id="employees" min="1" max="1000" value="3">
                    </div>
                    
                    <div class="calculator-input-group">
                        <label for="hourly-rate">Average hourly cost per employee (€):</label>
                        <input type="number" id="hourly-rate" min="10" max="200" value="20">
                    </div>
                    
                    <div class="calculator-input-group">
                        <label for="hours-weekly">Hours spent on repetitive tasks (per week):</label>
                        <input type="number" id="hours-weekly" min="1" max="40" value="10">
                    </div>
                    
                    <div class="calculator-input-group">
                        <label for="automation-percent">Percentage of tasks that can be automated:</label>
                        <div class="range-slider-container">
                            <input type="range" id="automation-percent" min="40" max="90" value="70" class="range-slider">
                            <span id="automation-percent-value">70%</span>
                        </div>
                    </div>
                    
                    <button id="calculate-roi" class="calculate-button">Calculate My Savings</button>
                </div>
                
                <div class="calculator-results" id="calculator-results">
                    <h3>Your Potential Savings</h3>
                    
                    <div class="result-card monthly">
                        <h4>Monthly Savings</h4>
                        <div class="result-value">€<span id="monthly-savings">1,680</span></div>
                        <div class="result-breakdown">Based on <span id="monthly-hours">84</span> hours saved</div>
                    </div>
                    
                    <div class="result-card yearly">
                        <h4>Yearly Savings</h4>
                        <div class="result-value">€<span id="yearly-savings">20,160</span></div>
                        <div class="result-breakdown">Based on <span id="yearly-hours">1,008</span> hours saved</div>
                    </div>
                    
                    <div class="result-card roi">
                        <h4>5-Year ROI</h4>
                        <div class="result-value"><span id="roi-multiple">25</span>x</div>
                        <div class="result-breakdown">Return on automation investment</div>
                    </div>
                    
                    <div class="results-note">
                        <p>Want to explore exactly which processes you could automate?</p>
                        <button onclick="openBookingModal()" class="results-cta">Get Your Free Automation Assessment</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content Section with Common Challenges -->
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

        <!-- Solutions Description -->
        <div class="automation_case_studies_group">
            <div class="text_part_automation_case_studies_group">
                <h2>How I Can Help Solve These <span>Problems</span></h2>
                <p>
                    I create custom automation solutions using powerful tools like Zapier, Brevo, n8n, and more. 
                    My approach focuses on identifying your business's unique needs and developing tailored solutions 
                    that seamlessly integrate with your existing systems. By automating repetitive tasks, your team 
                    can focus on high-value activities while reducing errors and costs.
                </p>
                <button onclick="openBookingModal()">Schedule a Consultation</button>
            </div>
        </div>
    </section>

    <!-- Enhanced Capabilities Section -->
    <section class="automation_capabilities_section">
        <div class="container">
            <div class="section-header">
                <h2>What Can You Automate?</h2>
                <div class="section-divider"></div>
                <p class="section-description">Discover the business processes that can be transformed through strategic automation</p>
            </div>
            
            <div class="capabilities-grid">
                <!-- Capability 1: Lead Management -->
                <div class="capability-card">
                    <div class="capability-icon">
                        <span class="material-symbols-outlined">person_add</span>
                    </div>
                    <div class="capability-content">
                        <h3>Lead Management</h3>
                        <p>Automatically capture, qualify, and route leads from your website, social media, and other channels to your CRM. Follow up with personalized emails based on lead behavior.</p>
                        
                        <div class="capability-metrics">
                            <div class="metric">
                                <span class="metric-value">68%</span>
                                <span class="metric-label">Faster Lead Response</span>
                            </div>
                            <div class="metric">
                                <span class="metric-value">37%</span>
                                <span class="metric-label">Increased Conversion</span>
                            </div>
                        </div>
                        
                        <div class="tools-used">
                            <span class="tool-tag">Brevo</span>
                            <span class="tool-tag">Zapier</span>
                            <span class="tool-tag">Make</span>
                        </div>
                    </div>
                </div>
                
                <!-- Capability 2: Order Processing -->
                <div class="capability-card">
                    <div class="capability-icon">
                        <span class="material-symbols-outlined">shopping_cart</span>
                    </div>
                    <div class="capability-content">
                        <h3>Order Processing</h3>
                        <p>Automate inventory updates, order confirmations, shipping notifications, and invoice creation. Connect your e-commerce platform with accounting and fulfillment systems.</p>
                        
                        <div class="capability-metrics">
                            <div class="metric">
                                <span class="metric-value">75%</span>
                                <span class="metric-label">Less Processing Time</span>
                            </div>
                            <div class="metric">
                                <span class="metric-value">93%</span>
                                <span class="metric-label">Fewer Errors</span>
                            </div>
                        </div>
                        
                        <div class="tools-used">
                            <span class="tool-tag">n8n</span>
                            <span class="tool-tag">Make</span>
                            <span class="tool-tag">Zapier</span>
                        </div>
                    </div>
                </div>
                
                <!-- Capability 3: Document Processing -->
                <div class="capability-card">
                    <div class="capability-icon">
                        <span class="material-symbols-outlined">description</span>
                    </div>
                    <div class="capability-content">
                        <h3>Document Processing</h3>
                        <p>Extract data from emails, PDFs, and other documents and route it to the right systems. Automatically generate contracts, proposals, and reports based on templates.</p>
                        
                        <div class="capability-metrics">
                            <div class="metric">
                                <span class="metric-value">85%</span>
                                <span class="metric-label">Data Entry Reduction</span>
                            </div>
                            <div class="metric">
                                <span class="metric-value">67%</span>
                                <span class="metric-label">Faster Document Creation</span>
                            </div>
                        </div>
                        
                        <div class="tools-used">
                            <span class="tool-tag">Zapier</span>
                            <span class="tool-tag">Make</span>
                            <span class="tool-tag">Docusign</span>
                        </div>
                    </div>
                </div>
                
                <!-- Capability 4: Customer Support -->
                <div class="capability-card">
                    <div class="capability-icon">
                        <span class="material-symbols-outlined">support_agent</span>
                    </div>
                    <div class="capability-content">
                        <h3>Customer Support</h3>
                        <p>Route support requests to the right team members, send automatic responses to common questions, and follow up on resolved tickets with satisfaction surveys.</p>
                        
                        <div class="capability-metrics">
                            <div class="metric">
                                <span class="metric-value">42%</span>
                                <span class="metric-label">Faster Resolution Time</span>
                            </div>
                            <div class="metric">
                                <span class="metric-value">24%</span>
                                <span class="metric-label">Higher Satisfaction</span>
                            </div>
                        </div>
                        
                        <div class="tools-used">
                            <span class="tool-tag">Brevo</span>
                            <span class="tool-tag">n8n</span>
                            <span class="tool-tag">Make</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="capabilities-cta">
                <p>Wondering which processes in your business can be automated?</p>
                <button onclick="openBookingModal()" class="capabilities-button">Book Your Free Automation Assessment</button>
            </div>
        </div>
    </section>

    <!-- Enhanced Case Study Section -->
    <section class="automation_case_study_section">
        <div class="container">
            <div class="section-header">
                <h2>Automation Success Story</h2>
                <div class="section-divider"></div>
                <p class="section-description">A real-world example of how business automation transformed operations</p>
            </div>
            
            <div class="featured-case-study">
                <div class="case-study-header">
                    <div class="case-study-badge">Marketing Automation</div>
                    <h3>How a B2B Service Provider Increased Lead Quality by 45% While Reducing Manual Work</h3>
                </div>
                
                <div class="case-study-content">
                    <div class="case-study-challenge">
                        <h4>The Challenge</h4>
                        <p>A B2B service provider was struggling with their lead management process. Their marketing team was spending 15+ hours weekly manually transferring leads from website forms to their CRM, sending follow-up emails, and updating lead statuses. This manual process resulted in:</p>
                        <ul class="challenge-list">
                            <li>Slow response times to new leads (24+ hours)</li>
                            <li>Inconsistent follow-up sequences</li>
                            <li>Leads falling through the cracks</li>
                            <li>Marketing team unable to focus on strategic activities</li>
                            <li>No visibility into lead behavior after initial contact</li>
                        </ul>
                    </div>
                    
                    <div class="case-study-solution">
                        <h4>The Solution</h4>
                        <p>I developed a comprehensive lead nurturing automation system using Brevo and Zapier that:</p>
                        
                        <div class="solution-steps">
                            <div class="solution-step">
                                <div class="step-number">1</div>
                                <div class="step-content">
                                    <h5>Web Form Integration</h5>
                                    <p>Connected website forms directly to Brevo, capturing all lead information in real-time.</p>
                                </div>
                            </div>
                            
                            <div class="solution-step">
                                <div class="step-number">2</div>
                                <div class="step-content">
                                    <h5>Automated Lead Scoring</h5>
                                    <p>Created a system that automatically scored leads based on industry, company size, and expressed needs.</p>
                                </div>
                            </div>
                            
                            <div class="solution-step">
                                <div class="step-number">3</div>
                                <div class="step-content">
                                    <h5>Personalized Nurture Sequences</h5>
                                    <p>Developed different email sequences triggered by lead score and initial inquiry type.</p>
                                </div>
                            </div>
                            
                            <div class="solution-step">
                                <div class="step-number">4</div>
                                <div class="step-content">
                                    <h5>CRM Integration</h5>
                                    <p>Synced all lead data and interactions with their CRM system for sales team visibility.</p>
                                </div>
                            </div>
                            
                            <div class="solution-step">
                                <div class="step-number">5</div>
                                <div class="step-content">
                                    <h5>Behavior-Based Alerts</h5>
                                    <p>Created instant notifications for the sales team when leads showed high buying intent.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="case-study-results">
                        <h4>The Results</h4>
                        
                        <div class="results-metrics">
                            <div class="result-metric">
                                <span class="result-value">45%</span>
                                <span class="result-label">Increase in Qualified Leads</span>
                                <p class="result-description">Better targeting and nurturing improved lead quality</p>
                            </div>
                            
                            <div class="result-metric">
                                <span class="result-value">93%</span>
                                <span class="result-label">Faster Response Time</span>
                                <p class="result-description">From 24+ hours to under 2 hours</p>
                            </div>
                            
                            <div class="result-metric">
                                <span class="result-value">15hrs</span>
                                <span class="result-label">Weekly Time Saved</span>
                                <p class="result-description">Marketing team redirected to strategic work</p>
                            </div>
                            
                            <div class="result-metric">
                                <span class="result-value">28%</span>
                                <span class="result-label">Higher Conversion Rate</span>
                                <p class="result-description">From initial lead to sales conversation</p>
                            </div>
                        </div>
                        
                        <div class="client-quote">
                            <p>"The automation system has completely transformed how we handle leads. Our marketing team is now focused on creating campaigns instead of manual data entry, and our sales team has much better visibility into lead behavior. The ROI has been remarkable."</p>
                            <div class="quote-author">— Marketing Director</div>
                        </div>
                    </div>
                    
                    <div class="case-study-tools">
                        <h4>Tools Used</h4>
                        <div class="tools-list">
                            <div class="tool-item">
                                <img src="static/images/automation_programs_logos/Brevo-Logo-1.svg" alt="Brevo">
                                <span>Brevo</span>
                            </div>
                            <div class="tool-item">
                                <img src="static/images/automation_programs_logos/zapier.svg" alt="Zapier">
                                <span>Zapier</span>
                            </div>
                            <div class="tool-item">
                                <img src="static/images/automation_programs_logos/Make-Logo-RGB.svg" alt="Make">
                                <span>Make</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="case-study-cta">
                    <p>Want to see similar results for your business?</p>
                    <button onclick="openBookingModal()" class="case-study-button">Schedule Your Free Automation Assessment</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Automation Lead Magnet Section -->
    <section class="automation_lead_magnet_section">
        <div class="container">
            <div class="lead-magnet-container">
                <div class="lead-magnet-content">
                    <div class="lead-magnet-badge">FREE CHECKLIST</div>
                    <h2>27-Point Automation Opportunity Finder</h2>
                    <p>Discover which processes in your business are costing you the most time and money, and how they can be automated for maximum ROI.</p>
                    
                    <ul class="checklist-features">
                        <li><span class="check-icon">✓</span> Identify your highest-impact automation opportunities</li>
                        <li><span class="check-icon">✓</span> Calculate potential time and cost savings</li>
                        <li><span class="check-icon">✓</span> Learn which tools are best for different processes</li>
                        <li><span class="check-icon">✓</span> Create your automation roadmap in order of priority</li>
                    </ul>
                    
                    <div class="checklist-testimonial">
                        <p>"This checklist helped us identify over €12,000 in annual savings from just automating our invoicing process. Worth its weight in gold."</p>
                        <div class="testimonial-author">— Operations Manager at a Romanian SMB</div>
                    </div>
                </div>
                
                <div class="lead-magnet-form">
                    <div class="checklist-preview">
                        <img src="static/images/resources/automation-checklist-preview.png" alt="Automation Opportunity Finder Checklist">
                    </div>
                    
                    <form id="checklistForm" action="includes/download_resource.php" method="POST">
                        <input type="hidden" name="resource_type" value="automation-checklist">
                        
                        <div class="form-group">
                            <label for="checklist-name">Your Name</label>
                            <input type="text" id="checklist-name" name="name" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="checklist-email">Email to Send Checklist</label>
                            <input type="email" id="checklist-email" name="email" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="checklist-company">Company</label>
                            <input type="text" id="checklist-company" name="company">
                        </div>
                        
                        <div class="form-group">
                            <label for="checklist-interest">What process are you most interested in automating?</label>
                            <select id="checklist-interest" name="interest">
                                <option value="lead-management">Lead Management</option>
                                <option value="order-processing">Order Processing</option>
                                <option value="document-handling">Document Handling</option>
                                <option value="customer-support">Customer Support</option>
                                <option value="reporting">Reporting & Analytics</option>
                                <option value="other">Other (Please Specify)</option>
                            </select>
                        </div>
                        
                        <div class="form-group other-container" style="display: none;">
                            <label for="checklist-other">Please specify:</label>
                            <input type="text" id="checklist-other" name="other_interest">
                        </div>
                        
                        <div class="form-checkbox">
                            <input type="checkbox" id="checklist-consent" name="consent" required>
                            <label for="checklist-consent">I agree to receive the checklist and occasional automation tips</label>
                        </div>
                        
                        <button type="submit" class="checklist-submit">Download Free Checklist <span class="arrow-right">→</span></button>
                    </form>
                    
                    <div class="downloads-count">
                        <span class="material-symbols-outlined">download</span>
                        <p>Downloaded by 315 business professionals</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<!-- Enhanced Booking Modal -->
<div id="bookingModal" class="booking-modal hidden">
    <div class="booking-modal-content">
        <button class="modal-close" onclick="closeBookingModal()">
            <span>&times;</span>
        </button>
        
        <div class="modal-header">
            <h2>Book Your Free Automation Assessment</h2>
            <p>Schedule a 30-minute consultation to identify your best automation opportunities (<strong>€150 value</strong>)</p>
        </div>
        
        <div class="booking-columns">
            <div class="booking-form-column">
                <form id="bookingForm" action="includes/submit_booking.php" method="POST">
                    <input type="hidden" id="booking-service-type" name="service_type" value="Automation">
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="booking-name">Full Name</label>
                            <input type="text" id="booking-name" name="name" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="booking-email">Business Email</label>
                            <input type="email" id="booking-email" name="email" required>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="booking-company">Company Name</label>
                            <input type="text" id="booking-company" name="company">
                        </div>
                        
                        <div class="form-group">
                            <label for="booking-phone">Phone Number</label>
                            <input type="tel" id="booking-phone" name="phone" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="booking-service">Area of Interest</label>
                        <select id="booking-service" name="service" required>
                            <option value="Automation" selected>Business Automation</option>
                            <option value="Marketing Automation">Marketing Automation</option>
                            <option value="E-commerce Automation">E-commerce Automation</option>
                            <option value="Document Automation">Document Automation</option>
                            <option value="Customer Support Automation">Customer Support Automation</option>
                        </select>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="booking-date">Preferred Date</label>
                            <input type="date" id="booking-date" name="date" required>
                        </div>
                        
                        <div class="form-group">
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
                    
                    <div class="form-group">
                        <label for="booking-description">What processes would you like to automate?</label>
                        <textarea id="booking-description" name="description" rows="4" placeholder="Please describe the manual processes in your business that you'd like to automate..." required></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="booking-team-size">How many people are involved in these processes?</label>
                        <select id="booking-team-size" name="team_size" required>
                            <option value="1-5">1-5 people</option>
                            <option value="6-15">6-15 people</option>
                            <option value="16-50">16-50 people</option>
                            <option value="51+">51+ people</option>
                        </select>
                    </div>
                    
                    <div class="form-checkbox">
                        <input type="checkbox" id="privacy-policy" name="privacy_policy" required>
                        <label for="privacy-policy">
                            I agree to the <a href="privacy-policy.php" target="_blank">privacy policy</a> and consent to being contacted about this request.
                        </label>
                    </div>
                    
                    <div class="form-submit">
                        <button type="submit" class="booking-submit-btn">Confirm Booking</button>
                    </div>
                </form>
            </div>
            
            <div class="booking-info-column">
                <div class="session-includes">
                    <h3>Your Free Assessment Includes:</h3>
                    <ul>
                        <li><span class="check-icon">✓</span> 30-minute video consultation</li>
                        <li><span class="check-icon">✓</span> Review of your current processes</li>
                        <li><span class="check-icon">✓</span> Identification of automation opportunities</li>
                        <li><span class="check-icon">✓</span> Tool recommendations</li>
                        <li><span class="check-icon">✓</span> Estimated time & cost savings</li>
                    </ul>
                </div>
                
                <div class="booking-testimonial">
                    <p>"The automation assessment was eye-opening. Petrică quickly identified several processes we could automate that we hadn't even considered. His recommendations helped us save over 20 hours of work per week."</p>
                    <div class="booking-testimonial-author">
                        <span>Marketing Manager at a Romanian B2B Company</span>
                    </div>
                </div>
                
                <div class="spots-remaining">
                    <div class="spots-icon">
                        <span class="material-symbols-outlined">schedule</span>
                    </div>
                    <div class="spots-text">
                        <p><strong>Only 3 spots remaining this week</strong></p>
                        <p>Next available: <?php echo date('l, F j', strtotime('+2 days')); ?></p>
                    </div>
                </div>
                
                <div class="satisfaction-guarantee">
                    <div class="guarantee-icon">
                        <span class="material-symbols-outlined">verified</span>
                    </div>
                    <div class="guarantee-text">
                        <h3>No-Obligation Guarantee</h3>
                        <p>If you don't receive at least 3 viable automation ideas during our session, I'll send you a €50 gift card as an apology for your time.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Notification Area -->
<div id="notification" class="hidden">
    <p id="notification-message"></p>
</div>

<!-- JavaScript -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Booking modal functions
        function openBookingModal(service = '') {
            const modal = document.getElementById('bookingModal');
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden'; // Prevent scrolling
            
            // Pre-select service if provided
            if (service) {
                const serviceSelect = document.getElementById('booking-service');
                for (let i = 0; i < serviceSelect.options.length; i++) {
                    if (serviceSelect.options[i].value === service) {
                        serviceSelect.selectedIndex = i;
                        break;
                    }
                }
                
                // Also set the hidden input
                document.getElementById('booking-service-type').value = service;
            }
        }
        
        function closeBookingModal() {
            document.getElementById('bookingModal').classList.add('hidden');
            document.body.style.overflow = 'auto'; // Enable scrolling
        }
        
        // Set default date to tomorrow for booking form
        const dateInput = document.getElementById('booking-date');
        if (dateInput) {
            const tomorrow = new Date();
            tomorrow.setDate(tomorrow.getDate() + 2); // Start from day after tomorrow
            const formattedDate = tomorrow.toISOString().split('T')[0];
            dateInput.setAttribute('min', formattedDate);
            dateInput.value = formattedDate;
        }
        
        // ROI Calculator
        // Update automation percentage value when slider moves
        const automationSlider = document.getElementById('automation-percent');
        const automationValue = document.getElementById('automation-percent-value');
        
        if (automationSlider && automationValue) {
            automationSlider.addEventListener('input', function() {
                automationValue.textContent = this.value + '%';
                calculateSavings();
            });
            
            // Calculate when the calculate button is clicked
            document.getElementById('calculate-roi').addEventListener('click', calculateSavings);
            
            // Also calculate when any input changes
            document.getElementById('employees').addEventListener('input', calculateSavings);
            document.getElementById('hourly-rate').addEventListener('input', calculateSavings);
            document.getElementById('hours-weekly').addEventListener('input', calculateSavings);
            
            // Initial calculation
            calculateSavings();
        }
        
        function calculateSavings() {
            // Get input values
            const employees = parseInt(document.getElementById('employees').value) || 1;
            const hourlyRate = parseInt(document.getElementById('hourly-rate').value) || 20;
            const hoursWeekly = parseInt(document.getElementById('hours-weekly').value) || 10;
            const automationPercent = parseInt(document.getElementById('automation-percent').value) || 70;
            
            // Calculate savings
            const weeklyHoursSaved = employees * hoursWeekly * (automationPercent / 100);
            const monthlyHoursSaved = weeklyHoursSaved * 4;
            const yearlyHoursSaved = weeklyHoursSaved * 48; // Accounting for holidays
            
            const monthlySavings = monthlyHoursSaved * hourlyRate;
            const yearlySavings = yearlyHoursSaved * hourlyRate;
            
            // Estimate ROI (assuming average automation solution costs around €4,000)
            const automationCost = 4000;
            const fiveYearSavings = yearlySavings * 5;
            const roiMultiple = Math.round(fiveYearSavings / automationCost);
            
            // Update results
            document.getElementById('monthly-savings').textContent = monthlySavings.toLocaleString();
            document.getElementById('yearly-savings').textContent = yearlySavings.toLocaleString();
            document.getElementById('monthly-hours').textContent = Math.round(monthlyHoursSaved).toLocaleString();
            document.getElementById('yearly-hours').textContent = Math.round(yearlyHoursSaved).toLocaleString();
            document.getElementById('roi-multiple').textContent = roiMultiple;
            
            // Show results with animation
            const resultsContainer = document.getElementById('calculator-results');
            resultsContainer.style.opacity = '0';
            setTimeout(() => {
                resultsContainer.style.opacity = '1';
            }, 300);
        }
        
        // Checklist form - show/hide the "other" field based on selection
        const interestSelect = document.getElementById('checklist-interest');
        const otherContainer = document.querySelector('.other-container');
        
        if (interestSelect && otherContainer) {
            interestSelect.addEventListener('change', function() {
                if (this.value === 'other') {
                    otherContainer.style.display = 'block';
                } else {
                    otherContainer.style.display = 'none';
                }
            });
        }
        
        // Smooth scroll function
        function scrollToElement(elementId) {
            const element = document.getElementById(elementId);
            if (element) {
                element.scrollIntoView({ behavior: 'smooth' });
            }
        }
        
        // Close modal when clicking outside
        window.addEventListener('click', function(event) {
            const modal = document.getElementById('bookingModal');
            if (event.target === modal) {
                closeBookingModal();
            }
        });
        
        // Expose functions globally
        window.openBookingModal = openBookingModal;
        window.closeBookingModal = closeBookingModal;
        window.scrollToElement = scrollToElement;
        window.calculateSavings = calculateSavings;
    });
</script>

<?php include(ROOT_PATH . '/includes/footer.php'); ?>
</body>
</html>
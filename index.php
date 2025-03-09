<?php require_once('config.php'); ?>
<?php require_once(ROOT_PATH . '/includes/heading.php'); ?>
<?php $page_css = 'home.css';?>
<title>Hreniuc Petrică | Web Development & Automation Services</title>
</head>
<body>
    <?php include(ROOT_PATH . '/includes/navbar.php'); ?>

    <!-- Hero Section -->
    <section id="hero_section">
        <div class="hero-container">
            <div class="hero-content">
                <div class="hero-text-content">
                    <h1 class="hero-title">Technical solutions for<br>growing businesses</h1>
                    <div class="hero-divider"></div>
                    <p class="hero-description">I develop custom websites and automation systems that help Romanian businesses operate more efficiently and effectively.</p>
                    
                    <div class="hero-expertise">
                        <div class="expertise-item">
                            <span class="expertise-number">01</span>
                            <div class="expertise-text">
                                <h3>Web Development</h3>
                                <p>Custom websites optimized for performance and conversions</p>
                            </div>
                        </div>
                        <div class="expertise-item">
                            <span class="expertise-number">02</span>
                            <div class="expertise-text">
                                <h3>Business Automation</h3>
                                <p>Streamlined workflows to eliminate repetitive tasks</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="hero-cta">
                        <button onclick="openBookingModal()" class="cta-button">Schedule Consultation</button>
                        <a href="#services_section" class="text-link">View Services</a>
                    </div>
                </div>
                
                <div class="hero-identity">
                    <div class="identity-container">
                        <div class="portrait-container">
                            <img src="static/images/me-close-up.png" alt="Hreniuc Petrica" class="portrait-image">
                        </div>
                        <div class="identity-text">
                            <h2 class="identity-name">Hreniuc Petrică</h2>
                            <p class="identity-role">Web Developer & Automation Specialist<br><span>Founder, NOTSOMARKETING</span></p>
                        </div>
                    </div>
                    
                    <div class="clients-section">
                        <p class="clients-label">Working with businesses across Romania</p>
                        <div class="tech-logos-small">
                            <img src="static/images/programming_techs_logos/php-alt.svg" alt="PHP">
                            <img src="static/images/programming_techs_logos/javascript.svg" alt="JavaScript">
                            <img src="static/images/automation_programs_logos/Brevo-Logo-1.svg" alt="Brevo">
                            <img src="static/images/automation_programs_logos/zapier.svg" alt="Zapier">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="scroll-indicator">
            <span>Scroll</span>
            <i class="fas fa-chevron-down"></i>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services_section">
        <div class="container">
            <div class="section-header">
                <h2>Services</h2>
                <div class="section-divider"></div>
                <p class="section-description">Comprehensive web development and automation solutions tailored to your business needs</p>
            </div>
            
            <div class="services-grid">
                <div class="service-column">
                    <div class="service-category">
                        <span class="category-number">01</span>
                        <h3>Web Development</h3>
                    </div>
                    
                    <div class="service-list">
                        <div class="service-item">
                            <h4>E-commerce Solutions</h4>
                            <p>Custom online stores with secure payment processing, inventory management, and optimized user experience</p>
                        </div>
                        
                        <div class="service-item">
                            <h4>Business Websites</h4>
                            <p>Professional web presence for small and medium companies with content management systems</p>
                        </div>
                        
                        <div class="service-item">
                            <h4>Administrative Interfaces</h4>
                            <p>Custom dashboards and management systems to streamline your business operations</p>
                        </div>
                        
                        <div class="service-item">
                            <h4>Performance Optimization</h4>
                            <p>SEO and speed improvements for existing websites to enhance search rankings and user engagement</p>
                        </div>
                    </div>
                </div>
                
                <div class="service-column">
                    <div class="service-category">
                        <span class="category-number">02</span>
                        <h3>Business Automation</h3>
                    </div>
                    
                    <div class="service-list">
                        <div class="service-item">
                            <h4>Marketing Automation</h4>
                            <p>Email marketing and customer journey automation using Brevo to nurture leads and drive conversions</p>
                        </div>
                        
                        <div class="service-item">
                            <h4>Workflow Integration</h4>
                            <p>Connect various business tools and create efficient processes with Make and n8n</p>
                        </div>
                        
                        <div class="service-item">
                            <h4>API Integration</h4>
                            <p>Connect your existing software tools using Zapier to eliminate manual data transfer</p>
                        </div>
                        
                        <div class="service-item">
                            <h4>Order Processing</h4>
                            <p>Automate your purchase-to-delivery workflows to reduce errors and save time</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Process Section -->
    <section id="process_section">
        <div class="container">
            <div class="section-header">
                <h2>Work Process</h2>
                <div class="section-divider"></div>
                <p class="section-description">A structured approach that ensures quality results for every project</p>
            </div>
            
            <div class="process-timeline">
                <div class="timeline-item">
                    <div class="timeline-number">01</div>
                    <div class="timeline-content">
                        <h3>Consultation</h3>
                        <p>In-depth discovery of your business needs, goals, and current challenges to establish project parameters</p>
                    </div>
                </div>
                
                <div class="timeline-item">
                    <div class="timeline-number">02</div>
                    <div class="timeline-content">
                        <h3>Strategy</h3>
                        <p>Developing a comprehensive plan with solutions tailored specifically to your business requirements</p>
                    </div>
                </div>
                
                <div class="timeline-item">
                    <div class="timeline-number">03</div>
                    <div class="timeline-content">
                        <h3>Implementation</h3>
                        <p>Execution of the strategy with regular updates and transparent communication throughout the process</p>
                    </div>
                </div>
                
                <div class="timeline-item">
                    <div class="timeline-number">04</div>
                    <div class="timeline-content">
                        <h3>Support</h3>
                        <p>Ongoing assistance, training, and maintenance to ensure long-term success of your digital solutions</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Technology Section -->
    <section id="technology_section">
        <div class="container">
            <div class="section-header">
                <h2>Technology Stack</h2>
                <div class="section-divider"></div>
                <p class="section-description">Professional tools and platforms that power your digital solutions</p>
            </div>
            
            <div class="tech-categories">
                <div class="tech-category">
                    <h3>Frontend Development</h3>
                    <div class="tech-grid">
                        <div class="tech-item">
                            <img src="static/images/programming_techs_logos/html-5.svg" alt="HTML5">
                            <span>HTML5</span>
                        </div>
                        <div class="tech-item">
                            <img src="static/images/programming_techs_logos/css-3.svg" alt="CSS3">
                            <span>CSS3</span>
                        </div>
                        <div class="tech-item">
                            <img src="static/images/programming_techs_logos/javascript.svg" alt="JavaScript">
                            <span>JavaScript</span>
                        </div>
                        <div class="tech-item">
                            <img src="static/images/programming_techs_logos/vue.svg" alt="Vue.js">
                            <span>Vue.js</span>
                        </div>
                        <div class="tech-item">
                            <img src="static/images/programming_techs_logos/vite.svg" alt="Vite">
                            <span>Vite</span>
                        </div>
                    </div>
                </div>
                
                <div class="tech-category">
                    <h3>Backend Development</h3>
                    <div class="tech-grid">
                        <div class="tech-item">
                            <img src="static/images/programming_techs_logos/php-alt.svg" alt="PHP">
                            <span>PHP</span>
                        </div>
                        <div class="tech-item">
                            <img src="static/images/programming_techs_logos/laravel.svg" alt="Laravel">
                            <span>Laravel</span>
                        </div>
                        <div class="tech-item">
                            <img src="static/images/programming_techs_logos/mysql.svg" alt="MySQL">
                            <span>MySQL</span>
                        </div>
                    </div>
                </div>
                
                <div class="tech-category">
                    <h3>DevOps & Infrastructure</h3>
                    <div class="tech-grid">
                        <div class="tech-item">
                            <img src="static/images/programming_techs_logos/git-icon.svg" alt="Git">
                            <span>Git</span>
                        </div>
                        <div class="tech-item">
                            <img src="static/images/programming_techs_logos/github.svg" alt="GitHub">
                            <span>GitHub</span>
                        </div>
                        <div class="tech-item">
                            <img src="static/images/programming_techs_logos/nginx.svg" alt="Nginx">
                            <span>Nginx</span>
                        </div>
                        <div class="tech-item">
                            <img src="static/images/programming_techs_logos/apache.svg" alt="Apache">
                            <span>Apache</span>
                        </div>
                    </div>
                </div>
                
                <div class="tech-category">
                    <h3>Automation Platforms</h3>
                    <div class="tech-grid">
                        <div class="tech-item">
                            <img src="static/images/automation_programs_logos/Brevo-Logo-1.svg" alt="Brevo">
                            <span>Brevo</span>
                        </div>
                        <div class="tech-item">
                            <img src="static/images/automation_programs_logos/Make-Logo-RGB.svg" alt="Make">
                            <span>Make</span>
                        </div>
                        <div class="tech-item">
                            <img src="static/images/automation_programs_logos/n8n_io.svg" alt="n8n">
                            <span>n8n</span>
                        </div>
                        <div class="tech-item">
                            <img src="static/images/automation_programs_logos/zapier.svg" alt="Zapier">
                            <span>Zapier</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Case Study Section -->
    <section id="case_study_section">
        <div class="container">
            <div class="section-header">
                <h2>Case Studies</h2>
                <div class="section-divider"></div>
                <p class="section-description">Real-world applications of web development and automation technologies</p>
            </div>
            
            <!-- Case Study Navigation -->
            <div class="case-study-nav">
                <button class="case-nav-btn active" data-study="ecommerce">E-Commerce Solution</button>
                <button class="case-nav-btn" data-study="samples">Sample Distribution Automation</button>
            </div>
            
            <!-- Case Study 1: E-Commerce Solution -->
            <div class="case-study-container active" id="ecommerce-case">
                <div class="case-overview">
                    <div class="case-header">
                        <span class="case-label">Web Development + Automation</span>
                        <h3>E-Commerce with Verification Workflow</h3>
                    </div>
                    
                    <div class="case-challenge">
                        <h4>Challenge</h4>
                        <p>A Romanian distribution company needed an e-commerce platform that would qualify leads, verify business identity, and streamline the product inquiry process for samples and technical information.</p>
                    </div>
                </div>
                
                <div class="case-details">
                    <div class="solution-column">
                        <h4>Solution</h4>
                        <div class="solution-workflow">
                            <div class="workflow-step">
                                <span class="step-number">01</span>
                                <div class="step-content">
                                    <h5>CUI Verification System</h5>
                                    <p>Built a custom verification system that checks the Romanian company ID (CUI) against an existing customer database.</p>
                                </div>
                            </div>
                            
                            <div class="workflow-step">
                                <span class="step-number">02</span>
                                <div class="step-content">
                                    <h5>Dual-Path Workflow</h5>
                                    <p>Existing clients are immediately directed to an expedited request form, while new contacts undergo verification via Brevo's API before proceeding.</p>
                                </div>
                            </div>
                            
                            <div class="workflow-step">
                                <span class="step-number">03</span>
                                <div class="step-content">
                                    <h5>Request Management System</h5>
                                    <p>Created a system that handles various request types (offers, technical files, samples) with different automation workflows for each.</p>
                                </div>
                            </div>
                            
                            <div class="workflow-step">
                                <span class="step-number">04</span>
                                <div class="step-content">
                                    <h5>Staff Notification</h5>
                                    <p>Automated alerts notify staff of new requests, with contextual information about the client and their inquiry.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="diagram-column">
                        <div class="diagram-container">
                            <svg width="100%" height="320" viewBox="0 0 600 320" xmlns="http://www.w3.org/2000/svg">
                                <style>
                                    .node { fill: rgba(70, 130, 180, 0.1); stroke: rgba(70, 130, 180, 0.3); stroke-width: 1; }
                                    .arrow { stroke: rgba(70, 130, 180, 0.5); stroke-width: 1.5; }
                                    .text { fill: #AAAAAA; font-family: sans-serif; font-size: 12px; text-anchor: middle; }
                                    .title { fill: #FFFFFF; font-family: sans-serif; font-size: 14px; font-weight: bold; text-anchor: middle; }
                                </style>
                                
                                <!-- Website Node -->
                                <rect class="node" x="50" y="70" width="120" height="60" rx="2" />
                                <text class="title" x="110" y="95">Website</text>
                                <text class="text" x="110" y="115">CUI Verification</text>
                                
                                <!-- Arrow 1 -->
                                <line class="arrow" x1="170" y1="100" x2="220" y2="100" />
                                <polygon points="220,95 230,100 220,105" fill="rgba(70, 130, 180, 0.5)" />
                                
                                <!-- Verification Node -->
                                <rect class="node" x="230" y="70" width="120" height="60" rx="2" />
                                <text class="title" x="290" y="95">Verification</text>
                                <text class="text" x="290" y="115">Database Check</text>
                                
                                <!-- Arrow 2 -->
                                <line class="arrow" x1="350" y1="100" x2="400" y2="100" />
                                <polygon points="400,95 410,100 400,105" fill="rgba(70, 130, 180, 0.5)" />
                                
                                <!-- Request Node -->
                                <rect class="node" x="410" y="70" width="140" height="60" rx="2" />
                                <text class="title" x="480" y="95">Request System</text>
                                <text class="text" x="480" y="115">Products/Technical</text>
                                
                                <!-- Arrow Down -->
                                <line class="arrow" x1="470" y1="130" x2="470" y2="170" />
                                <polygon points="465,170 470,180 475,170" fill="rgba(70, 130, 180, 0.5)" />
                                
                                <!-- Staff Node -->
                                <rect class="node" x="410" y="180" width="120" height="60" rx="2" />
                                <text class="title" x="470" y="205">Staff</text>
                                <text class="text" x="470" y="225">Notification</text>
                                
                                <!-- Connected Systems -->
                                <rect class="node" x="50" y="180" width="120" height="60" rx="2" />
                                <text class="title" x="110" y="205">Brevo API</text>
                                <text class="text" x="110" y="225">Email Verification</text>
                                
                                <rect class="node" x="230" y="180" width="120" height="60" rx="2" />
                                <text class="title" x="290" y="205">Database</text>
                                <text class="text" x="290" y="225">Client Records</text>
                                
                                <!-- Connection Lines -->
                                <line class="arrow" x1="110" y1="180" x2="110" y2="140" />
                                <line class="arrow" x1="110" y1="140" x2="290" y2="140" />
                                <line class="arrow" x1="290" y1="140" x2="290" y2="180" />
                                
                                <line class="arrow" x1="290" y1="180" x2="290" y2="150" />
                                <line class="arrow" x1="290" y1="150" x2="470" y2="150" />
                            </svg>
                        </div>
                    </div>
                </div>
                
                <div class="case-results-container">
                    <div class="tech-used">
                        <h4>Technologies Used</h4>
                        <div class="tech-pills">
                            <span class="tech-pill">PHP</span>
                            <span class="tech-pill">MySQL</span>
                            <span class="tech-pill">JavaScript</span>
                            <span class="tech-pill">Brevo API</span>
                            <span class="tech-pill">Zapier</span>
                        </div>
                    </div>
                    
                    <div class="case-results">
                        <h4>Results</h4>
                        <div class="result-metrics">
                            <div class="result-metric">
                                <span class="metric-value">65%</span>
                                <span class="metric-label">Reduction in manual verification time</span>
                            </div>
                            <div class="result-metric">
                                <span class="metric-value">40%</span>
                                <span class="metric-label">Increase in qualified leads</span>
                            </div>
                            <div class="result-metric">
                                <span class="metric-value">90%</span>
                                <span class="metric-label">Faster response to client inquiries</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Case Study 2: Sample Distribution Automation -->
            <div class="case-study-container" id="samples-case">
                <div class="case-overview">
                    <div class="case-header">
                        <span class="case-label">Multi-platform Automation</span>
                        <h3>Product Samples Distribution System</h3>
                    </div>
                    
                    <div class="case-challenge">
                        <h4>Challenge</h4>
                        <p>A manufacturing company was struggling with their manual product sample distribution process, which was time-consuming, prone to errors, and lacked proper tracking and follow-up mechanisms.</p>
                    </div>
                </div>
                
                <div class="case-details">
                    <div class="solution-column">
                        <h4>Solution</h4>
                        <div class="solution-workflow">
                            <div class="workflow-step">
                                <span class="step-number">01</span>
                                <div class="step-content">
                                    <h5>Digital Request Portal</h5>
                                    <p>Created a form-based portal for sales agents to submit sample requests, capturing all necessary client and product information.</p>
                                </div>
                            </div>
                            
                            <div class="workflow-step">
                                <span class="step-number">02</span>
                                <div class="step-content">
                                    <h5>Multi-channel Communication</h5>
                                    <p>Implemented Zapier workflows that trigger both email and WhatsApp messages via Messaggio API, ensuring clients receive notifications through their preferred channels.</p>
                                </div>
                            </div>
                            
                            <div class="workflow-step">
                                <span class="step-number">03</span>
                                <div class="step-content">
                                    <h5>Response Tracking System</h5>
                                    <p>Developed a webhook system that captures client responses and triggers the next steps in the automation workflow.</p>
                                </div>
                            </div>
                            
                            <div class="workflow-step">
                                <span class="step-number">04</span>
                                <div class="step-content">
                                    <h5>Document Delivery & Staff Notifications</h5>
                                    <p>Automated the delivery of technical files to clients and simultaneously notified staff to prepare physical samples for shipping.</p>
                                </div>
                            </div>
                            
                            <div class="workflow-step">
                                <span class="step-number">05</span>
                                <div class="step-content">
                                    <h5>Marketing Integration</h5>
                                    <p>Connected the system with Brevo's email marketing platform to automatically add responsive clients to targeted marketing campaigns.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="diagram-column">
                        <div class="diagram-container">
                            <svg width="100%" height="400" viewBox="0 0 660 400" xmlns="http://www.w3.org/2000/svg">
                                <style>
                                    .node { fill: rgba(70, 130, 180, 0.1); stroke: rgba(70, 130, 180, 0.3); stroke-width: 1; }
                                    .arrow { stroke: rgba(70, 130, 180, 0.5); stroke-width: 1.5; }
                                    .text { fill: #AAAAAA; font-family: sans-serif; font-size: 12px; text-anchor: middle; }
                                    .title { fill: #FFFFFF; font-family: sans-serif; font-size: 14px; font-weight: bold; text-anchor: middle; }
                                </style>
                                
                                <!-- Form Node -->
                                <rect class="node" x="50" y="50" width="120" height="60" rx="2" />
                                <text class="title" x="110" y="75">Request Form</text>
                                <text class="text" x="110" y="95">Sales Agent</text>
                                
                                <!-- Arrow 1 -->
                                <line class="arrow" x1="170" y1="80" x2="220" y2="80" />
                                <polygon points="220,75 230,80 220,85" fill="rgba(70, 130, 180, 0.5)" />
                                
                                <!-- Database Node -->
                                <rect class="node" x="230" y="50" width="120" height="60" rx="2" />
                                <text class="title" x="290" y="75">Database</text>
                                <text class="text" x="290" y="95">Request Storage</text>
                                
                                <!-- Arrow 2 -->
                                <line class="arrow" x1="350" y1="80" x2="400" y2="80" />
                                <polygon points="400,75 410,80 400,85" fill="rgba(70, 130, 180, 0.5)" />
                                
                                <!-- Zapier Node -->
                                <rect class="node" x="410" y="50" width="120" height="60" rx="2" />
                                <text class="title" x="470" y="75">Zapier</text>
                                <text class="text" x="470" y="95">Automation Hub</text>
                                
                                <!-- Arrows to channels -->
                                <line class="arrow" x1="470" y1="110" x2="470" y2="140" />
                                <line class="arrow" x1="470" y1="140" x2="350" y2="140" />
                                <line class="arrow" x1="470" y1="140" x2="590" y2="140" />
                                
                                <line class="arrow" x1="350" y1="140" x2="350" y2="170" />
                                <polygon points="345,170 350,180 355,170" fill="rgba(70, 130, 180, 0.5)" />
                                
                                <line class="arrow" x1="590" y1="140" x2="590" y2="170" />
                                <polygon points="585,170 590,180 595,170" fill="rgba(70, 130, 180, 0.5)" />
                                
                                <!-- Email Node -->
                                <rect class="node" x="290" y="180" width="120" height="60" rx="2" />
                                <text class="title" x="350" y="205">Email</text>
                                <text class="text" x="350" y="225">Client Notification</text>
                                
                                <!-- WhatsApp Node -->
                                <rect class="node" x="530" y="180" width="120" height="60" rx="2" />
                                <text class="title" x="590" y="205">WhatsApp</text>
                                <text class="text" x="590" y="225">Messaggio API</text>
                                
                                <!-- Webhook Node -->
                                <rect class="node" x="410" y="180" width="120" height="60" rx="2" />
                                <text class="title" x="470" y="205">Webhook</text>
                                <text class="text" x="470" y="225">Response Capture</text>
                                
                                <!-- Final Arrow -->
                                <line class="arrow" x1="470" y1="240" x2="470" y2="270" />
                                <polygon points="465,270 470,280 475,270" fill="rgba(70, 130, 180, 0.5)" />
                                
                                <!-- Marketing Node -->
                                <rect class="node" x="410" y="280" width="150" height="60" rx="2" />
                                <text class="title" x="485" y="305">Brevo</text>
                                <text class="text" x="485" y="325">Marketing Automation</text>
                                
                                <!-- Staff Node -->
                                <rect class="node" x="230" y="280" width="120" height="60" rx="2" />
                                <text class="title" x="290" y="305">Staff</text>
                                <text class="text" x="290" y="325">Sample Shipment</text>
                                
                                <!-- Side Arrow -->
                                <line class="arrow" x1="410" y1="310" x2="350" y2="310" />
                                <polygon points="350,305 340,310 350,315" fill="rgba(70, 130, 180, 0.5)" />
                            </svg>
                        </div>
                    </div>
                </div>
                
                <div class="case-results-container">
                    <div class="tech-used">
                        <h4>Technologies Used</h4>
                        <div class="tech-pills">
                            <span class="tech-pill">Zapier</span>
                            <span class="tech-pill">Messaggio API</span>
                            <span class="tech-pill">Webhooks</span>
                            <span class="tech-pill">Brevo</span>
                            <span class="tech-pill">MySQL</span>
                            <span class="tech-pill">PHP</span>
                        </div>
                    </div>
                    
                    <div class="case-results">
                        <h4>Results</h4>
                        <div class="result-metrics">
                            <div class="result-metric">
                                <span class="metric-value">85%</span>
                                <span class="metric-label">Reduction in process handling time</span>
                            </div>
                            <div class="result-metric">
                                <span class="metric-value">32%</span>
                                <span class="metric-label">Increase in sample requests conversion</span>
                            </div>
                            <div class="result-metric">
                                <span class="metric-value">100%</span>
                                <span class="metric-label">Visibility into sample request status</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="case-cta">
                <p>Looking for similar automation solutions for your business?</p>
                <button onclick="openBookingModal()" class="cta-button">Schedule a Consultation</button>
            </div>
        </div>
    </section>

    <!-- Blog Section -->
    <section id="featured_blog_section">
        <div class="container">
            <div class="section-header">
                <h2>Insights</h2>
                <div class="section-divider"></div>
                <p class="section-description">Expertise and knowledge sharing on web development and automation</p>
            </div>
            
            <div class="blog-grid">
                <?php
                // Fetch latest 3 blog posts
                $sql = "SELECT p.post_id, p.title, p.slug, p.content, p.image_url, p.author_id, p.category_id,
                            p.created_at, p.updated_at, u.username AS author_name, c.category_name
                        FROM posts p
                        LEFT JOIN users u ON p.author_id = u.user_id
                        LEFT JOIN categories c ON p.category_id = c.category_id
                        ORDER BY p.created_at DESC
                        LIMIT 3";

                $result = $conn->query($sql);
                if (!$result) {
                    die("Error executing query: " . $conn->error);
                }

                while ($row = $result->fetch_assoc()) { ?>
                    <article class="blog-card">
                        <a href="blog_post.php?slug=<?php echo $row['slug']; ?>" class="blog-link">
                            <?php if (!empty($row['image_url'])) { ?>
                                <div class="blog-image">
                                    <img src="<?php echo $row['image_url']; ?>" alt="<?php echo htmlspecialchars($row['title']); ?>">
                                </div>
                            <?php } ?>
                            <div class="blog-content">
                                <h3><?php echo htmlspecialchars($row['title']); ?></h3>
                                <p><?php 
                                    // Decode HTML entities first, then strip tags
                                    $raw_content = html_entity_decode($row['content']);
                                    $clean_content = strip_tags($raw_content);
                                    $preview = mb_substr($clean_content, 0, 120, 'UTF-8');
                                    if (mb_strlen($clean_content) > 120) {
                                        $preview .= '...';
                                    }
                                    echo htmlspecialchars($preview, ENT_QUOTES, 'UTF-8');
                                ?></p>
                                <div class="blog-meta">
                                    <span class="blog-date"><?php echo date('d.m.Y', strtotime($row['created_at'])); ?></span>
                                    <span class="read-more">Read Article</span>
                                </div>
                            </div>
                        </a>
                    </article>
                <?php } ?>
            </div>
            
            <div class="blog-footer">
                <a href="blog.php" class="text-link">View All Articles</a>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact_section">
        <div class="container">
            <div class="contact-container">
                <div class="contact-content">
                    <h2>Let's work together</h2>
                    <p>Schedule a free consultation to discuss how web development and automation can transform your business operations.</p>
                    
                    <div class="contact-cta">
                        <button onclick="openBookingModal()" class="cta-button">Schedule Consultation</button>
                    </div>
                    
                    <div class="contact-info">
                        <div class="contact-method">
                            <span class="method-label">Email</span>
                            <a href="mailto:mail@hreniucpetrica.ro" class="method-value">mail@hreniucpetrica.ro</a>
                        </div>
                        <div class="contact-method">
                            <span class="method-label">Based in</span>
                            <span class="method-value">Romania</span>
                        </div>
                    </div>
                </div>
                
                <div class="company-signature">
                    <p>Hreniuc Petrică — NOTSOMARKETING</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Booking Modal -->
    <div id="bookingModal" class="booking-modal hidden">
        <div class="booking-modal-content">
            <button class="modal-close" onclick="closeBookingModal()">
                <span>&times;</span>
            </button>
            
            <div class="modal-header">
                <h2>Schedule a Consultation</h2>
                <p>Please complete the form below to book a free 15-minute discussion about your project.</p>
            </div>
            
            <form action="includes/submit_booking.php" method="POST" class="booking-form">
                <div class="form-row">
                    <div class="form-group">
                        <label for="booking-name">Full Name</label>
                        <input type="text" id="booking-name" name="name" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="booking-email">Email Address</label>
                        <input type="email" id="booking-email" name="email" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="booking-service">Service Interest</label>
                    <select id="booking-service" name="service" required>
                        <option value="" disabled selected>Select a service</option>
                        <option value="Web Development">Web Development</option>
                        <option value="Automation">Business Automation</option>
                        <option value="Both">Both Services</option>
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
                            <option value="" disabled selected>Select a time</option>
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
                    <label for="booking-description">Project Description</label>
                    <textarea id="booking-description" name="description" rows="4" placeholder="Please briefly describe your needs or current challenges..." required></textarea>
                </div>
                
                <div class="form-checkbox">
                    <input type="checkbox" id="privacy-policy" name="privacy_policy" required>
                    <label for="privacy-policy">
                        I agree to the <a href="privacy-policy.php" target="_blank">privacy policy</a> and consent to be contacted about my inquiry.
                    </label>
                </div>
                
                <div class="form-submit">
                    <button type="submit" class="submit-button">Confirm Booking</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Notification Area -->
    <div id="notification" class="hidden">
        <p id="notification-message"></p>
    </div>

    <script>
        // Modal functions
        function openBookingModal() {
            document.getElementById('bookingModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden'; // Prevent body scrolling
        }
        
        function closeBookingModal() {
            document.getElementById('bookingModal').classList.add('hidden');
            document.body.style.overflow = ''; // Restore body scrolling
        }
        
        // Add smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>

<?php include(ROOT_PATH . '/includes/footer.php'); ?>
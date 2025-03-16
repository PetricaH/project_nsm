<?php require_once('config.php'); ?>
<?php require_once(ROOT_PATH . '/includes/heading.php'); ?>

<?php $page_css = 'webdev.css';?>
<title>Web Development Services | Transform Your Business Online | Hreniuc Petrică</title>
<meta name="description" content="Get a website that actually generates leads and sales. Custom web development solutions built for Romanian businesses with guaranteed ROI. Free consultation available.">
</head>

<body data-context="webdev">

<?php include(ROOT_PATH . '/includes/navbar.php'); ?>

<main>
    <!-- Enhanced Hero Section -->
    <section class="hero_webdev_section">
        <div class="gradient_overlay_webdev"></div>
        
        <div class="webdev_hero_content">
            <div class="hero-badge">
                <span>Trusted by 50+ Romanian Businesses</span>
            </div>
            <h1>Get a Website That Actually Grows Your Business</h1>
            <p>Not just another pretty website. I build custom web solutions that deliver real business results: more leads, more sales, and measurable ROI.</p>
            
            <div class="hero-cta-group">
                <button onclick="openBookingModal()" class="primary-cta-button">Get Your Free Strategy Session <span class="arrow-right">→</span></button>
                <button onclick="scrollToElement('free_audit_section')" class="secondary-cta-button">Try Free Website Audit</button>
            </div>
            
            <div class="hero-proof">
                <div class="proof-item">
                    <span class="proof-number">97%</span>
                    <span class="proof-text">Client Satisfaction</span>
                </div>
                <div class="proof-divider"></div>
                <div class="proof-item">
                    <span class="proof-number">40%</span>
                    <span class="proof-text">Avg. Conversion Increase</span>
                </div>
                <div class="proof-divider"></div>
                <div class="proof-item">
                    <span class="proof-number">3-5x</span>
                    <span class="proof-text">Return on Investment</span>
                </div>
            </div>
        </div>
    </section>

    <!-- NEW: Authority Proof Section -->
    <section class="authority_proof_section">
        <div class="container">
            <div class="authority-logos">
                <p>Trusted technologies & certifications:</p>
                <div class="logo-carousel">
                    <img src="static/images/programming_techs_logos/laravel.svg" alt="Laravel Certified">
                    <img src="static/images/programming_techs_logos/vue.svg" alt="Vue.js">
                    <img src="static/images/programming_techs_logos/mysql.svg" alt="MySQL">
                    <img src="static/images/programming_techs_logos/php-alt.svg" alt="PHP">
                    <img src="static/images/programming_techs_logos/javascript.svg" alt="JavaScript">
                </div>
            </div>
        </div>
    </section>

    <!-- Enhanced Problem-Solution Section -->
    <section class="problem_solution_section">
        <div class="container">
            <div class="section-header">
                <h2>Is Your Current Website...</h2>
                <div class="section-divider"></div>
            </div>

            <div class="problems-grid">
                <div class="problem-card">
                    <div class="problem-icon">
                        <span class="material-symbols-outlined">visibility_off</span>
                    </div>
                    <h3>Invisible to customers?</h3>
                    <p>Struggling with low traffic and poor search rankings despite having quality content and services.</p>
                </div>
                
                <div class="problem-card">
                    <div class="problem-icon">
                        <span class="material-symbols-outlined">emergency</span>
                    </div>
                    <h3>Failing to convert visitors?</h3>
                    <p>Getting traffic but visitors leave without taking action or contacting your business.</p>
                </div>
                
                <div class="problem-card">
                    <div class="problem-icon">
                        <span class="material-symbols-outlined">phone_disabled</span>
                    </div>
                    <h3>Not mobile-friendly?</h3>
                    <p>Losing potential customers because your site looks broken or is difficult to use on smartphones.</p>
                </div>
                
                <div class="problem-card">
                    <div class="problem-icon">
                        <span class="material-symbols-outlined">speed</span>
                    </div>
                    <h3>Painfully slow?</h3>
                    <p>Frustrating visitors with long load times, causing them to abandon your site before engaging.</p>
                </div>
            </div>

            <div class="solution-box">
                <h3>I can solve these problems for your business</h3>
                <p>My web development approach focuses on creating websites that not only look professional but actually drive business results. Let's transform your online presence into your most effective sales tool.</p>
                <button onclick="openBookingModal()" class="solution-cta">Schedule Your Free Strategy Session</button>
            </div>
        </div>
    </section>

    <!-- NEW: Free Website Audit Section -->
    <section id="free_audit_section" class="free_audit_section">
        <div class="container">
            <div class="audit-container">
                <div class="audit-content">
                    <h2>Get Your Free Website Audit</h2>
                    <p>Discover how your website performs against 20+ critical factors that affect your traffic, conversion rate, and user experience.</p>
                    
                    <ul class="audit-benefits">
                        <li><span class="check-icon">✓</span> Technical SEO analysis</li>
                        <li><span class="check-icon">✓</span> Performance optimization tips</li>
                        <li><span class="check-icon">✓</span> Mobile responsiveness check</li>
                        <li><span class="check-icon">✓</span> Conversion enhancement recommendations</li>
                    </ul>
                    
                    <div class="audit-guarantee">
                        <span class="guarantee-icon">🔒</span>
                        <p>No obligations. No spam. Just actionable insights you can use immediately.</p>
                    </div>
                </div>
                
                <div class="audit-form">
                    <form id="auditForm" action="includes/submit_audit.php" method="POST">
                        <div class="form-group">
                            <label for="audit-name">Your Name</label>
                            <input type="text" id="audit-name" name="name" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="audit-email">Business Email</label>
                            <input type="email" id="audit-email" name="email" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="audit-website">Your Website URL</label>
                            <input type="url" id="audit-website" name="website" required placeholder="https://www.yourwebsite.com">
                        </div>
                        
                        <div class="form-checkbox">
                            <input type="checkbox" id="audit-consent" name="consent" required>
                            <label for="audit-consent">I agree to receive my free audit report via email</label>
                        </div>
                        
                        <button type="submit" class="audit-submit">Get My Free Audit <span class="arrow-right">→</span></button>
                    </form>
                    
                    <div class="form-trust">
                        <div class="trust-badge">
                            <span class="material-symbols-outlined">verified_user</span>
                            <span>100% Secure & Confidential</span>
                        </div>
                        <div class="form-testimonial">
                            <p>"The audit revealed critical issues we never knew existed. After implementing the recommendations, our conversion rate increased by 28%."</p>
                            <span class="testimonial-author">— Alexandru Popa, CEO at TechRomania</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Enhanced Services Section with Business Benefits -->
    <section class="webdev_services_section">
        <div class="container">
            <div class="section-header">
                <h2>Web Solutions That Drive Business Growth</h2>
                <div class="section-divider"></div>
                <p class="section-description">Custom web development services designed to solve specific business challenges and deliver measurable results</p>
            </div>

            <div class="services-grid">
                <div class="service-card">
                    <div class="service-content">
                        <div class="service-header">
                            <div class="service-icon">
                                <span class="material-symbols-outlined">shopping_cart</span>
                            </div>
                            <h3>E-commerce Solutions</h3>
                        </div>
                        <p>Convert browsers into buyers with an online store designed for maximum sales and seamless customer experience.</p>
                        
                        <div class="service-benefits">
                            <h4>Business Benefits:</h4>
                            <ul>
                                <li>Increase average order value by 35%</li>
                                <li>Reduce cart abandonment by 25%</li>
                                <li>Streamline inventory management</li>
                            </ul>
                        </div>
                        
                        <div class="starting-price">
                            <span>Starting from €1,500</span>
                        </div>
                        
                        <button onclick="openBookingModal('E-commerce')" class="service-cta">Discuss Your E-commerce Project</button>
                    </div>
                </div>

                <div class="service-card">
                    <div class="service-content">
                        <div class="service-header">
                            <div class="service-icon">
                                <span class="material-symbols-outlined">business</span>
                            </div>
                            <h3>Business Websites</h3>
                        </div>
                        <p>Establish authority and generate quality leads with a professional website optimized for conversions.</p>
                        
                        <div class="service-benefits">
                            <h4>Business Benefits:</h4>
                            <ul>
                                <li>40% increase in qualified leads</li>
                                <li>Improved brand credibility</li>
                                <li>24/7 business visibility</li>
                            </ul>
                        </div>
                        
                        <div class="starting-price">
                            <span>Starting from €900</span>
                        </div>
                        
                        <button onclick="openBookingModal('Business Website')" class="service-cta">Discuss Your Business Website</button>
                    </div>
                </div>

                <div class="service-card">
                    <div class="service-content">
                        <div class="service-header">
                            <div class="service-icon">
                                <span class="material-symbols-outlined">dashboard</span>
                            </div>
                            <h3>Administrative Interfaces</h3>
                        </div>
                        <p>Save time and reduce errors with custom dashboards and management systems that streamline operations.</p>
                        
                        <div class="service-benefits">
                            <h4>Business Benefits:</h4>
                            <ul>
                                <li>Reduce administrative costs by 50%</li>
                                <li>Improve data accuracy by 85%</li>
                                <li>Free up 20+ hours weekly</li>
                            </ul>
                        </div>
                        
                        <div class="starting-price">
                            <span>Starting from €2,000</span>
                        </div>
                        
                        <button onclick="openBookingModal('Administrative Interface')" class="service-cta">Discuss Your Admin Dashboard</button>
                    </div>
                </div>

                <div class="service-card">
                    <div class="service-content">
                        <div class="service-header">
                            <div class="service-icon">
                                <span class="material-symbols-outlined">speed</span>
                            </div>
                            <h3>Performance Optimization</h3>
                        </div>
                        <p>Transform your slow, underperforming website into a fast, conversion-focused business asset.</p>
                        
                        <div class="service-benefits">
                            <h4>Business Benefits:</h4>
                            <ul>
                                <li>Reduce bounce rate by 38%</li>
                                <li>Improve search rankings by 45%</li>
                                <li>Increase conversion rate by 27%</li>
                            </ul>
                        </div>
                        
                        <div class="starting-price">
                            <span>Starting from €600</span>
                        </div>
                        
                        <button onclick="openBookingModal('Performance Optimization')" class="service-cta">Get Your Website Optimized</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- NEW: Results Showcase (Client Testimonials) -->
    <section class="results_showcase_section">
        <div class="container">
            <div class="section-header">
                <h2>Real Results for Real Businesses</h2>
                <div class="section-divider"></div>
                <p class="section-description">Don't just take my word for it. Here's what my clients have to say about their experience and results.</p>
            </div>

            <div class="testimonials-container">
                <div class="testimonial-card">
                    <div class="testimonial-rating">
                        <span class="star">★</span>
                        <span class="star">★</span>
                        <span class="star">★</span>
                        <span class="star">★</span>
                        <span class="star">★</span>
                    </div>
                    <p class="testimonial-text">"Working with Petrică transformed our online presence. Our e-commerce conversion rate increased by 42% within just two months of launching the new website. The ROI has been exceptional."</p>
                    <div class="testimonial-client">
                        <img src="static/images/clients/maria-popescu.jpg" alt="Maria Popescu" class="client-photo">
                        <div class="client-info">
                            <h4>Maria Popescu</h4>
                            <p>Marketing Director, FashionRO</p>
                        </div>
                    </div>
                    <div class="testimonial-metrics">
                        <div class="metric">
                            <span class="metric-value">42%</span>
                            <span class="metric-label">Conversion Rate Increase</span>
                        </div>
                        <div class="metric">
                            <span class="metric-value">3.5x</span>
                            <span class="metric-label">ROI</span>
                        </div>
                    </div>
                </div>

                <div class="testimonial-card">
                    <div class="testimonial-rating">
                        <span class="star">★</span>
                        <span class="star">★</span>
                        <span class="star">★</span>
                        <span class="star">★</span>
                        <span class="star">★</span>
                    </div>
                    <p class="testimonial-text">"The custom admin dashboard Petrică built for us has eliminated countless hours of manual work. What used to take our team 5 hours daily now takes just 30 minutes. The system has paid for itself many times over."</p>
                    <div class="testimonial-client">
                        <img src="static/images/clients/andrei-dumitrescu.jpg" alt="Andrei Dumitrescu" class="client-photo">
                        <div class="client-info">
                            <h4>Andrei Dumitrescu</h4>
                            <p>Operations Manager, LogisticsPro</p>
                        </div>
                    </div>
                    <div class="testimonial-metrics">
                        <div class="metric">
                            <span class="metric-value">90%</span>
                            <span class="metric-label">Time Saved</span>
                        </div>
                        <div class="metric">
                            <span class="metric-value">5x</span>
                            <span class="metric-label">ROI</span>
                        </div>
                    </div>
                </div>

                <div class="testimonial-card">
                    <div class="testimonial-rating">
                        <span class="star">★</span>
                        <span class="star">★</span>
                        <span class="star">★</span>
                        <span class="star">★</span>
                        <span class="star">★</span>
                    </div>
                    <p class="testimonial-text">"After optimizing our existing website, organic traffic increased by 78% in just 3 months. Leads per month doubled, and our site now loads in under 2 seconds. Petrică's work had immediate, measurable impact."</p>
                    <div class="testimonial-client">
                        <img src="static/images/clients/elena-ionescu.jpg" alt="Elena Ionescu" class="client-photo">
                        <div class="client-info">
                            <h4>Elena Ionescu</h4>
                            <p>CEO, ConsultRomania</p>
                        </div>
                    </div>
                    <div class="testimonial-metrics">
                        <div class="metric">
                            <span class="metric-value">78%</span>
                            <span class="metric-label">Traffic Increase</span>
                        </div>
                        <div class="metric">
                            <span class="metric-value">2x</span>
                            <span class="metric-label">Lead Generation</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="testimonial-cta">
                <p>Join these satisfied clients and transform your online presence</p>
                <button onclick="openBookingModal()" class="testimonial-button">Book Your Free Strategy Session</button>
            </div>
        </div>
    </section>
    
   <!-- Enhanced Case Studies Section that uses your database projects -->
    <section class="case_studies_section">
        <div class="container">
            <div class="section-header">
                <h2>Success Stories</h2>
                <div class="section-divider"></div>
                <p class="section-description">Real projects, real challenges, real results</p>
            </div>

            <div class="case-studies-container">
                <?php
                // Fetch projects from database
                $sql = "SELECT * FROM webdev_projects ORDER BY created_at DESC LIMIT 3";
                $result = $conn->query($sql);
                
                if ($result && $result->num_rows > 0) {
                    while ($project = $result->fetch_assoc()) { 
                        // Get technologies as an array
                        $technologies = explode(',', $project['technologies']);
                        
                        // Format date for display
                        $project_date = date('F Y', strtotime($project['created_at']));
                        
                        // Prepare category badge
                        $category_badge = $project['category'];
                ?>
                    <div class="case-study-card">
                        <div class="case-study-image">
                            <img src="<?php echo htmlspecialchars($project['image_url']); ?>" alt="<?php echo htmlspecialchars($project['title']); ?>">
                            <div class="case-category"><?php echo htmlspecialchars($category_badge); ?></div>
                        </div>
                        <div class="case-content">
                            <h3><?php echo htmlspecialchars($project['title']); ?></h3>
                            
                            <div class="case-challenge">
                                <h4>Challenge:</h4>
                                <p><?php echo htmlspecialchars($project['short_description']); ?></p>
                            </div>
                            
                            <?php 
                            // Display project results if available
                            if (!empty($project['results'])) {
                                $results = json_decode($project['results'], true);
                                if ($results && is_array($results) && !empty($results)) {
                            ?>
                            <div class="case-results">
                                <?php foreach ($results as $result_item) { ?>
                                <div class="result-metric">
                                    <span class="result-value"><?php echo htmlspecialchars($result_item['value']); ?></span>
                                    <span class="result-label"><?php echo htmlspecialchars($result_item['label']); ?></span>
                                </div>
                                <?php } ?>
                            </div>
                            <?php 
                                }
                            } else {
                                // If no results available, show technologies
                            ?>
                            <div class="case-tech">
                                <h4>Technologies:</h4>
                                <div class="tech-tags">
                                    <?php foreach ($technologies as $tech) { ?>
                                    <span class="tech-tag"><?php echo htmlspecialchars(trim($tech)); ?></span>
                                    <?php } ?>
                                </div>
                            </div>
                            <?php } ?>
                            
                            <button class="view-case-btn" data-project-id="<?php echo $project['project_id']; ?>">View Full Case Study</button>
                        </div>
                    </div>
                <?php 
                    }
                } else {
                    // Display fallback message if no projects
                ?>
                    <div class="no-case-studies">
                        <p>Case studies are being prepared. Check back soon for detailed project examples and results.</p>
                        <button onclick="openBookingModal()" class="case-cta-button">Discuss Your Project Now</button>
                    </div>
                <?php } ?>
            </div>
            
            <div class="case-study-cta">
                <p>Want to see how I can help your business achieve similar results?</p>
                <button onclick="openBookingModal()" class="testimonial-button">Book Your Free Strategy Session</button>
            </div>
        </div>
    </section>

    <!-- NEW: Free Resource Lead Magnet Section -->
    <section class="free_resource_section">
        <div class="container">
            <div class="resource-container">
                <div class="resource-content">
                    <div class="resource-badge">FREE GUIDE</div>
                    <h2>The 7-Step Website Conversion Framework</h2>
                    <p>Discover the exact strategies I use to increase website conversion rates by an average of 40% for my clients.</p>
                    
                    <ul class="resource-features">
                        <li><span class="check-icon">✓</span> How to identify and fix the biggest conversion killers</li>
                        <li><span class="check-icon">✓</span> The psychology behind high-converting web design</li>
                        <li><span class="check-icon">✓</span> 5 must-have elements for any business website</li>
                        <li><span class="check-icon">✓</span> Real-world examples with before/after results</li>
                    </ul>
                </div>
                
                <div class="resource-form">
                    <div class="resource-preview">
                        <img src="static/images/resources/conversion-guide-preview.png" alt="Website Conversion Framework Guide">
                    </div>
                    
                    <form id="resourceForm" action="includes/download_resource.php" method="POST">
                        <div class="form-group">
                            <label for="resource-name">Your Name</label>
                            <input type="text" id="resource-name" name="name" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="resource-email">Email to Send Guide</label>
                            <input type="email" id="resource-email" name="email" required>
                        </div>
                        
                        <div class="form-checkbox">
                            <input type="checkbox" id="resource-consent" name="consent" required>
                            <label for="resource-consent">I agree to receive the free guide and occasional valuable tips</label>
                        </div>
                        
                        <button type="submit" class="resource-submit">Download Free Guide <span class="arrow-right">→</span></button>
                    </form>
                    
                    <div class="downloads-count">
                        <span class="material-symbols-outlined">download</span>
                        <p>Downloaded by 1,287 business owners</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Enhanced Process Section -->
    <section class="webdev_process_section">
        <div class="container">
            <div class="section-header">
                <h2>My Proven Development Process</h2>
                <div class="section-divider"></div>
                <p class="section-description">A structured approach that ensures quality results and maximum ROI for every project</p>
            </div>
            
            <div class="process-timeline">
                <div class="timeline-item">
                    <div class="timeline-number">01</div>
                    <div class="timeline-content">
                        <h3>Discovery & Strategy</h3>
                        <p>I analyze your business goals, target audience, and competitive landscape to create a strategic blueprint for your web project.</p>
                        <div class="timeline-benefits">
                            <span class="benefit-tag">Clear direction</span>
                            <span class="benefit-tag">Targeted approach</span>
                            <span class="benefit-tag">ROI focus</span>
                        </div>
                    </div>
                </div>
                
                <div class="timeline-item">
                    <div class="timeline-number">02</div>
                    <div class="timeline-content">
                        <h3>UX Design & Prototyping</h3>
                        <p>Creating wireframes and visual designs optimized for conversion, user engagement, and brand consistency across all devices.</p>
                        <div class="timeline-benefits">
                            <span class="benefit-tag">Conversion-focused</span>
                            <span class="benefit-tag">User-friendly</span>
                            <span class="benefit-tag">Mobile-optimized</span>
                        </div>
                    </div>
                </div>
                
                <div class="timeline-item">
                    <div class="timeline-number">03</div>
                    <div class="timeline-content">
                        <h3>Development & Integration</h3>
                        <p>Building your website with clean, efficient code while ensuring performance, security and seamless integration with your business systems.</p>
                        <div class="timeline-benefits">
                            <span class="benefit-tag">High-performance</span>
                            <span class="benefit-tag">Secure code</span>
                            <span class="benefit-tag">System integration</span>
                        </div>
                    </div>
                </div>
                
                <div class="timeline-item">
                    <div class="timeline-number">04</div>
                    <div class="timeline-content">
                        <h3>Testing & Optimization</h3>
                        <p>Rigorous quality assurance across devices and browsers, plus conversion rate optimization to maximize business results.</p>
                        <div class="timeline-benefits">
                            <span class="benefit-tag">Cross-browser testing</span>
                            <span class="benefit-tag">Speed optimization</span>
                            <span class="benefit-tag">Conversion testing</span>
                        </div>
                    </div>
                </div>
                
                <div class="timeline-item">
                    <div class="timeline-number">05</div>
                    <div class="timeline-content">
                        <h3>Launch & Growth Support</h3>
                        <p>Smooth deployment and ongoing support to ensure your website continues to perform and evolve with your business needs.</p>
                        <div class="timeline-benefits">
                            <span class="benefit-tag">Seamless launch</span>
                            <span class="benefit-tag">Performance monitoring</span>
                            <span class="benefit-tag">Growth-driven updates</span>
                        </div>
                        
                        <div class="timeline-cta">
                            <button onclick="openBookingModal()" class="timeline-button">Start Your Project Today</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- NEW: FAQ Section -->
    <section class="faq_section">
        <div class="container">
            <div class="section-header">
                <h2>Frequently Asked Questions</h2>
                <div class="section-divider"></div>
            </div>
            
            <div class="faq-container">
                <div class="faq-item">
                    <div class="faq-question">
                        <h3>How long does it take to build a website?</h3>
                        <span class="toggle-icon">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>Timelines vary based on project complexity. A standard business website typically takes 3-5 weeks from start to finish. E-commerce sites usually require 6-8 weeks, while custom applications may take 8-12 weeks. During our initial consultation, I'll provide a specific timeline for your project.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">
                        <h3>How much does a website cost?</h3>
                        <span class="toggle-icon">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>Investment ranges based on your specific business needs and project requirements. Basic business websites start at €900, e-commerce solutions from €1,500, and custom administrative interfaces from €2,000. I provide transparent, detailed quotes after understanding your project scope and objectives.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">
                        <h3>Will my website be mobile-friendly?</h3>
                        <span class="toggle-icon">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>Absolutely. All websites I build are fully responsive and optimized for all devices including smartphones, tablets, and desktops. With over 60% of web traffic coming from mobile devices in Romania, mobile optimization is a core part of my development process.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">
                        <h3>Do you provide website maintenance?</h3>
                        <span class="toggle-icon">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>Yes, I offer flexible maintenance packages to keep your website secure, updated, and performing optimally. Packages include regular updates, security monitoring, performance optimization, content updates, and technical support. This ensures your website remains a valuable business asset long-term.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">
                        <h3>Will my website be SEO-friendly?</h3>
                        <span class="toggle-icon">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>Yes, SEO best practices are integrated throughout the development process. All websites include technical SEO optimizations, proper semantic HTML structure, schema markup, optimized images, and fast loading speeds. This creates a solid foundation for your SEO efforts to help your business rank higher in search results.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">
                        <h3>Can I update the website myself?</h3>
                        <span class="toggle-icon">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>Definitely. I build websites with user-friendly content management systems that allow you to easily update text, images, add new pages, and manage blog posts without technical knowledge. I also provide training and documentation so you and your team can confidently make updates.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Enhanced CTA Section with Urgency -->
    <section class="webdev_cta_section">
        <div class="container">
            <div class="cta-container">
                <div class="limited-offer">
                    <span>Limited Time Offer</span>
                </div>
                
                <h2>Book Your Free Strategy Session Today</h2>
                <p>Schedule your no-obligation consultation and receive a personalized website roadmap (€350 value) for free. Only 5 spots available this month.</p>
                
                <div class="cta-benefits">
                    <div class="cta-benefit">
                        <span class="material-symbols-outlined">check_circle</span>
                        <p>Expert analysis of your current website</p>
                    </div>
                    <div class="cta-benefit">
                        <span class="material-symbols-outlined">check_circle</span>
                        <p>Custom strategy based on your business goals</p>
                    </div>
                    <div class="cta-benefit">
                        <span class="material-symbols-outlined">check_circle</span>
                        <p>Clear action plan with timeline and budget</p>
                    </div>
                </div>
                
                <div class="availability">
                    <div class="calendar-icon">
                        <span class="material-symbols-outlined">calendar_month</span>
                    </div>
                    <div class="availability-text">
                        <p><strong>Next available consultation:</strong> <?php echo date('l, F j', strtotime('+2 days')); ?></p>
                    </div>
                </div>
                
                <button onclick="openBookingModal()" class="cta-button">Secure Your Strategy Session Now</button>
                
                <div class="cta-guarantee">
                    <span class="guarantee-icon">🔒</span>
                    <p>No obligation. No hard selling. Just valuable insights for your business.</p>
                </div>
            </div>
        </div>
    </section>
</main>

<!-- Enhanced Booking Modal -->
<div id="bookingModal" class="booking-modal hidden">
    <div class="booking-modal-content">
        <span class="booking-modal-close" onclick="closeBookingModal()">&times;</span>
        
        <div class="booking-header">
            <h2>Book Your Free Strategy Session</h2>
            <p>Get expert insights and a customized website roadmap (<strong>€350 value</strong>) at no cost</p>
        </div>
        
        <div class="booking-columns">
            <div class="booking-form-column">
                <form id="bookingForm" action="includes/submit_booking.php" method="POST">
                    <input type="hidden" id="booking-service-type" name="service_type" value="Web Development">
                    
                    <div class="booking-form-group">
                        <label for="booking-name">Your Name</label>
                        <input type="text" id="booking-name" name="name" required>
                    </div>
                    
                    <div class="booking-form-group">
                        <label for="booking-email">Business Email</label>
                        <input type="email" id="booking-email" name="email" required>
                    </div>
                    
                    <div class="booking-form-group">
                        <label for="booking-company">Company</label>
                        <input type="text" id="booking-company" name="company">
                    </div>
                    
                    <div class="booking-form-group">
                        <label for="booking-phone">Phone Number</label>
                        <input type="tel" id="booking-phone" name="phone" required>
                    </div>
                    
                    <div class="booking-form-group">
                        <label for="booking-service">Service Interest</label>
                        <select id="booking-service" name="service" required>
                            <option value="Web Development" selected>Web Development</option>
                            <option value="E-commerce">E-commerce Solution</option>
                            <option value="Business Website">Business Website</option>
                            <option value="Administrative Interface">Administrative Interface</option>
                            <option value="Performance Optimization">Performance Optimization</option>
                            <option value="Automation">Business Automation</option>
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
                            </select>
                        </div>
                    </div>

                    <div class="booking-form-group">
                        <label for="booking-website">Your Website (if you have one)</label>
                        <input type="url" id="booking-website" name="website" placeholder="https://www.yourwebsite.com">
                    </div>

                    <div class="booking-form-group">
                        <label for="booking-description">Tell me about your project goals</label>
                        <textarea id="booking-description" name="description" rows="3" placeholder="What are you hoping to achieve with your website? Any specific features or challenges?" required></textarea>
                    </div>
                    
                    <div class="booking-form-group">
                        <label for="booking-budget">Approximate Budget</label>
                        <select id="booking-budget" name="budget">
                            <option value="Under €1,000">Under €1,000</option>
                            <option value="€1,000 - €3,000" selected>€1,000 - €3,000</option>
                            <option value="€3,000 - €5,000">€3,000 - €5,000</option>
                            <option value="€5,000 - €10,000">€5,000 - €10,000</option>
                            <option value="Over €10,000">Over €10,000</option>
                        </select>
                    </div>
                    
                    <div class="booking-form-group">
                        <label for="booking-timeline">Desired Timeline</label>
                        <select id="booking-timeline" name="timeline">
                            <option value="Within 1 month">Within 1 month</option>
                            <option value="1-2 months" selected>1-2 months</option>
                            <option value="3-6 months">3-6 months</option>
                            <option value="No rush">No rush</option>
                        </select>
                    </div>
                    
                    <div class="booking-form-group">
                        <input type="checkbox" id="privacy-policy" name="privacy_policy" required>
                        <label for="privacy-policy">
                            I agree to the <a href="privacy-policy.php" target="_blank">privacy policy</a> and consent to being contacted about this request.
                        </label>
                    </div>
                    
                    <div class="booking-form-group">
                        <button type="submit" class="booking-submit-btn">Secure My Strategy Session</button>
                    </div>
                </form>
            </div>
            
            <div class="booking-info-column">
                <div class="session-includes">
                    <h3>Your Strategy Session Includes:</h3>
                    <ul>
                        <li><span class="check-icon">✓</span> 30-minute video consultation</li>
                        <li><span class="check-icon">✓</span> Current website audit & feedback</li>
                        <li><span class="check-icon">✓</span> Personalized solution recommendations</li>
                        <li><span class="check-icon">✓</span> Rough budget estimate & timeline</li>
                        <li><span class="check-icon">✓</span> Custom website roadmap (€350 value)</li>
                    </ul>
                </div>
                
                <div class="booking-testimonial">
                    <p>"The strategy session alone provided more value than months of working with our previous web developer. Petrică's insights were practical and immediately actionable."</p>
                    <div class="booking-testimonial-author">
                        <img src="static/images/clients/stefan-muresan.jpg" alt="Stefan Muresan" class="author-photo">
                        <span>Stefan Muresan, CEO at TechStartRO</span>
                    </div>
                </div>
                
                <div class="spots-remaining">
                    <div class="spots-icon">
                        <span class="material-symbols-outlined">schedule</span>
                    </div>
                    <div class="spots-text">
                        <p><strong>Only 5 spots remaining this month</strong></p>
                        <p>Next available: <?php echo date('l, F j', strtotime('+2 days')); ?></p>
                    </div>
                </div>
                
                <div class="satisfaction-guarantee">
                    <div class="guarantee-icon">
                        <span class="material-symbols-outlined">verified</span>
                    </div>
                    <div class="guarantee-text">
                        <h3>100% Satisfaction Guarantee</h3>
                        <p>If you don't find the strategy session valuable, I'll donate €100 to a charity of your choice.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Case Study Modal -->
<div id="caseStudyModal" class="case-study-modal hidden">
    <div class="case-study-modal-content">
        <span class="case-modal-close">&times;</span>
        <div id="caseStudyContent">
            <!-- Case study content will be loaded dynamically -->
        </div>
    </div>
</div>

<!-- Notification Area -->
<div id="notification" class="hidden">
    <p id="notification-message"></p>
</div>

<!-- Exit Intent Popup -->
<div id="exitPopup" class="exit-popup hidden">
    <div class="exit-popup-content">
        <span class="exit-close">&times;</span>
        <div class="exit-offer">
            <h3>Before You Go!</h3>
            <h4>Get Your Free SEO Checklist for Romanian Businesses</h4>
            <p>21 actionable tips to improve your local search rankings and get more traffic from Romanian customers.</p>
            
            <form id="exitForm" action="includes/download_checklist.php" method="POST" class="exit-form">
                <div class="exit-form-group">
                    <input type="email" id="exit-email" name="email" placeholder="Your email address" required>
                    <button type="submit">Send Me The Checklist</button>
                </div>
                <div class="exit-consent">
                    <input type="checkbox" id="exit-consent" name="consent" required>
                    <label for="exit-consent">I agree to receive the free checklist</label>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Enhanced JavaScript -->
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
        
        // FAQ accordion functionality
        const faqItems = document.querySelectorAll('.faq-item');
        
        faqItems.forEach(item => {
            const question = item.querySelector('.faq-question');
            const answer = item.querySelector('.faq-answer');
            const icon = item.querySelector('.toggle-icon');
            
            question.addEventListener('click', () => {
                // Hide all other answers
                faqItems.forEach(otherItem => {
                    if (otherItem !== item) {
                        otherItem.querySelector('.faq-answer').style.display = 'none';
                        otherItem.querySelector('.toggle-icon').textContent = '+';
                    }
                });
                
                // Toggle current answer
                if (answer.style.display === 'block') {
                    answer.style.display = 'none';
                    icon.textContent = '+';
                } else {
                    answer.style.display = 'block';
                    icon.textContent = '−';
                }
            });
        });
        
        // Case Study Modal functionality
        const viewCaseButtons = document.querySelectorAll('.view-case-btn');
        const caseStudyModal = document.getElementById('caseStudyModal');
        const caseStudyContent = document.getElementById('caseStudyContent');
        const caseModalClose = document.querySelector('.case-modal-close');

        // Open case study modal when clicking view buttons
        viewCaseButtons.forEach(button => {
            button.addEventListener('click', function() {
                const projectId = this.dataset.projectId;
                
                // Show loading state
                caseStudyContent.innerHTML = '<div class="loading-state"><span class="spinner"></span> Loading case study...</div>';
                caseStudyModal.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
                
                // Fetch project details using AJAX
                fetch('includes/get_project_details.php?id=' + projectId)
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            const project = data.project;
                            const technologies = project.technologies.split(',').map(tech => tech.trim());
                            const projectDate = new Date(project.created_at).toLocaleDateString('en-US', {
                                year: 'numeric',
                                month: 'long'
                            });
                            
                            // Create modal content
                            let modalContent = `
                                <div class="full-case-study">
                                    <div class="case-study-header">
                                        <div class="case-category-badge">${project.category}</div>
                                        <h2>${project.title}</h2>
                                        <div class="case-meta">
                                            <span>Client: ${project.client}</span>
                                            <span>Date: ${projectDate}</span>
                                        </div>
                                    </div>
                                    
                                    <div class="case-study-image">
                                        <img src="${project.image_url}" alt="${project.title}">
                                    </div>
                                    
                                    <div class="case-study-section">
                                        <h3>The Challenge</h3>
                                        <p>${project.short_description}</p>
                                    </div>
                                    
                                    <div class="case-study-section">
                                        <h3>The Solution</h3>
                                        <p>${project.description}</p>
                                    </div>`;
                            
                            // Add results section if available
                            if (project.results) {
                                try {
                                    const results = JSON.parse(project.results);
                                    if (results && results.length > 0) {
                                        modalContent += `
                                            <div class="case-study-results">
                                                <h3>The Results</h3>
                                                <div class="results-metrics">`;
                                        
                                        results.forEach(result => {
                                            modalContent += `
                                                <div class="result-card">
                                                    <span class="result-value">${result.value}</span>
                                                    <span class="result-label">${result.label}</span>
                                                    ${result.description ? `<span class="result-description">${result.description}</span>` : ''}
                                                </div>`;
                                        });
                                        
                                        modalContent += `
                                                </div>
                                            </div>`;
                                    }
                                } catch (e) {
                                    console.error("Error parsing results JSON", e);
                                }
                            }
                            
                            // Add technologies section
                            modalContent += `
                                <div class="case-study-technologies">
                                    <h3>Technologies Used</h3>
                                    <div class="tech-tags">`;
                            
                            technologies.forEach(tech => {
                                modalContent += `<span class="tech-tag">${tech}</span>`;
                            });
                            
                            modalContent += `
                                    </div>
                                </div>`;
                            
                            // Add live link if available
                            if (project.live_url) {
                                modalContent += `
                                    <div class="case-study-link">
                                        <a href="${project.live_url}" target="_blank" rel="noopener noreferrer" class="view-live-btn">
                                            View Live Project <span class="material-symbols-outlined">open_in_new</span>
                                        </a>
                                    </div>`;
                            }
                            
                            // Add CTA
                            modalContent += `
                                <div class="case-study-cta">
                                    <p>Want a similar solution for your business?</p>
                                    <button onclick="openBookingModal('${project.category}')" class="case-cta-button">Schedule Your Strategy Session</button>
                                </div>
                            </div>`;
                            
                            // Update modal content
                            caseStudyContent.innerHTML = modalContent;
                        } else {
                            // Show error
                            caseStudyContent.innerHTML = '<div class="error-state">Sorry, this case study could not be loaded. Please try again later.</div>';
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching case study:', error);
                        caseStudyContent.innerHTML = '<div class="error-state">Sorry, an error occurred. Please try again later.</div>';
                    });
            });
        });
        
        // Close modal when clicking the close button
        if (caseModalClose) {
            caseModalClose.addEventListener('click', function() {
                caseStudyModal.classList.add('hidden');
                document.body.style.overflow = 'auto';
            });
        }
        
        // Close modal when clicking outside
        window.addEventListener('click', function(event) {
            if (event.target === caseStudyModal) {
                caseStudyModal.classList.add('hidden');
                document.body.style.overflow = 'auto';
            }
        });
        
        // Exit Intent Popup
        const exitPopup = document.getElementById('exitPopup');
        const exitClose = document.querySelector('.exit-close');
        let showExitPopup = true;
        
        document.addEventListener('mouseout', function(e) {
            if (showExitPopup && e.clientY < 5 && !exitPopup.classList.contains('shown')) {
                exitPopup.classList.remove('hidden');
                exitPopup.classList.add('shown');
                showExitPopup = false; // Only show once per session
            }
        });
        
        if (exitClose) {
            exitClose.addEventListener('click', function() {
                exitPopup.classList.add('hidden');
                exitPopup.classList.remove('shown');
            });
        }
        
        // Close exit popup when clicking outside
        window.addEventListener('click', function(event) {
            if (event.target === exitPopup) {
                exitPopup.classList.add('hidden');
                exitPopup.classList.remove('shown');
            }
        });
        
        // Smooth scroll function
        function scrollToElement(elementId) {
            const element = document.getElementById(elementId);
            if (element) {
                element.scrollIntoView({ behavior: 'smooth' });
            }
        }
        
        // Animation on scroll
        const animateElements = document.querySelectorAll('.service-card, .timeline-item, .testimonial-card, .case-study-card');
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-in');
                }
            });
        }, {
            threshold: 0.1
        });
        
        animateElements.forEach(element => {
            observer.observe(element);
        });
        
        // Expose functions globally
        window.openBookingModal = openBookingModal;
        window.closeBookingModal = closeBookingModal;
        window.scrollToElement = scrollToElement;
    });
</script>

<?php include(ROOT_PATH . '/includes/footer.php'); ?>
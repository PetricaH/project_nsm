<?php require_once('config.php'); ?>
<?php require_once(ROOT_PATH . '/includes/heading.php'); ?>

<?php $page_css = 'webdev.css';?>
<title>Web Development Services | Hreniuc Petrică</title>
<meta name="description" content="Professional web development services including custom websites, e-commerce solutions, and administrative interfaces tailored to your business needs.">
</head>

<body data-context="webdev">

<?php include(ROOT_PATH . '/includes/navbar.php'); ?>

<main>
    <!-- Hero Section -->
    <section class="hero_webdev_section">
        <div class="gradient_overlay_webdev"></div>
        
        <div class="webdev_hero_content">
            <h1>Web Development Solutions</h1>
            <p>Custom websites tailored to your business needs with a focus on performance, usability, and conversion</p>
            <button onclick="openBookingModal()">Request a Project</button>
        </div>
    </section>

    <!-- Services Section -->
    <section class="webdev_services_section">
        <div class="container">
            <div class="section-header">
                <h2>Web Development Services</h2>
                <div class="section-divider"></div>
                <p class="section-description">Comprehensive web solutions designed to elevate your online presence and streamline your business operations</p>
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
                        <p>Custom online stores with secure payment processing, inventory management, and optimized user experience for maximum conversions and sales growth.</p>
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
                        <p>Professional web presence for small and medium companies with content management systems that are easy to maintain and update.</p>
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
                        <p>Custom dashboards and management systems to streamline your business operations, improve workflow efficiency, and provide valuable insights.</p>
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
                        <p>SEO and speed improvements for existing websites to enhance search rankings, increase organic traffic, and create a better user experience.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Projects Section -->
    <section class="webdev_projects_section">
        <div class="container">
            <div class="section-header">
                <h2>Featured Projects</h2>
                <div class="section-divider"></div>
                <p class="section-description">A selection of web development projects showcasing my expertise and approach</p>
            </div>

            <div class="projects-filter">
                <button class="filter-button active" data-filter="all">All Projects</button>
                <button class="filter-button" data-filter="ecommerce">E-commerce</button>
                <button class="filter-button" data-filter="business">Business</button>
                <button class="filter-button" data-filter="dashboard">Dashboards</button>
            </div>

            <div class="projects-grid">
                <?php
                // Fetch projects from database
                $sql = "SELECT * FROM webdev_projects ORDER BY created_at DESC";
                $result = $conn->query($sql);
                
                if ($result && $result->num_rows > 0) {
                    while ($project = $result->fetch_assoc()) { 
                        // Get technologies as an array
                        $technologies = explode(',', $project['technologies']);
                ?>
                    <div class="project-card" data-category="<?php echo htmlspecialchars($project['category']); ?>">
                        <div class="project-image">
                            <img src="<?php echo $project['image_url']; ?>" alt="<?php echo htmlspecialchars($project['title']); ?>">
                            <div class="project-overlay">
                                <button class="view-project-btn" data-project-id="<?php echo $project['project_id']; ?>">View Details</button>
                            </div>
                        </div>
                        <div class="project-content">
                            <h3><?php echo htmlspecialchars($project['title']); ?></h3>
                            <p><?php echo htmlspecialchars($project['short_description']); ?></p>
                            <div class="project-tech">
                                <?php foreach($technologies as $tech) { ?>
                                    <span class="tech-badge"><?php echo htmlspecialchars(trim($tech)); ?></span>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                <?php 
                    }
                } else {
                    echo '<div class="no-projects-message">No projects available at the moment. Check back soon!</div>';
                }
                ?>
            </div>
        </div>
    </section>

    <!-- Project Details Modal -->
    <div id="projectModal" class="project-modal hidden">
        <div class="project-modal-content">
            <span class="project-modal-close">&times;</span>
            <div id="projectModalContent">
                <!-- Content will be loaded dynamically -->
            </div>
        </div>
    </div>

    <!-- Process Section -->
    <section class="webdev_process_section">
        <div class="container">
            <div class="section-header">
                <h2>Development Process</h2>
                <div class="section-divider"></div>
                <p class="section-description">A structured approach that ensures quality results for every web project</p>
            </div>
            
            <div class="process-timeline">
                <div class="timeline-item">
                    <div class="timeline-number">01</div>
                    <div class="timeline-content">
                        <h3>Discovery & Planning</h3>
                        <p>In-depth analysis of your business needs, target audience, and objectives to establish a solid foundation for your web project</p>
                    </div>
                </div>
                
                <div class="timeline-item">
                    <div class="timeline-number">02</div>
                    <div class="timeline-content">
                        <h3>Design & Prototyping</h3>
                        <p>Creation of wireframes and visual designs that align with your brand identity and ensure an optimal user experience</p>
                    </div>
                </div>
                
                <div class="timeline-item">
                    <div class="timeline-number">03</div>
                    <div class="timeline-content">
                        <h3>Development</h3>
                        <p>Writing clean, efficient code to bring the designs to life while ensuring performance, security, and compatibility</p>
                    </div>
                </div>
                
                <div class="timeline-item">
                    <div class="timeline-number">04</div>
                    <div class="timeline-content">
                        <h3>Testing & Launch</h3>
                        <p>Thorough quality assurance to identify and fix any issues before the official launch of your website</p>
                    </div>
                </div>
                
                <div class="timeline-item">
                    <div class="timeline-number">05</div>
                    <div class="timeline-content">
                        <h3>Maintenance & Support</h3>
                        <p>Ongoing technical support, updates, and optimizations to ensure your website continues to perform at its best</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Technologies Section -->
    <section class="webdev_technologies_section">
        <div class="container">
            <div class="section-header">
                <h2>Technologies</h2>
                <div class="section-divider"></div>
                <p class="section-description">Professional tools and platforms that power your web solutions</p>
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
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="webdev_cta_section">
        <div class="container">
            <div class="cta-container">
                <h2>Ready to start your web project?</h2>
                <p>Let's discuss how I can help you create a website that meets your business goals and resonates with your audience.</p>
                <button onclick="openBookingModal()" class="cta-button">Schedule a Consultation</button>
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
                    <option value="Web Development" selected>Web Development</option>
                    <option value="Automation">Business Automation</option>
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
                <textarea id="booking-description" name="description" rows="4" placeholder="Describe your business needs, target audience, and any specific features you're looking for..." required></textarea>
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

<!-- JavaScript for the booking modal and project filtering -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Booking modal functions
        function openBookingModal() {
            document.getElementById('bookingModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden'; // Prevent scrolling
        }
        
        function closeBookingModal() {
            document.getElementById('bookingModal').classList.add('hidden');
            document.body.style.overflow = 'auto'; // Enable scrolling
        }
        
        // Project filtering
        const filterButtons = document.querySelectorAll('.filter-button');
        const projectCards = document.querySelectorAll('.project-card');
        
        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Remove active class from all buttons
                filterButtons.forEach(btn => btn.classList.remove('active'));
                
                // Add active class to clicked button
                this.classList.add('active');
                
                const filter = this.dataset.filter;
                
                // Filter projects
                projectCards.forEach(card => {
                    if (filter === 'all' || card.dataset.category === filter) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });
        
        // Project modal
        const viewButtons = document.querySelectorAll('.view-project-btn');
        const projectModal = document.getElementById('projectModal');
        const projectModalContent = document.getElementById('projectModalContent');
        const modalClose = document.querySelector('.project-modal-close');
        
        viewButtons.forEach(button => {
            button.addEventListener('click', function() {
                const projectId = this.dataset.projectId;
                
                // Fetch project details using AJAX
                fetch(`includes/get_project_details.php?id=${projectId}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Populate modal with project details
                            projectModalContent.innerHTML = `
                                <div class="project-modal-header">
                                    <h2>${data.project.title}</h2>
                                    <p class="project-category">${data.project.category}</p>
                                </div>
                                <div class="project-modal-image">
                                    <img src="${data.project.image_url}" alt="${data.project.title}">
                                </div>
                                <div class="project-modal-details">
                                    <div class="project-description">
                                        <h3>Project Overview</h3>
                                        <p>${data.project.description}</p>
                                    </div>
                                    <div class="project-meta">
                                        <div class="meta-item">
                                            <h4>Client</h4>
                                            <p>${data.project.client}</p>
                                        </div>
                                        <div class="meta-item">
                                            <h4>Year</h4>
                                            <p>${new Date(data.project.created_at).getFullYear()}</p>
                                        </div>
                                        <div class="meta-item">
                                            <h4>Technologies</h4>
                                            <div class="tech-badges">
                                                ${data.project.technologies.split(',').map(tech => 
                                                    `<span class="tech-badge">${tech.trim()}</span>`
                                                ).join('')}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                ${data.project.live_url ? `
                                <div class="project-links">
                                    <a href="${data.project.live_url}" target="_blank" class="project-link">Visit Website</a>
                                </div>
                                ` : ''}
                            `;
                            
                            // Show modal
                            projectModal.classList.remove('hidden');
                            document.body.style.overflow = 'hidden'; // Prevent scrolling
                        } else {
                            console.error('Error fetching project details');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            });
        });
        
        // Close modal when clicking close button
        if (modalClose) {
            modalClose.addEventListener('click', function() {
                projectModal.classList.add('hidden');
                document.body.style.overflow = 'auto'; // Enable scrolling
            });
        }
        
        // Close modal when clicking outside
        window.addEventListener('click', function(event) {
            if (event.target === projectModal) {
                projectModal.classList.add('hidden');
                document.body.style.overflow = 'auto'; // Enable scrolling
            }
        });
        
        // Set default date to tomorrow for booking form
        const dateInput = document.getElementById('booking-date');
        if (dateInput) {
            const tomorrow = new Date();
            tomorrow.setDate(tomorrow.getDate() + 1);
            const formattedDate = tomorrow.toISOString().split('T')[0];
            dateInput.setAttribute('min', formattedDate);
            dateInput.value = formattedDate;
        }
        
        // Expose openBookingModal globally
        window.openBookingModal = openBookingModal;
        window.closeBookingModal = closeBookingModal;
    });
</script>

<?php include(ROOT_PATH . '/includes/footer.php'); ?>
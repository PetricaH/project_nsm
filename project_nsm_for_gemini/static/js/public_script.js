// Encapsulate the script in an IIFE (Immediately Invoked Function Expression)
(function () {
    // Define all the API endpoints in one place for easy reference
    const API_ENDPOINTS = {
        artworks: '/admin/admin_includes/artworks_actions/get_artworks.php', // For loading artworks
        register: '/includes/register_handler.php', // For handling user registration
        login: '/includes/login_handler.php', // For handling user login
    };

    // Store commonly accessed DOM elements to reduce repetitive queries
    const domElements = {
        menuToggle: document.getElementById('menu_toggle'), // Button to toggle menu
        navMenu: document.getElementById('nav_menu'), // The navigation menu
        artworksGrid: document.getElementById('artworksGrid'), // Container for artworks
        loginFormWrapper: document.getElementById('loginFormWrapper'), // Login form wrapper
        registerFormWrapper: document.getElementById('registerFormWrapper'), // Register form wrapper
        showRegisterFormButton: document.getElementById('showRegisterForm'), // Button to show register form
        showLoginFormButton: document.getElementById('showLoginForm'), // Button to show login form
    };

    const menuItems = domElements.navMenu ? Array.from(domElements.navMenu.querySelectorAll('li')) : [];

    /**
     * Utility function to perform an API call and return the response as JSON
     * @param {string} url - The URL of the API
     * @param {object} options - Fetch options (method, body, etc.)
     * @returns {Promise<object>} - Parsed JSON response from the server
     */
    async function fetchData(url, options = {}) {
        try {
            const response = await fetch(url, options);
            const text = await response.text(); // Get raw response for debugging
    
            if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
            return JSON.parse(text); // Parse JSON
        } catch (error) {
            console.error(`Error fetching data from ${url}:`, error);
            throw error;
        }
    }    

    /**
     * Toggles the visibility of the navigation menu
     * Triggered when the menu toggle button is clicked
     */
    function initMenuToggle() {
        const { menuToggle, navMenu } = domElements;
    
        if (menuToggle && navMenu) {
            const menuItems = navMenu.querySelectorAll('a'); // select all <a> elements from the menu
            const forms = navMenu.querySelectorAll('form'); // select all the forms from the menu

            menuToggle.addEventListener('click', () => {
                const isOpening = !navMenu.classList.contains('active');
                navMenu.classList.toggle('active'); // Show/hide the menu
                menuToggle.classList.toggle('open'); // Change button appearance
    
                if (isOpening) {
                    // Add animations to menu items when the menu opens
                    menuItems.forEach((item, index) => {
                        item.style.animation = `fadeInUp 0.5s ease forwards ${0.5 + index * 0.1}s`;
                    });
                }
            });

            // close menu when any menu item is clicked
            menuItems.forEach((item) => {
                item.addEventListener('click', () => {
                    navMenu.classList.remove('active');
                    menuToggle.classList.remove('open');
                });
            });

            // prevent menu from closing when interacting with forms
            forms.forEach((form) => {
                form.addEventListener('click', (event) => {
                    event.stopPropagation(); // stop event from bubbling to parent <li>
                });

                // close menu when the form is submitted 
                form.addEventListener('submit', () => {
                    navMenu.classList.remove('active');
                    menuToggle.classList.remove('open');
                });
            });
        } else {
            console.error('Menu toggle or navigation menu is not defined.');
        }
    }    

    /**
     * Handles switching between login and register forms
     */
    function initFormSwitching() {
        const {
            loginFormWrapper,
            registerFormWrapper,
            showRegisterFormButton,
            showLoginFormButton,
        } = domElements;

        if (loginFormWrapper && registerFormWrapper && showRegisterFormButton && showLoginFormButton) {
            // show register form
            showRegisterFormButton.addEventListener('click', () => {
                loginFormWrapper.classList.remove('active');
                registerFormWrapper.classList.add('active');
            });

            // show login form
            showLoginFormButton.addEventListener('click', () => {
                registerFormWrapper.classList.remove('active');
                loginFormWrapper.classList.add('active');
            });
        } else {
            console.error('Form switching elements are not defined.');
        }
    }

    /**
     * Fetches and displays the first six artworks in the grid
     * Dynamically populates the page with data from the server
     */
    async function loadArtworksOnPageLoad() {
        const { artworksGrid } = domElements;

        try {
            const data = await fetchData(API_ENDPOINTS.artworks); // Fetch artworks
            if (data.success && artworksGrid) {
                artworksGrid.innerHTML = ''; // Clear existing artworks
                // Display up to six artworks
                data.artworks.slice(0, 6).forEach((artwork) => {
                    const div = document.createElement('div');
                    div.className = 'artwork';
                    div.innerHTML = `
                        <img src="${artwork.image}" alt="${artwork.title}">
                        <h3>${artwork.title}</h3>
                    `;
                    artworksGrid.appendChild(div); // Add to the grid
                });
            }
        } catch (error) {
            console.error('Error loading artworks:', error);
        }
    }

    /**
     * Handles user registration form submission
     * Sends the form data to the server and provides feedback to the user
     * @param {HTMLFormElement} form - The registration form
     */
    function initRegisterForm(form) {
        form.addEventListener('submit', async (event) => {
            event.preventDefault();
            const formData = new FormData(form); // Gather form data

            try {
                const data = await fetchData(API_ENDPOINTS.register, { method: 'POST', body: formData });
    
                if (data.success) {
                    // Clear form fields after successful registration
                    form.reset(); 
    
                    // Optionally, display a success message to the user
                    alert('Registration successful!'); 

                } else {
                    alert(data.error || 'An error occurred.');
                }
            } catch (error) {
                console.error('Error during registration:', error);
            }
        });
    }

    /**
     * Handles user login form submission
     * Sends the form data to the server and logs in the user if successful
     * @param {HTMLFormElement} form - The login form
     */
    function initLoginForm(form) {
        form.addEventListener('submit', async (event) => {
            event.preventDefault(); // Prevent the default form submission
            const formData = new FormData(form); // Gather form data
    
            try {
                const data = await fetchData(API_ENDPOINTS.login, { method: 'POST', body: formData });
    
                if (data.success) {
                    window.location.reload(); // Reload the page to reflect the login
                } else {
                    alert(data.error || 'Invalid credentials.'); // Show error message for failed login
                }
            } catch (error) {
                console.error('Error during login:', error);
            }
        });
    }

    /**
     * Initializes all the functionality on the page
     * Called when the DOM content is fully loaded
     */
    function init() {
        initMenuToggle(); // Set up menu toggle functionality
        initFormSwitching(); // Set up login/register form switching
        loadArtworksOnPageLoad(); // Load and display artworks

        // Check if the registration form exists and initialize it
        const registerForm = document.getElementById('registerForm');
        if (registerForm) initRegisterForm(registerForm);

        // Check if the login form exists and initialize it
        const loginForm = document.getElementById('loginForm');
        if (loginForm) initLoginForm(loginForm);
    }

    document.querySelectorAll('.card').forEach(card => {
        card.addEventListener('mousemove', (e) => {
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            
            card.style.setProperty('--x', `${x}px`);
            card.style.setProperty('--y', `${y}px`);
        });
    });
    // Run the initialization function when the DOM content is loaded
    document.addEventListener('DOMContentLoaded', init);
})();

document.addEventListener('DOMContentLoaded', function() {
    // Get the menu toggle and nav menu elements
    const menuToggle = document.getElementById('menu_toggle');
    const navMenu = document.getElementById('nav_menu');
    
    if (menuToggle && navMenu) {
        // Add click event listener to menu toggle
        menuToggle.addEventListener('click', function(e) {
            console.log("Menu toggle clicked");
            
            // Toggle open class on menu toggle
            this.classList.toggle('open');
            console.log("Menu toggle has 'open' class:", this.classList.contains('open'));
            
            // Toggle active class on nav menu
            navMenu.classList.toggle('active');
            console.log("Nav menu has 'active' class:", navMenu.classList.contains('active'));
            
            // Log the computed style of nav menu to see if it's actually changing
            const computedStyle = window.getComputedStyle(navMenu);
            console.log("Nav menu transform:", computedStyle.transform);
            console.log("Nav menu display:", computedStyle.display);
            console.log("Nav menu visibility:", computedStyle.visibility);
            console.log("Nav menu opacity:", computedStyle.opacity);
            
            // Prevent default behavior to ensure the click event isn't being intercepted
            e.preventDefault();
        });
    } else {
        console.error("Menu toggle or nav menu element not found!");
    }
});

/* Simple case study switching script */
document.addEventListener('DOMContentLoaded', function() {
    const navButtons = document.querySelectorAll('.case-nav-btn');
    const caseStudies = document.querySelectorAll('.case-study-container');
    
    navButtons.forEach(button => {
        button.addEventListener('click', function() {
            const studyId = this.getAttribute('data-study');
            
            // Update active button
            navButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            
            // Show selected case study
            caseStudies.forEach(study => {
                if (study.id === `${studyId}-case`) {
                    study.classList.add('active');
                } else {
                    study.classList.remove('active');
                }
            });
        });
    });
});

// Add this to your public_script.js file or create a new file case-studies.js

document.addEventListener('DOMContentLoaded', function() {
    // Case study navigation
    const navButtons = document.querySelectorAll('.case-nav-btn');
    const caseStudies = document.querySelectorAll('.case-study-container');
    
    if (navButtons.length > 0 && caseStudies.length > 0) {
        navButtons.forEach(button => {
            button.addEventListener('click', function() {
                const studyId = this.getAttribute('data-study');
                
                // Update active button
                navButtons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
                
                // Show selected case study with animation
                caseStudies.forEach(study => {
                    study.style.opacity = '0';
                    
                    setTimeout(() => {
                        study.classList.remove('active');
                        if (study.id === `${studyId}-case`) {
                            study.classList.add('active');
                            setTimeout(() => {
                                study.style.opacity = '1';
                            }, 50);
                        }
                    }, 300);
                });
            });
        });
    }
    
    // Create placeholder SVG diagrams if they don't exist
    const diagramPlaceholders = document.querySelectorAll('.diagram-placeholder');
    
    diagramPlaceholders.forEach(placeholder => {
        if (!placeholder.getAttribute('src') || placeholder.getAttribute('src').includes('placeholder')) {
            // Create a simple placeholder diagram with SVG
            createPlaceholderDiagram(placeholder);
        }
    });
    
    function createPlaceholderDiagram(element) {
        // Get the parent container dimensions
        const container = element.parentElement;
        const width = container.offsetWidth || 600;
        const height = 300;
        
        // Create an SVG string with a basic workflow diagram
        const svgId = element.getAttribute('alt').includes('E-Commerce') ? 'ecommerce' : 'samples';
        
        let svgContent = '';
        
        if (svgId === 'ecommerce') {
            svgContent = `
            <svg width="${width}" height="${height}" viewBox="0 0 ${width} ${height}" xmlns="http://www.w3.org/2000/svg">
                <style>
                    .box { fill: rgba(70, 130, 180, 0.1); stroke: rgba(70, 130, 180, 0.3); stroke-width: 1; }
                    .arrow { stroke: rgba(70, 130, 180, 0.5); stroke-width: 1.5; }
                    .text { fill: #AAAAAA; font-family: sans-serif; font-size: 12px; text-anchor: middle; }
                    .node-title { fill: #FFFFFF; font-family: sans-serif; font-size: 14px; text-anchor: middle; }
                </style>
                
                <!-- Website Node -->
                <rect class="box" x="50" y="70" width="120" height="60" rx="2" />
                <text class="node-title" x="110" y="95">Website</text>
                <text class="text" x="110" y="115">CUI Verification</text>
                
                <!-- Arrow 1 -->
                <line class="arrow" x1="170" y1="100" x2="220" y2="100" />
                <polygon points="220,95 230,100 220,105" fill="rgba(70, 130, 180, 0.5)" />
                
                <!-- Verification Node -->
                <rect class="box" x="230" y="70" width="120" height="60" rx="2" />
                <text class="node-title" x="290" y="95">Verification</text>
                <text class="text" x="290" y="115">Database Check</text>
                
                <!-- Arrow 2 -->
                <line class="arrow" x1="350" y1="100" x2="400" y2="100" />
                <polygon points="400,95 410,100 400,105" fill="rgba(70, 130, 180, 0.5)" />
                
                <!-- Request Node -->
                <rect class="box" x="410" y="70" width="120" height="60" rx="2" />
                <text class="node-title" x="470" y="95">Request System</text>
                <text class="text" x="470" y="115">Products/Technical</text>
                
                <!-- Arrow Down -->
                <line class="arrow" x1="470" y1="130" x2="470" y2="170" />
                <polygon points="465,170 470,180 475,170" fill="rgba(70, 130, 180, 0.5)" />
                
                <!-- Staff Node -->
                <rect class="box" x="410" y="180" width="120" height="60" rx="2" />
                <text class="node-title" x="470" y="205">Staff</text>
                <text class="text" x="470" y="225">Notification</text>
                
                <!-- Connected Systems -->
                <rect class="box" x="50" y="180" width="120" height="60" rx="2" />
                <text class="node-title" x="110" y="205">Brevo API</text>
                <text class="text" x="110" y="225">Email Verification</text>
                
                <rect class="box" x="230" y="180" width="120" height="60" rx="2" />
                <text class="node-title" x="290" y="205">Database</text>
                <text class="text" x="290" y="225">Client Records</text>
                
                <!-- Connection Lines -->
                <line class="arrow" x1="110" y1="180" x2="110" y2="140" />
                <line class="arrow" x1="110" y1="140" x2="290" y2="140" />
                <line class="arrow" x1="290" y1="140" x2="290" y2="180" />
                
                <line class="arrow" x1="290" y1="180" x2="290" y2="150" />
                <line class="arrow" x1="290" y1="150" x2="410" y2="150" />
            </svg>`;
        } else {
            svgContent = `
            <svg width="${width}" height="${height}" viewBox="0 0 ${width} ${height}" xmlns="http://www.w3.org/2000/svg">
                <style>
                    .box { fill: rgba(70, 130, 180, 0.1); stroke: rgba(70, 130, 180, 0.3); stroke-width: 1; }
                    .arrow { stroke: rgba(70, 130, 180, 0.5); stroke-width: 1.5; }
                    .text { fill: #AAAAAA; font-family: sans-serif; font-size: 12px; text-anchor: middle; }
                    .node-title { fill: #FFFFFF; font-family: sans-serif; font-size: 14px; text-anchor: middle; }
                </style>
                
                <!-- Form Node -->
                <rect class="box" x="50" y="70" width="120" height="60" rx="2" />
                <text class="node-title" x="110" y="95">Request Form</text>
                <text class="text" x="110" y="115">Sales Agent</text>
                
                <!-- Arrow 1 -->
                <line class="arrow" x1="170" y1="100" x2="220" y2="100" />
                <polygon points="220,95 230,100 220,105" fill="rgba(70, 130, 180, 0.5)" />
                
                <!-- Database Node -->
                <rect class="box" x="230" y="70" width="120" height="60" rx="2" />
                <text class="node-title" x="290" y="95">Database</text>
                <text class="text" x="290" y="115">Request Storage</text>
                
                <!-- Arrow 2 -->
                <line class="arrow" x1="350" y1="100" x2="400" y2="100" />
                <polygon points="400,95 410,100 400,105" fill="rgba(70, 130, 180, 0.5)" />
                
                <!-- Zapier Node -->
                <rect class="box" x="410" y="70" width="120" height="60" rx="2" />
                <text class="node-title" x="470" y="95">Zapier</text>
                <text class="text" x="470" y="115">Automation Hub</text>
                
                <!-- Arrows to channels -->
                <line class="arrow" x1="470" y1="130" x2="470" y2="150" />
                <line class="arrow" x1="470" y1="150" x2="350" y2="150" />
                <line class="arrow" x1="470" y1="150" x2="590" y2="150" />
                
                <line class="arrow" x1="350" y1="150" x2="350" y2="170" />
                <polygon points="345,170 350,180 355,170" fill="rgba(70, 130, 180, 0.5)" />
                
                <line class="arrow" x1="590" y1="150" x2="590" y2="170" />
                <polygon points="585,170 590,180 595,170" fill="rgba(70, 130, 180, 0.5)" />
                
                <!-- Email Node -->
                <rect class="box" x="290" y="180" width="120" height="60" rx="2" />
                <text class="node-title" x="350" y="205">Email</text>
                <text class="text" x="350" y="225">Client Notification</text>
                
                <!-- WhatsApp Node -->
                <rect class="box" x="530" y="180" width="120" height="60" rx="2" />
                <text class="node-title" x="590" y="205">WhatsApp</text>
                <text class="text" x="590" y="225">Messaggio API</text>
                
                <!-- Webhook Node -->
                <rect class="box" x="410" y="180" width="120" height="60" rx="2" />
                <text class="node-title" x="470" y="205">Webhook</text>
                <text class="text" x="470" y="225">Response Capture</text>
                
                <!-- Final Arrow -->
                <line class="arrow" x1="470" y1="240" x2="470" y2="260" />
                <polygon points="465,260 470,270 475,260" fill="rgba(70, 130, 180, 0.5)" />
                
                <!-- Marketing Node -->
                <rect class="box" x="410" y="270" width="120" height="60" rx="2" />
                <text class="node-title" x="470" y="295">Brevo</text>
                <text class="text" x="470" y="315">Marketing Automation</text>
            </svg>`;
        }
        
        // Create a data URI for the SVG
        const svgDataUri = 'data:image/svg+xml;charset=utf-8,' + encodeURIComponent(svgContent);
        
        // Set the src attribute of the image
        element.setAttribute('src', svgDataUri);
    }
});
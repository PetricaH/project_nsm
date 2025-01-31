// Encapsulate the script in an IIFE (Immediately Invoked Function Expression)
(function () {
    // Define all the API endpoints in one place for easy reference
    const API_ENDPOINTS = {
        artworks: '/project_nsm/admin/admin_includes/artworks_actions/get_artworks.php', // For loading artworks
        register: '/project_nsm/includes/register_handler.php', // For handling user registration
        login: '/project_nsm/includes/login_handler.php', // For handling user login
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

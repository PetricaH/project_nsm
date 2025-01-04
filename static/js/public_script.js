// Encapsulate the script in an IIFE (Immediately Invoked Function Expression)
(function () {
    // Define all the API endpoints in one place for easy reference
    const API_ENDPOINTS = {
        artworks: '/project_nsm/admin/admin_includes/artworks_actions/get_artworks.php', // For loading artworks
        register: '../includes/register_handler.php', // For handling user registration
        login: '../includes/login_handler.php', // For handling user login
    };

    // Store commonly accessed DOM elements to reduce repetitive queries
    const domElements = {
        menuToggle: document.getElementById('menu_toggle'), // Button to toggle menu
        navMenu: document.getElementById('nav_menu'), // The navigation menu
        artworksGrid: document.getElementById('artworksGrid'), // Container for artworks
        registerModal: document.getElementById('registerModal'), // Registration modal
        loginModal: document.getElementById('loginModal'), // Login modal
    };

    /**
     * Utility function to perform an API call and return the response as JSON
     * @param {string} url - The URL of the API
     * @param {object} options - Fetch options (method, body, etc.)
     * @returns {Promise<object>} - Parsed JSON response from the server
     */
    async function fetchData(url, options = {}) {
        try {
            const response = await fetch(url, options); // Make the API call
            if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
            return await response.json(); // Parse and return JSON data
        } catch (error) {
            console.error(`Error fetching data from ${url}:`, error);
            throw error; // Re-throw the error for handling in calling function
        }
    }

    /**
     * Toggles the visibility of the navigation menu
     * Triggered when the menu toggle button is clicked
     */
    function initMenuToggle() {
        const { menuToggle, navMenu } = domElements;

        if (menuToggle && navMenu) {
            menuToggle.addEventListener('click', () => {
                navMenu.classList.toggle('active'); // Show/hide the menu
                menuToggle.classList.toggle('open'); // Change button appearance
            });
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
            event.preventDefault(); // Prevent the default form submission
            const formData = new FormData(form); // Gather form data

            try {
                const data = await fetchData(API_ENDPOINTS.register, { method: 'POST', body: formData });
                if (data.success) {
                    alert('Registration successful!'); // Show success message
                    toggleRegisterModal(); // Hide the registration modal
                } else {
                    alert(data.error || 'An error occurred.'); // Show error message
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
                    alert('Login successful!'); // Show success message
                    window.location.reload(); // Reload the page to reflect the login
                } else {
                    alert(data.error || 'Invalid credentials.'); // Show error message
                }
            } catch (error) {
                console.error('Error during login:', error);
            }
        });
    }

    /**
     * Toggles the visibility of the registration modal
     */
    function toggleRegisterModal() {
        const registerModal = domElements.registerModal;
        if (registerModal) {
            registerModal.classList.toggle('hidden');
        } else {
            console.error("Register modal not found!");
        }
    }

    /**
     * Toggles the visibility of the login modal
     */
    function toggleLoginModal() {
        const loginModal = domElements.loginModal;
        if (loginModal) {
            loginModal.classList.toggle('hidden');
        } else {
            console.error("Login modal not found!");
        }
    }

    /**
     * Initializes all the functionality on the page
     * Called when the DOM content is fully loaded
     */
    function init() {
        initMenuToggle(); // Set up menu toggle functionality
        loadArtworksOnPageLoad(); // Load and display artworks

        // Check if the registration form exists and initialize it
        const registerForm = document.getElementById('registerForm');
        if (registerForm) initRegisterForm(registerForm);

        // Check if the login form exists and initialize it
        const loginForm = document.getElementById('loginForm');
        if (loginForm) initLoginForm(loginForm);

        // Add event listeners for toggling modals
        const loginToggle = document.getElementById('loginToggle');
        const registerToggle = document.getElementById('registerToggle');

        if (loginToggle) {
            loginToggle.addEventListener('click', toggleLoginModal);
        }

        if (registerToggle) {
            registerToggle.addEventListener('click', toggleRegisterModal);
        }
    }

    // Run the initialization function when the DOM content is loaded
    document.addEventListener('DOMContentLoaded', init);
})();

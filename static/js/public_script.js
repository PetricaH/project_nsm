// Main DOMContentLoaded event
document.addEventListener('DOMContentLoaded', () => {
    initMenuToggle();
    loadArtworksOnPageLoad();

    const registerForm = document.getElementById('registerForm');
    if (registerForm) {
        initRegisterForm(registerForm);
    }

    const loginForm = document.getElementById('loginForm');
    if (loginForm) {
        initLoginForm(loginForm);
    }

    const registerModalToggle = document.getElementById('registerModalToggle');
    if (registerModalToggle) {
        registerModalToggle.addEventListener('click', toggleRegisterModal);
    }

    const loginModalToggle = document.getElementById('loginModalToggle');
    if (loginModalToggle) {
        loginModalToggle.addEventListener('click', toggleLoginModal);
    }
});

// Handle toggle functionality of the menu
function initMenuToggle() {
    const menuToggle = document.getElementById('menu_toggle');
    const navMenu = document.getElementById('nav_menu');

    if (menuToggle && navMenu) {
        menuToggle.addEventListener('click', () => {
            navMenu.classList.toggle('active');
            menuToggle.classList.toggle('open');
        });
    }
}

// Load artworks dynamically
function loadArtworksOnPageLoad() {
    async function loadArtworks() {
        try {
            const url = '../admin/admin_includes/get_artworks.php'; // Corrected path
            console.log(`Fetching artworks from: ${url}`);

            const response = await fetch(url);

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const data = await response.json();

            if (data.success) {
                const artworks = data.artworks;
                const grid = document.getElementById('artworksGrid');
                if (grid) {
                    grid.innerHTML = ''; // Clear grid before inserting new artworks

                    // Display up to 6 artworks
                    artworks.slice(0, 6).forEach((artwork) => {
                        const div = document.createElement('div');
                        div.className = 'artwork';
                        div.innerHTML = `
                            <img src="${artwork.image}" alt="${artwork.title}">
                            <h3>${artwork.title}</h3>
                        `;
                        grid.appendChild(div);
                    });
                }
            } else {
                console.error('No artworks found');
            }
        } catch (error) {
            console.error('Error fetching artworks:', error);
        }
    }

    loadArtworks(); // Call the function
}

// Initialize register form submission
function initRegisterForm(form) {
    form.addEventListener('submit', async (event) => {
        event.preventDefault();
        const formData = new FormData(form);

        try {
            const response = await fetch('../includes/register_handler.php', {
                method: 'POST',
                body: formData,
            });
            const data = await response.json();

            if (data.success) {
                alert('Registration successful!');
                toggleRegisterModal();
            } else {
                alert(data.error || "An error occurred.");
            }
        } catch (error) {
            console.error('Error during registration:', error);
        }
    });
}

// Initialize login form submission
function initLoginForm(form) {
    form.addEventListener('submit', async (event) => {
        event.preventDefault();
        const formData = new FormData(form);

        try {
            const response = await fetch('../includes/login_handler.php', {
                method: 'POST',
                body: formData,
            });
            const result = await response.json();

            if (result.success) {
                alert('Login successful!');
                window.location.reload();
            } else {
                alert(result.error || 'Invalid credentials.');
            }
        } catch (error) {
            console.error('Error during login:', error);
        }
    });
}

// Toggle register modal visibility
function toggleRegisterModal() {
    const modal = document.getElementById('registerModal');
    if (modal) {
        modal.classList.toggle('hidden');
    } else {
        console.error('Register modal not found in the DOM.');
    }
}

// Toggle login modal visibility
function toggleLoginModal() {
    const modal = document.getElementById('loginModal');
    if (modal) {
        modal.classList.toggle('hidden');
    } else {
        console.error('Login modal not found in the DOM.');
    }
}

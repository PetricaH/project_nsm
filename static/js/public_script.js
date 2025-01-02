// Main DOMContentLoaded event
document.addEventListener('DOMContentLoaded', () => {
    initMenuToggle();
    loadArtworksOnPageLoad();
    toggleRegisterModal();
    toggleLoginModal();
    // Add other initializations here
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
            const url = '../admin/admin_includes/get_artworks.php'; // Corrected path to get_artworks.php
            console.log(`Fetching artworks from: ${url}`);

            const response = await fetch(url);

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const data = await response.json();

            if (data.success) {
                const artworks = data.artworks;
                const grid = document.getElementById('artworksGrid');
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
            } else {
                console.error('No artworks found');
            }
        } catch (error) {
            console.error('Error fetching artworks:', error);
        }
    }

    loadArtworks(); // Call the function
}

// function to show register form

document.getElementById('registerForm').addEventListener('submit', function (event) {
    event.preventDefault();
    const formData = new formData(this);

    fetch('register_handler.php', {
        method: 'POST',
        body: formData,
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Registration successful!');
            toggleRegisterModal();
        } else {
            alert(data.error || "An error occured");
        }
    })
    .catch(error => console.error('Error:', error));
});

function toggleRegisterModal() {
    const modal = document.getElementById('registerModal');
    modal.classList.toggle('hidden');
}

// function to make login form work :D
document.getElementById('loginForm').addEventListener('submit', async (Event) => {
    Event.preventDefault();
    const formData = new FormData(Event.target);

    try {
        const response = await fetch('login_handler.php', {
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

function toggleLoginModal() {
    const modal = document.getElementById('loginModal');
    modal.classList.toggle('hidden');
}

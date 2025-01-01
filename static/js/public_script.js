// Handle toggle functionality of the menu
document.addEventListener('DOMContentLoaded', () => {
    const menuToggle = document.getElementById('menu_toggle');
    const navMenu = document.getElementById('nav_menu');

    // Toggle menu visibility
    menuToggle.addEventListener('click', () => {
        navMenu.classList.toggle('active');
        menuToggle.classList.toggle('open');
    });
});
    // Load artworks dynamically
    document.addEventListener('DOMContentLoaded', () => {
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

    // Load artworks on window load
    window.onload = loadArtworks;
});

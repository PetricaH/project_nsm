document.addEventListener("DOMContentLoaded", () => {
    const BASE_URL = `${window.location.origin}${window.location.pathname.split('/').slice(0, -1).join('/')}/`;
    const links = document.querySelectorAll(".tab");
    const mainContent = document.querySelector(".main_content");

    // Load the default page and CSS on first load
    const defaultPage = "manage_bookings"; // Default page
    loadPage(defaultPage);

    // Handle sidebar navigation clicks
    links.forEach(link => {
        link.addEventListener("click", (e) => {
            e.preventDefault();
            const page = link.getAttribute("href").split("=")[1];
            loadPage(page);

            // Highlight the active link
            links.forEach(l => l.classList.remove("active"));
            link.classList.add("active");
        });
    });

    function loadPage(page) {
        // Fetch the content of the page
        fetch(`${BASE_URL}${page}.php`)
            .then(response => {
                if (!response.ok) throw new Error("Page not found");
                return response.text();
            })
            .then(data => {
                // Insert the content into the main_content div
                mainContent.innerHTML = data;

                // Load the CSS for the specific page
                loadPageCSS(page);

                // Initialize page-specific JavaScript
                initializePageScripts(page);
            })
            .catch(error => {
                mainContent.innerHTML = `<h1>${error.message}</h1>`;
                console.error(error);
            });
    }

    function loadPageCSS(page) {
        // Map page names to specific CSS file names if they don't match directly
        const cssFileMap = {
            manage_artwork: "manage_artworks.css",
            manage_bookings: "manage_bookings.css",
            manage_users: "manage_users.css",
            manage_blog: "manage_blog.css",
        };

        // Remove any existing page-specific CSS
        const existingCSS = document.getElementById("page-specific-css");
        if (existingCSS) {
            existingCSS.remove();
        }

        // Determine the correct CSS file name
        const cssFileName = cssFileMap[page] || `${page}.css`;

        // Add the new page-specific CSS
        const linkElement = document.createElement("link");
        linkElement.id = "page-specific-css";
        linkElement.rel = "stylesheet";
        linkElement.type = "text/css";
        linkElement.href = `../admin/admin_styles/${cssFileName}`;

        document.head.appendChild(linkElement);
    }

    function initializePageScripts(page) {
        switch (page) {
            case "manage_artworks":
                console.log("Artwork management script skipped. Handled by artwork.js");
                break;
            case "manage_bookings":
                initializeBookingManagement();
                break;
            case "manage_users":
                initializeUserManagement();
                break;
            case "manage_blog":
                initializeBlogManagement();
                break;
            default:
                console.error("No specific scripts for this page.");
        }
    }

    function initializeBookingManagement() {
        console.log("Booking management scripts initialized.");
    }

    function initializeUserManagement() {
        console.log("User management scripts initialized.");
    }

    function initializeBlogManagement() {
        console.log("Blog management scripts initialized.");
    }
});

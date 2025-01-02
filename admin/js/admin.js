document.addEventListener("DOMContentLoaded", () => {
    const BASE_URL = `${window.location.origin}${window.location.pathname.split('/').slice(0, -1).join('/')}/`;
    const links = document.querySelectorAll(".tab");
    const mainContent = document.querySelector(".main_content");

    // Load the default page and CSS on first load
    const defaultPage = "manage_users"; // Default page
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
                initializeArtworkManagement();
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

    function initializeArtworkManagement() {
        console.log("Artwork management scripts initialized.");
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
    

    const dropZone = document.getElementById("drop_zone");
    const fileInput = document.getElementById("image");
    const preview = document.getElementById("preview");

    dropZone.addEventListener("dragover", (e) => {
        e.preventDefault();
        dropZone.classList.add("dragging");
    });

    dropZone.addEventListener("dragleave", () => {
        dropZone.classList.remove("dragging");
    });

    dropZone.addEventListener("drop", (e) => {
        e.preventDefault();
        dropZone.classList.remove("dragging");

        const files = e.dataTransfer.files;
        if (files.length > 0) {
            fileInput.files = files;
            previewImage(files[0]);
        }
    });

    fileInput.addEventListener("change", (e) => {
        if (e.target.files.length > 0) {
            previewImage(e.target.files[0]);
        }
    });

    function previewImage(file) {
        preview.innerHTML = "";
        if (file && file.type.startsWith("image/")) {
            const img = document.createElement("img");
            img.src = URL.createObjectURL(file);
            img.alt = "Preview";
            img.style.maxWidth = "100%";
            img.style.maxHeight = "200px";
            preview.appendChild(img);

            const fileName = document.createElement("p");
            fileName.textContent = `Selected file: ${file.name}`;
            fileName.style.marginTop = "10px";
            fileName.style.fontSize = ".9em";
            fileName.style.color = "#333";
            preview.appendChild(fileName);

            const clearBtn = document.createElement("button");
            clearBtn.textContent = "Delete Image";
            clearBtn.style.marginTop = "10px";
            clearBtn.addEventListener("click", () => {
                fileInput.value = "";
                preview.innerHTML = "";
            });
            preview.appendChild(clearBtn);
        } else {
            preview.innerHTML = "<p>Invalid file</p>";
        }
    }

    fetchArtworks();

    function fetchArtworks() {
        fetch("./admin_includes/get_artworks.php")
            .then((response) => response.json())
            .then((data) => {
                if (data.success) {
                    const container = document.getElementById("artworks_container");
                    container.innerHTML = "";
                    data.artworks.forEach((artwork) => {
                        addArtworkToGallery(artwork.title, artwork.image, artwork.id);
                    });
                } else {
                    console.error(data.message);
                }
            })
            .catch((error) => {
                console.error("Error fetching artworks:", error);
            });
    }

    function addArtworkToGallery(title, imageUrl, id) {
        const container = document.getElementById("artworks_container");

        const artworkCard = document.createElement("div");
        artworkCard.classList.add("artwork_card");

        const img = document.createElement("img");
        img.src = imageUrl;
        img.alt = title;

        const titleElem = document.createElement("div");
        titleElem.classList.add("artwork_title");
        titleElem.textContent = title;

        const deleteBtn = document.createElement("button");
        deleteBtn.textContent = "Delete";
        deleteBtn.classList.add("delete_button");
        deleteBtn.addEventListener("click", () => deleteArtwork(id, artworkCard));

        artworkCard.appendChild(img);
        artworkCard.appendChild(titleElem);
        artworkCard.appendChild(deleteBtn);

        container.appendChild(artworkCard);
    }

    function deleteArtwork(id, cardElement) {
        if (confirm("Are you sure you want to delete this artwork?")) {
            fetch("./admin_includes/delete_artwork.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: `id=${id}`,
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        alert(data.message);
                        cardElement.remove();
                    } else {
                        alert(data.message);
                    }
                })
                .catch((error) => {
                    console.error("Error deleting artwork:", error);
                });
        }
    }

    document.getElementById("manage_artwork_form").addEventListener("submit", function (event) {
        event.preventDefault();
        const formData = new FormData(this);
        const xhr = new XMLHttpRequest();

        xhr.open("POST", "./admin_includes/post_artwork.php", true);
        xhr.onload = function () {
            if (xhr.status === 200) {
                try {
                    const response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        showNotification("Artwork uploaded successfully!");
                        addArtworkToGallery(formData.get("title"), response.imageUrl);

                        document.getElementById("title").value = "";
                        document.getElementById("image").value = "";
                        document.getElementById("date").value = "";
                        document.getElementById("preview").innerHTML = "";
                    } else {
                        showNotification("Failed to upload artwork: " + response.message, true);
                    }
                } catch (error) {
                    showNotification("An unexpected error occurred.", true);
                }
            } else {
                showNotification("An error occurred while uploading.", true);
            }
        };

        xhr.send(formData);
    });

    function showNotification(message, isError = false) {
        const notification = document.getElementById("notification");
        const messageElement = document.getElementById("notificationMessage");

        notification.classList.remove("hidden", "error", "show");
        notification.style.backgroundColor = isError ? "#f44336" : "#4caf50";
        messageElement.textContent = message;

        setTimeout(() => {
            notification.classList.add("show");
        }, 10);

        setTimeout(() => {
            notification.classList.remove("show");
        }, 5000);
    }

    function closeNotification() {
        const notification = document.getElementById("notification");
        notification.classList.remove("show");
    }
    
});

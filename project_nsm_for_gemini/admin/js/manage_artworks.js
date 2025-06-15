document.addEventListener("DOMContentLoaded", () => {
    // Check if the current page is 'manage_artwork'
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('page') !== 'manage_artwork') {
        console.log("Not on the manage_artwork page. Exiting script.");
        return; // Exit if not on the 'manage_artwork' page
    }

    console.log("manage_artworks.js loaded for manage_artwork page.");

    // Use MutationObserver to handle dynamically loaded content
    const observer = new MutationObserver(() => {
        const dropZone = document.getElementById("drop_zone");
        if (dropZone) {
            console.log("dropZone element found. Initializing script...");
            initializeDropZone(); // Call the initialization function
            observer.disconnect(); // Stop observing after the element is found
        }
    });

    observer.observe(document.body, { childList: true, subtree: true });

    function initializeDropZone() {
        const dropZone = document.getElementById("drop_zone");
        const fileInput = document.getElementById("image");
        const preview = document.getElementById("preview");
        const form = document.getElementById("manage_artwork_form");

        // Drag-and-drop functionality
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

        // Handle form submission for posting artwork
        form.addEventListener("submit", (e) => {
            e.preventDefault(); // Prevent default form submission behavior

            const formData = new FormData(form); // Gather form data

            // Send the POST request to save the artwork
            fetch("../admin/admin_includes/artworks_actions/post_artwork.php", {
                method: "POST",
                body: formData,
            })
                .then((response) => response.json())
                .then((data) => {
                    const notification = document.getElementById("notification");
                    const notificationMessage = document.getElementById("notificationMessage");

                    if (data.success) {
                        notificationMessage.textContent = data.message;
                        notification.classList.add("show");
                        notification.classList.remove("hidden");
                        form.reset(); // Clear the form
                        preview.innerHTML = ""; // Clear the preview

                        // Optionally, refresh artworks
                        fetchArtworks();
                    } else {
                        notificationMessage.textContent = data.message;
                        notification.classList.add("error");
                        notification.classList.add("show");
                        notification.classList.remove("hidden");
                    }

                    // Hide notification after 3 seconds
                    setTimeout(() => {
                        notification.classList.remove("show");
                        notification.classList.add("hidden");
                    }, 3000);
                })
                .catch((error) => {
                    console.error("Error posting artwork:", error);
                });
        });

        // Fetch and display artworks
        fetchArtworks();

        function fetchArtworks() {
            fetch("../admin/admin_includes/artworks_actions/get_artworks.php")
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
                fetch("../admin/admin_includes/artworks_actions/delete_artwork.php?id=" + id, {
                    method: "DELETE" 
                })
                .then((response) => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
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
    }
});

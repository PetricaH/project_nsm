document.addEventListener("DOMContentLoaded", () => {
    const links = document.querySelectorAll(".tab");
    const mainContent = document.querySelector(".main_content");

    links.forEach(link => {
        link.addEventListener("click", (e) => {
            e.preventDefault();
            const page = link.getAttribute("href").split("=")[1];
            console.log(`Fetching page: ${page}`);

            fetch(`../${page}.php`) // Corrected URL
                .then(response => {
                    if (!response.ok) throw new Error("Page not found");
                    return response.text();
                })
                .then(data => {
                    mainContent.innerHTML = data;
                })
                .catch(error => {
                    mainContent.innerHTML = `<h1>${error.message}</h1>`;
                    console.error(error);
                });
        });
    });

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

document.addEventListener("DOMContentLoaded", () => {
    const links = document.querySelectorAll(".tab"); // select all sidebar links
    const mainContent = document.querySelector(".main_content"); // select the main content area

    // add click event listeners to all sidebar links
    links.forEach(link => {
        link.addEventListener("click", (e) => {
            e.preventDefault(); // prevent default link behaviour
            const page = link.getAttribute("href").split("=")[1]; // extract the 'page' parameter from the URL

            // fetch the content dynamically
            fetch(`admin/${page}.php`)
                .then(response => {
                    if (!response.ok) throw new Error("Page not found"); // handle HTTP errors
                    return response.text(); // parse the response as text (HTML)
                })
                .then(data => {
                    mainContent.innerHTML = data; // inject the fetched HTML into the main content area
                })
                .catch(error => {
                    mainContent.innerHTML = `<h1>${error.messagge}</h1>`; // display an error message
                });
        });
    });

    // code for making drag and drop images doable
    const dropZone = document.getElementById("drop_zone");
    const fileInput = document.getElementById("image");
    const preview = document.getElementById("preview");

    // highlight drop zone when file is dragged over
    dropZone.addEventListener("dragover", (e) => {
        e.preventDefault();
        dropZone.classList.add("dragging");
    });

    dropZone.addEventListener("dragleave", () => {
        dropZone.classList.remove("dragging");
    });

    // handle file drop
    dropZone.addEventListener("drop", (e) => {
        e.preventDefault();
        dropZone.classList.remove("dragging");

        const files = e.dataTransfer.files;
        if (files.length > 0) {
            fileInput.files = files; // attach dropped files to the input 
            previewImage(files[0]);
        }
    });

    // handle file selection through input
    fileInput.addEventListener("change", (e) => {
        if (e.target.files.length > 0) {
            previewImage(e.target.files[0]);
        }
    });

    // preview the image
    function previewImage(file) {
        preview.innerHTML = ""; // clear previous preview
        if (file && file.type.startsWith("image/")) {
            const img = document.createElement("img");
            img.src = URL.createObjectURL(file);
            img.alt = "Preview";
            img.style.maxWidth = "100%";
            img.style.maxHeight = "200px";
            preview.appendChild(img);

            // show file name

            const fileName = document.createElement("p");
            fileName.textContent = `Selected file: ${file.name}`;
            fileName.style.marginTop = "10px";
            fileName.style.fontSize = ".9em";
            fileName.style.color = "#333";
            preview.appendChild(fileName);

            // clear button
            const clearBtn = document.createElement("button");
            clearBtn.textContent = "Delete Image";
            clearBtn.style.marginTop = "10px";
            clearBtn.addEventListener("click", () => {
                fileInput.value = "";
                preview.innerHTML = "";
            });
            preview.appendChild(clearBtn);
        } else {
            preview.innerHTML = "<p>Invalid file</p>"
        }
    }

     fetchArtworks();

     function fetchArtworks() {
        fetch("./admin_includes/get_artworks.php")
            .then((response) => response.json())
            .then((data) => {
                if (data.success) {
                    const container = document.getElementById("artworks_container");
                    container.innerHTML = ""; // Clear existing content
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
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded",
                },
                body: `id=${id}`, // Send the artwork ID
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        alert(data.message);
                        cardElement.remove(); // Remove the artwork card from the DOM
                    } else {
                        alert(data.message);
                    }
                })
                .catch((error) => {
                    console.error("Error deleting artwork:", error);
                });
        }
    }
    

     // Attach the addArtworkToGallery function to the form submission
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
 
                         // Add the new artwork to the gallery
                         addArtworkToGallery(formData.get("title"), response.imageUrl);
 
                         // Reset fields manually
                         document.getElementById("title").value = "";
                         document.getElementById("image").value = "";
                         document.getElementById("date").value = "";
                         document.getElementById("preview").innerHTML = ""; // Clear the preview
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
    
    // Notification Functions
    function showNotification(message, isError = false) {
        const notification = document.getElementById("notification");
        const messageElement = document.getElementById("notificationMessage");

        // Set notification style based on success or error
        notification.classList.remove("hidden", "error", "show");
        notification.style.backgroundColor = isError ? "#f44336" : "#4caf50"; // Red for error, green for success
        messageElement.textContent = message;

        // Display the notification smoothly
        setTimeout(() => {
            notification.classList.add("show");
        }, 10);

        // Auto-hide notification after 5 seconds
        setTimeout(() => {
            notification.classList.remove("show");
        }, 5000);
    }

    // Close notification manually
    function closeNotification() {
        const notification = document.getElementById("notification");
        notification.classList.remove("show");
    }
   
});
document.addEventListener("DOMContentLoaded", () => {
    const galleryContainer = document.getElementById("galleryContainer");
    const itemsPerPage = 10; // Number of artworks per page
    let currentPage = 1;

    // Fetch artworks for the current page
    const fetchGalleryItems = (page) => {
        fetch(`../admin/admin_includes/get_artworks.php?context=gallery&page=${page}&limit=${itemsPerPage}`)
            .then((response) => {
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                return response.json();
            })
            .then((data) => {
                if (data.success) {
                    displayGalleryItems(data.artworks);
                    createGalleryPagination(data.totalPages, page);
                } else {
                    console.error("Failed to fetch gallery items:", data.error);
                }
            })
            .catch((err) => {
                console.error("Error fetching gallery items:", err);
            });
    };

    // Render artworks in a flex layout
    const displayGalleryItems = (artworks) => {
        galleryContainer.innerHTML = ""; // Clear previous artworks
        galleryContainer.style.display = "flex"; // Use flexbox
        galleryContainer.style.flexWrap = "wrap"; // Wrap rows
        galleryContainer.style.justifyContent = "center"; // Center align the grid

        artworks.forEach((item) => {
            const galleryItem = document.createElement("div");
            galleryItem.className = "gallery-item";
            galleryItem.style.width = "300px"; // Set fixed width
            galleryItem.style.height = "300px"; // Set fixed height
            galleryItem.style.margin = "15px"; // Add spacing between items
            galleryItem.style.textAlign = "center"; // Center-align content
            galleryItem.innerHTML = `
                <img src="${item.image}" alt="${item.title}" style="width: 100%; height: auto; border-radius: 10px; box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);">
                <h3 style="margin-top: 10px; font-size: 16px;">${item.title}</h3>
            `;
            galleryContainer.appendChild(galleryItem);
        });
    };

    // Render pagination buttons
    const createGalleryPagination = (totalPages, currentPage) => {
        const paginationContainer = document.querySelector(".gallery-pagination") || document.createElement("div");
        paginationContainer.className = "gallery-pagination";
        paginationContainer.innerHTML = ""; // Clear existing pagination

        for (let i = 1; i <= totalPages; i++) {
            const paginationButton = document.createElement("button");
            paginationButton.textContent = i;
            paginationButton.className = i === currentPage ? "active-page" : "page-button";
            paginationButton.addEventListener("click", () => {
                fetchGalleryItems(i);
            });
            paginationContainer.appendChild(paginationButton);
        }

        if (!document.querySelector(".gallery-pagination")) {
            galleryContainer.parentElement.appendChild(paginationContainer);
        }
    };

    fetchGalleryItems(currentPage); // Initial fetch
});

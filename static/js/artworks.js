document.addEventListener("DOMContentLoaded", () => {
    console.log("artworks.js loaded.");

    // fetch the first page of artworks on load 
    fetchArtworks(1);

    function fetchArtworks(page = 1, limit = 14) {
        fetch(`admin/admin_includes/artworks_actions/get_artworks.php?page=${page}&limit=${limit}`)
            .then((Response) => Response.json())
            .then((data) => {
                if (data.success) {
                    renderArtworks(data.artworks);

                    // if server returns totalPages/currentPage, display pagination
                    if (data.totalPages && data.currentPage) {
                        displayPagination(data.totalPages, data.currentPage);
                    }
                } else {
                    console.error("Failed to fetch artworks: ", data.message);
                }
            })
            .catch((error) => {
                console.error("error fetching artworks:", error);
            });
    }

    function renderArtworks(artworks) {
        const galleryContainer = document.getElementById("galleryContainer");
        galleryContainer.innerHTML = "";

        artworks.forEach((art) => {
            const card = createArtworkCard(art);
            galleryContainer.appendChild(card);
        });
    } 

    function createArtworkCard(artwork) {
        // artwork = { id, title, image }
        const card = document.createElement("div");
        card.classList.add("artwork_card");

        const img = document.createElement("img");
        img.src = artwork.image;
        img.alt = artwork.title;

        const titleDiv = document.createElement("div");
        titleDiv.classList.add("artwork_title");
        titleDiv.textContent = artwork.title;

        card.appendChild(img);
        card.appendChild(titleDiv);

        return card;
    }

    function displayPagination(totalPages, currentPage) {
        const paginationDiv = document.querySelector(".gallery_pagination");
        paginationDiv.innerHTML = "";

        for (let page = 1; page <= totalPages; page++) {
            const link = document.createElement("a");
            link.textContent = page;
            link.href = "#";

            // highlight current page
            if (page === currentPage) {
                link.classList.add("active_page");
            }

            // on click, fetch that page
            link.addEventListener("click", (e) => {
                e.preventDefault();
                fetchArtworks(page);
            });

            paginationDiv.appendChild(link);
        }
    }
}) 
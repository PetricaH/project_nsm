<?php require_once('config.php'); ?>
<?php require_once(ROOT_PATH . '/includes/heading.php'); ?>

<?php $page_css = 'artworks.css';?>
<title>Digital Art Portfolio | Hreniuc Petrică</title>
<meta name="description" content="Explore my digital art portfolio featuring a collection of illustrations, concept art, and digital paintings created with passion and creativity.">
</head>

<body data-context="artworks">

<?php include(ROOT_PATH . '/includes/navbar.php'); ?>

<div class="page-container">
    <!-- Hero Section -->
    <section class="gallery-hero">
        <div class="gallery-hero-content">
            <h1>Digital Art Portfolio</h1>
            <p>A collection of illustrations, concept art, and digital paintings created with passion and creativity</p>
        </div>
    </section>
    
    <!-- Gallery Section -->
    <div class="gallery-container">
        <!-- Gallery Header with Filters -->
        <div class="gallery-header">
            <h2 class="gallery-title">Featured Works</h2>
            <div class="gallery-filters">
                <button class="filter-button active" data-filter="all">All</button>
                <button class="filter-button" data-filter="illustration">Illustrations</button>
                <button class="filter-button" data-filter="concept">Concept Art</button>
                <button class="filter-button" data-filter="painting">Digital Paintings</button>
            </div>
        </div>
        
        <!-- Gallery Grid -->
        <div id="galleryContainer">
            <!-- Gallery items will be loaded dynamically via JavaScript -->
            <div class="loading-indicator">
                <div class="loading-spinner"></div>
                <span>Loading gallery...</span>
            </div>
        </div>
        
        <!-- Pagination -->
        <div class="gallery-pagination">
            <!-- Pagination will be generated dynamically -->
        </div>
    </div>
</div>

<!-- Artwork Lightbox -->
<div class="artwork-lightbox" id="artworkLightbox">
    <div class="lightbox-content">
        <img src="" alt="" class="lightbox-image" id="lightboxImage">
        <button class="lightbox-close" id="lightboxClose">&times;</button>
        <div class="lightbox-nav">
            <button class="lightbox-nav-button" id="lightboxPrev">&lt;</button>
            <button class="lightbox-nav-button" id="lightboxNext">&gt;</button>
        </div>
        <div class="lightbox-caption" id="lightboxCaption"></div>
    </div>
</div>

<!-- Booking Modal -->
<div id="bookingModal" class="booking-modal hidden">
    <div class="booking-modal-content">
        <span class="booking-modal-close" onclick="closeBookingModal()">&times;</span>
        <h2>Request a Commission</h2>
        <form action="includes/submit_booking.php" method="POST">
            <div class="booking-form-group">
                <label for="booking-name">Name</label>
                <input type="text" id="booking-name" name="name" required>
            </div>
            <div class="booking-form-group">
                <label for="booking-email">Email</label>
                <input type="email" id="booking-email" name="email" required>
            </div>
            <div class="booking-form-group">
                <label for="booking-service">Art Type</label>
                <select id="booking-service" name="service" required>
                    <option value="Illustration">Illustration</option>
                    <option value="Concept Art">Concept Art</option>
                    <option value="Digital Painting">Digital Painting</option>
                    <option value="Other">Other (please specify)</option>
                </select>
            </div>
            <div class="booking-form-group">
                <label for="booking-description">Project Details</label>
                <textarea id="booking-description" name="description" rows="4" placeholder="Describe your project, desired style, dimensions, and any other important details..." required></textarea>
            </div>
            <div class="booking-form-group">
                <input type="checkbox" id="privacy-policy" name="privacy_policy" required>
                <label for="privacy-policy">
                    I agree to the <a href="privacy-policy.php" target="_blank">privacy policy</a> and consent to being contacted about this request.
                </label>
            </div>
            <div class="booking-form-group">
                <button type="submit" class="booking-submit-btn">Submit Request</button>
            </div>
        </form>
    </div>
</div>

<!-- Notification Area -->
<div id="notification" class="hidden">
    <p id="notification-message"></p>
</div>

<!-- Gallery JavaScript -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Sample artwork data - in a real implementation, this would come from your database
        const artworks = [
            {
                id: 1,
                title: "Cyberpunk Cityscape",
                category: "illustration",
                image: "static/images/artworks/artwork1.jpg",
                date: "2023-05-15"
            },
            {
                id: 2,
                title: "Fantasy Character Design",
                category: "concept",
                image: "static/images/artworks/artwork2.jpg",
                date: "2023-04-22"
            },
            {
                id: 3,
                title: "Ethereal Landscape",
                category: "painting",
                image: "static/images/artworks/artwork3.jpg",
                date: "2023-03-10"
            },
            {
                id: 4,
                title: "Sci-Fi Environment",
                category: "concept",
                image: "static/images/artworks/artwork4.jpg",
                date: "2023-02-28"
            },
            {
                id: 5,
                title: "Character Portrait",
                category: "illustration",
                image: "static/images/artworks/artwork5.jpg",
                date: "2023-01-15"
            },
            {
                id: 6,
                title: "Abstract Composition",
                category: "painting",
                image: "static/images/artworks/artwork6.jpg",
                date: "2022-12-05"
            }
        ];
        
        const galleryContainer = document.getElementById('galleryContainer');
        const paginationContainer = document.querySelector('.gallery-pagination');
        const filterButtons = document.querySelectorAll('.filter-button');
        
        const itemsPerPage = 9;
        let currentPage = 1;
        let filteredArtworks = [...artworks];
        
        // Initialize gallery
        function initGallery() {
            // Remove loading indicator
            galleryContainer.innerHTML = '';
            
            // Filter artworks
            const startIndex = (currentPage - 1) * itemsPerPage;
            const paginatedArtworks = filteredArtworks.slice(startIndex, startIndex + itemsPerPage);
            
            if (paginatedArtworks.length === 0) {
                // Show empty state
                galleryContainer.innerHTML = `
                    <div class="empty-gallery">
                        <h3>No artworks found</h3>
                        <p>No artworks match your current filter selection. Please try a different category.</p>
                    </div>
                `;
                paginationContainer.innerHTML = '';
                return;
            }
            
            // Create artwork cards
            paginatedArtworks.forEach(artwork => {
                const artworkCard = document.createElement('div');
                artworkCard.className = 'artwork_card';
                artworkCard.dataset.id = artwork.id;
                artworkCard.dataset.category = artwork.category;
                
                artworkCard.innerHTML = `
                    <img src="${artwork.image}" alt="${artwork.title}">
                    <h3 class="artwork_title">${artwork.title}</h3>
                    <div class="artwork_overlay">
                        <div class="artwork_category">${artwork.category.charAt(0).toUpperCase() + artwork.category.slice(1)}</div>
                        <div class="artwork_date">${formatDate(artwork.date)}</div>
                    </div>
                `;
                
                // Add click event to open lightbox
                artworkCard.addEventListener('click', function() {
                    openLightbox(artwork);
                });
                
                galleryContainer.appendChild(artworkCard);
            });
            
            // Create pagination
            updatePagination();
        }
        
        // Update pagination
        function updatePagination() {
            const totalPages = Math.ceil(filteredArtworks.length / itemsPerPage);
            
            let paginationHTML = '';
            
            // Previous button
            paginationHTML += `
                <button class="pagination-button ${currentPage === 1 ? 'disabled' : ''}" 
                    ${currentPage === 1 ? 'disabled' : ''} data-page="prev">
                    &lt;
                </button>
            `;
            
            // Page numbers
            for (let i = 1; i <= totalPages; i++) {
                paginationHTML += `
                    <button class="pagination-button ${currentPage === i ? 'active' : ''}" 
                        data-page="${i}">
                        ${i}
                    </button>
                `;
            }
            
            // Next button
            paginationHTML += `
                <button class="pagination-button ${currentPage === totalPages ? 'disabled' : ''}" 
                    ${currentPage === totalPages ? 'disabled' : ''} data-page="next">
                    &gt;
                </button>
            `;
            
            paginationContainer.innerHTML = paginationHTML;
            
            // Add event listeners to pagination buttons
            document.querySelectorAll('.pagination-button').forEach(button => {
                button.addEventListener('click', function() {
                    if (this.disabled) return;
                    
                    const page = this.dataset.page;
                    
                    if (page === 'prev') {
                        currentPage--;
                    } else if (page === 'next') {
                        currentPage++;
                    } else {
                        currentPage = parseInt(page);
                    }
                    
                    initGallery();
                    
                    // Scroll to top of gallery
                    galleryContainer.scrollIntoView({ behavior: 'smooth' });
                });
            });
        }
        
        // Filter click event
        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Remove active class from all buttons
                filterButtons.forEach(btn => btn.classList.remove('active'));
                
                // Add active class to clicked button
                this.classList.add('active');
                
                const filter = this.dataset.filter;
                
                // Filter artworks
                if (filter === 'all') {
                    filteredArtworks = [...artworks];
                } else {
                    filteredArtworks = artworks.filter(artwork => artwork.category === filter);
                }
                
                // Reset to first page
                currentPage = 1;
                
                // Re-initialize gallery
                initGallery();
            });
        });
        
        // Format date helper
        function formatDate(dateString) {
            const options = { year: 'numeric', month: 'short' };
            return new Date(dateString).toLocaleDateString('en-US', options);
        }
        
        // Lightbox functionality
        const lightbox = document.getElementById('artworkLightbox');
        const lightboxImage = document.getElementById('lightboxImage');
        const lightboxCaption = document.getElementById('lightboxCaption');
        const lightboxClose = document.getElementById('lightboxClose');
        const lightboxPrev = document.getElementById('lightboxPrev');
        const lightboxNext = document.getElementById('lightboxNext');
        
        let currentArtworkIndex = 0;
        
        function openLightbox(artwork) {
            lightboxImage.src = artwork.image;
            lightboxImage.alt = artwork.title;
            lightboxCaption.textContent = `${artwork.title} - ${artwork.category.charAt(0).toUpperCase() + artwork.category.slice(1)}`;
            
            // Find index of current artwork
            currentArtworkIndex = filteredArtworks.findIndex(a => a.id === artwork.id);
            
            // Update prev/next buttons
            updateLightboxNav();
            
            // Show lightbox
            lightbox.classList.add('active');
            document.body.style.overflow = 'hidden'; // Prevent scrolling
        }
        
        function closeLightbox() {
            lightbox.classList.remove('active');
            document.body.style.overflow = 'auto'; // Enable scrolling
        }
        
        function updateLightboxNav() {
            // Enable/disable prev button
            if (currentArtworkIndex > 0) {
                lightboxPrev.disabled = false;
                lightboxPrev.style.opacity = 1;
            } else {
                lightboxPrev.disabled = true;
                lightboxPrev.style.opacity = 0.5;
            }
            
            // Enable/disable next button
            if (currentArtworkIndex < filteredArtworks.length - 1) {
                lightboxNext.disabled = false;
                lightboxNext.style.opacity = 1;
            } else {
                lightboxNext.disabled = true;
                lightboxNext.style.opacity = 0.5;
            }
        }
        
        // Lightbox navigation
        lightboxClose.addEventListener('click', closeLightbox);
        
        lightboxPrev.addEventListener('click', function() {
            if (currentArtworkIndex > 0) {
                currentArtworkIndex--;
                const artwork = filteredArtworks[currentArtworkIndex];
                lightboxImage.src = artwork.image;
                lightboxImage.alt = artwork.title;
                lightboxCaption.textContent = `${artwork.title} - ${artwork.category.charAt(0).toUpperCase() + artwork.category.slice(1)}`;
                updateLightboxNav();
            }
        });
        
        lightboxNext.addEventListener('click', function() {
            if (currentArtworkIndex < filteredArtworks.length - 1) {
                currentArtworkIndex++;
                const artwork = filteredArtworks[currentArtworkIndex];
                lightboxImage.src = artwork.image;
                lightboxImage.alt = artwork.title;
                lightboxCaption.textContent = `${artwork.title} - ${artwork.category.charAt(0).toUpperCase() + artwork.category.slice(1)}`;
                updateLightboxNav();
            }
        });
        
        // Close lightbox when clicking outside the image
        lightbox.addEventListener('click', function(e) {
            if (e.target === lightbox) {
                closeLightbox();
            }
        });
        
        // Close lightbox with ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeLightbox();
            } else if (e.key === 'ArrowLeft') {
                lightboxPrev.click();
            } else if (e.key === 'ArrowRight') {
                lightboxNext.click();
            }
        });
        
        // Initialize gallery
        initGallery();
    });

    // Booking Modal Functions
    function openBookingModal() {
        document.getElementById('bookingModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden'; // Prevent scrolling
    }
    
    function closeBookingModal() {
        document.getElementById('bookingModal').classList.add('hidden');
        document.body.style.overflow = 'auto'; // Enable scrolling
    }
    
    // Close modal when clicking outside
    window.addEventListener('click', function(event) {
        const modal = document.getElementById('bookingModal');
        if (event.target === modal) {
            closeBookingModal();
        }
    });
</script>

<?php include(ROOT_PATH . '/includes/footer.php'); ?>
</body>
</html>
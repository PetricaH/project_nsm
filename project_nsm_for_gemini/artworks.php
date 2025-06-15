<?php require_once('config.php'); ?>
<?php require_once(ROOT_PATH . '/includes/heading.php'); ?>

<?php $page_css = 'artworks.css';?>
<title>Portofoliu de Artă Digitală | Hreniuc Petrică</title>
<meta name="description" content="Explorează portofoliul meu de artă digitală ce prezintă o colecție de ilustrații, artă conceptuală și picturi digitale create cu pasiune și creativitate.">
</head>

<body data-context="artworks">

<?php include(ROOT_PATH . '/includes/navbar.php'); ?>

<div class="page-container">
    <!-- Hero Section -->
    <section class="gallery-hero">
        <div class="gallery-hero-content">
            <h1>Portofoliu de Artă Digitală</h1>
            <p>O colecție de ilustrații, artă conceptuală și picturi digitale create cu pasiune și creativitate</p>
        </div>
    </section>
    
    <!-- Gallery Section -->
    <div class="gallery-container">
        <!-- Gallery Header with Filters -->
        <div class="gallery-header">
            <h2 class="gallery-title">Lucrări Reprezentative</h2>
            <div class="gallery-filters">
                <button class="filter-button active" data-filter="all">Toate</button>
                <button class="filter-button" data-filter="illustration">Ilustrații</button>
                <button class="filter-button" data-filter="concept">Artă Conceptuală</button>
                <button class="filter-button" data-filter="painting">Picturi Digitale</button>
            </div>
        </div>
        
        <!-- Gallery Grid -->
        <div id="galleryContainer">
            <!-- Gallery items will be loaded dynamically via JavaScript -->
            <div class="loading-indicator">
                <div class="loading-spinner"></div>
                <span>Se încarcă galeria...</span>
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
        <h2>Solicită o Comandă</h2>
        <form action="includes/submit_booking.php" method="POST">
            <div class="booking-form-group">
                <label for="booking-name">Nume</label>
                <input type="text" id="booking-name" name="name" required>
            </div>
            <div class="booking-form-group">
                <label for="booking-email">Email</label>
                <input type="email" id="booking-email" name="email" required>
            </div>
            <div class="booking-form-group">
                <label for="booking-service">Tip de Artă</label>
                <select id="booking-service" name="service" required>
                    <option value="Illustration">Ilustrație</option>
                    <option value="Concept Art">Artă Conceptuală</option>
                    <option value="Digital Painting">Pictură Digitală</option>
                    <option value="Other">Altele (te rog specifică)</option>
                </select>
            </div>
            <div class="booking-form-group">
                <label for="booking-description">Detalii Proiect</label>
                <textarea id="booking-description" name="description" rows="4" placeholder="Descrie proiectul tău, stilul dorit, dimensiunile și orice alte detalii importante..." required></textarea>
            </div>
            <div class="booking-form-group">
                <input type="checkbox" id="privacy-policy" name="privacy_policy" required>
                <label for="privacy-policy">
                    Sunt de acord cu <a href="privacy-policy.php" target="_blank">politica de confidențialitate</a> și îmi dau consimțământul pentru a fi contactat în legătură cu această solicitare.
                </label>
            </div>
            <div class="booking-form-group">
                <button type="submit" class="booking-submit-btn">Trimite Solicitarea</button>
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
                title: "Peisaj Urban Cyberpunk",
                category: "illustration",
                image: "static/images/artworks/artwork1.jpg",
                date: "2023-05-15"
            },
            {
                id: 2,
                title: "Design Personaj Fantasy",
                category: "concept",
                image: "static/images/artworks/artwork2.jpg",
                date: "2023-04-22"
            },
            {
                id: 3,
                title: "Peisaj Eteric",
                category: "painting",
                image: "static/images/artworks/artwork3.jpg",
                date: "2023-03-10"
            },
            {
                id: 4,
                title: "Mediu Sci-Fi",
                category: "concept",
                image: "static/images/artworks/artwork4.jpg",
                date: "2023-02-28"
            },
            {
                id: 5,
                title: "Portret de Personaj",
                category: "illustration",
                image: "static/images/artworks/artwork5.jpg",
                date: "2023-01-15"
            },
            {
                id: 6,
                title: "Compoziție Abstractă",
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
                        <h3>Nicio lucrare găsită</h3>
                        <p>Nicio lucrare nu corespunde filtrului selectat. Te rugăm să încerci o categorie diferită.</p>
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
                        <div class="artwork_category">${getCategoryTranslation(artwork.category)}</div>
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
        
        // Get Romanian category translation
        function getCategoryTranslation(category) {
            const translations = {
                'illustration': 'Ilustrație',
                'concept': 'Artă Conceptuală',
                'painting': 'Pictură Digitală'
            };
            
            return translations[category] || category.charAt(0).toUpperCase() + category.slice(1);
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
            return new Date(dateString).toLocaleDateString('ro-RO', options);
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
            lightboxCaption.textContent = `${artwork.title} - ${getCategoryTranslation(artwork.category)}`;
            
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
                lightboxCaption.textContent = `${artwork.title} - ${getCategoryTranslation(artwork.category)}`;
                updateLightboxNav();
            }
        });
        
        lightboxNext.addEventListener('click', function() {
            if (currentArtworkIndex < filteredArtworks.length - 1) {
                currentArtworkIndex++;
                const artwork = filteredArtworks[currentArtworkIndex];
                lightboxImage.src = artwork.image;
                lightboxImage.alt = artwork.title;
                lightboxCaption.textContent = `${artwork.title} - ${getCategoryTranslation(artwork.category)}`;
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
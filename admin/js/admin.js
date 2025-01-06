document.addEventListener("DOMContentLoaded", () => {
    const BASE_URL = `${window.location.origin}${window.location.pathname.split('/').slice(0, -1).join('/')}/`;
    const links = document.querySelectorAll(".tab");
    const mainContent = document.querySelector(".main_content");

    // Load the default page and CSS on first load
    const defaultPage = "manage_blog"; // Default page
    loadPage(defaultPage);

    // Handle sidebar navigation clicks
    links.forEach(link => {
        link.addEventListener("click", (e) => {
            e.preventDefault();
            const page = link.getAttribute("href").split("=")[1];

            loadPage(page, true); // `true` ensures the history is updated

            // Highlight the active link
            links.forEach(l => l.classList.remove("active"));
            link.classList.add("active");
        });
    });

    function loadPage(page, pushToHistory = true) {
        // Before loading a new page, destroy existing CKEditor instances to prevent conflicts
        destroyAllEditors();
        
        // Fetch the content of the page
        fetch(`${BASE_URL}${page}.php`)
            .then(response => {
                if (!response.ok) throw new Error("Page not found");
                return response.text();
            })
            .then(data => {
                // Insert the content into the main_content div
                mainContent.innerHTML = data;

                // update the url without refreshing the page
                if (pushToHistory) {
                    history.pushState({ page }, "", `?page=${page}`); 
                }

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
                initializeArtworksManagement();
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

    function initializeArtworksManagement() {
        console.log("Artworks management initialized.");
    }

    function initializeBookingManagement() {
        console.log("Booking management scripts initialized.");
    }

    function initializeUserManagement() {
        console.log("User management scripts initialized.");
    }

    function initializeBlogManagement() {
        console.log("Blog management scripts initialized.");

         // If you ever loaded CKEditor on this same ID before, destroy it:
         if (CKEDITOR.instances['contentField']) {
            CKEDITOR.instances['contentField'].destroy(true);
        }

        // Now see if the partial includes <textarea id="contentField">
        const contentField = document.getElementById('contentField');
        if (contentField) {
            // Attach CKEditor
            CKEDITOR.replace('contentField', {
                // Optional custom config
                toolbar: [
                    { name: 'document', items: ['Source','-','NewPage','Preview'] },
                    { name: 'clipboard', items: ['Cut','Copy','Paste','Undo','Redo'] },
                    { name: 'editing', items: ['Find','Replace','SelectAll'] },
                    '/',
                    { name: 'basicstyles', items: ['Bold','Italic','Underline','Strike','RemoveFormat'] },
                    { name: 'paragraph', items: ['NumberedList','BulletedList','Blockquote','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'] },
                    { name: 'links', items: ['Link','Unlink','Anchor'] },
                    { name: 'insert', items: ['Image','Table','HorizontalRule','SpecialChar'] },
                    '/',
                    { name: 'styles', items: ['Styles','Format','Font','FontSize'] },
                    { name: 'colors', items: ['TextColor','BGColor'] }
                ]
            });
        }

         // Handle Add Category Form Submission via AJAX
         const addCategoryForm = document.getElementById('addCategoryForm');
         if (addCategoryForm) {
             addCategoryForm.addEventListener('submit', function(e) {
                 e.preventDefault(); // Prevent default form submission
 
                 const formData = new FormData(addCategoryForm);
                 fetch('admin_includes/blog_actions/process_blog.php', {
                     method: 'POST',
                     body: formData
                 })
                 .then(response => response.text())
                 .then(data => {
                     // Optionally, handle success or error messages
                     // For example, reload the categories table
                     loadPage('manage_blog', false); // Reload manage_blog without pushing to history
                 })
                 .catch(error => {
                     console.error('Error adding category:', error);
                 });
             });
         }
 
         // Handle Delete Category Buttons via AJAX
         const deleteCategoryButtons = document.querySelectorAll('.delete-category-btn');
         deleteCategoryButtons.forEach(button => {
             button.addEventListener('click', function() {
                 const categoryId = this.getAttribute('data-category-id');
                 if (confirm('Are you sure you want to delete this category?')) {
                     const formData = new FormData();
                     formData.append('action', 'delete_category');
                     formData.append('category_id', categoryId);
 
                     fetch('admin_includes/blog_actions/process_blog.php', {
                         method: 'POST',
                         body: formData
                     })
                     .then(response => response.text())
                     .then(data => {
                         // Optionally, handle success or error messages
                         // For example, reload the categories table
                         loadPage('manage_blog', false); // Reload manage_blog without pushing to history
                     })
                     .catch(error => {
                         console.error('Error deleting category:', error);
                     });
                 }
             });
         });

        const deletePostButtons = document.querySelectorAll('.delete-post-btn');
        deletePostButtons.forEach(button => {
            button.addEventListener('click', function() {
                const postId = this.getAttribute('data-post-id');
                if (confirm('Are you sure you want to delete this post?')) {
                    const formData = new FormData();
                    formData.append('action', 'delete_post');
                    formData.append('post_id', postId);

                    fetch('admin_includes/blog_actions/process_blog.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.text())
                    .then(data => {
                        loadPage('manage_blog', false); // Reload manage_blog without pushing to history
                    })
                    .catch(error => {
                        console.error('Error deleting post:', error);
                    });
                }
            });
        });
    }

    // Function to destroy all existing CKEditor instances before loading a new page
    function destroyAllEditors() {
        for (let instance in CKEDITOR.instances) {
            if (CKEDITOR.instances.hasOwnProperty(instance)) {
                CKEDITOR.instances[instance].destroy(true);
            }
        }
    }

    // Handle browser back/forward buttons
    window.addEventListener("popstate", (event) => {
        const page = event.state?.page || "manage_artwork"; // default to "manage_artwork" if no state exists
        loadPage(page, false); // `false` to avoid pushing to history again
    });
});

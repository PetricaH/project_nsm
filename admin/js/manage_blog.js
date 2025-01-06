// manage_blog.js
console.log('manage_blog.js has been loadedawddad.');

(function() {
    function initManageBlog() {
        console.log("Blog management scripts initialized.");

        // Initialize CKEditor for contentField
        const contentField = document.getElementById('contentField');
        if (contentField) {
            CKEDITOR.replace('contentField', {
                toolbar: [
                    { name: 'document', items: ['Source', '-', 'NewPage', 'Preview'] },
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
    }

    // Automatically initialize when the script is loaded
    initManageBlog();
})();

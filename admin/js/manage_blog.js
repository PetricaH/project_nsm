// manage_blog.js

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
                        loadPage('manage_blog', false); // Reload manage_blog without pushing to history
                    })
                    .catch(error => {
                        console.error('Error deleting category:', error);
                    });
                }
            });
        });

        // Handle Delete Post Buttons via AJAX
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

    // Automatically initialize when the script is loaded
    document.addEventListener("DOMContentLoaded", initManageBlog);
})();

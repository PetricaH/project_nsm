document.addEventListener('DOMContentLoaded', () => {
    const formContainer = document.getElementById('blogFormContainer');
    const blogForm = document.getElementById('blogForm');
    const formTitle = document.getElementById('formTitle');
    const formActionField = document.getElementById('formAction');
    const postIdField = document.getElementById('postIdField');

    // fields
    const titleField = document.getElementById('titleField');
    const slugField = document.getElementById('slugField');
    const categoryField = document.getElementById('categoryField');
    const authorField = document.getElementById('authorField');
    const imageField = document.getElementById('imageField');
    const contentField = CKEDITOR.instances['contentField'];

    const saveBtn = document.getElementById('saveBtn');
    const cancelBtn = document.getElementById('cancelBtn');

    // show form in "Create" mode
    function showCreateForm() {
        formTitle.textContent = "Create New Post";
        formActionField.value = "create";
        postIdField.value = "";

        // clear all fields
        titleField.value = "";
        slugField.value = "";
        categoryField.value = "";
        authorField.value = "";
        imageField.value = "";
        contentField.setData("");

        // show form
        formContainer.style.display = "block";
    }

    // show form in "Edit mode"
    function showEditForm(postData) {
        formTitle.textContent = "Edit Post: " + postData.title;
        formActionField.value = "update";
        postIdField.value = postData.post_id;

        // fil lfields from JSON data
        titleField.value = postData.title;
        slugField.value = postData.slug;
        categoryField.value = postData.category_id || "";
        authorField.value = postData.author_id;
        imageField.value = postData.image_url;
        contentField.setData(postData.content);

        // show form
        formContainer.style.display = "block";
    }

    // cancel button
    cancelBtn.addEventListener("click", () => {
        formContainer.style.display = "none";
    });

    // edit buttons
    document.querySelectorAll(".edit-btn").forEach((btn) => {
        btn.addEventListener("click", () => {
            const postData = JSON.parse(btn.dataset.post);
            showEditForm(postData);
        });
    });

    // show create form button
    document.getElementById('newPostBtn').addEventListener("click", showCreateForm);

    // handle delete buttons
    document.querySelectorAll(".delete-btn").forEach((delBtn) => {
        delBtn.addEventListener("click", () => {
            const row = delBtn.closest("tr");
            const postId = row.dataset.id;

            if (confirm("Are you sure you want to delete this post?")) {
                fetch(`process_blog.php?action=delete&post_id=${postId}`)
                    .then(res => res.text())
                    .then(data => {
                        row.remove();
                    })
                    .catch(err => console.error(err));
            }
        });
    });
});
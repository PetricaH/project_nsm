// manage_blog.js
console.log("manage_blog.js has been loaded.");

/**
 * Initialize blog management functionality after the HTML
 * for manage_blog.php is injected into .main_content.
 *
 * We attach this function to `window.initManageBlog` so that
 * `admin.js` can call it after the script loads.
 */
window.initManageBlog = function initManageBlog() {
  console.log("Blog management scripts initialized.");

  // 1. Destroy any old CKEditor instance on #contentField (just in case)
  if (CKEDITOR.instances["contentField"]) {
    CKEDITOR.instances["contentField"].destroy(true);
  }

  // 2. Re-initialize CKEditor on the blog post text area
  const contentField = document.getElementById("contentField");
  if (contentField) {
    CKEDITOR.replace("contentField", {
      toolbar: [
        { name: "document", items: ["Source", "-", "NewPage", "Preview"] },
        { name: "clipboard", items: ["Cut","Copy","Paste","Undo","Redo"] },
        { name: "editing", items: ["Find","Replace","SelectAll"] },
        "/",
        { name: "basicstyles", items: ["Bold","Italic","Underline","Strike","RemoveFormat"] },
        {
          name: "paragraph",
          items: [
            "NumberedList","BulletedList","Blockquote",
            "JustifyLeft","JustifyCenter","JustifyRight","JustifyBlock"
          ]
        },
        { name: "links", items: ["Link","Unlink","Anchor"] },
        { name: "insert", items: ["Image","Table","HorizontalRule","SpecialChar"] },
        "/",
        { name: "styles", items: ["Styles","Format","Font","FontSize"] },
        { name: "colors", items: ["TextColor","BGColor"] }
      ]
    });
  }

  // 3. Add Category
  const addCategoryForm = document.getElementById("addCategoryForm");
  if (addCategoryForm) {
    addCategoryForm.addEventListener("submit", function(e) {
      e.preventDefault(); // Prevent normal form submission

      const formData = new FormData(addCategoryForm);
      fetch("admin_includes/blog_actions/process_blog.php", {
        method: "POST",
        body: formData
      })
        .then(response => response.text())
        .then(data => {
          // For success or error feedback, you can parse data or show a message
          // Reload the blog page content to refresh categories
          if (typeof loadPage === "function") {
            loadPage("manage_blog", false);
          }
        })
        .catch(error => {
          console.error("Error adding category:", error);
        });
    });
  }

  // 4. Delete Category
  const deleteCategoryButtons = document.querySelectorAll(".delete-category-btn");
  deleteCategoryButtons.forEach(button => {
    button.addEventListener("click", () => {
      const categoryId = button.getAttribute("data-category-id");
      if (confirm("Are you sure you want to delete this category?")) {
        const formData = new FormData();
        formData.append("action", "delete_category");
        formData.append("category_id", categoryId);

        fetch("admin_includes/blog_actions/process_blog.php", {
          method: "POST",
          body: formData
        })
          .then(response => response.text())
          .then(data => {
            // Reload the blog page
            if (typeof loadPage === "function") {
              loadPage("manage_blog", false);
            }
          })
          .catch(error => {
            console.error("Error deleting category:", error);
          });
      }
    });
  });

  // 5. Delete Post
  const deletePostButtons = document.querySelectorAll(".delete-post-btn");
  deletePostButtons.forEach(button => {
    button.addEventListener("click", () => {
      const postId = button.getAttribute("data-post-id");
      if (confirm("Are you sure you want to delete this post?")) {
        const formData = new FormData();
        formData.append("action", "delete_post");
        formData.append("post_id", postId);

        fetch("admin_includes/blog_actions/process_blog.php", {
            method: "POST",
            body: formData
          })
          .then(response => response.json())
          .then(data => {
            if (data.status === 'post_deleted') {
              loadPage('manage_blog', false);
            } else if (data.status === 'error') {
              console.error("Error:", data.message);
            }
          })
          .catch(error => {
            console.error("AJAX error:", error);
          });                   
      }
    });
  });

  // 2. Create/Update Post Form
  const blogForm = document.getElementById("blogForm");
  if (blogForm) {
    blogForm.addEventListener("submit", function(e) {
      e.preventDefault();

      // Ensure CKEditor content is added
      if (CKEDITOR.instances.contentField) {
        CKEDITOR.instances.contentField.updateElement();
        console.log("CKEditor content:", CKEDITOR.instances.contentField.getData()); // Debugging
      } else {
        console.error("CKEditor instance is missing.");
      }

      const formData = new FormData(blogForm);

      // Debugging: Check if content is being added to formData
      console.log("FormData content:", formData.get("content"));

      fetch("admin_includes/blog_actions/process_blog.php", {
        method: "POST",
        body: formData
      })
        .then(response => response.json())
        .then(data => {
          if (data.status === "post_created" || data.status === "post_updated") {
            console.log("Post saved successfully!");
            loadPage('manage_blog', false);
          } else {
            console.error("Post error:", data.message);
          }
        })
        .catch(error => {
          console.error("Fetch error (saving post):", error);
        });
    });
  }
};
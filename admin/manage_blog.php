<?php
session_start();

if ($_SESSION['role'] !== 'admin') {
    header('Location: ../index.php');
    exit;
}

require_once('../config.php');
require_once('../admin/admin_includes/admin_heading.php');

// Fetch existing posts
$sql = "SELECT p.post_id, p.title, p.slug, p.content, p.image_url, p.author_id, p.category_id,
               p.created_at, p.updated_at, u.username AS author_name, c.category_name
        FROM posts p
        LEFT JOIN users u ON p.author_id = u.user_id
        LEFT JOIN categories c ON p.category_id = c.category_id
        ORDER BY p.created_at DESC";

$result = $conn->query($sql);
if (!$result) {
    die("Error executing query: " . $conn->error);
}

// Fetch all categories for the dropdown
$categoriesSql = "SELECT category_id, category_name FROM categories ORDER BY category_name ASC";
$categoriesResult = $conn->query($categoriesSql);
$categories = [];
if ($categoriesResult && $categoriesResult->num_rows > 0) {
    while ($catRow = $categoriesResult->fetch_assoc()) {
        $categories[] = $catRow;
    }
}

// Fetch all categories for the categories management table
$allCategoriesSql = "SELECT category_id, category_name, slug FROM categories ORDER BY category_name ASC";
$allCategoriesResult = $conn->query($allCategoriesSql);
$allCategories = [];
if ($allCategoriesResult && $allCategoriesResult->num_rows > 0) {
    while ($catRow = $allCategoriesResult->fetch_assoc()) {
        $allCategories[] = $catRow;
    }
}
?>

<h1>Manage Blog Posts</h1>

<!-- Table of existing posts -->
<table class="blog-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Slug</th>
            <th>Category</th>
            <th>Author</th>
            <th>Created</th>
            <th>Updated</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr data-id="<?php echo $row['post_id']; ?>">
                <td><?php echo $row['post_id']; ?></td>
                <td><?php echo htmlspecialchars($row['title']); ?></td>
                <td><?php echo htmlspecialchars($row['slug']); ?></td>
                <td><?php echo htmlspecialchars($row['category_name']); ?></td>
                <td><?php echo htmlspecialchars($row['author_name']); ?></td>
                <td><?php echo $row['created_at']; ?></td>
                <td><?php echo $row['updated_at']; ?></td>
                <td>
                    <button class="edit-btn" data-post='<?php echo json_encode($row); ?>'>
                        Edit
                    </button>
                    <button class="delete-post-btn">Delete</button>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<!-- New post / edit post form -->
<div class="blog-form-container" id="blogFormContainer" ">
    <h2 id="formTitle">Create New Post</h2>
    <form method="POST" action="../admin/admin_includes/blog_actions/process_blog.php" enctype="multipart/form-data" id="blogForm">
        <input type="hidden" name="action" value="create" id="formAction">
        <input type="hidden" name="post_id" value="" id="postIdField">

        <!-- Title -->
        <div class="form-group">
            <label for="titleField">Title:</label>
            <input type="text" name="title" id="titleField" required>
        </div>

        <!-- Slug -->
        <div class="form-group">
            <label for="slugField">Slug:</label>
            <input type="text" name="slug" id="slugField" required>
        </div>

        <!-- Category -->
        <div class="form-group">
            <label for="categoryField">Category:</label>
            <select name="category_id" id="categoryField">
                <option value="">Select Category</option>
                <?php foreach ($categories as $cat) { ?>
                    <option value="<?php echo $cat['category_id']; ?>">
                        <?php echo htmlspecialchars($cat['category_name']); ?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <!-- Author ID -->
        <div class="form-group">
            <label for="authorField">Author ID:</label>
            <input type="number" name="author_id" id="authorField" required>
        </div>

        <!-- Featured Image URL -->
        <div class="form-group">
            <label for="imageField">Image URL:</label>
            <input type="text" name="image_url" id="imageField" placeholder="https://example.com/image.jpg">
        </div>

        <!-- Content (for CKEditor) -->
        <div class="form-group">
            <label for="contentField">Content:</label>
            <textarea name="content" id="contentField" rows="10"></textarea>
        </div>

        <div class="form-buttons">
            <button type="submit" id="saveBtn">Save Post</button>
            <button type="button" id="cancelBtn">Cancel</button>
        </div>
    </form>
</div>

<h2>Manage Categories</h2>

<!-- Categories Table -->
<table class="categories-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Category Name</th>
            <th>Slug</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($allCategories as $category) { ?>
            <tr data-id="<?php echo $category['category_id']; ?>">
                <td><?php echo $category['category_id']; ?></td>
                <td><?php echo htmlspecialchars($category['category_name']); ?></td>
                <td><?php echo htmlspecialchars($category['slug']); ?></td>
                <td>
                    <button class="delete-category-btn" data-category-id="<?php echo $category['category_id']; ?>">
                        Delete
                    </button>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<!-- Add New Category Form -->
<div class="category-form-container">
    <h3>Add New Category</h3>
    <form method="POST" action="../admin/admin_includes/blog_actions/process_blog.php" id="addCategoryForm">
        <input type="hidden" name="action" value="create_category">
        
        <!-- Category Name -->
        <div class="form-group">
            <label for="newCategoryName">Category Name:</label>
            <input type="text" name="category_name" id="newCategoryName" required>
        </div>
        
        <!-- Slug (Optional: Auto-generate if left blank) -->
        <div class="form-group">
            <label for="newCategorySlug">Slug:</label>
            <input type="text" name="slug" id="newCategorySlug" placeholder="Auto-generated if left blank">
        </div>
        
        <button type="submit">Add Category</button>
    </form>
</div>

<?php include('../admin/admin_includes/admin_footer.php'); ?>

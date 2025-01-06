<?php
session_start();

// ensure only admins can accesst this page
if ($_SESSION['role'] !== 'admin') {
    header('Location: ../index.php');
    exit;
}

require_once('../config.php');
require_once('../admin/admin_includes/admin_heading.php');


// fetch existing posts
$sql = "SELECT p.post_id, p.title, p.slug, p.content, p.image_url, p.author_id, p.category_id, p.created_at, p.updated_at, u.username AS author_name, c.category_name FROM
        posts p LEFT JOIN users u ON p.author_id = u.user_id
        LEFT JOIN categories c ON p.category_id = c.category_id
        ORDER BY p.created_at DESC";

$result = $conn->query($sql);
if (!$result) {
    die("Error executing query: " . $conn->error);
}

// fetch all categories for the dropdown
$categoriesSql = "SELECT category_id, category_name FROM categories ORDER BY category_name ASC";
$categoriesResult = $conn->query($categoriesSql);
$categories = [];
if ($categoriesResult && $categoriesResult->num_rows > 0) {
    while ($catRow = $categoriesResult->fetch_assoc()) {
        $categories[] = $catRow;
    }
}
?>

<h1>Manage Blog Posts</h1>

<!-- table of existing posts -->
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
            <tr data-id="<?php echo $row['post_id']; ?>
                <td><?php echo $row['post_id']; ?></td>
                <td><?php echo htmlspecialchars($row['title']); ?></td>
                <td><?php echo htmlspecialchars($row['slug']); ?></td>
                <td><?php echo htmlspecialchars($row['category_name']); ?></td>
                <td><?php echo htmlspecialchars($row['author_name']); ?></td>
                <td><?php echo $row['created_at']; ?></td>
                <td><?php echo $row['updated_at']; ?></td>
                <td>
                    <button class="edit-btn"
                        data-post='<?php echo json_encode($row); ?>'>
                        Edit
                    </button>
                    <button class="delete-btn">Delete</button>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<!-- new post / edit post form -->

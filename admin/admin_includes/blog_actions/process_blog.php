<?php
session_start();

// Only admins can process these requests
if ($_SESSION['role'] !== 'admin') {
    header('Location: ../index.php');
    exit;
}

require_once('../../../config.php');

/**
 * Generates a URL-friendly slug from a given string.
 *
 * @param string $string The input string.
 *
 * @return string        The generated slug.
 */
function generateSlug($string) {
    // Convert to lowercase
    $slug = strtolower($string);
    // Replace non-alphanumeric characters with hyphens
    $slug = preg_replace('/[^a-z0-9]+/i', '-', $slug);
    // Trim hyphens from ends
    $slug = trim($slug, '-');
    return $slug;
}

/**
 * Ensures that the slug is unique within the specified table and column.
 *
 * @param mysqli    $conn        The MySQLi connection object.
 * @param string    $slug        The initial slug to check.
 * @param string    $table       The table to check against (e.g., 'categories').
 * @param string    $column      The column to check (e.g., 'slug').
 * @param int|null  $exclude_id  The ID to exclude from the check (useful for updates).
 *
 * @return string                A unique slug.
 */
function ensureUniqueSlug($conn, $slug, $table, $column, $exclude_id = null) {
    $original_slug = $slug;
    $i = 1;

    while (true) {
        // Prepare SQL statement based on whether to exclude an ID
        if ($exclude_id) {
            $stmt = $conn->prepare("SELECT COUNT(*) FROM `$table` WHERE `$column` = ? AND `category_id` != ?");
            if (!$stmt) {
                die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
            }
            $stmt->bind_param("si", $slug, $exclude_id);
        } else {
            $stmt = $conn->prepare("SELECT COUNT(*) FROM `$table` WHERE `$column` = ?");
            if (!$stmt) {
                die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
            }
            $stmt->bind_param("s", $slug);
        }

        // Execute the statement and check for errors
        if (!$stmt->execute()) {
            die("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
        }

        // Bind the result to the $count variable
        $stmt->bind_result($count);
        if (!$stmt->fetch()) {
            // If fetch fails, assume count is 0 to avoid infinite loop
            $count = 0;
        }
        $stmt->close();

        // If no existing slug is found, break the loop
        if ($count == 0) {
            break;
        }

        // Modify the slug and continue the loop
        $slug = $original_slug . '-' . $i;
        $i++;
    }

    return $slug;
}

// Handle POST requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'create' || $action === 'update') {
        // Common fields for both create and update
        $title = trim($_POST['title'] ?? '');
        $content = trim($_POST['content'] ?? '');
        $image_url = trim($_POST['image_url'] ?? '');
        $author_id = isset($_POST['author_id']) ? (int)$_POST['author_id'] : 0;
        $category_id = isset($_POST['category_id']) ? (int)$_POST['category_id'] : 0;
    
        // Validate required fields
        if (empty($title)) {
            die("Error: Title is required.");
        }
        if ($author_id <= 0) {
            die("Error: Invalid Author ID.");
        }
        if ($category_id <= 0) {
            die("Error: Invalid Category ID.");
        }
    
        // Generate slug from title
        $slug = generateSlug($title);
    
        if ($action === 'create') {
            // Ensure slug is unique in the 'posts' table
            $slug = ensureUniqueSlug($conn, $slug, 'posts', 'slug');
    
            // Insert a new post
            $stmt = $conn->prepare("INSERT INTO posts (title, slug, content, image_url, author_id, category_id) VALUES (?, ?, ?, ?, ?, ?)");
            if (!$stmt) {
                die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
            }
            $stmt->bind_param("sssiii", $title, $slug, $content, $image_url, $author_id, $category_id);
            
            if ($stmt->execute()) {
                // Redirect back to manage_blog with success
                header("Location: ../admin.php?page=manage_blog&status=post_created");
                exit;
            } else {
                die("Error creating post: " . $stmt->error);
            }
            $stmt->close();
        } elseif ($action === 'update') {
            // Update an existing post
            $post_id = isset($_POST['post_id']) ? (int)$_POST['post_id'] : 0;
            if ($post_id <= 0) {
                die("Error: Invalid Post ID.");
            }
    
            // Ensure slug is unique, excluding the current post
            $slug = ensureUniqueSlug($conn, $slug, 'posts', 'slug', $post_id);
    
            $stmt = $conn->prepare("UPDATE posts SET title = ?, slug = ?, content = ?, image_url = ?, author_id = ?, category_id = ?, updated_at = CURRENT_TIMESTAMP WHERE post_id = ?");
            if (!$stmt) {
                die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
            }
            $stmt->bind_param("sssiiii", $title, $slug, $content, $image_url, $author_id, $category_id, $post_id);
            
            if ($stmt->execute()) {
                // Redirect back to manage_blog with success
                header("Location: ../admin.php?page=manage_blog&status=post_updated");
                exit;
            } else {
                die("Error updating post: " . $stmt->error);
            }
            $stmt->close();
        }
    }

    // Handle Category Actions
    elseif ($action === 'create_category') {
        // Fields for category
        $category_name = trim($_POST['category_name'] ?? '');
        $slug = trim($_POST['slug'] ?? '');

        // Validate required fields
        if (empty($category_name)) {
            die("Error: Category name is required.");
        }

        // Generate slug if not provided
        if (empty($slug)) {
            $slug = generateSlug($category_name);
        }

        // Ensure slug is unique
        $slug = ensureUniqueSlug($conn, $slug, 'categories', 'slug');

        // Insert the new category
        $stmt = $conn->prepare("INSERT INTO categories (category_name, slug) VALUES (?, ?)");
        if (!$stmt) {
            die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
        }
        $stmt->bind_param("ss", $category_name, $slug);
        
        if ($stmt->execute()) {
            // Redirect back to manage_blog with success
            header("Location: ../admin.php?page=manage_blog&status=category_created");
            exit;
        } else {
            die("Error creating category: " . $stmt->error);
        }
        $stmt->close();
    }

    elseif ($action === 'delete_category') {
        // Get category_id to delete
        $category_id = isset($_POST['category_id']) ? (int)$_POST['category_id'] : 0;
        if ($category_id <= 0) {
            die("Error: Invalid Category ID.");
        }

        // Delete the category
        $stmt = $conn->prepare("DELETE FROM categories WHERE category_id = ?");
        if (!$stmt) {
            die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
        }
        $stmt->bind_param("i", $category_id);
        
        if ($stmt->execute()) {
            // Redirect back to manage_blog with success
            header("Location: ../admin.php?page=manage_blog&status=category_deleted");
            exit;
        } else {
            die("Error deleting category: " . $stmt->error);
        }
        $stmt->close();
    }

    elseif ($action === 'delete_post') {
        // get post id to delete
        $post_id = isset($_POST['post_id']) ? (int)$_POST['post_id'] : 0;
        if ($post_id <= 0) {
            die("Error: Invalid post ID.");
        }
        
        //  delete the post
        $stmt = $conn->prepare("DELETE FROM posts WHERE post_id = ?");
        if (!$stmt) {
            die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
        }
        $stmt->bind_param("i", $post_id);

        if ($stmt->execute()) {
            header("Location: ../admin.php?page=manage_blog&status=post_deleted");
            exit;
        } else {
            die("Error deleting post: " . $stmt->error);
        }
        $stmt->close();
    }

    else {
        die("Error: Invalid action.");
    }
} else {
    die("Error: Invalid request method.");
}
?>

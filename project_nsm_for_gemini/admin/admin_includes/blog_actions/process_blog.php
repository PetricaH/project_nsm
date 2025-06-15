<?php
require_once('../../../config.php'); // session_start() and DB connection presumably in config

header('Content-Type: application/json'); // We will always return JSON

// Check admin role
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo json_encode([
        'status' => 'error',
        'message' => 'Unauthorized request. Admin only.'
    ]);
    exit;
}

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
        // Prepare SQL based on whether to exclude an ID
        if ($exclude_id) {
            $stmt = $conn->prepare("SELECT COUNT(*) FROM `$table` WHERE `$column` = ? AND `category_id` != ?");
            if (!$stmt) {
                echo json_encode(['status' => 'error', 'message' => $conn->error]);
                exit;
            }
            $stmt->bind_param("si", $slug, $exclude_id);
        } else {
            $stmt = $conn->prepare("SELECT COUNT(*) FROM `$table` WHERE `$column` = ?");
            if (!$stmt) {
                echo json_encode(['status' => 'error', 'message' => $conn->error]);
                exit;
            }
            $stmt->bind_param("s", $slug);
        }

        if (!$stmt->execute()) {
            echo json_encode(['status' => 'error', 'message' => $stmt->error]);
            exit;
        }

        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();

        if ($count == 0) {
            // No collision, we can use this slug
            break;
        }

        // Collision found; increment slug
        $slug = $original_slug . '-' . $i;
        $i++;
    }

    return $slug;
}

// Must be a POST request
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid request method. Only POST allowed.'
    ]);
    exit;
}

$action = $_POST['action'] ?? '';

/*--------------------------------------------------------------
 | 1. CREATE OR UPDATE POST
 *-------------------------------------------------------------*/
if ($action === 'create' || $action === 'update') {
    // Common fields
    $title       = trim($_POST['title'] ?? '');
    $content     = trim($_POST['content'] ?? '');
    $image_url   = trim($_POST['image_url'] ?? '');
    $author_id   = isset($_POST['author_id']) ? (int)$_POST['author_id'] : 0;
    $category_id = isset($_POST['category_id']) ? (int)$_POST['category_id'] : 0;

    // Validation
    if (empty($title)) {
        echo json_encode(['status' => 'error', 'message' => 'Title is required.']);
        exit;
    }
    if ($author_id <= 0) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid Author ID.']);
        exit;
    }
    if ($category_id <= 0) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid Category ID.']);
        exit;
    }

    // Generate slug from title
    $slug = generateSlug($title);

    /*----------------------------------------------------------
     | CREATE POST
     *---------------------------------------------------------*/
    if ($action === 'create') {
        // Ensure unique slug in 'posts'
        $slug = ensureUniqueSlug($conn, $slug, 'posts', 'slug');

        // Insert new post
        $stmt = $conn->prepare("INSERT INTO posts (title, slug, content, image_url, author_id, category_id) 
                                VALUES (?, ?, ?, ?, ?, ?)");
        if (!$stmt) {
            echo json_encode(['status' => 'error', 'message' => $conn->error]);
            exit;
        }
        $stmt->bind_param("sssiii", $title, $slug, $content, $image_url, $author_id, $category_id);

        if ($stmt->execute()) {
            echo json_encode(['status' => 'post_created']);
        } else {
            echo json_encode(['status' => 'error', 'message' => $stmt->error]);
        }
        $stmt->close();
        exit;
    }

    /*----------------------------------------------------------
     | UPDATE POST
     *---------------------------------------------------------*/
    if ($action === 'update') {
        $post_id = isset($_POST['post_id']) ? (int)$_POST['post_id'] : 0;
        if ($post_id <= 0) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid Post ID.']);
            exit;
        }

        // Ensure slug is unique, excluding the current post
        $slug = ensureUniqueSlug($conn, $slug, 'posts', 'slug', $post_id);

        $stmt = $conn->prepare("UPDATE posts
                                SET title = ?, slug = ?, content = ?, image_url = ?, author_id = ?, category_id = ?, updated_at = CURRENT_TIMESTAMP
                                WHERE post_id = ?");
        if (!$stmt) {
            echo json_encode(['status' => 'error', 'message' => $conn->error]);
            exit;
        }

        $stmt->bind_param("sssiiii", $title, $slug, $content, $image_url, $author_id, $category_id, $post_id);

        if ($stmt->execute()) {
            echo json_encode(['status' => 'post_updated']);
        } else {
            echo json_encode(['status' => 'error', 'message' => $stmt->error]);
        }
        $stmt->close();
        exit;
    }
}

/*--------------------------------------------------------------
 | 2. CREATE CATEGORY
 *-------------------------------------------------------------*/
elseif ($action === 'create_category') {
    $category_name = trim($_POST['category_name'] ?? '');
    $slug          = trim($_POST['slug'] ?? '');

    if (empty($category_name)) {
        echo json_encode(['status' => 'error', 'message' => 'Category name is required.']);
        exit;
    }

    // Generate slug if not provided
    if (empty($slug)) {
        $slug = generateSlug($category_name);
    }

    // Ensure slug is unique
    $slug = ensureUniqueSlug($conn, $slug, 'categories', 'slug');

    $stmt = $conn->prepare("INSERT INTO categories (category_name, slug) VALUES (?, ?)");
    if (!$stmt) {
        echo json_encode(['status' => 'error', 'message' => $conn->error]);
        exit;
    }
    $stmt->bind_param("ss", $category_name, $slug);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'category_created']);
    } else {
        echo json_encode(['status' => 'error', 'message' => $stmt->error]);
    }
    $stmt->close();
    exit;
}

/*--------------------------------------------------------------
 | 3. DELETE CATEGORY
 *-------------------------------------------------------------*/
elseif ($action === 'delete_category') {
    $category_id = isset($_POST['category_id']) ? (int)$_POST['category_id'] : 0;
    if ($category_id <= 0) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid Category ID.']);
        exit;
    }

    $stmt = $conn->prepare("DELETE FROM categories WHERE category_id = ?");
    if (!$stmt) {
        echo json_encode(['status' => 'error', 'message' => $conn->error]);
        exit;
    }
    $stmt->bind_param("i", $category_id);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'category_deleted']);
    } else {
        echo json_encode(['status' => 'error', 'message' => $stmt->error]);
    }
    $stmt->close();
    exit;
}

/*--------------------------------------------------------------
 | 4. DELETE POST
 *-------------------------------------------------------------*/
elseif ($action === 'delete_post') {
    $post_id = isset($_POST['post_id']) ? (int)$_POST['post_id'] : 0;
    if ($post_id <= 0) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid Post ID.']);
        exit;
    }

    $stmt = $conn->prepare("DELETE FROM posts WHERE post_id = ?");
    if (!$stmt) {
        echo json_encode(['status' => 'error', 'message' => $conn->error]);
        exit;
    }
    $stmt->bind_param("i", $post_id);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'post_deleted']);
    } else {
        echo json_encode(['status' => 'error', 'message' => $stmt->error]);
    }
    $stmt->close();
    exit;
}

/*--------------------------------------------------------------
 | 5. UNKNOWN ACTION
 *-------------------------------------------------------------*/
else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid action.']);
    exit;
}

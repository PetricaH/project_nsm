<?php 
session_start();

if ($_SESSION['role'] !== 'admin') {
    header('Location: ../index.php');
    exit;
}

require_once('../../../config.php');
header('Content-Type: application/json');

// create post
if (isset($_POST['action']) && $_POST['action'] === 'create') {
    $title = $conn->real_escape_string($_POST['title'] ?? '');
    $slug = $conn->real_escape_string($_POST['slug'] ?? '');
    $content = $conn->real_escape_string($_POST['content'] ?? '');
    $image_url = $conn->real_escape_string($_POST['image_url'] ?? '');
    $author_id = (int)($_POST['author_id'] ?? 0);
    $category_id = (int)($_POST['category_id'] ?? 0);

    $sql = "INSERT INTO posts (title, slug, content, image_url, author_id, category_id)
            VALUES ('$title', '$slug', '$content', '$image_url', '$author_id', '$category_id')";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: admin.php?page=manage_blog");
        exit;
    } else {
        echo "Error creating post: " . $conn->error;
    }
}

// update post
if (isset($_POST['action']) && $_POST['action'] === 'update') {
    $post_id = (int)($_POST['post_id'] ?? 0);
    $title = $conn->real_escape_string($_POST['title'] ?? '');
    $slug = $conn->real_escape_string($_POST['slug'] ?? '');
    $content = $conn->real_escape_string($_POST['content'] ?? '');
    $image_url = $conn->real_escape_string($_POST['image_url'] ?? '');
    $author_id = (int)($_POST['author_id'] ?? 0);
    $category_id = (int)($_POST['category_id'] ?? 0);

    $sql = "UPDATE posts
            SET title = '$title',
                slug = '$slug',
                content = '$content',
                image_url = '$image_url',
                author_id = '$author_id',
                category_id = '$category_id',
                updated_at = CURRENT_TIMESTAMP
            WHERE post_id = $post_id";

    if ($conn->query($sql) === TRUE) {
        header("Location: admin.php?page=manage_blog");
        exit;
    } else {
        echo "Error updating post: " . $conn->error;
    }
}

// delete post

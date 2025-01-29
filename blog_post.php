<?php require_once('config.php'); ?>

<?php require_once(ROOT_PATH . '/includes/heading.php'); ?>

<?php $page_css = 'blog.css';?>

<?php
$slug = $_GET['slug'] ?? '';
if (empty($slug)) {
    header('Location: blog.php');
    exit;
}

// Fetch the blog post
$sql = "SELECT p.post_id, p.title, p.slug, p.content, p.image_url, p.author_id, p.category_id,
               p.created_at, p.updated_at, u.username AS author_name, c.category_name
        FROM posts p
        LEFT JOIN users u ON p.author_id = u.user_id
        LEFT JOIN categories c ON p.category_id = c.category_id
        WHERE p.slug = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $slug);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    header('Location: blog.php');
    exit;
}

$post = $result->fetch_assoc();
?>
<?php include(ROOT_PATH . '/includes/navbar.php'); ?>
<!-- Blog Post Content -->
<section class="blog_post_section">
    <div class="container">
        <h1><?php echo htmlspecialchars($post['title']); ?></h1>
        <div class="post_meta">
            <span class="author">By <?php echo htmlspecialchars($post['author_id']); ?></span>
            <span class="date"><?php echo date('M d, Y', strtotime($post['created_at'])); ?></span>
        </div>
        <?php if (!empty($post['image_url'])) { ?>
            <img src="<?php echo $post['image_url']; ?>" alt="<?php echo htmlspecialchars($post['title']); ?>" class="post_image">
        <?php } ?>
        <div class="post_content">
            <?php echo nl2br(htmlspecialchars($post['content'])); ?>
        </div>
    </div>
</section>

<?php include('includes/footer.php'); ?>
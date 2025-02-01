<?php require_once('config.php'); ?>
<?php require_once(ROOT_PATH . '/includes/heading.php'); ?>

<?php $page_css = 'blog_post.css'; ?>

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
<div class="blog_post_page">
    <section class="blog_post_section">
    <button id="mode_toggle">🌙</button>
        <div class="container">
            <h1><?php echo htmlspecialchars($post['title']); ?></h1>

            <div class="post_meta">
                <span class="author">By <?php echo htmlspecialchars($post['author_id']); ?></span>
                <span class="date"><?php echo date('M d, Y', strtotime($post['created_at'])); ?></span>
            </div>

            <?php if (!empty($post['image_url'])) { ?>
                <img src="<?php echo $post['image_url']; ?>" alt="<?php echo htmlspecialchars($post['title']); ?>" class="post_image">
            <?php } else { ?>
                <img src="/images/default-blog.jpg" alt="Default Blog Image" class="post_image">
            <?php } ?>

            <div class="post_content">
                <?php echo nl2br($post['content']); ?>
            </div>
        </div>
        <!-- Social Share Section -->
        <div class="social_share">
            <p>Share this post:</p>
            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode("https://hreniucpetrica.ro/blog_post.php?slug=" . $post['slug']); ?>" target="_blank" class="share_btn facebook">Facebook</a>
            <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode("https://hreniucpetrica.ro/blog_post.php?slug=" . $post['slug']); ?>&text=<?php echo urlencode($post['title']); ?>" target="_blank" class="share_btn twitter">Twitter</a>
            <a href="https://api.whatsapp.com/send?text=<?php echo urlencode("Check this out: " . $post['title'] . " https://hreniucpetrica.ro/blog_post.php?slug=" . $post['slug']); ?>" target="_blank" class="share_btn whatsapp">WhatsApp</a>
            <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo urlencode("https://hreniucpetrica.ro/blog_post.php?slug=" . $post['slug']); ?>" target="_blank" class="share_btn linkedin">LinkedIn</a>
        </div>

        <!-- Related Posts Section -->
        <div class="related_posts">
            <h2>Related Posts</h2>
            <div class="related_posts_grid">
                <?php
                $related_sql = "SELECT title, slug, image_url FROM posts 
                                WHERE category_id = ? AND slug != ? 
                                ORDER BY created_at DESC LIMIT 3";
                $stmt_related = $conn->prepare($related_sql);
                $stmt_related->bind_param("is", $post['category_id'], $post['slug']);
                $stmt_related->execute();
                $related_result = $stmt_related->get_result();

                while ($related_post = $related_result->fetch_assoc()) { ?>
                    <a href="blog_post.php?slug=<?php echo $related_post['slug']; ?>" class="related_post_card">
                        <img src="<?php echo $related_post['image_url'] ?: 'images/default-blog.jpg'; ?>" alt="<?php echo htmlspecialchars($related_post['title']); ?>">
                        <h3><?php echo htmlspecialchars($related_post['title']); ?></h3>
                    </a>
                <?php } ?>
            </div>
        </div>
    </section>
</div>

<?php include('includes/footer.php'); ?>

<?php require_once('config.php'); ?>

<?php require_once(ROOT_PATH . '/includes/heading.php'); ?>

<?php $page_css = 'blog.css';?>

<?php
// Fetch all blog posts
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
?>

<?php include(ROOT_PATH . '/includes/navbar.php'); ?>

<!-- Hero Section -->
<section class="hero_blog_section">
    <div class="gradient_overlay"></div>
    <div class="blog_hero_content">
        <h1>Everything that matters</h1>
        <div class="under_h1_text_container">
            <p>Take a look, you'll like it here!</p>
        </div>
    </div>
</section>

<!-- Blog Posts Grid -->
<section id="blog_posts_section">
    <div class="container">
        <h2>Latest <span>Posts</span></h2>
        <div class="blog_posts_grid">
            <?php while ($row = $result->fetch_assoc()) { ?>
                <div class="blog_post_card">
                    <a href="blog_post.php?slug=<?php echo $row['slug']; ?>">
                        <?php if (!empty($row['image_url'])) { ?>
                            <img src="<?php echo $row['image_url']; ?>" alt="<?php echo htmlspecialchars($row['title']); ?>">
                        <?php } ?>
                        <h3><?php echo htmlspecialchars($row['title']); ?></h3>
                        <p><?php 
                                // Decode HTML entities first, then strip tags
                                $raw_content = html_entity_decode($row['content']);
                                $clean_content = strip_tags($raw_content);
                                $preview = mb_substr($clean_content, 0, 50, 'UTF-8');
                                if (mb_strlen($clean_content) > 50) {
                                    $preview .= '...';
                                }
                                echo htmlspecialchars($preview, ENT_QUOTES, 'UTF-8');
                            ?></p>
                        <div class="post_meta">
                            <span class="author">By <?php echo htmlspecialchars($row['author_name']); ?></span>
                            <span class="date"><?php echo date('M d, Y', strtotime($row['created_at'])); ?></span>
                        </div>
                    </a>
                </div>
            <?php } ?>
        </div>
    </div>
</section>

<?php include('includes/footer.php'); ?>
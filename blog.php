<?php require_once('config.php'); ?>
<?php require_once(ROOT_PATH . '/includes/heading.php'); ?>

<?php $page_css = 'blog.css'; ?>

<?php include(ROOT_PATH . '/includes/navbar.php'); ?>

<!-- Blog Listing Page Wrapper -->
<div class="blog_list_page">
    <!-- Hero Section -->
    <section class="hero_blog_section">
        <div class="blog_hero_content">
            <h1>Latest Blog Posts</h1>
        </div>
    </section>

    <!-- Blog Posts Grid -->
    <section id="blog_posts_section">
        <div class="container">
            <div class="blog_posts_grid">
                <?php
                $sql = "SELECT post_id, title, slug, content, image_url, created_at FROM posts ORDER BY created_at DESC";
                $result = $conn->query($sql);
                while ($post = $result->fetch_assoc()) { ?>
                    <div class="blog_post_card">
                        <img src="<?php echo $post['image_url'] ?: 'images/default-blog.jpg'; ?>" alt="<?php echo htmlspecialchars($post['title']); ?>">
                        <h3><?php echo htmlspecialchars($post['title']); ?></h3>
                        <p><?php echo substr(strip_tags($post['content']), 0, 100) . '...'; ?></p>
                        <div class="post_meta">
                            <span><?php echo date('M d, Y', strtotime($post['created_at'])); ?></span>
                        </div>
                        <a href="blog_post.php?slug=<?php echo $post['slug']; ?>" class="see_more_btn">Read More</a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
</div>

<?php include('includes/footer.php'); ?>

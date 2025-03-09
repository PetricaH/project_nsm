<?php require_once('config.php'); ?>
<?php require_once(ROOT_PATH . '/includes/heading.php'); ?>

<?php $page_css = 'blog.css'; ?>
<title>Blog - Latest Articles</title>
</head>

<body data-context="blog">

<?php include(ROOT_PATH . '/includes/navbar.php'); ?>

<!-- Blog Listing Page Wrapper -->
<div class="blog_list_page">
    <!-- Hero Section -->
    <section class="hero_blog_section">
        <div class="blog_hero_content">
            <h1>Latest Articles</h1>
            <p>Insights, tutorials, and thoughts on web development, automation, and digital experiences.</p>
        </div>
    </section>
    
    <!-- Blog Posts Grid -->
    <section id="blog_posts_section">
        <div class="container">
            <div class="blog_posts_grid">
                <?php
                $sql = "SELECT post_id, title, slug, content, image_url, created_at FROM posts ORDER BY created_at DESC";
                $result = $conn->query($sql);
                
                if ($result && $result->num_rows > 0) {
                    while ($post = $result->fetch_assoc()) { 
                        // Get excerpt by stripping tags and limiting to 150 characters
                        $excerpt = substr(strip_tags($post['content']), 0, 150);
                        // Add ellipsis if content was truncated
                        if (strlen(strip_tags($post['content'])) > 150) {
                            $excerpt .= '...';
                        }
                        
                        // Format date
                        $date = date('M d, Y', strtotime($post['created_at']));
                ?>
                    <div class="blog_post_card">
                        <img src="<?php echo $post['image_url'] ?: 'static/images/default-blog.jpg'; ?>" alt="<?php echo htmlspecialchars($post['title']); ?>">
                        <div class="blog_post_card_content">
                            <h3><?php echo htmlspecialchars($post['title']); ?></h3>
                            <p><?php echo $excerpt; ?></p>
                            <div class="post_meta">
                                <span><?php echo $date; ?></span>
                            </div>
                            <a href="blog_post.php?slug=<?php echo $post['slug']; ?>" class="see_more_btn">Read Article</a>
                        </div>
                    </div>
                <?php 
                    }
                } else {
                    echo '<div class="no-posts-message">No blog posts available at the moment. Check back soon!</div>';
                }
                ?>
            </div>
        </div>
    </section>
</div>

<?php include(ROOT_PATH . '/includes/footer.php'); ?>
</body>
</html>
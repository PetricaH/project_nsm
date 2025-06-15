<?php require_once('config.php'); ?>
<?php require_once(ROOT_PATH . '/includes/heading.php'); ?>

<?php
// Get blog post by slug
if (isset($_GET['slug'])) {
    $slug = $_GET['slug'];
    $sql = "SELECT post_id, title, content, image_url, created_at, author_id FROM posts WHERE slug = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $slug);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $post = $result->fetch_assoc();
    } else {
        // Redirect to blog page if post not found
        header("Location: blog.php");
        exit();
    }
    $stmt->close();
} else {
    // Redirect to blog page if no slug provided
    header("Location: blog.php");
    exit();
}
?>

<?php $page_css = 'blog_post.css'; ?>
<title><?php echo htmlspecialchars($post['title']); ?> - Blog</title>

<!-- Meta tags for social sharing -->
<meta property="og:title" content="<?php echo htmlspecialchars($post['title']); ?>">
<meta property="og:description" content="<?php echo htmlspecialchars(substr(strip_tags($post['content']), 0, 150)) . '...'; ?>">
<meta property="og:image" content="<?php echo $post['image_url']; ?>">
<meta property="og:url" content="<?php echo "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>">
<meta name="twitter:card" content="summary_large_image">

</head>

<body data-context="blog_post">

<?php include(ROOT_PATH . '/includes/navbar.php'); ?>

<div class="blog_post_page">
    <article class="blog_post_section">
        <!-- Featured Image -->
        <div class="post_image_container">
            <img src="<?php echo $post['image_url'] ?: 'static/images/default-blog.jpg'; ?>" alt="<?php echo htmlspecialchars($post['title']); ?>" class="post_image">
        </div>
        
        <div class="post_content_container">
            <!-- Blog Title -->
            <h1><?php echo htmlspecialchars($post['title']); ?></h1>
            
            <!-- Post Meta -->
            <div class="post_meta">
                <span>De <?php echo htmlspecialchars($post['author_id']); ?></span>
                <span><?php echo date('d F Y', strtotime($post['created_at'])); ?></span>
            </div>
            
            <!-- Blog Content -->
            <div class="post_content">
                <?php echo $post['content']; ?>
            </div>
            
            <!-- Social Share -->
            <div class="social_share">
                <p>Distribuie acest articol:</p>
                <div class="share_buttons">
                    <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode("https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>&text=<?php echo urlencode($post['title']); ?>" target="_blank" rel="noopener noreferrer" class="share_btn">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode("https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>" target="_blank" rel="noopener noreferrer" class="share_btn">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode("https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>&title=<?php echo urlencode($post['title']); ?>" target="_blank" rel="noopener noreferrer" class="share_btn">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                </div>
            </div>
            
            <!-- Related Posts -->
            <section class="related_posts">
                <h2>Articole Similare</h2>
                <div class="related_posts_grid">
                    <?php
                    // Get 3 recent posts excluding current post
                    $sql = "SELECT post_id, title, slug, content, image_url, created_at FROM posts WHERE post_id != ? ORDER BY created_at DESC LIMIT 3";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $post['post_id']);
                    $stmt->execute();
                    $related_result = $stmt->get_result();
                    
                    while ($related_post = $related_result->fetch_assoc()) {
                        // Get short excerpt
                        $excerpt = substr(strip_tags($related_post['content']), 0, 100);
                        if (strlen(strip_tags($related_post['content'])) > 100) {
                            $excerpt .= '...';
                        }
                    ?>
                    <a href="blog_post.php?slug=<?php echo $related_post['slug']; ?>" class="related_post_card">
                        <img src="<?php echo $related_post['image_url'] ?: 'static/images/default-blog.jpg'; ?>" alt="<?php echo htmlspecialchars($related_post['title']); ?>">
                        <div class="related_post_card_content">
                            <h3><?php echo htmlspecialchars($related_post['title']); ?></h3>
                            <p><?php echo $excerpt; ?></p>
                        </div>
                    </a>
                    <?php
                    }
                    $stmt->close();
                    ?>
                </div>
            </section>
        </div>
        
        <!-- Light/Dark Mode Toggle -->
        <button id="mode_toggle" aria-label="Comută Modul Luminos/Întunecat">
            <i class="fas fa-moon dark-icon"></i>
            <i class="fas fa-sun light-icon" style="display: none;"></i>
        </button>
    </article>
</div>

<!-- Mode Toggle Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const modeToggle = document.getElementById('mode_toggle');
    const blogPostSection = document.querySelector('.blog_post_section');
    const darkIcon = document.querySelector('.dark-icon');
    const lightIcon = document.querySelector('.light-icon');
    
    // Check for saved mode preference
    const savedMode = localStorage.getItem('blogMode');
    if (savedMode === 'light') {
        enableLightMode();
    }
    
    // Toggle mode on button click
    modeToggle.addEventListener('click', function() {
        if (blogPostSection.classList.contains('light_mode')) {
            enableDarkMode();
        } else {
            enableLightMode();
        }
    });
    
    function enableLightMode() {
        blogPostSection.classList.add('light_mode');
        darkIcon.style.display = 'none';
        lightIcon.style.display = 'inline-block';
        localStorage.setItem('blogMode', 'light');
    }
    
    function enableDarkMode() {
        blogPostSection.classList.remove('light_mode');
        darkIcon.style.display = 'inline-block';
        lightIcon.style.display = 'none';
        localStorage.setItem('blogMode', 'dark');
    }
});
</script>

<?php include(ROOT_PATH . '/includes/footer.php'); ?>
</body>
</html>
<?php
require_once('../config.php');
require_once('../admin/admin_includes/admin_heading.php');
require_once('../admin/admin_includes/admin_navbar.php');

// Define allowed pages and their paths
$allowed_pages = [
    'manage_artwork' => 'manage_artwork.php',
    'manage_blog' => 'manage_blog.php',
    'manage_bookings' => 'manage_bookings.php',
];

// Get the requested page from the query string or default to 'manage_artwork'
$page = isset($_GET['page']) && array_key_exists($_GET['page'], $allowed_pages) ? $_GET['page'] : 'manage_bookings';

// Initialize the content variable
$content = "<h1>Invalid page request</h1>";

// Check if the requested page exists in the allowed pages 
if (array_key_exists($page, $allowed_pages)) {
    $pagePath = $allowed_pages[$page];
    if (file_exists($pagePath)) {
        error_log("Resolved Path: " . $pagePath);
        ob_start(); // Start output buffering
        include $pagePath;
        $content = ob_get_clean(); // Get the included file's output
    } else {
        $content = "<h1>Error: Page file not found</h1>";
    }
}
?>

<div class="sidebar">
    <ul>
        <li><a href="?page=manage_artwork" class="tab">Manage Artwork</a></li>
        <li><a href="?page=manage_blog" class="tab">Manage Blog</a></li>
        <li><a href="?page=manage_bookings" class="tab">Manage Bookings</a></li>
    </ul>
</div>

<div class="main_content">
    <?php echo $content; ?>
</div>

<?php include ('../admin/admin_includes/admin_footer.php'); ?>
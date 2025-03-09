<?php
// admin.php

/****************************************************
 * 1. Include config.php (which starts the session)
 *    BEFORE any HTML is output.
 ****************************************************/
require_once('../config.php');

/****************************************************
 * 2. Check if the user is logged in and has 'admin' role
 ****************************************************/
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true || $_SESSION['role'] !== 'admin') {
    // Optionally, set a flash message about unauthorized access
    header('Location: ../index.php');
    exit;
}

/****************************************************
 * 3. Define allowed pages and their file paths
 ****************************************************/
$allowed_pages = [
    'manage_artwork'   => 'manage_artwork.php',
    'manage_blog'      => 'manage_blog.php',
    'manage_bookings'  => 'manage_bookings.php',
    'manage_users'     => 'manage_users.php',
    'manage_webdev'    => 'manage_webdev.php',
];

/****************************************************
 * 4. Determine requested page or default to 'manage_users'
 ****************************************************/
$page = isset($_GET['page']) && array_key_exists($_GET['page'], $allowed_pages)
    ? $_GET['page']
    : 'manage_users';

/****************************************************
 * 5. Capture the page content output into a buffer
 ****************************************************/
ob_start(); 
if (array_key_exists($page, $allowed_pages)) {
    $pagePath = $allowed_pages[$page];
    if (file_exists($pagePath)) {
        error_log("Resolved Path: " . $pagePath);
        include $pagePath;  // This file's output goes into the buffer
    } else {
        echo "<h1>Error: Page file not found</h1>";
    }
} else {
    echo "<h1>Invalid page request</h1>";
}
$content = ob_get_clean(); // Store the page's output in $content

/****************************************************
 * 6. Include heading and navbar AFTER checks,
 *    but BEFORE printing the main layout
 ****************************************************/
require_once('../admin/admin_includes/admin_heading.php');
require_once('../admin/admin_includes/admin_navbar.php');
?>

<!-- Your main layout starts here -->
<div class="sidebar">
    <ul>
        <li><a href="?page=manage_artwork" class="tab <?php echo $page === 'manage_artwork' ? 'active' : ''; ?>">Manage Artwork</a></li>
        <li><a href="?page=manage_blog" class="tab <?php echo $page === 'manage_blog' ? 'active' : ''; ?>">Manage Blog</a></li>
        <li><a href="?page=manage_bookings" class="tab <?php echo $page === 'manage_bookings' ? 'active' : ''; ?>">Manage Bookings</a></li>
        <li><a href="?page=manage_users" class="tab <?php echo $page === 'manage_users' ? 'active' : ''; ?>">Manage Users</a></li>
        <li><a href="?page=manage_webdev" class="tab <?php echo $page === 'manage_webdev' ? 'active' : ''; ?>">Manage Web Projects</a></li>
    </ul>
</div>

<div class="main_content">
    <?php 
    // Display status messages if present
    if (isset($_GET['status'])) {
        $statusClass = $_GET['status'] === 'success' ? 'success' : 'error';
        $message = $_GET['message'] ?? ($_GET['status'] === 'success' ? 'Operation completed successfully!' : 'An error occurred.');
        echo "<div class='notification {$statusClass}'>{$message}</div>";
    }
    
    // Display the page content
    echo $content; 
    ?>
</div>

<?php include ('../admin/admin_includes/admin_footer.php'); ?>
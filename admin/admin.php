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
        <li><a href="?page=manage_artwork" class="tab">Manage Artwork</a></li>
        <li><a href="?page=manage_blog" class="tab">Manage Blog</a></li>
        <li><a href="?page=manage_bookings" class="tab">Manage Bookings</a></li>
        <li><a href="?page=manage_users" class="tab">Manage Users</a></li>
    </ul>
</div>

<div class="main_content">
    <?php echo $content; ?>
</div>

<!-- Success/Error Messages -->
<?php if (isset($_GET['status'])): ?>
    <div class="notification <?= htmlspecialchars($_GET['status']); ?>">
        <?php
        switch ($_GET['status']) {
            case 'success':
                echo 'User deleted successfully!';
                break;
            case 'error':
                echo 'Failed to delete the user.';
                break;
            case 'invalid':
                echo 'Invalid user ID.';
                break;
        }
        ?>
    </div>
<?php endif; ?>

<?php include ('../admin/admin_includes/admin_footer.php'); ?>

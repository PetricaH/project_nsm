<?php require_once('../config.php'); ?>
<?php require_once('../admin/admin_includes/admin_heading.php'); ?>
<?php require_once('../admin/admin_includes/admin_navbar.php'); ?>

<div class="sidebar">
    <ul>
        <li><a href="?page=manage_artwork" class="tab">Manage Artwork</a></li>
        <li><a href="?page=manage_blog" class="tab">Manage Blog</a></li>
        <li><a href="?page=manage_bookings" class="tab">Manage Bookings</a></li>
    </ul>
</div>

<div class="main_content">
    <?php
    $page = isset($_GET['page']) ? $_GET['page'] : 'manage_artwork';
    $allowed_pages = ['manage_artwork', 'manage_blog', 'manage_bookings'];

    if (in_array($page, $allowed_pages)) {
        $pagePath = "../admin/$page.php";
        if (file_exists($pagePath)) {
            include $pagePath;
        } else {
            echo "<h1>Page not found</h1>";
        }
    } else {
        echo "<h1>Invalid page request</h1>";
    }
    ?>
</div>

<?php include '../admin/admin_includes/admin_footer.php'; ?>

<?php require_once('../config.php'); ?>
<?php require_once( ROOT_PATH . '/admin/admin_includes/admin_heading.php'); ?>
<?php require_once( ROOT_PATH . '/admin/admin_includes/admin_navbar.php'); ?>
<?php
// Check if the 'page' parameter exists in the URL, otherwise, set a default page
$page = isset($_GET['page']) ? $_GET['page'] : 'default_page';  // Default to 'default_page' if no 'page' is set

// Build the path to the page dynamically
$pagePath = "admin/" . $page . ".php";

// Check if the page file exists, and include it if found
if (file_exists($pagePath)) {
    include($pagePath);  // Include the page content
} else {
    echo "Page not found";  // Handle the case where the page doesn't exist
}
?>
    <title>Admin Panel</title>

</head>
<body>

    <div class="sidebar">
        <ul>
            <li><a href="?page=manage_artwork" class="tab">Manage Artwork</a></li>
            <li><a href="?page=manage_blog" class="tab">Manage blog</a></li>
        </ul>
    </div>

    <div class="main_content">
        <?php 
        // dinamically include the content based on the selected tab
        switch ($page) {
            case 'manage_artwork':
                include '/admin/manage_artwork.php';
                break;
            case 'manage_blog':
                include '/admin/manage_blog.php';
                break;
            default:
                include '../admin/manage_artwork.php';
        }
        ?>
    </div>

    <script src="admin/admin/admin.js"></script>
</body>
</html>
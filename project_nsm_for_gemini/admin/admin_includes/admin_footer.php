<!-- Admin JavaScript -->
<script src="js/admin.js"></script>
    
    <?php
    // Page-specific JS
    $page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
    $jsMap = [
        'manage_blog'    => 'manage_blog.js',
        'manage_artwork' => 'manage_artworks.js',
        'manage_bookings'=> 'manage_bookings.js', 
        'manage_users'   => 'manage_users.js',
        'manage_webdev'  => 'manage_webdev.js',
        'dashboard'      => 'dashboard.js'
    ];
    
    if (isset($jsMap[$page])) {
        echo '<script src="js/' . $jsMap[$page] . '"></script>';
    }
    ?>
</body>
</html>
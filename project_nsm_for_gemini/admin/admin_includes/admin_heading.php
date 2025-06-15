<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Panel | Hreniuc Petrică</title>
    
    <!-- Poppins and Reenie Beanie fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Reenie+Beanie&display=swap" rel="stylesheet">
    
    <!-- Admin CSS -->
    <link rel="stylesheet" href="admin_styles/admin.css">
    
    <?php
    // Page-specific CSS
    $page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
    $cssMap = [
        'manage_artwork' => 'manage_artworks.css',
        'manage_blog'    => 'manage_blog.css',
        'manage_bookings'=> 'manage_bookings.css',
        'manage_users'   => 'manage_users.css',
        'manage_webdev'  => 'manage_webdev.css',
        'dashboard'      => 'dashboard.css'
    ];
    
    if (isset($cssMap[$page])) {
        echo '<link rel="stylesheet" href="admin_styles/' . $cssMap[$page] . '">';
    }
    ?>
    
    <!-- CKEditor (for blog editing) -->
    <script src="https://cdn.ckeditor.com/4.20.2/standard/ckeditor.js"></script>
    
    <!-- jQuery (if needed) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
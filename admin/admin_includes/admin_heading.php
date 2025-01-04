<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Poppins and Reenie Beanie fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Reenie+Beanie&display=swap" rel="stylesheet">
    <!-- Google Icons -->

    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />

    <!-- Common Styles -->
    <link rel="stylesheet" type="text/css" href="../admin/admin_styles/admin.css">
    <link rel="stylesheet" type="text/css" href="../admin/admin_styles/notifications.css">

    <!-- Dynamic Page-Specific Styles -->
    <?php if (isset($page)): ?>
        <?php if ($page === 'manage_artwork'): ?>
            <link rel="stylesheet" type="text/css" href="../admin/admin_styles/manage_artworks.css">
        <?php elseif ($page === 'manage_bookings'): ?>
            <link rel="stylesheet" type="text/css" href="../admin/admin_styles/manage_bookings.css">
        <?php elseif ($page === 'manage_users'): ?>
            <link rel="stylesheet" type="text/css" href="../admin/admin_styles/manage_users.css">
        <?php elseif ($page === 'manage_blog'): ?>
            <link rel="stylesheet" type="text/css" href="../admin/admin_styles/manage_blog.css">
        <?php endif; ?>
    <?php endif; ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <?php require_once('../config.php'); ?>

    <title>Admin Panel</title>

</head>

<body>
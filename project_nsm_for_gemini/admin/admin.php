<?php
// admin.php - Main admin dashboard controller

// Include configuration and start session
require_once('../config.php');

// Authentication check
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true || $_SESSION['role'] !== 'admin') {
    // Set a flash message about unauthorized access
    $_SESSION['flash_message'] = 'You must be logged in as an administrator to access the admin panel.';
    $_SESSION['flash_type'] = 'error';
    
    // Redirect to login page
    header('Location: ../login.php');
    exit;
}

// Define allowed pages and their file paths
$allowed_pages = [
    'dashboard'      => 'admin_includes/dashboard.php',
    'manage_artwork' => 'manage_artwork.php',
    'manage_blog'    => 'manage_blog.php',
    'manage_bookings'=> 'manage_bookings.php',
    'manage_users'   => 'manage_users.php',
    'manage_webdev'  => 'manage_webdev.php',
];

// Determine requested page or default to dashboard
$page = isset($_GET['page']) && array_key_exists($_GET['page'], $allowed_pages)
    ? $_GET['page']
    : 'dashboard';

// Include the header (includes DOCTYPE, <html>, <head>, etc.)
require_once('admin_includes/admin_heading.php');
?>

<div class="admin-container">
    <!-- Admin Sidebar -->
    <aside class="admin-sidebar">
        <div class="sidebar-header">
            <div class="admin-logo">
                <img src="../static/images/hreniuc_logo.png" alt="Admin Logo">
            </div>
            <h3>Admin Panel</h3>
        </div>
        
        <div class="sidebar-user">
            <div class="user-avatar">
                <span><?php echo strtoupper(substr($_SESSION['username'] ?? 'A', 0, 1)); ?></span>
            </div>
            <div class="user-info">
                <p class="user-name"><?php echo htmlspecialchars($_SESSION['username'] ?? 'Admin'); ?></p>
                <p class="user-role"><?php echo ucfirst(htmlspecialchars($_SESSION['role'] ?? 'Administrator')); ?></p>
            </div>
        </div>
        
        <nav class="sidebar-nav">
            <ul>
                <li>
                    <a href="?page=dashboard" class="<?php echo $page === 'dashboard' ? 'active' : ''; ?>">
                        <span class="nav-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="9"></rect><rect x="14" y="3" width="7" height="5"></rect><rect x="14" y="12" width="7" height="9"></rect><rect x="3" y="16" width="7" height="5"></rect></svg>
                        </span>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="?page=manage_blog" class="<?php echo $page === 'manage_blog' ? 'active' : ''; ?>">
                        <span class="nav-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                        </span>
                        <span>Blog Posts</span>
                    </a>
                </li>
                <li>
                    <a href="?page=manage_artwork" class="<?php echo $page === 'manage_artwork' ? 'active' : ''; ?>">
                        <span class="nav-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
                        </span>
                        <span>Artworks</span>
                    </a>
                </li>
                <li>
                    <a href="?page=manage_webdev" class="<?php echo $page === 'manage_webdev' ? 'active' : ''; ?>">
                        <span class="nav-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>
                        </span>
                        <span>Web Projects</span>
                    </a>
                </li>
                <li>
                    <a href="?page=manage_bookings" class="<?php echo $page === 'manage_bookings' ? 'active' : ''; ?>">
                        <span class="nav-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                        </span>
                        <span>Bookings</span>
                    </a>
                </li>
                <li>
                    <a href="?page=manage_users" class="<?php echo $page === 'manage_users' ? 'active' : ''; ?>">
                        <span class="nav-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                        </span>
                        <span>Users</span>
                    </a>
                </li>
            </ul>
        </nav>
        
        <div class="sidebar-footer">
            <a href="../includes/logout.php" class="logout-button">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                <span>Logout</span>
            </a>
        </div>
    </aside>

    <!-- Main Content Area -->
    <main class="admin-content">
        <!-- Top Bar -->
        <div class="admin-topbar">
            <div class="mobile-toggle" id="sidebarToggle">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
            </div>
            <div class="page-title">
                <h1>
                    <?php
                    switch ($page) {
                        case 'dashboard':
                            echo 'Dashboard';
                            break;
                        case 'manage_blog':
                            echo 'Manage Blog Posts';
                            break;
                        case 'manage_artwork':
                            echo 'Manage Artworks';
                            break;
                        case 'manage_webdev':
                            echo 'Manage Web Projects';
                            break;
                        case 'manage_bookings':
                            echo 'Manage Bookings';
                            break;
                        case 'manage_users':
                            echo 'Manage Users';
                            break;
                        default:
                            echo 'Admin Panel';
                    }
                    ?>
                </h1>
            </div>
            <div class="topbar-actions">
                <a href="../index.php" class="view-site-btn" target="_blank">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>
                    <span>View Site</span>
                </a>
            </div>
        </div>
        
        <!-- Content Area -->
        <div class="content-wrapper">
            <!-- Display notification messages -->
            <?php if (isset($_SESSION['flash_message'])): ?>
                <div class="notification <?php echo $_SESSION['flash_type'] ?? 'info'; ?>">
                    <span class="notification-message"><?php echo $_SESSION['flash_message']; ?></span>
                    <button class="notification-close">&times;</button>
                </div>
                <?php 
                // Clear the flash message
                unset($_SESSION['flash_message']);
                unset($_SESSION['flash_type']);
                ?>
            <?php endif; ?>
            
            <?php if (isset($_GET['status'])): ?>
                <div class="notification <?php echo htmlspecialchars($_GET['status']); ?>">
                    <span class="notification-message">
                        <?php
                        if (isset($_GET['message'])) {
                            echo htmlspecialchars($_GET['message']);
                        } else {
                            switch ($_GET['status']) {
                                case 'success':
                                    echo 'Operation completed successfully!';
                                    break;
                                case 'error':
                                    echo 'An error occurred.';
                                    break;
                                case 'invalid':
                                    echo 'Invalid request.';
                                    break;
                            }
                        }
                        ?>
                    </span>
                    <button class="notification-close">&times;</button>
                </div>
            <?php endif; ?>
            
            <!-- Page content -->
            <div class="page-content">
                <?php
                // Load the requested page content
                if (array_key_exists($page, $allowed_pages)) {
                    $pagePath = $allowed_pages[$page];
                    if (file_exists($pagePath)) {
                        include $pagePath;
                    } else {
                        echo '<div class="error-message"><h2>Error: Page file not found</h2><p>The requested page could not be found.</p></div>';
                    }
                } else {
                    echo '<div class="error-message"><h2>Invalid page request</h2><p>The requested page is not valid.</p></div>';
                }
                ?>
            </div>
        </div>
    </main>
</div>

<?php
// Include footer (with closing </body> and </html> tags)
require_once('admin_includes/admin_footer.php');
?>
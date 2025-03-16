<?php
// Include configuration and check for authentication
require_once(__DIR__ . '/../../config.php');

// Get site statistics
$stats = [
    'users' => 0,
    'blog_posts' => 0,
    'artworks' => 0,
    'bookings' => 0,
    'webdev_projects' => 0
];

// Count users
$sql = "SELECT COUNT(*) as count FROM users";
$result = $conn->query($sql);
if ($result && $row = $result->fetch_assoc()) {
    $stats['users'] = $row['count'];
}

// Count blog posts
$sql = "SELECT COUNT(*) as count FROM posts";
$result = $conn->query($sql);
if ($result && $row = $result->fetch_assoc()) {
    $stats['blog_posts'] = $row['count'];
}

// Count artworks (check if table exists)
$check_table = $conn->query("SHOW TABLES LIKE 'artworks'");
if ($check_table && $check_table->num_rows > 0) {
    $sql = "SELECT COUNT(*) as count FROM artworks";
    $result = $conn->query($sql);
    if ($result && $row = $result->fetch_assoc()) {
        $stats['artworks'] = $row['count'];
    }
}

// Count bookings
$sql = "SELECT COUNT(*) as count FROM bookings";
$result = $conn->query($sql);
if ($result && $row = $result->fetch_assoc()) {
    $stats['bookings'] = $row['count'];
}

// Count webdev projects (check if table exists)
$check_table = $conn->query("SHOW TABLES LIKE 'webdev_projects'");
if ($check_table && $check_table->num_rows > 0) {
    $sql = "SELECT COUNT(*) as count FROM webdev_projects";
    $result = $conn->query($sql);
    if ($result && $row = $result->fetch_assoc()) {
        $stats['webdev_projects'] = $row['count'];
    }
}

// Get recent activities (combined from various tables)
$recent_activities = [];

// Recent blog posts
$sql = "SELECT 
            'blog_post' as type, 
            post_id as id, 
            title, 
            created_at, 
            author_id 
        FROM posts 
        ORDER BY created_at DESC 
        LIMIT 5";
$result = $conn->query($sql);
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $row['action'] = 'created a blog post';
        $recent_activities[] = $row;
    }
}

// Recent bookings
$sql = "SELECT 
            'booking' as type, 
            id, 
            name as title, 
            booking_datetime as created_at, 
            '' as author_id 
        FROM bookings 
        ORDER BY booking_datetime DESC 
        LIMIT 5";
$result = $conn->query($sql);
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $row['action'] = 'made a booking';
        $recent_activities[] = $row;
    }
}

// Recent webdev projects (check if table exists)
$check_table = $conn->query("SHOW TABLES LIKE 'webdev_projects'");
if ($check_table && $check_table->num_rows > 0) {
    $sql = "SELECT 
                'webdev_project' as type, 
                project_id as id, 
                title, 
                created_at, 
                '' as author_id 
            FROM webdev_projects 
            ORDER BY created_at DESC 
            LIMIT 5";
    $result = $conn->query($sql);
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $row['action'] = 'added a web project';
            $recent_activities[] = $row;
        }
    }
}

// Sort all activities by date
usort($recent_activities, function($a, $b) {
    return strtotime($b['created_at']) - strtotime($a['created_at']);
});

// Keep only the most recent 10
$recent_activities = array_slice($recent_activities, 0, 10);

// Get pending bookings
$pending_bookings = [];
$sql = "SELECT * FROM bookings WHERE status = 'Pending' OR status IS NULL OR status = '' ORDER BY booking_datetime DESC LIMIT 5";
$result = $conn->query($sql);
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $pending_bookings[] = $row;
    }
}
?>

<!-- Dashboard Statistics -->
<div class="dashboard-stats">
    <div class="stat-card">
        <div class="stat-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
        </div>
        <div class="stat-info">
            <div class="stat-value"><?php echo $stats['users']; ?></div>
            <div class="stat-label">Total Users</div>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
        </div>
        <div class="stat-info">
            <div class="stat-value"><?php echo $stats['blog_posts']; ?></div>
            <div class="stat-label">Blog Posts</div>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
        </div>
        <div class="stat-info">
            <div class="stat-value"><?php echo $stats['artworks']; ?></div>
            <div class="stat-label">Artworks</div>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>
        </div>
        <div class="stat-info">
            <div class="stat-value"><?php echo $stats['webdev_projects']; ?></div>
            <div class="stat-label">Web Projects</div>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
        </div>
        <div class="stat-info">
            <div class="stat-value"><?php echo $stats['bookings']; ?></div>
            <div class="stat-label">Bookings</div>
        </div>
    </div>
</div>

<!-- Recent Activity -->
<div class="recent-activity">
    <div class="section-header">
        <h2>Recent Activity</h2>
    </div>
    
    <div class="activity-list">
        <?php if (empty($recent_activities)): ?>
            <div class="empty-state">
                <p>No recent activities found.</p>
            </div>
        <?php else: ?>
            <?php foreach ($recent_activities as $activity): ?>
                <div class="activity-item">
                    <div class="activity-icon">
                        <?php if ($activity['type'] === 'blog_post'): ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                        <?php elseif ($activity['type'] === 'booking'): ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                        <?php elseif ($activity['type'] === 'webdev_project'): ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>
                        <?php endif; ?>
                    </div>
                    <div class="activity-content">
                        <div class="activity-title">
                            <?php 
                                echo !empty($activity['author_id']) ? htmlspecialchars($activity['author_id']) : 'Someone';
                                echo ' ' . htmlspecialchars($activity['action']) . ': ';
                                echo htmlspecialchars($activity['title']);
                            ?>
                        </div>
                        <div class="activity-time">
                            <?php 
                                $timestamp = strtotime($activity['created_at']);
                                echo date('F j, Y, g:i a', $timestamp); 
                            ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<!-- Pending Bookings -->
<div class="recent-activity">
    <div class="section-header">
        <h2>Pending Bookings</h2>
    </div>
    
    <div class="table-container">
        <?php if (empty($pending_bookings)): ?>
            <div class="empty-state" style="padding: 20px;">
                <p>No pending bookings at this time.</p>
            </div>
        <?php else: ?>
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Date & Time</th>
                        <th>Service</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pending_bookings as $booking): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($booking['name']); ?></td>
                            <td>
                                <?php 
                                    $timestamp = strtotime($booking['booking_datetime']);
                                    echo date('M j, Y, g:i a', $timestamp); 
                                ?>
                            </td>
                            <td><?php echo htmlspecialchars($booking['service']); ?></td>
                            <td>
                                <div class="actions">
                                    <a href="?page=manage_bookings&edit=<?php echo $booking['id']; ?>" class="btn btn-primary">View</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
    
    <div style="text-align: center; padding: 15px;">
        <a href="?page=manage_bookings" class="btn btn-primary">View All Bookings</a>
    </div>
</div>

<!-- Quick Actions -->
<div class="recent-activity">
    <div class="section-header">
        <h2>Quick Actions</h2>
    </div>
    
    <div style="padding: 20px; display: flex; flex-wrap: wrap; gap: 15px;">
        <a href="?page=manage_blog" class="btn btn-primary">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
            New Blog Post
        </a>
        
        <a href="?page=manage_artwork" class="btn btn-primary">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
            Upload Artwork
        </a>
        
        <a href="?page=manage_webdev" class="btn btn-primary">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>
            Add Web Project
        </a>
        
        <a href="?page=manage_users" class="btn btn-primary">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
            Manage Users
        </a>
        
        <a href="../index.php" target="_blank" class="btn btn-secondary">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>
            View Website
        </a>
    </div>
</div>
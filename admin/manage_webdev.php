<?php
require_once('../config.php');

// Check if the user is logged in and has the 'admin' role
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true || $_SESSION['role'] !== 'admin') {
    // Optionally, set a flash message about unauthorized access
    header('Location: ../index.php');
    exit;
}

// Create webdev_projects table if it doesn't exist
$createTableQuery = "
CREATE TABLE IF NOT EXISTS `webdev_projects` (
  `project_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `category` varchar(50) NOT NULL,
  `short_description` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `client` varchar(100) NOT NULL,
  `technologies` varchar(255) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `live_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`project_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
";

if ($conn->query($createTableQuery) !== TRUE) {
    error_log("Error creating webdev_projects table: " . $conn->error);
}

// Create the directory for project images if it doesn't exist
$uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/static/images/webdev_projects/';
if (!file_exists($uploadDir)) {
    if (!mkdir($uploadDir, 0755, true)) {
        error_log("Error creating directory: $uploadDir");
    }
}

// Handle form submissions for adding, updating, or deleting projects
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Process the form data
    if (isset($_POST['action'])) {
        $action = $_POST['action'];
        
        switch ($action) {
            case 'create':
                handleCreateProject($conn, $uploadDir);
                break;
            case 'update':
                handleUpdateProject($conn, $uploadDir);
                break;
            case 'delete':
                handleDeleteProject($conn);
                break;
        }
    }
}

// Get project for editing if ID is provided
$projectToEdit = null;
if (isset($_GET['edit']) && !empty($_GET['edit'])) {
    $projectId = (int)$_GET['edit'];
    $stmt = $conn->prepare("
        SELECT * FROM webdev_projects WHERE project_id = ?
    ");
    $stmt->bind_param("i", $projectId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result && $result->num_rows > 0) {
        $projectToEdit = $result->fetch_assoc();
    }
    $stmt->close();
}

// Fetch all projects for the table
$category = isset($_GET['category']) ? trim($_GET['category']) : '';
$search = isset($_GET['search']) ? trim($_GET['search']) : '';

$query = "SELECT * FROM webdev_projects WHERE 1=1";
$params = [];
$types = '';

if (!empty($category)) {
    $query .= " AND category = ?";
    $params[] = $category;
    $types .= 's';
}

if (!empty($search)) {
    $query .= " AND (
        title LIKE ? OR 
        short_description LIKE ? OR
        description LIKE ? OR
        client LIKE ? OR
        technologies LIKE ?
    )";
    
    $searchPattern = "%$search%";
    $params[] = $searchPattern;
    $params[] = $searchPattern;
    $params[] = $searchPattern;
    $params[] = $searchPattern;
    $params[] = $searchPattern;
    
    $types .= 'sssss';
}

$query .= " ORDER BY created_at DESC";

$stmt = $conn->prepare($query);

if (!empty($params)) {
    $bindParams = array_merge([$types], $params);
    $stmt->bind_param(...$bindParams);
}

$stmt->execute();
$projects = $stmt->get_result();
$stmt->close();

/**
 * Handle creating a new project
 */
function handleCreateProject($conn, $uploadDir) {
    // Validate required fields
    $requiredFields = ['title', 'category', 'client', 'short_description', 'description', 'technologies'];
    foreach ($requiredFields as $field) {
        if (!isset($_POST[$field]) || trim($_POST[$field]) === '') {
            setStatusMessage('error', "Missing required field: $field");
            return;
        }
    }
    
    // Handle image upload
    $imagePath = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $imagePath = handleImageUpload($_FILES['image'], $uploadDir);
        if (!$imagePath) {
            // Error message is set by handleImageUpload
            return;
        }
    } else {
        setStatusMessage('error', 'Project image is required');
        return;
    }
    
    // Prepare data for insertion
    $title = trim($_POST['title']);
    $category = trim($_POST['category']);
    $client = trim($_POST['client']);
    $shortDescription = trim($_POST['short_description']);
    $description = trim($_POST['description']);
    $technologies = trim($_POST['technologies']);
    $liveUrl = isset($_POST['live_url']) ? trim($_POST['live_url']) : null;
    
    // Insert the project
    $stmt = $conn->prepare("
        INSERT INTO webdev_projects (title, category, short_description, description, client, technologies, image_url, live_url)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)
    ");
    
    if (!$stmt) {
        setStatusMessage('error', 'Database error: ' . $conn->error);
        return;
    }
    
    $stmt->bind_param("ssssssss", $title, $category, $shortDescription, $description, $client, $technologies, $imagePath, $liveUrl);
    
    if (!$stmt->execute()) {
        setStatusMessage('error', 'Failed to create project: ' . $stmt->error);
        return;
    }
    
    $stmt->close();
    setStatusMessage('success', 'Project created successfully');
    
    // Redirect to clear form
    header('Location: admin.php?page=manage_webdev');
    exit;
}

/**
 * Handle updating an existing project
 */
function handleUpdateProject($conn, $uploadDir) {
    // Check project ID
    if (!isset($_POST['project_id']) || empty($_POST['project_id'])) {
        setStatusMessage('error', 'Project ID is required');
        return;
    }
    
    $projectId = (int)$_POST['project_id'];
    
    // Validate required fields
    $requiredFields = ['title', 'category', 'client', 'short_description', 'description', 'technologies'];
    foreach ($requiredFields as $field) {
        if (!isset($_POST[$field]) || trim($_POST[$field]) === '') {
            setStatusMessage('error', "Missing required field: $field");
            return;
        }
    }
    
    // Handle image upload if a new image is provided
    $imagePath = isset($_POST['current_image']) ? $_POST['current_image'] : '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $newImagePath = handleImageUpload($_FILES['image'], $uploadDir);
        if ($newImagePath) {
            // If successful upload, replace the old path
            $imagePath = $newImagePath;
            
            // Delete old image if it exists and is different
            if (isset($_POST['current_image']) && $_POST['current_image'] && $newImagePath !== $_POST['current_image']) {
                $oldImagePath = $_SERVER['DOCUMENT_ROOT'] . '/' . $_POST['current_image'];
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
        } else {
            // Error message is set by handleImageUpload
            return;
        }
    }
    
    // Prepare data for update
    $title = trim($_POST['title']);
    $category = trim($_POST['category']);
    $client = trim($_POST['client']);
    $shortDescription = trim($_POST['short_description']);
    $description = trim($_POST['description']);
    $technologies = trim($_POST['technologies']);
    $liveUrl = isset($_POST['live_url']) ? trim($_POST['live_url']) : null;
    
    // Update the project
    $stmt = $conn->prepare("
        UPDATE webdev_projects
        SET title = ?, category = ?, short_description = ?, description = ?,
            client = ?, technologies = ?, image_url = ?, live_url = ?
        WHERE project_id = ?
    ");
    
    if (!$stmt) {
        setStatusMessage('error', 'Database error: ' . $conn->error);
        return;
    }
    
    $stmt->bind_param("ssssssssi", $title, $category, $shortDescription, $description, $client, $technologies, $imagePath, $liveUrl, $projectId);
    
    if (!$stmt->execute()) {
        setStatusMessage('error', 'Failed to update project: ' . $stmt->error);
        return;
    }
    
    $stmt->close();
    setStatusMessage('success', 'Project updated successfully');
    
    // Redirect to clear form
    header('Location: admin.php?page=manage_webdev');
    exit;
}

/**
 * Handle deleting a project
 */
function handleDeleteProject($conn) {
    // Check project ID
    if (!isset($_POST['project_id']) || empty($_POST['project_id'])) {
        setStatusMessage('error', 'Project ID is required');
        return;
    }
    
    $projectId = (int)$_POST['project_id'];
    
    // Get the image path first to delete the file later
    $stmt = $conn->prepare("SELECT image_url FROM webdev_projects WHERE project_id = ?");
    $stmt->bind_param("i", $projectId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $project = $result->fetch_assoc();
        $imagePath = $project['image_url'];
    }
    
    $stmt->close();
    
    // Delete the project from the database
    $stmt = $conn->prepare("DELETE FROM webdev_projects WHERE project_id = ?");
    $stmt->bind_param("i", $projectId);
    
    if (!$stmt->execute()) {
        setStatusMessage('error', 'Failed to delete project: ' . $stmt->error);
        return;
    }
    
    $stmt->close();
    
    // Delete the image file if it exists
    if (isset($imagePath) && $imagePath) {
        $fullImagePath = $_SERVER['DOCUMENT_ROOT'] . '/' . $imagePath;
        if (file_exists($fullImagePath)) {
            unlink($fullImagePath);
        }
    }
    
    setStatusMessage('success', 'Project deleted successfully');
    
    // Redirect to update the list
    header('Location: admin.php?page=manage_webdev');
    exit;
}

/**
 * Handle image upload and return the path
 */
function handleImageUpload($file, $uploadDir) {
    // Validate file
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    $maxSize = 5 * 1024 * 1024; // 5MB
    
    if (!in_array($file['type'], $allowedTypes)) {
        setStatusMessage('error', 'Invalid file type. Allowed: JPG, PNG, GIF, WEBP');
        return false;
    }
    
    if ($file['size'] > $maxSize) {
        setStatusMessage('error', 'File too large. Maximum: 5MB');
        return false;
    }
    
    // Generate unique filename
    $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $fileName = 'project_' . time() . '_' . mt_rand(1000, 9999) . '.' . $fileExtension;
    $targetFile = $uploadDir . $fileName;
    
    // Move uploaded file
    if (!move_uploaded_file($file['tmp_name'], $targetFile)) {
        setStatusMessage('error', 'Error uploading file');
        return false;
    }
    
    // Return relative path for database storage
    return 'static/images/webdev_projects/' . $fileName;
}

/**
 * Set status message in session
 */
function setStatusMessage($type, $message) {
    $_SESSION['status_type'] = $type;
    $_SESSION['status_message'] = $message;
}
?>

<!-- Include the CSS file -->
<link rel="stylesheet" href="../admin/admin_styles/manage_webdev.css">

<h1>Manage Web Development Projects</h1>

<!-- Status Messages -->
<?php if (isset($_SESSION['status_message'])): ?>
    <div class="status-message <?php echo $_SESSION['status_type']; ?>">
        <?php 
            echo htmlspecialchars($_SESSION['status_message']); 
            // Clear the messages
            unset($_SESSION['status_type']);
            unset($_SESSION['status_message']);
        ?>
    </div>
<?php endif; ?>

<div class="webdev-dashboard">
    <!-- Project Form Section -->
    <div class="project-form-container">
        <h2><?php echo $projectToEdit ? 'Edit Project' : 'Add New Project'; ?></h2>
        <form id="projectForm" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="action" value="<?php echo $projectToEdit ? 'update' : 'create'; ?>">
            <?php if ($projectToEdit): ?>
                <input type="hidden" name="project_id" value="<?php echo $projectToEdit['project_id']; ?>">
                <input type="hidden" name="current_image" value="<?php echo $projectToEdit['image_url']; ?>">
            <?php endif; ?>
            
            <!-- Title -->
            <div class="form-group">
                <label for="title">Project Title:</label>
                <input type="text" id="title" name="title" required value="<?php echo $projectToEdit ? htmlspecialchars($projectToEdit['title']) : ''; ?>">
            </div>
            
            <!-- Category -->
            <div class="form-group">
                <label for="category">Category:</label>
                <select id="category" name="category" required>
                    <option value="">Select a category</option>
                    <?php
                    $categories = ['E-commerce', 'Corporate', 'Landing Page', 'Web Application', 'Portfolio', 'Blog', 'Dashboard', 'Other'];
                    foreach ($categories as $cat) {
                        $selected = ($projectToEdit && $projectToEdit['category'] === $cat) ? 'selected' : '';
                        echo "<option value=\"$cat\" $selected>$cat</option>";
                    }
                    ?>
                </select>
            </div>
            
            <!-- Client -->
            <div class="form-group">
                <label for="client">Client:</label>
                <input type="text" id="client" name="client" required value="<?php echo $projectToEdit ? htmlspecialchars($projectToEdit['client']) : ''; ?>">
            </div>
            
            <!-- Short Description -->
            <div class="form-group">
                <label for="shortDescription">Short Description:</label>
                <textarea id="shortDescription" name="short_description" rows="2" maxlength="255" required><?php echo $projectToEdit ? htmlspecialchars($projectToEdit['short_description']) : ''; ?></textarea>
                <small>Brief overview for project listing (max 255 characters)</small>
            </div>
            
            <!-- Full Description -->
            <div class="form-group">
                <label for="description">Full Description:</label>
                <textarea id="description" name="description" rows="6" required><?php echo $projectToEdit ? htmlspecialchars($projectToEdit['description']) : ''; ?></textarea>
            </div>
            
            <!-- Technologies Used -->
            <div class="form-group">
                <label for="technologies">Technologies Used:</label>
                <input type="text" id="technologies" name="technologies" required value="<?php echo $projectToEdit ? htmlspecialchars($projectToEdit['technologies']) : ''; ?>">
                <small>Separate with commas (e.g., HTML, CSS, JavaScript, PHP)</small>
            </div>
            
            <!-- Live URL -->
            <div class="form-group">
                <label for="liveUrl">Live URL (optional):</label>
                <input type="url" id="liveUrl" name="live_url" placeholder="https://" value="<?php echo $projectToEdit ? htmlspecialchars($projectToEdit['live_url']) : ''; ?>">
            </div>
            
            <!-- Image Upload -->
            <div class="form-group">
                <label for="projectImage">Project Image:</label>
                <div id="imagePreviewContainer" class="image-preview-container">
                    <div id="imagePreview" class="image-preview <?php echo $projectToEdit ? 'has-image' : ''; ?>">
                        <?php if ($projectToEdit && $projectToEdit['image_url']): ?>
                            <img src="/<?php echo htmlspecialchars($projectToEdit['image_url']); ?>" alt="<?php echo htmlspecialchars($projectToEdit['title']); ?>">
                        <?php endif; ?>
                    </div>
                    <input type="file" id="projectImage" name="image" accept="image/*" <?php echo $projectToEdit ? '' : 'required'; ?>>
                    <label for="projectImage" class="upload-label">Choose File</label>
                </div>
                <small>Recommended size: 1200x800px, Max size: 5MB<?php echo $projectToEdit ? ' (upload a new image only if you want to replace the current one)' : ''; ?></small>
            </div>
            
            <!-- Form Buttons -->
            <div class="form-actions">
                <button type="submit" class="btn btn-primary"><?php echo $projectToEdit ? 'Update Project' : 'Save Project'; ?></button>
                <?php if ($projectToEdit): ?>
                    <a href="admin.php?page=manage_webdev" class="btn btn-secondary">Cancel</a>
                <?php endif; ?>
            </div>
        </form>
    </div>

    <!-- Projects List Section -->
    <div class="projects-list-container">
        <h2>Existing Projects</h2>
        
        <!-- Filters -->
        <form method="GET" class="filters">
            <input type="hidden" name="page" value="manage_webdev">
            <div class="filter-group">
                <label for="categoryFilter">Filter by Category:</label>
                <select id="categoryFilter" name="category" onchange="this.form.submit()">
                    <option value="">All Categories</option>
                    <?php
                    foreach ($categories as $cat) {
                        $selected = ($category === $cat) ? 'selected' : '';
                        echo "<option value=\"$cat\" $selected>$cat</option>";
                    }
                    ?>
                </select>
            </div>
            
            <div class="filter-group">
                <label for="searchFilter">Search:</label>
                <input type="text" id="searchFilter" name="search" value="<?php echo htmlspecialchars($search); ?>" placeholder="Search projects...">
                <button type="submit" class="btn">Search</button>
                <?php if (!empty($category) || !empty($search)): ?>
                    <a href="admin.php?page=manage_webdev" class="btn btn-secondary">Clear Filters</a>
                <?php endif; ?>
            </div>
        </form>
        
        <!-- Projects Table -->
        <div class="table-responsive">
            <table class="projects-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($projects && $projects->num_rows > 0): ?>
                        <?php while ($project = $projects->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $project['project_id']; ?></td>
                                <td>
                                    <div class="project-thumbnail">
                                        <img src="/<?php echo htmlspecialchars($project['image_url']); ?>" 
                                             alt="<?php echo htmlspecialchars($project['title']); ?>"
                                             onerror="this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22100%22 height=%22100%22 viewBox=%220 0 100 100%22%3E%3Crect fill=%22%23cccccc%22 width=%22100%22 height=%22100%22/%3E%3C/svg%3E'; this.onerror=null;">
                                    </div>
                                </td>
                                <td><?php echo htmlspecialchars($project['title']); ?></td>
                                <td><?php echo htmlspecialchars($project['category']); ?></td>
                                <td><?php echo htmlspecialchars(substr($project['short_description'], 0, 100)) . (strlen($project['short_description']) > 100 ? '...' : ''); ?></td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="admin.php?page=manage_webdev&edit=<?php echo $project['project_id']; ?>" class="btn btn-edit">Edit</a>
                                        <form method="POST" onsubmit="return confirm('Are you sure you want to delete this project?');" style="display: inline;">
                                            <input type="hidden" name="action" value="delete">
                                            <input type="hidden" name="project_id" value="<?php echo $project['project_id']; ?>">
                                            <button type="submit" class="btn btn-delete">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" style="text-align: center;">No projects found</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
// Simple JavaScript for image preview
document.addEventListener('DOMContentLoaded', function() {
    const projectImageInput = document.getElementById('projectImage');
    const imagePreview = document.getElementById('imagePreview');
    
    if (projectImageInput && imagePreview) {
        projectImageInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (!file) return;
            
            const reader = new FileReader();
            reader.onload = function(event) {
                imagePreview.innerHTML = `<img src="${event.target.result}" alt="Preview">`;
                imagePreview.classList.add('has-image');
            };
            reader.readAsDataURL(file);
        });
    }
    
    // Auto-hide status message after 5 seconds
    const statusMessage = document.querySelector('.status-message');
    if (statusMessage) {
        setTimeout(() => {
            statusMessage.style.opacity = '0';
            setTimeout(() => {
                statusMessage.style.display = 'none';
            }, 500);
        }, 5000);
    }
});
</script>
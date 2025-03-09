<?php
require_once('../config.php');

// Check if the user is logged in and has the 'admin' role
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true || $_SESSION['role'] !== 'admin') {
    // Optionally, set a flash message about unauthorized access
    header('Location: ../index.php');
    exit;
}

// Include admin header
require_once('../admin/admin_includes/admin_heading.php');

// Fetch existing projects
$sql = "SELECT p.project_id, p.title, p.category, p.short_description, p.client, p.image_url, p.live_url, 
               p.created_at, p.updated_at
        FROM webdev_projects p
        ORDER BY p.created_at DESC";

$result = $conn->query($sql);
if (!$result) {
    die("Error executing query: " . $conn->error);
}

// Define project categories
$categories = [
    'ecommerce' => 'E-commerce',
    'business' => 'Business Website',
    'dashboard' => 'Dashboard/Admin',
    'portfolio' => 'Portfolio',
    'other' => 'Other'
];
?>

<h1>Manage Web Development Projects</h1>

<div class="container">
    <div class="dashboard-container">
        <!-- Projects Section -->
        <div class="projects-section">
            <h2>Web Development Projects</h2>
            
            <!-- New Project / Edit Project Form -->
            <div class="project-form-container">
                <h2 id="formTitle">Create New Project</h2>
                <form method="POST" action="../admin/admin_includes/webdev_actions/process_webdev.php" enctype="multipart/form-data" id="webdevForm">
                    <input type="hidden" name="action" value="create" id="formAction">
                    <input type="hidden" name="project_id" value="" id="projectIdField">
            
                    <!-- Project Title -->
                    <div class="form-group">
                        <label for="titleField">Project Title:</label>
                        <input type="text" name="title" id="titleField" required>
                    </div>
            
                    <!-- Category -->
                    <div class="form-group">
                        <label for="categoryField">Category:</label>
                        <select name="category" id="categoryField" required>
                            <option value="">Select Category</option>
                            <?php foreach ($categories as $key => $value) { ?>
                                <option value="<?php echo $key; ?>">
                                    <?php echo htmlspecialchars($value); ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    
                    <!-- Client Name -->
                    <div class="form-group">
                        <label for="clientField">Client:</label>
                        <input type="text" name="client" id="clientField" required>
                    </div>
                    
                    <!-- Short Description -->
                    <div class="form-group">
                        <label for="shortDescField">Short Description (for cards):</label>
                        <textarea name="short_description" id="shortDescField" rows="3" maxlength="150" required></textarea>
                        <small class="char-count">0/150 characters</small>
                    </div>
            
                    <!-- Full Description -->
                    <div class="form-group">
                        <label for="descriptionField">Full Description:</label>
                        <textarea name="description" id="descriptionField" rows="6" required></textarea>
                    </div>
                    
                    <!-- Technologies -->
                    <div class="form-group">
                        <label for="technologiesField">Technologies (comma separated):</label>
                        <input type="text" name="technologies" id="technologiesField" placeholder="HTML, CSS, JavaScript, PHP" required>
                        <small>Enter technologies separated by commas</small>
                    </div>
                    
                    <!-- Live URL -->
                    <div class="form-group">
                        <label for="liveUrlField">Live Website URL (optional):</label>
                        <input type="url" name="live_url" id="liveUrlField" placeholder="https://example.com">
                    </div>
            
                    <!-- Project Image -->
                    <div class="form-group">
                        <label for="imageField">Project Image:</label>
                        <div id="drop_zone">
                            <p>Drag & drop your image here, or click to select a file</p>
                            <input type="file" name="image" id="imageField" accept="image/*">
                        </div>
                        <div id="image_preview"></div>
                        <div id="current_image" style="display: none;">
                            <p>Current image:</p>
                            <img src="" alt="Current project image" style="max-width: 200px; margin-top: 10px;">
                            <input type="hidden" name="current_image" id="currentImageField" value="">
                        </div>
                    </div>
            
                    <div class="form-buttons">
                        <button type="submit" class="btn save-btn" id="saveBtn">Save Project</button>
                        <button type="button" class="btn cancel-btn" id="cancelBtn">Cancel</button>
                    </div>
                </form>
            </div>
            
            <!-- Table of Existing Projects -->
            <div class="table-wrapper">
                <table class="projects-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Client</th>
                            <th>Created</th>
                            <th>Updated</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($result && $result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) { ?>
                                <tr data-id="<?php echo $row['project_id']; ?>">
                                    <td><?php echo $row['project_id']; ?></td>
                                    <td>
                                        <img src="<?php echo htmlspecialchars($row['image_url']); ?>" alt="Project thumbnail" class="thumbnail">
                                    </td>
                                    <td><?php echo htmlspecialchars($row['title']); ?></td>
                                    <td><?php echo htmlspecialchars($categories[$row['category']] ?? $row['category']); ?></td>
                                    <td><?php echo htmlspecialchars($row['client']); ?></td>
                                    <td><?php echo date('Y-m-d', strtotime($row['created_at'])); ?></td>
                                    <td><?php echo $row['updated_at'] ? date('Y-m-d', strtotime($row['updated_at'])) : 'N/A'; ?></td>
                                    <td>
                                        <button class="btn btn-primary edit-btn" data-project-id="<?php echo $row['project_id']; ?>">
                                            Edit
                                        </button>
                                        <button class="btn btn-danger delete-project-btn" data-project-id="<?php echo $row['project_id']; ?>">
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            <?php }
                        } else { ?>
                            <tr>
                                <td colspan="8" class="no-records">No projects found. Add your first project!</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Character counter for short description
    const shortDescField = document.getElementById('shortDescField');
    const charCount = document.querySelector('.char-count');
    
    if (shortDescField && charCount) {
        shortDescField.addEventListener('input', function() {
            const currentLength = this.value.length;
            charCount.textContent = `${currentLength}/150 characters`;
            
            if (currentLength > 150) {
                charCount.classList.add('exceeded');
            } else {
                charCount.classList.remove('exceeded');
            }
        });
    }
    
    // Image preview functionality
    const imageField = document.getElementById('imageField');
    const imagePreview = document.getElementById('image_preview');
    const dropZone = document.getElementById('drop_zone');
    
    if (imageField && imagePreview && dropZone) {
        // File input change handler
        imageField.addEventListener('change', function() {
            previewImage(this.files[0]);
        });
        
        // Drag and drop handlers
        dropZone.addEventListener('dragover', function(e) {
            e.preventDefault();
            this.classList.add('dragover');
        });
        
        dropZone.addEventListener('dragleave', function() {
            this.classList.remove('dragover');
        });
        
        dropZone.addEventListener('drop', function(e) {
            e.preventDefault();
            this.classList.remove('dragover');
            
            if (e.dataTransfer.files.length) {
                imageField.files = e.dataTransfer.files;
                previewImage(e.dataTransfer.files[0]);
            }
        });
        
        // Click to select file
        dropZone.addEventListener('click', function() {
            imageField.click();
        });
    }
    
    function previewImage(file) {
        if (!file || !file.type.match('image.*')) return;
        
        const reader = new FileReader();
        
        reader.onload = function(e) {
            imagePreview.innerHTML = `<img src="${e.target.result}" alt="Image preview" style="max-width: 100%; max-height: 200px;">`;
            dropZone.style.display = 'none';
            imagePreview.style.display = 'block';
        }
        
        reader.readAsDataURL(file);
    }
    
    // Edit project functionality
    const editButtons = document.querySelectorAll('.edit-btn');
    const formTitle = document.getElementById('formTitle');
    const formAction = document.getElementById('formAction');
    const projectIdField = document.getElementById('projectIdField');
    const webdevForm = document.getElementById('webdevForm');
    const cancelBtn = document.getElementById('cancelBtn');
    const currentImage = document.getElementById('current_image');
    const currentImageField = document.getElementById('currentImageField');
    
    editButtons.forEach(button => {
        button.addEventListener('click', function() {
            const projectId = this.dataset.projectId;
            
            // Fetch project details
            fetch(`../admin/admin_includes/webdev_actions/get_project.php?id=${projectId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update form title and action
                        formTitle.textContent = 'Edit Project';
                        formAction.value = 'update';
                        projectIdField.value = projectId;
                        
                        // Populate form fields
                        document.getElementById('titleField').value = data.project.title;
                        document.getElementById('categoryField').value = data.project.category;
                        document.getElementById('clientField').value = data.project.client;
                        document.getElementById('shortDescField').value = data.project.short_description;
                        document.getElementById('descriptionField').value = data.project.description;
                        document.getElementById('technologiesField').value = data.project.technologies;
                        document.getElementById('liveUrlField').value = data.project.live_url || '';
                        
                        // Update character count for short description
                        const currentLength = data.project.short_description.length;
                        charCount.textContent = `${currentLength}/150 characters`;
                        
                        // Handle image
                        dropZone.style.display = 'none';
                        imagePreview.style.display = 'none';
                        currentImage.style.display = 'block';
                        currentImage.querySelector('img').src = data.project.image_url;
                        currentImageField.value = data.project.image_url;
                        
                        // Scroll to form
                        webdevForm.scrollIntoView({ behavior: 'smooth' });
                    } else {
                        alert('Failed to load project details');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while loading project details');
                });
        });
    });
    
    // Cancel editing
    if (cancelBtn) {
        cancelBtn.addEventListener('click', function() {
            // Reset form
            webdevForm.reset();
            formTitle.textContent = 'Create New Project';
            formAction.value = 'create';
            projectIdField.value = '';
            
            // Reset image section
            dropZone.style.display = 'block';
            imagePreview.style.display = 'none';
            imagePreview.innerHTML = '';
            currentImage.style.display = 'none';
            currentImageField.value = '';
            
            // Reset character count
            charCount.textContent = '0/150 characters';
            charCount.classList.remove('exceeded');
        });
    }
    
    // Delete project confirmation
    const deleteButtons = document.querySelectorAll('.delete-project-btn');
    
    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            const projectId = this.dataset.projectId;
            const confirmDelete = confirm('Are you sure you want to delete this project? This action cannot be undone.');
            
            if (confirmDelete) {
                // Create a form and submit it
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '../admin/admin_includes/webdev_actions/process_webdev.php';
                
                const actionInput = document.createElement('input');
                actionInput.type = 'hidden';
                actionInput.name = 'action';
                actionInput.value = 'delete';
                
                const idInput = document.createElement('input');
                idInput.type = 'hidden';
                idInput.name = 'project_id';
                idInput.value = projectId;
                
                form.appendChild(actionInput);
                form.appendChild(idInput);
                document.body.appendChild(form);
                form.submit();
            }
        });
    });
    
    // Initialize CKEDITOR for the description field
    if (typeof CKEDITOR !== 'undefined') {
        CKEDITOR.replace('descriptionField', {
            height: 300,
            removePlugins: 'elementspath',
            resize_enabled: false,
            toolbar: [
                ['Bold', 'Italic', 'Underline', 'Strike', '-', 'RemoveFormat'],
                ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent'],
                ['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'],
                ['Link', 'Unlink'],
                ['Styles', 'Format'],
                ['Source']
            ]
        });
    }
});
</script>

<?php include('../admin/admin_includes/admin_footer.php'); ?>
/**
 * Web Development Projects Management
 */
console.log('manage_webdev.js loaded');

document.addEventListener('DOMContentLoaded', function() {
    initWebDevManagement();
});

function initWebDevManagement() {
    console.log('Initializing Web Dev Management');
    
    // DOM Elements
    const projectForm = document.getElementById('projectForm');
    const formTitle = document.getElementById('formTitle');
    const formAction = document.getElementById('formAction');
    const projectIdField = document.getElementById('projectId');
    const currentImageField = document.getElementById('currentImage');
    const cancelButton = document.getElementById('cancelButton');
    const categoryFilter = document.getElementById('categoryFilter');
    const searchFilter = document.getElementById('searchFilter');
    const projectsList = document.getElementById('projectsList');
    const deleteModal = document.getElementById('deleteModal');
    const deleteForm = document.getElementById('deleteForm');
    const deleteProjectIdField = document.getElementById('deleteProjectId');
    const cancelDeleteButton = document.getElementById('cancelDelete');
    const imagePreview = document.getElementById('imagePreview');
    const projectImageInput = document.getElementById('projectImage');
    
    // Check if elements exist
    if (!projectsList) {
        console.error('Projects list container not found');
        return;
    }
    
    /**
     * Load projects with optional filtering
     */
    function loadProjects() {
        console.log('Loading projects');
        
        // Show loading state
        projectsList.innerHTML = '<tr class="loading-row"><td colspan="6">Loading projects...</td></tr>';
        
        // Get filter values
        const category = categoryFilter ? categoryFilter.value : '';
        const search = searchFilter ? searchFilter.value : '';
        
        // Build query string
        const queryParams = new URLSearchParams();
        if (category) {
            queryParams.append('category', category);
        }
        if (search) {
            queryParams.append('search', search);
        }
        
        // Add timestamp to prevent caching
        queryParams.append('_', Date.now());
        
        // Make API call
        fetch('/admin/admin_includes/webdev_actions/list_projects.php?' + queryParams.toString())
            .then(response => {
                if (!response.ok) {
                    return response.text().then(text => {
                        throw new Error(`Network response was not ok: ${response.status} - ${text}`);
                    });
                }
                return response.json();
            })
            .then(data => {
                console.log('Projects data received:', data);
                if (data.success) {
                    displayProjects(data.projects);
                } else {
                    projectsList.innerHTML = `<tr><td colspan="6">Error: ${data.error || 'Unknown error'}</td></tr>`;
                }
            })
            .catch(error => {
                console.error('Error fetching projects:', error);
                projectsList.innerHTML = `<tr><td colspan="6">Failed to load projects: ${error.message}</td></tr>`;
            });
    }
    
    /**
     * Display projects in the table
     */
    function displayProjects(projects) {
        console.log('Displaying projects:', projects);
        
        if (!projects || projects.length === 0) {
            console.log('No projects to display');
            projectsList.innerHTML = '<tr><td colspan="6">No projects found.</td></tr>';
            return;
        }
        
        let html = '';
        
        projects.forEach(project => {
            html += `
                <tr data-id="${project.project_id}">
                    <td>${project.project_id}</td>
                    <td>
                        <div class="project-thumbnail">
                            <img src="/${project.image_url}" alt="${escapeHtml(project.title)}" 
                                 onerror="this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22100%22 height=%22100%22 viewBox=%220 0 100 100%22%3E%3Crect fill=%22%23cccccc%22 width=%22100%22 height=%22100%22/%3E%3C/svg%3E'; this.onerror=null;">
                        </div>
                    </td>
                    <td>${escapeHtml(project.title)}</td>
                    <td>${escapeHtml(project.category || 'Uncategorized')}</td>
                    <td>${escapeHtml(project.short_description || '')}</td>
                    <td>
                        <div class="action-buttons">
                            <button type="button" class="btn btn-edit" data-id="${project.project_id}">Edit</button>
                            <button type="button" class="btn btn-delete" data-id="${project.project_id}">Delete</button>
                        </div>
                    </td>
                </tr>
            `;
        });
        
        // Set the HTML content directly
        projectsList.innerHTML = html;
        
        // Add event listeners to the new buttons
        document.querySelectorAll('.btn-edit').forEach(button => {
            button.addEventListener('click', () => editProject(button.dataset.id));
        });
        
        document.querySelectorAll('.btn-delete').forEach(button => {
            button.addEventListener('click', () => openDeleteModal(button.dataset.id));
        });
    }
    
    // Load projects on page load
    loadProjects();
    
    // Event Listeners
    if (categoryFilter) {
        categoryFilter.addEventListener('change', loadProjects);
    }
    
    if (searchFilter) {
        searchFilter.addEventListener('input', debounce(loadProjects, 300));
    }
    
    if (cancelButton) {
        cancelButton.addEventListener('click', resetForm);
    }
    
    if (cancelDeleteButton) {
        cancelDeleteButton.addEventListener('click', closeDeleteModal);
    }
    
    if (projectImageInput) {
        projectImageInput.addEventListener('change', handleImagePreview);
    }
    
    // Update status message dismissal
    const statusMessage = document.querySelector('.status-message');
    if (statusMessage) {
        // Auto-hide after 5 seconds
        setTimeout(() => {
            statusMessage.style.opacity = '0';
            setTimeout(() => {
                statusMessage.style.display = 'none';
            }, 500);
        }, 5000);
        
        // Clear URL parameters
        const url = new URL(window.location.href);
        if (url.searchParams.has('status')) {
            url.searchParams.delete('status');
            url.searchParams.delete('message');
            window.history.replaceState({}, document.title, url.toString());
        }
    }
    
    /**
     * Edit a project
     */
    function editProject(projectId) {
        fetch(`/admin/admin_includes/webdev_actions/get_project.php?id=${projectId}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    populateForm(data.project);
                } else {
                    alert(`Error: ${data.error}`);
                }
            })
            .catch(error => {
                console.error('Error fetching project details:', error);
                alert('Failed to load project details. Please try again.');
            });
    }
    
    /**
     * Populate the form with project data
     */
    function populateForm(project) {
        // Update form for editing
        formTitle.textContent = 'Edit Project';
        formAction.value = 'update';
        
        // Populate fields
        projectIdField.value = project.project_id;
        document.getElementById('title').value = project.title;
        document.getElementById('category').value = project.category;
        document.getElementById('client').value = project.client;
        document.getElementById('shortDescription').value = project.short_description;
        document.getElementById('description').value = project.description;
        document.getElementById('technologies').value = project.technologies;
        document.getElementById('liveUrl').value = project.live_url || '';
        
        // Handle image
        currentImageField.value = project.image_url;
        if (project.image_url) {
            imagePreview.innerHTML = `<img src="/${project.image_url}" alt="${project.title}">`;
            imagePreview.classList.add('has-image');
        }
        
        // Scroll to form
        projectForm.scrollIntoView({ behavior: 'smooth' });
    }
    
    /**
     * Reset the form to its initial state
     */
    function resetForm() {
        // Reset form title and action
        formTitle.textContent = 'Add New Project';
        formAction.value = 'create';
        
        // Clear fields
        projectForm.reset();
        projectIdField.value = '';
        currentImageField.value = '';
        
        // Clear image preview
        imagePreview.innerHTML = '';
        imagePreview.classList.remove('has-image');
    }
    
    /**
     * Open the delete confirmation modal
     */
    function openDeleteModal(projectId) {
        deleteProjectIdField.value = projectId;
        deleteModal.classList.add('active');
    }
    
    /**
     * Close the delete confirmation modal
     */
    function closeDeleteModal() {
        deleteModal.classList.remove('active');
    }
    
    /**
     * Handle image preview
     */
    function handleImagePreview(e) {
        const file = e.target.files[0];
        if (!file) return;
        
        const reader = new FileReader();
        reader.onload = function(event) {
            imagePreview.innerHTML = `<img src="${event.target.result}" alt="Preview">`;
            imagePreview.classList.add('has-image');
        };
        reader.readAsDataURL(file);
    }
    
    /**
     * Helper function to escape HTML
     */
    function escapeHtml(unsafe) {
        if (unsafe === null || unsafe === undefined) return '';
        
        return String(unsafe)
            .replace(/&/g, "&amp;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;")
            .replace(/"/g, "&quot;")
            .replace(/'/g, "&#039;");
    }
    
    /**
     * Debounce function to limit how often a function can be called
     */
    function debounce(func, wait) {
        let timeout;
        return function(...args) {
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(this, args), wait);
        };
    }
}
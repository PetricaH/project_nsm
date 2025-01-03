(function () {
    // Define API endpoints for managing users
    const API_ENDPOINTS = {
        fetchUsers: '../admin_includes/users_actions/fetch_users.php', // Fetch all users
        createUser: '../admin_includes/users_actions/create_user_handler.php', // Create a new user
        deleteUser: '../admin_includes/users_actions/delete_user.php', // Delete a user
        editUser: '../admin_includes/users_actions/edit_user.php', // Edit a user
    };

    // Store commonly accessed DOM elements
    const domElements = {
        userTableBody: document.querySelector('.user-table tbody'), // Table body for user list
        createUserForm: document.getElementById('createUserForm'), // Form for creating users
        formMessage: document.getElementById('formMessage'), // Message area for success/error feedback
    };

    /**
     * Utility function to display success or error messages
     * @param {string} message - The message to display
     * @param {string} type - Type of message ('success' or 'error')
     */
    function displayMessage(message, type) {
        const { formMessage } = domElements;
        if (!formMessage) return;

        formMessage.textContent = message; // Set the message text
        formMessage.className = `message ${type}`; // Apply the relevant CSS class
        formMessage.classList.remove('hidden'); // Make the message visible

        // Automatically hide the message after 3 seconds
        setTimeout(() => {
            formMessage.classList.add('hidden');
        }, 3000);
    }

    /**
     * Fetch and display the list of users dynamically
     */
    async function loadUsers() {
        const { userTableBody } = domElements;

        try {
            const response = await fetch(API_ENDPOINTS.fetchUsers); // Fetch users from the server
            const data = await response.text(); // Get HTML table rows as response
            if (userTableBody) userTableBody.innerHTML = data; // Update the table body
        } catch (error) {
            console.error('Error loading users:', error);
            displayMessage('An error occurred while loading users.', 'error');
        }
    }

    /**
     * Handle form submission for creating a new user
     * @param {Event} event - The form submission event
     */
    async function handleCreateUserFormSubmit(event) {
        event.preventDefault(); // Prevent default form submission

        const { createUserForm } = domElements;
        if (!createUserForm) return;

        const formData = new FormData(createUserForm); // Collect form data

        try {
            const response = await fetch(API_ENDPOINTS.createUser, { method: 'POST', body: formData });
            const result = await response.json(); // Parse JSON response

            if (result.success) {
                displayMessage('User created successfully!', 'success'); // Show success message
                loadUsers(); // Refresh the user list
                createUserForm.reset(); // Reset the form
            } else {
                displayMessage(result.error || 'Failed to create user.', 'error'); // Show error message
            }
        } catch (error) {
            console.error('Error creating user:', error);
            displayMessage('An error occurred while creating the user.', 'error');
        }
    }

    /**
     * Handle deletion of a user
     * @param {string} userId - The ID of the user to delete
     */
    async function deleteUser(userId) {
        if (!confirm('Are you sure you want to delete this user?')) return; // Confirm deletion

        try {
            const response = await fetch(API_ENDPOINTS.deleteUser, {
                method: 'POST',
                body: new URLSearchParams({ user_id: userId }), // Send user ID as form data
            });
            const result = await response.json();

            if (result.success) {
                displayMessage('User deleted successfully!', 'success'); // Show success message
                loadUsers(); // Refresh the user list
            } else {
                displayMessage(result.error || 'Failed to delete user.', 'error'); // Show error message
            }
        } catch (error) {
            console.error('Error deleting user:', error);
            displayMessage('An error occurred while deleting the user.', 'error');
        }
    }

    /**
     * Initialize event listeners
     */
    function addEventListeners() {
        const { createUserForm, userTableBody } = domElements;

        // Handle user creation form submission
        if (createUserForm) {
            createUserForm.addEventListener('submit', handleCreateUserFormSubmit);
        }

        // Delegate event handling for delete and edit actions in the user table
        if (userTableBody) {
            userTableBody.addEventListener('click', (event) => {
                const target = event.target;

                // Handle delete button click
                if (target.classList.contains('delete-user')) {
                    const userId = target.dataset.userId; // Get user ID from data attribute
                    deleteUser(userId); // Call deleteUser function
                }

                // You can add additional event handling here (e.g., for editing users)
            });
        }
    }

    /**
     * Initialize the manage users script
     */
    function init() {
        loadUsers(); // Load and display the user list
        addEventListeners(); // Add event listeners for user interactions
    }

    // Run the initialization when the DOM content is loaded
    document.addEventListener('DOMContentLoaded', init);
})();

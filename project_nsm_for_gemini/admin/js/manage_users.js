(function () {
    // Define API endpoints for managing users
    const API_ENDPOINTS = {
        fetchUsers: '../admin/admin_includes/users_actions/fetch_users.php',
        createUser: '../admin/admin_includes/users_actions/create_user_handler.php',
        editUser: '../admin/admin_includes/users_actions/edit_user.php',
    };

    // Store commonly accessed DOM elements
    const domElements = {
        userTableDiv: document.querySelector('.user-table-div'), // Parent container of the table
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
        const userTableBody = document.querySelector('.user-table tbody'); // Dynamically fetch the table body
        try {
            const response = await fetch(API_ENDPOINTS.fetchUsers);
            const data = await response.text();
            if (userTableBody) {
                userTableBody.innerHTML = data; // Dynamically update the table
                console.log('Users loaded successfully');
            } else {
                console.error('userTableBody not found while loading users!');
            }
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
     * Enable editing a user
     * @param {HTMLElement} row - The table row of the user to edit
     * @param {string} userId - The ID of the user to edit
     */
    function enableEditUser(row, userId) {
        const emailCell = row.querySelector('.user-email');
        const roleCell = row.querySelector('.user-role');
        const editButton = row.querySelector('.edit-user');

        // Change the cells to editable fields
        emailCell.innerHTML = `<input type="email" value="${emailCell.textContent.trim()}" />`;
        roleCell.innerHTML = `
            <select>
                <option value="user" ${roleCell.textContent.trim() === 'user' ? 'selected' : ''}>User</option>
                <option value="author" ${roleCell.textContent.trim() === 'author' ? 'selected' : ''}>Author</option>
                <option value="admin" ${roleCell.textContent.trim() === 'admin' ? 'selected' : ''}>Admin</option>
            </select>
        `;

        // Change edit button to save
        editButton.textContent = 'Save';
        editButton.classList.replace('edit-user', 'save-user');
    }

    /**
     * Save edited user data
     * @param {HTMLElement} row - The table row of the user to save
     * @param {string} userId - The ID of the user to save
     */
    async function saveEditedUser(row, userId) {
        const emailInput = row.querySelector('.user-email input');
        const roleSelect = row.querySelector('.user-role select');
        const editButton = row.querySelector('.save-user');

        const email = emailInput.value.trim();
        const role = roleSelect.value;

        try {
            const response = await fetch(API_ENDPOINTS.editUser, {
                method: 'POST',
                body: new URLSearchParams({ user_id: userId, email, role }),
            });
            const result = await response.json();

            if (result.success) {
                displayMessage('User updated successfully!', 'success');
                loadUsers(); // Refresh the user list
            } else {
                displayMessage(result.error || 'Failed to update user.', 'error');
            }
        } catch (error) {
            console.error('Error updating user:', error);
            displayMessage('An error occurred while updating the user.', 'error');
        }
    }

    /**
     * Initialize event listeners
     */
    function addEventListeners() {
        const { userTableDiv, createUserForm } = domElements;

        console.log('addEventListeners called');

        // Handle user creation form submission
        if (createUserForm) {
            createUserForm.addEventListener('submit', handleCreateUserFormSubmit);
        }

        // Delegate event handling for edit actions in the user table
        if (userTableDiv) {
            userTableDiv.addEventListener('click', (event) => {
                const target = event.target;
                const row = target.closest('tr');
                const userId = target.dataset.userId;

                if (target.classList.contains('edit-user')) {
                    console.log('Edit button clicked for user ID:', userId);
                    enableEditUser(row, userId);
                } else if (target.classList.contains('save-user')) {
                    console.log('Save button clicked for user ID:', userId);
                    saveEditedUser(row, userId);
                }
            });
        } else {
            console.error('userTableDiv not found!');
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

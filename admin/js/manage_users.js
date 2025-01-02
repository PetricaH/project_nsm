document.addEventListener('DOMContentLoaded', () => {
    const createUserForm = document.getElementById('createUserForm');
    const formMessage = document.getElementById('formMessage');

    if (createUserForm) {
        createUserForm.addEventListener('submit', async (event) => {
            event.preventDefault(); // Prevent default form submission

            const formData = new FormData(createUserForm);

            try {
                const response = await fetch('../admin_includes/users_actions/create_user_handler.php', {
                    method: 'POST',
                    body: formData,
                });

                const result = await response.json();

                if (result.success) {
                    displayMessage('User created successfully!', 'success');
                    loadUsers(); // Refresh user table dynamically
                    createUserForm.reset(); // Clear the form
                } else {
                    displayMessage(result.error || 'Failed to create user.', 'error');
                }
            } catch (error) {
                console.error('Error:', error);
                displayMessage('An error occurred while creating the user.', 'error');
            }
        });
    }

    // Function to refresh the user table without page reload
    async function loadUsers() {
        try {
            const response = await fetch('../admin_includes/users_actions/fetch_users.php');
            const data = await response.text();

            const userTable = document.querySelector('.user-table tbody');
            if (userTable) {
                userTable.innerHTML = data;
            }
        } catch (error) {
            console.error('Error loading users:', error);
            displayMessage('An error occurred while loading users.', 'error');
        }
    }

    // Utility function to display success or error messages
    function displayMessage(message, type) {
        formMessage.textContent = message;
        formMessage.className = `message ${type}`;
        formMessage.classList.remove('hidden');

        // Automatically hide the message after 3 seconds
        setTimeout(() => {
            formMessage.classList.add('hidden');
        }, 3000);
    }
});

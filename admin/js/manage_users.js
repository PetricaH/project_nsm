document.addEventListener('DOMContentLoaded', () => {
    const createUserForm = document.getElementById('createUserForm');
    const formMessage = document.getElementById('formMessage');

    if (createUserForm) {
        createUserForm.addEventListener('submit', async (event) => {
            event.preventDefault(); // Prevent form from refreshing

            const formData = new FormData(createUserForm);

            try {
                const response = await fetch('../admin_includes/users_actions/create_user_handler.php', {
                    method: 'POST',
                    body: formData,
                });

                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }

                const result = await response.json();
                console.log("Response:", result);

                if (result.success) {
                    displayMessage('User created successfully!', 'success');
                    loadUsers(); // Refresh user table
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

    // Function to refresh the user table
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

    // Utility function to display success/error messages
    function displayMessage(message, type) {
        formMessage.textContent = message;
        formMessage.className = `message ${type}`;
        formMessage.classList.remove('hidden');

        setTimeout(() => {
            formMessage.classList.add('hidden');
        }, 3000);
    }
});

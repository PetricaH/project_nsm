document.addEventListener('DOMContentLoaded', () => {
    // Handle status change
    const statusSelects = document.querySelectorAll('.status-select');

    statusSelects.forEach((select) => {
        select.addEventListener('change', function () {
            const id = this.dataset.id; // Get the booking ID
            const newStatus = this.value; // Get the selected status

            // Send the updated status to the server
            fetch('admin_includes/booking_actions/update_booking_status.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ id, status: newStatus }),
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        showNotification('Status updated successfully!');
                    } else {
                        showNotification(data.message || 'Error updating status.', true);
                    }
                })
                .catch(() => {
                    showNotification('An error occurred while updating the status.', true);
                });
        });
    });

    // Show notifications
    function showNotification(message, isError = false) {
        const notification = document.getElementById('notification');
        const notificationMessage = document.getElementById('notificationMessage');

        notificationMessage.textContent = message;
        notification.classList.remove('hidden');
        if (isError) notification.classList.add('error');
        else notification.classList.remove('error');

        setTimeout(() => {
            notification.classList.add('hidden');
        }, 3000);
    }

    const deleteButton = document.querySelectorAll('.delete-btn');

    deleteButton.forEach((button) => {
        button.addEventListener('click', function() {
            const id = this.dataset.id; // get the booking id

            // confirm before deleting
            if (confirm('Are you sure you want to delete this booking?')) {
                // send the delete request to the server
                fetch('admin_includes/booking_actions/delete_booking.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ id }),
                })
                    .then((response) => response.json())
                    .then((data) => {
                        if (data.success) {
                            alert('Booking deleted successfully!');
                            // remove the row from the table
                            this.closest('tr').remove();
                        } else {
                            alert(data.message || 'Error deleting booking.');
                        }
                    })
                    .catch(() => {
                        alert('An error occured wihile deleting the booking.');
                    });
            }
        });
    });
});

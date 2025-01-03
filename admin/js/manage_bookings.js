document.addEventListener('DOMContentLoaded', () => {
    // Handle booking deletion
    const deleteButtons = document.querySelectorAll('.delete-btn');

    deleteButtons.forEach((button) => {
        button.addEventListener('click', function () {
            const id = this.dataset.id;

            if (confirm('Are you sure you want to delete this booking?')) {
                fetch('admin_includes/booking_actions/delete_booking.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ id }),
                })
                    .then((response) => response.json())
                    .then((data) => {
                        if (data.success) {
                            alert('Booking deleted successfully!');
                            this.closest('tr').remove();
                        } else {
                            alert(data.message || 'Error deleting booking.');
                        }
                    })
                    .catch(() => {
                        alert('An error occurred while deleting the booking.');
                    });
            }
        });
    });

    // Notification function
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
});

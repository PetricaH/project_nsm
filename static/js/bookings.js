document.addEventListener('DOMContentLoaded', () => {
    // Open booking modal
    function openBookingModal() {
        document.getElementById('bookingModal').classList.remove('hidden');
    }

    // Close booking modal
    function closeBookingModal() {
        document.getElementById('bookingModal').classList.add('hidden');
    }

    // Restrict date picker to allow only Monday to Sunday from 4:30 PM to 11:00 PM
    const bookingDateInput = document.getElementById('booking-date');
    if (bookingDateInput) {
        bookingDateInput.addEventListener('input', function () {
            const selectedDate = new Date(bookingDateInput.value);
            const day = selectedDate.getDay(); // Sunday = 0, Monday = 1, ..., Saturday = 6
            const hour = selectedDate.getHours();
            const minutes = selectedDate.getMinutes();

            if (
                day === 0 || // Allow Sunday
                (hour < 16 || (hour === 16 && minutes < 30)) || // Before 4:30 PM
                hour >= 23 // After 11:00 PM
            ) {
                alert("Please select a date and time between 4:30 PM and 11:00 PM from Monday to Sunday.");
                bookingDateInput.value = ''; // Clear the invalid date
            }
        });
    }

    // Attach modal open/close functions to the global scope for button handlers
    window.openBookingModal = openBookingModal;
    window.closeBookingModal = closeBookingModal;
});

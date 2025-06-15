document.addEventListener('DOMContentLoaded', () => {
    // Open booking modal
    window.openBookingModal = function openBookingModal() {
        document.getElementById('bookingModal').classList.remove('hidden');
    };

    // Close booking modal
    window.closeBookingModal = function closeBookingModal() {
        document.getElementById('bookingModal').classList.add('hidden');
    };
});

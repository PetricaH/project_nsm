<script src="../admin/js/admin.js"></script>
<script src="../admin/js/manage_artworks.js"></script>
<script src="../admin/js/manage_bookings.js"></script>
<script src="../admin/js/manage_users.js"></script>
<script src="../admin/js/manage_blog.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const url = new URL(window.location.href);
        if (url.searchParams.has('status')) {
            url.searchParams.delete('status'); // Remove the status parameter
            window.history.replaceState({}, document.title, url.pathname); // Update the URL
        }
    });
</script>
</body>

</html>
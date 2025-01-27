<?php
    // Determine which scripts to load based on $page
    $page = $_GET['page'] ?? '';
?>

<footer></footer>

<script src="../admin/js/admin.js"></script>

<?php if ($page === 'manage_artwork'): ?>
    <script src="../admin/js/manage_artworks.js"></script>
<?php elseif ($page === 'manage_bookings'): ?>
    <script src="../admin/js/manage_bookings.js"></script>
<?php elseif ($page === 'manage_users'): ?>
    <script src="../admin/js/manage_users.js"></script>
<?php elseif ($page === 'manage_blog'): ?>
    <script src="../admin/js/manage_blog.js"></script>
<?php endif; ?>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const url = new URL(window.location.href);
    if (url.searchParams.has('status')) {
        url.searchParams.delete('status'); 
        window.history.replaceState({}, document.title, url.toString());
    }
});
</script>

</body>
</html>

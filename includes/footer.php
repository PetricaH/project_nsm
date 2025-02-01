<!-- linking to the stylesheet for the index.php -->
<script src="static/js/public_script.js"></script>

<script src="static/js/artworks.js"></script>

<script src="static/js/bookings.js"></script>
<footer class="site-footer">
    <div class="footer-content">
        <!-- Footer Links -->
        <div class="footer-section">
            <h3 class="footer-heading">Quick Links</h3>
            <ul class="footer-links">
                <li><a href="/">Home</a></li>
                <li><a href="artworks.php">Artworks</a></li>
                <li><a href="automation.php">Automation</a></li>
                <li><a href="webdev.php">Web Dev</a></li>
                <li><a onclick="openBookingModal()" style="cursor: pointer;">Contact</a></li>
            </ul>
        </div>

        <!-- Social Media Links -->
        <div class="footer-section">
            <h3 class="footer-heading">Follow Me</h3>
            <ul class="social-links">
                <li><a href="https://www.instagram.com/petrica_hreniuc/" target="_blank">Instagram</a></li>
                <li><a href="https://github.com/PetricaH" target="_blank">GitHub</a></li>
            </ul>
        </div>

        <!-- Legal and Cookie Preferences -->
        <div class="footer-section">
            <h3 class="footer-heading">Legal</h3>
            <ul class="legal-links">
                <li><a href="/privacy-policy">Privacy Policy</a></li>
                <li><a href="/terms-of-service">Terms of Service</a></li>
                <li><a href="#" onclick="clearConsentCookie()">Update Cookie Preferences</a></li>
            </ul>
        </div>
    </div>

    <!-- Copyright Notice -->
    <div class="footer-bottom">
        <p>&copy; <?php echo date("Y"); ?> Hreniuc Petrică. All rights reserved.</p>
    </div>
</footer>
<link rel="stylesheet" type="text/css" href="static/css/footer.css">
</body>

</html>
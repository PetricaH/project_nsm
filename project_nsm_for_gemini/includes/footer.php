<!-- Footer Section with proper versioning -->
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
                <li><a onclick="openBookingModal()" style="cursor: pointer;" noindex>Contact</a></li>
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

<?php
// Load footer CSS with proper versioning based on environment
if (ENVIRONMENT === 'production') {
    $footerCssPath = 'dist/styles/footer.min.css';
} else {
    $footerCssPath = 'static/css/footer.css';
}

if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $footerCssPath)) {
    $footerCssVersion = filemtime($_SERVER['DOCUMENT_ROOT'] . '/' . $footerCssPath);
    
    if (ENVIRONMENT === 'production') {
        echo '<link rel="preload" href="/' . $footerCssPath . '?v=' . $footerCssVersion . '" as="style" onload="this.onload=null;this.rel=\'stylesheet\'">';
        echo '<noscript><link rel="stylesheet" href="/' . $footerCssPath . '?v=' . $footerCssVersion . '"></noscript>';
    } else {
        echo '<link rel="stylesheet" href="/' . $footerCssPath . '?v=' . $footerCssVersion . '">';
    }
}
?>

<!-- Blog post theme toggle script -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    const modeToggle = document.getElementById("mode_toggle");
    if (modeToggle) {
        const postSection = document.querySelector(".blog_post_section");
        if (postSection) {
            // Check for saved theme preference for blog post section
            if (localStorage.getItem("blog_theme") === "light") {
                postSection.classList.add("light_mode");
                modeToggle.innerText = "☀️";
            }

            modeToggle.addEventListener("click", function () {
                postSection.classList.toggle("light_mode");

                if (postSection.classList.contains("light_mode")) {
                    localStorage.setItem("blog_theme", "light");
                    modeToggle.innerText = "☀️";
                } else {
                    localStorage.setItem("blog_theme", "dark");
                    modeToggle.innerText = "🌙";
                }
            });
        }
    }
});
</script>
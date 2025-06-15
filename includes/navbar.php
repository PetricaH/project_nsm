<!-- Modern navbar that matches the home page design -->
<nav class="navbar">
    <div class="navbar-container">
        <!-- Logo -->
        <div class="logo-container">
            <a href="index.php" class="logo-link">
                <img src="static/images/notso-white.png" id="logo_image" alt="NOTSO Logo">
            </a>
        </div>
        
        <!-- Menu Toggle Button (for mobile) -->
        <button class="menu_toggle" id="menu_toggle" aria-label="Toggle Navigation Menu">
            <div class="bar bar1"></div>
            <div class="bar bar2"></div>
            <div class="bar bar3"></div>
        </button>
        
        <!-- Main Navigation Menu -->
        <ul id="nav_menu" class="nav-menu">
            <li class="nav-item"><a href="index.php" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'index.php') ? 'active' : ''; ?>">Home</a></li>
            <li class="nav-item"><a href="webdev.php" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'webdev.php') ? 'active' : ''; ?>">Web Development</a></li>
            <li class="nav-item"><a href="automation.php" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'automation.php') ? 'active' : ''; ?>">Automation</a></li>
            <!-- <li class="nav-item"><a href="artworks.php" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'artworks.php') ? 'active' : ''; ?>">Digital Art</a></li> -->
            <!-- <li class="nav-item"><a href="blog.php" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'blog.php' || basename($_SERVER['PHP_SELF']) == 'blog_post.php') ? 'active' : ''; ?>">Blog</a></li> -->
            <li class="nav-item"><a href="#" onclick="openBookingModal()" class="nav-link contact-link">Contact</a></li>
            
            <?php if (isset($_SESSION['user_id'])): ?>
                <!-- User is logged in - show account info -->
                <li class="nav-item account-item">
                    <div class="user-menu-container">
                        <span class="welcome-message">Hello, <?= htmlspecialchars($_SESSION['username'] ?? '') ?></span>
                        
                        <?php if ($_SESSION['role'] === 'admin'): ?>
                            <a href="admin/admin.php" class="user-menu-link">Dashboard</a>
                        <?php elseif ($_SESSION['role'] === 'author'): ?>
                            <a href="author_dashboard.php" class="user-menu-link">Dashboard</a>
                        <?php endif; ?>
                        
                        <a href="includes/logout.php" class="user-menu-link logout-link">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </div>
                </li>
            <?php else: ?>
                <!-- User is not logged in - show auth forms -->
                <li class="nav-item auth-item">
                    <button class="auth-toggle-btn" id="authToggleBtn">Login / Register</button>
                    
                    <div id="authFormsContainer" class="auth-forms-container">
                        <!-- Login Form -->
                        <div id="loginFormWrapper" class="form-wrapper active">
                            <form id="loginForm" class="auth-form" method="POST" action="../includes/login_handler.php">
                                <h3>Login</h3>
                                <div class="form-group">
                                    <input type="email" name="email" placeholder="Email" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" placeholder="Password" required>
                                </div>
                                
                                <!-- Remember Me Checkbox -->
                                <div class="remember-me-container">
                                    <label class="remember-me">
                                        <input type="checkbox" name="remember_me">
                                        <span class="checkmark"></span>
                                        Stay logged in
                                    </label>
                                </div>
                                
                                <button type="submit" class="auth-submit-btn">Login</button>
                                
                                <p class="switch-text">
                                    Don't have an account? 
                                    <button type="button" id="showRegisterForm" class="switch-button">Register</button>
                                </p>
                            </form>
                        </div>

                        <!-- Register Form -->
                        <div id="registerFormWrapper" class="form-wrapper">
                            <form id="registerForm" class="auth-form" method="POST" action="../includes/register_handler.php">
                                <h3>Create Account</h3>
                                <div class="form-group">
                                    <input type="text" name="username" placeholder="Username" required>
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" placeholder="Email" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" placeholder="Password" required>
                                </div>
                                <button type="submit" class="auth-submit-btn">Register</button>
                                
                                <p class="switch-text">
                                    Already have an account? 
                                    <button type="button" id="showLoginForm" class="switch-button">Login</button>
                                </p>
                            </form>
                        </div>
                    </div>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>

<!-- Auth Forms Toggle Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Menu toggle functionality
    const menuToggle = document.getElementById('menu_toggle');
    const navMenu = document.getElementById('nav_menu');
    
    if (menuToggle) {
        menuToggle.addEventListener('click', function() {
            this.classList.toggle('open');
            navMenu.classList.toggle('active');
            
            // Prevent scrolling when menu is open
            document.body.classList.toggle('menu-open');
        });
    }
    
    // Auth forms toggle
    const authToggleBtn = document.getElementById('authToggleBtn');
    const authFormsContainer = document.getElementById('authFormsContainer');
    
    if (authToggleBtn && authFormsContainer) {
        authToggleBtn.addEventListener('click', function(e) {
            e.preventDefault();
            authFormsContainer.classList.toggle('active');
            
            // Close when clicking outside
            document.addEventListener('click', function closeAuthForms(event) {
                if (!authFormsContainer.contains(event.target) && event.target !== authToggleBtn) {
                    authFormsContainer.classList.remove('active');
                    document.removeEventListener('click', closeAuthForms);
                }
            });
        });
    }
    
    // Form switching functionality
    const loginFormWrapper = document.getElementById('loginFormWrapper');
    const registerFormWrapper = document.getElementById('registerFormWrapper');
    const showRegisterForm = document.getElementById('showRegisterForm');
    const showLoginForm = document.getElementById('showLoginForm');
    
    if (showRegisterForm && loginFormWrapper && registerFormWrapper) {
        showRegisterForm.addEventListener('click', function(e) {
            e.preventDefault();
            loginFormWrapper.classList.remove('active');
            registerFormWrapper.classList.add('active');
        });
    }
    
    if (showLoginForm && loginFormWrapper && registerFormWrapper) {
        showLoginForm.addEventListener('click', function(e) {
            e.preventDefault();
            registerFormWrapper.classList.remove('active');
            loginFormWrapper.classList.add('active');
        });
    }
});

/* JavaScript to add scrolled class to navbar */
document.addEventListener('DOMContentLoaded', function() {
    const navbar = document.querySelector('.navbar');
    
    window.addEventListener('scroll', function() {
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });
});
</script>
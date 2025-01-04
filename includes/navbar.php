<?php session_start(); // Ensure session is started ?>
<?php require_once(ROOT_PATH . '/includes/heading.php'); ?>
<script src="static/js/public_script.js"></script>

<!-- Navbar -->
<div class="navbar">
    <div class="logo_div">
        <a href="index.php"><img src="static/images/hreniuc_logo.png" id="logo_image" alt="Logo"></a>
    </div>

    <button class="menu_toggle" id="menu_toggle">
        <div class="bar bar1"></div>
        <div class="bar bar2"></div>
        <div class="bar bar3"></div>
    </button>

    <ul id="nav_menu">
        <li><a href="index.php" class="active">HOME</a></li>
        <li><a onclick="openBookingModal()">CONTACT</a></li>
        <li><a href="#programming_section">WEB DEV</a></li>
        <li><a href="#automation_section">MARKETING AUTOMATION</a></li>
        <li><a href="#digital_art_section">DIGITAL ART</a></li>

        <?php if (isset($_SESSION['user_id'])): ?>
            <!-- Show welcome message if logged in -->
            <li><span class="welcome_message">Welcome, <?= htmlspecialchars($_SESSION['username']) ?>!</span></li>
            <li><a href="includes/logout.php" class="logout">LOGOUT</a></li>
            <?php if ($_SESSION['role'] === 'admin'): ?>
                <li><a href="admin/admin.php">Admin Dashboard</a></li>
            <?php elseif ($_SESSION['role'] === 'author'): ?>
                <li><a href="author_dashboard.php">Author Dashboard</a></li>
            <?php endif; ?>
        <?php else: ?>
            <!-- Show login and register forms if not logged in -->
            <!-- Auth Forms Wrapper -->
            <div id="authFormsContainer">
                <!-- Login Form -->
                <div id="loginFormWrapper" class="form-wrapper active">
                    <form id="loginForm" class="auth_form" method="POST" action="../includes/login_handler.php">
                        <h2>Login</h2>
                        <input type="email" name="email" placeholder="Email" required>
                        <input type="password" name="password" placeholder="Password" required>
                        <button type="submit">Login</button>
                    </form>
                    <p class="switch-text">
                        Don't have an account? 
                        <button type="button" id="showRegisterForm" class="switch-button">Register</button>
                    </p>
                </div>

                <!-- Register Form -->
                <div id="registerFormWrapper" class="form-wrapper">
                    <form id="registerForm" class="auth_form" method="POST" action="../includes/register_handler.php">
                        <h2>Register</h2>
                        <input type="text" name="username" placeholder="Username" required>
                        <input type="email" name="email" placeholder="Email" required>
                        <input type="password" name="password" placeholder="Password" required>
                        <button type="submit">Register</button>
                    </form>
                    <p class="switch-text">
                        Already have an account? 
                        <button type="button" id="showLoginForm" class="switch-button">Login</button>
                    </p>
                </div>
            </div>
        <?php endif; ?>
    </ul>
</div>
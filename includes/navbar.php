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
            <li><a href="logout.php">LOGOUT</a></li>
            <?php if ($_SESSION['role'] === 'admin'): ?>
                <li><a href="admin_dashboard.php">Admin Dashboard</a></li>
            <?php endif; ?>
            <?php if ($_SESSION['role'] === 'author'): ?>
                <li><a href="author_dashboard.php">Author Dashboard</a></li>
            <?php endif; ?>
        <?php else: ?>
            <li><a href="#" onclick="toggleLoginModal()">LOGIN</a></li>
            <li><a href="#" onclick="toggleRegisterModal()">REGISTER</a></li>
        <?php endif; ?>
    </ul>
</div>
<div id="registerModal" class="modal hidden">
        <form id="registerForm">
            <label>Email</label>
            <input type="email" name="email" required>
            <label>Password</label>
            <input type="password" name="password" required>
            <button type="submit">Register</button>
        </form>
        <span class="close" onclick="toggleRegisterModal()">X</span>
    </div>

    <div id="loginModal" class="modal hidden">
        <form id="loginForm">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Login</button>
        </form>
        <span class="close" onclick="toggleLoginModal()">X</span>
    </div>
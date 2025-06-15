<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Debug: Check if headers are already sent
if (headers_sent($file, $line)) {
    die("Headers already sent in $file on line $line");
}

// Start output buffering
ob_start();

// Start session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Include config.php - make sure this path is correct
require_once(__DIR__ . '/../config.php');

// Check if environment constant is defined
if (!defined('ENVIRONMENT')) {
    // Default to production if not defined
    define('ENVIRONMENT', 'production');
}

// Set cache control headers based on environment
if (ENVIRONMENT === 'staging') {
    // Disable caching in staging
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
} else {
    // In production, set reasonable cache times but allow revalidation
    header("Cache-Control: public, max-age=86400, must-revalidate"); // 1 day
}

// Debug: Check for output
if (ob_get_length() > 0) {
    die("Unexpected output detected: " . ob_get_clean());
}

// Auto-login from cookie
if (!isset($_SESSION['logged_in']) && isset($_COOKIE['remember'])) {
    list($selector, $validator) = explode(':', $_COOKIE['remember']);

    $stmt = $conn->prepare("SELECT a.*, u.user_id, u.username, u.role
                            FROM auth_tokens a
                            JOIN users u ON a.user_id = u.user_id
                            WHERE a.selector = ? AND a.expires > NOW()");
    $stmt->bind_param("s", $selector);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $token = $result->fetch_assoc();

        if (hash_equals($token['hashed_validator'], hash('sha256', $validator))) {
            // Valid token - set session
            $_SESSION['user_id'] = $token['user_id'];
            $_SESSION['username'] = $token['username'];
            $_SESSION['role'] = $token['role'];
            $_SESSION['logged_in'] = true;

            // Rotate token
            $newValidator = bin2hex(random_bytes(32));
            $newHashedValidator = hash('sha256', $newValidator);

            $stmt = $conn->prepare("UPDATE auth_tokens
                                    SET hashed_validator = ?, expires = DATE_ADD(NOW(), INTERVAL 30 DAY)
                                    WHERE token_id = ?");
            $stmt->bind_param("si", $newHashedValidator, $token['token_id']);
            $stmt->execute();

            // Set new cookie
            setcookie(
                'remember',
                $selector . ':' . $newValidator,
                [
                    'expires' => time() + 60 * 60 * 24 * 30,
                    'path' => '/',
                    'secure' => isset($_SERVER['HTTPS']),
                    'httponly' => true,
                    'samesite' => 'Strict'
                ]
            );
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Web development and automation solutions for Romanian businesses.">

    <!-- Poppins and Reenie Beanie fonts linking -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Reenie+Beanie&display=swap" rel="stylesheet">

    <!-- Google Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <?php
    // CSS loading based on environment
    $currentFile = basename($_SERVER['PHP_SELF']);
    
    // Directory structure based on environment
    if (ENVIRONMENT === 'production') {
        $cssBasePath = 'dist/styles/';
        $jsBasePath = 'dist/scripts/';
        $fileExtension = '.min';
    } else {
        $cssBasePath = 'static/css/';
        $jsBasePath = 'static/js/';
        $fileExtension = '';
    }
    
    // Map page-specific CSS files
    $cssMap = [
        'index.php'       => 'home',
        'webdev.php'      => 'webdev',
        'automation.php'  => 'automation',
        'artworks.php'    => 'artworks',
        'blog.php'        => 'blog',
        'blog_post.php'   => 'blog_post',
        'webdev.php'      => 'webdev',
        'resource-thank-you.php' => 'thank-you'
        // Add more mappings as needed
    ];
    
    // Common CSS files that should be loaded before page-specific CSS
    $commonCssFiles = [
        'navbar'
    ];
    
    // CSS Loading Helper
    echo '<script>
    // Simple CSS load helper
    !function(e){"use strict";var t=function(t,n,r){function o(e){return i.body?e():void setTimeout(function(){o(e)})}function a(){d.addEventListener&&d.removeEventListener("load",a),d.media=r||"all"}var l,i=e.document,d=i.createElement("link");if(n)l=n;else{var s=(i.body||i.getElementsByTagName("head")[0]).childNodes;l=s[s.length-1]}var u=i.styleSheets;d.rel="stylesheet",d.href=t,d.media="only x",o(function(){l.parentNode.insertBefore(d,n?l:l.nextSibling)});var f=function(e){for(var t=d.href,n=u.length;n--;)if(u[n].href===t)return e();setTimeout(function(){f(e)})};return d.addEventListener&&d.addEventListener("load",a),d.onloadcssdefined=f,f(a),d};"undefined"!=typeof exports?exports.loadCSS=t:e.loadCSS=t}("undefined"!=typeof global?global:this);
    </script>';
    
    if (ENVIRONMENT === 'production') {
        // PRODUCTION ENVIRONMENT
        
        // 1. Load common CSS files
        foreach ($commonCssFiles as $cssFile) {
            $fullPath = $cssBasePath . $cssFile . $fileExtension . '.css';
            if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $fullPath)) {
                $cssVersion = filemtime($_SERVER['DOCUMENT_ROOT'] . '/' . $fullPath);
                echo '<link rel="preload" href="/' . $fullPath . '?v=' . $cssVersion . '" as="style" onload="this.onload=null;this.rel=\'stylesheet\'">';
                echo '<noscript><link rel="stylesheet" href="/' . $fullPath . '?v=' . $cssVersion . '"></noscript>';
            }
        }
        
        // 2. Load page-specific CSS
        if (isset($cssMap[$currentFile])) {
            $pageSpecificCss = $cssMap[$currentFile];
            $fullPath = $cssBasePath . $pageSpecificCss . $fileExtension . '.css';
            if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $fullPath)) {
                $cssVersion = filemtime($_SERVER['DOCUMENT_ROOT'] . '/' . $fullPath);
                echo '<link rel="preload" href="/' . $fullPath . '?v=' . $cssVersion . '" as="style" onload="this.onload=null;this.rel=\'stylesheet\'">';
                echo '<noscript><link rel="stylesheet" href="/' . $fullPath . '?v=' . $cssVersion . '"></noscript>';
            }
        }
        
        // 3. Load any manually specified CSS from the page
        if (isset($page_css)) {
            $fullPath = $cssBasePath . $page_css . $fileExtension . '.css';
            if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $fullPath)) {
                $cssVersion = filemtime($_SERVER['DOCUMENT_ROOT'] . '/' . $fullPath);
                echo '<link rel="preload" href="/' . $fullPath . '?v=' . $cssVersion . '" as="style" onload="this.onload=null;this.rel=\'stylesheet\'">';
                echo '<noscript><link rel="stylesheet" href="/' . $fullPath . '?v=' . $cssVersion . '"></noscript>';
            }
        }
        
    } else {
        // DEVELOPMENT ENVIRONMENT
        
        // 1. Load common CSS files
        foreach ($commonCssFiles as $cssFile) {
            $fullPath = $cssBasePath . $cssFile . '.css';
            if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $fullPath)) {
                $cssVersion = filemtime($_SERVER['DOCUMENT_ROOT'] . '/' . $fullPath);
                echo '<link rel="stylesheet" href="/' . $fullPath . '?v=' . $cssVersion . '">';
            }
        }
        
        // 2. Load page-specific CSS
        if (isset($cssMap[$currentFile])) {
            $pageSpecificCss = $cssMap[$currentFile];
            $fullPath = $cssBasePath . $pageSpecificCss . '.css';
            if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $fullPath)) {
                $cssVersion = filemtime($_SERVER['DOCUMENT_ROOT'] . '/' . $fullPath);
                echo '<link rel="stylesheet" href="/' . $fullPath . '?v=' . $cssVersion . '">';
            }
        }
        
        // 3. Load any manually specified CSS from the page
        if (isset($page_css)) {
            $fullPath = $cssBasePath . $page_css . '.css';
            if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $fullPath)) {
                $cssVersion = filemtime($_SERVER['DOCUMENT_ROOT'] . '/' . $fullPath);
                echo '<link rel="stylesheet" href="/' . $fullPath . '?v=' . $cssVersion . '">';
            }
        }
    }
    ?>

    <!-- JavaScript files with versioning -->
    <?php
    // Map page-specific JS files
    $jsMap = [
        'index.php'       => 'home',
        'webdev.php'      => 'webdev',
        'automation.php'  => 'automation',
        'artworks.php'    => 'artworks',
        'blog.php'        => 'blog',
        'blog_post.php'   => 'blog_post',
        'webdev.php'      => 'webdev'
        // Add more mappings as needed
    ];
    
    // Public script files shared across multiple pages
    $publicScriptFiles = [
        'public_script'
    ];
    
    if (ENVIRONMENT === 'production') {
        // PRODUCTION ENVIRONMENT
        
        // 1. Load public script files (minified)
        foreach ($publicScriptFiles as $jsFile) {
            $fullPath = $jsBasePath . $jsFile . $fileExtension . '.js';
            if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $fullPath)) {
                $jsVersion = filemtime($_SERVER['DOCUMENT_ROOT'] . '/' . $fullPath);
                echo '<script src="/' . $fullPath . '?v=' . $jsVersion . '" defer></script>';
            }
        }
        
        // 2. Load page-specific JS (minified)
        if (isset($jsMap[$currentFile])) {
            $pageSpecificJs = $jsMap[$currentFile];
            $fullPath = $jsBasePath . $pageSpecificJs . $fileExtension . '.js';
            if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $fullPath)) {
                $jsVersion = filemtime($_SERVER['DOCUMENT_ROOT'] . '/' . $fullPath);
                echo '<script src="/' . $fullPath . '?v=' . $jsVersion . '" defer></script>';
            }
        }
        
        // 3. Load any manually specified JS from the page
        if (isset($page_js)) {
            $fullPath = $jsBasePath . $page_js . $fileExtension . '.js';
            if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $fullPath)) {
                $jsVersion = filemtime($_SERVER['DOCUMENT_ROOT'] . '/' . $fullPath);
                echo '<script src="/' . $fullPath . '?v=' . $jsVersion . '" defer></script>';
            }
        }
        
    } else {
        // DEVELOPMENT ENVIRONMENT
        
        // 1. Load public script files
        foreach ($publicScriptFiles as $jsFile) {
            $fullPath = $jsBasePath . $jsFile . '.js';
            if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $fullPath)) {
                $jsVersion = filemtime($_SERVER['DOCUMENT_ROOT'] . '/' . $fullPath);
                echo '<script src="/' . $fullPath . '?v=' . $jsVersion . '" defer></script>';
            }
        }
        
        // 2. Load page-specific JS
        if (isset($jsMap[$currentFile])) {
            $pageSpecificJs = $jsMap[$currentFile];
            $fullPath = $jsBasePath . $pageSpecificJs . '.js';
            if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $fullPath)) {
                $jsVersion = filemtime($_SERVER['DOCUMENT_ROOT'] . '/' . $fullPath);
                echo '<script src="/' . $fullPath . '?v=' . $jsVersion . '" defer></script>';
            }
        }
        
        // 3. Load any manually specified JS from the page
        if (isset($page_js)) {
            $fullPath = $jsBasePath . $page_js . '.js';
            if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $fullPath)) {
                $jsVersion = filemtime($_SERVER['DOCUMENT_ROOT'] . '/' . $fullPath);
                echo '<script src="/' . $fullPath . '?v=' . $jsVersion . '" defer></script>';
            }
        }
    }
    
    // Define additional script files needed for specific pages
    $additionalScripts = [
        'artworks.php' => ['artworks'],
        'bookings.php' => ['bookings']
        // Add more page-specific scripts as needed
    ];

    // Check if current page needs additional scripts
    if (isset($additionalScripts[$currentFile])) {
        foreach ($additionalScripts[$currentFile] as $scriptName) {
            if (ENVIRONMENT === 'production') {
                $scriptPath = $jsBasePath . $scriptName . $fileExtension . '.js';
            } else {
                $scriptPath = $jsBasePath . $scriptName . '.js';
            }
            
            if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $scriptPath)) {
                $scriptVersion = filemtime($_SERVER['DOCUMENT_ROOT'] . '/' . $scriptPath);
                echo '<script src="/' . $scriptPath . '?v=' . $scriptVersion . '" defer></script>';
            }
        }
    }

    // Handle any other required scripts that might be needed globally but aren't in the main list
    $globalScripts = ['bookings']; // Scripts that might be needed on multiple pages
    foreach ($globalScripts as $scriptName) {
        // Only add if not already added for the current page
        if (!isset($additionalScripts[$currentFile]) || !in_array($scriptName, $additionalScripts[$currentFile])) {
            if (ENVIRONMENT === 'production') {
                $scriptPath = $jsBasePath . $scriptName . $fileExtension . '.js';
            } else {
                $scriptPath = $jsBasePath . $scriptName . '.js';
            }
            
            if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $scriptPath)) {
                $scriptVersion = filemtime($_SERVER['DOCUMENT_ROOT'] . '/' . $scriptPath);
                echo '<script src="/' . $scriptPath . '?v=' . $scriptVersion . '" defer></script>';
            }
        }
    }
    ?>

    <!-- Define dataLayer and gtag function -->
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() {
            dataLayer.push(arguments);
        }

        // Set default consent to 'denied' for all parameters
        gtag('consent', 'default', {
            'ad_storage': 'denied',
            'ad_user_data': 'denied',
            'ad_personalization': 'denied',
            'analytics_storage': 'denied',
            'wait_for_update': 500 // Wait 500ms for consent tool to update
        });
    </script>

    <!-- Load GTAG script with versioning -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-GD3WH3CZ7H"></script>
    <script>
        // Initialize GTAG
        gtag('js', new Date());
        gtag('config', 'G-GD3WH3CZ7H');
    </script>

    <style>
        .cookie-banner {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(15, 20, 19, 0.95);
            color: #f2f2f2;
            padding: 20px;
            text-align: center;
            z-index: 1000;
            display: none;
            box-shadow: 0 -4px 10px rgba(0, 0, 0, 0.3); 
            backdrop-filter: blur(8px);
            border-top: 1px solid rgba(222, 76, 54, 0.3); 
        }

        .cookie-banner p {
            margin: 0 0 15px;
            font-size: 1rem;
            font-family: 'Poppins', sans-serif; 
        }

        .cookie-banner a {
            color: #de4c36; 
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        .cookie-banner a:hover {
            color: #c43c2a;
        }

        .cookie-buttons {
            display: flex;
            justify-content: center;
            gap: 10px; 
        }

        .cookie-buttons button {
            background-color: #de4c36;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            font-family: 'Poppins', sans-serif; 
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .cookie-buttons button:hover {
            background-color: #c43c2a;
            transform: translateY(-2px); 
        }

        .cookie-buttons button#reject-cookies {
            background-color: transparent;
            border: 1px solid #f2f2f2;
            color: #f2f2f2;
        }

        .cookie-buttons button#reject-cookies:hover {
            background-color: rgba(242, 242, 242, 0.1);
        }

        #accept-cookies {
            color: rgb(255, 255, 255);
        }
    </style>
</head>
<body>
    <!-- Cookie Banner -->
    <div id="cookie-banner" class="cookie-banner">
        <p>We use cookies to enhance your experience. By continuing to visit this site, you agree to our use of cookies. 
           <a href="/privacy-policy" target="_blank">Learn more</a>.
        </p>
        <div class="cookie-buttons">
            <button id="accept-cookies">Accept</button>
            <button id="reject-cookies">Reject</button>
        </div>
    </div>

    <script>
        // Handle cookie consent
        document.addEventListener("DOMContentLoaded", function () {
            const cookieBanner = document.getElementById("cookie-banner");
            const acceptCookiesButton = document.getElementById("accept-cookies");
            const rejectCookiesButton = document.getElementById("reject-cookies");

            if (!getCookie("cookie_consent")) {
                cookieBanner.style.display = "block";
            }

            acceptCookiesButton.addEventListener("click", function () {
                setCookie("cookie_consent", "accepted", 365);
                cookieBanner.style.display = "none";
                gtag('consent', 'update', {
                    'ad_storage': 'granted',
                    'ad_user_data': 'granted',
                    'ad_personalization': 'granted',
                    'analytics_storage': 'granted'
                });
            });

            rejectCookiesButton.addEventListener("click", function () {
                setCookie("cookie_consent", "rejected", 365);
                cookieBanner.style.display = "none";
                gtag('consent', 'update', {
                    'ad_storage': 'denied',
                    'ad_user_data': 'denied',
                    'ad_personalization': 'denied',
                    'analytics_storage': 'denied'
                });
            });
        });

        // Cookie helper functions
        function setCookie(name, value, days) {
            const date = new Date();
            date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000);
            const expires = "expires=" + date.toUTCString();
            document.cookie = name + "=" + value + ";" + expires + ";path=/";
        }

        function getCookie(name) {
            const cookieName = name + "=";
            const decodedCookie = decodeURIComponent(document.cookie);
            const cookies = decodedCookie.split(";");
            for (let i = 0; i < cookies.length; i++) {
                let cookie = cookies[i].trim();
                if (cookie.indexOf(cookieName) === 0) {
                    return cookie.substring(cookieName.length, cookie.length);
                }
            }
            return null;
        }

        function clearConsentCookie() {
            document.cookie = "cookie_consent=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
            alert("Consent cookie cleared. Refresh the page to see the banner again.");
        }
    </script>
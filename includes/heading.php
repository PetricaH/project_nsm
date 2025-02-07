<?php
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

// Include config.php
require_once(__DIR__ . '/../config.php');

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
    <meta name="description" content="Doing important things for important individuals.">

    <!-- Poppins and Reenie Beanie fonts linking -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Reenie+Beanie&display=swap" rel="stylesheet">

    <!-- Google Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Linking to the stylesheet for the index.php -->
    <link rel="stylesheet" type="text/css" href="static/css/home.css">
    <link rel="stylesheet" type="text/css" href="static/css/navbar.css">
    <link rel="stylesheet" type="text/css" href="static/css/artworks.css">
    <link rel="stylesheet" type="text/css" href="static/css/automation.css">
    <link rel="stylesheet" type="text/css" href="static/css/blog.css">
    <link rel="stylesheet" type="text/css" href="static/css/blog_post.css">

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

    <!-- Load GTAG script -->
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
            color:rgb(255, 255, 255);
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
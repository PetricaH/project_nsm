<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Poppins and Reenie Beanie fonts linking -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Reenie+Beanie&display=swap" rel="stylesheet">

    <!-- Google Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />

    <!-- Linking to the stylesheet for the index.php -->
    <link rel="stylesheet" type="text/css" href="static/css/home.css">
    <link rel="stylesheet" type="text/css" href="static/css/navbar.css">
    <link rel="stylesheet" type="text/css" href="static/css/artworks.css">
    <link rel="stylesheet" type="text/css" href="static/css/automation.css">

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
        /* Cookie Banner Styles */
        .cookie-banner {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: #333;
            color: #fff;
            padding: 15px;
            text-align: center;
            z-index: 1000;
            display: none; /* Hidden by default */
        }

        .cookie-banner p {
            margin: 0 0 10px;
            font-size: 14px;
        }

        .cookie-banner a {
            color: #4caf50;
            text-decoration: underline;
        }

        .cookie-buttons button {
            background: #4caf50;
            color: #fff;
            border: none;
            padding: 8px 16px;
            margin: 0 5px;
            cursor: pointer;
            font-size: 14px;
        }

        .cookie-buttons button#reject-cookies {
            background: #f44336;
        }
    </style>

    <?php require_once('config.php'); ?>
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
    </script>
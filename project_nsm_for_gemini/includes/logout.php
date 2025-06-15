<?php
require_once('../config.php');

// Get current session cookie parameters
$cookieParams = session_get_cookie_params();

// Delete session cookie by setting expiration to past
setcookie(
    session_name(), 
    '', 
    [
        'expires' => time() - 3600,
        'path' => $cookieParams['path'],
        'domain' => $cookieParams['domain'],
        'secure' => $cookieParams['secure'],
        'httponly' => $cookieParams['httponly'],
        'samesite' => $cookieParams['samesite']
    ]
);

// Destroy session completely
$_SESSION = [];
session_unset();
session_destroy();

// Handle remember me cookie removal
if (isset($_COOKIE['remember'])) {
    list($selector, $validator) = explode(':', $_COOKIE['remember'], 2);
    
    // Delete token from database
    $stmt = $conn->prepare("DELETE FROM auth_tokens WHERE selector = ?");
    $stmt->bind_param("s", $selector);
    $stmt->execute();

    // Clear cookie with same parameters as when set
    setcookie(
        'remember', 
        '', 
        [
            'expires' => time() - 3600,
            'path' => '/',
            'domain' => $_SERVER['HTTP_HOST'],
            'secure' => isset($_SERVER['HTTPS']),
            'httponly' => true,
            'samesite' => 'Strict'
        ]
    );
}

// Force immediate cookie expiration client-side
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

// Redirect with anti-caching headers
header('Location: ../index.php');
exit;
?>
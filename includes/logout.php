<?php
require_once('../config.php');

// destroy session
session_unset();
session_destroy();

// remove remember cookies
if (isset($_COOKIE['remember'])) {
    list($selector, $validator) = explode(':', $_COOKIE['remember']);

    $stmt = $conn->prepare("DELETE FROM auth_tokens WHERE selector = ?");
    $stmt->bind_param("s", $selector);
    $stmt->execute();

    setcookie('remember', '', [
        'expires' => time() - 3600,
        'path' => '/'
    ]);
}

header('Location: ../index.php');
exit;
?>

<?php
ob_start(); // Start output buffering
header('Content-Type: application/json');

require_once('../config.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    ob_clean(); // Clear any unwanted output
    echo json_encode(['success' => false, 'error' => 'Invalid request method.']);
    exit;
}

$email = trim($_POST['email']);
$password = trim($_POST['password']);
$rememberMe = isset($_POST['remember_me']);

if (empty($email) || empty($password)) {
    ob_clean(); // Clear any unwanted output
    echo json_encode(['success' => false, 'error' => 'Email and password are required.']);
    exit;
}

$stmt = $conn->prepare("SELECT user_id, username, password_hash, role FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();

    if (password_verify($password, $user['password_hash'])) {
        // set session variables
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['logged_in'] = true;

        // handle 'Remember me functionality'
        if ($rememberMe) {
            // here generate tokens
            $selector = bin2hex(random_bytes(12));
            $validator = bin2hex(random_bytes(32));
            $hashedValidator =  hash('sha256', $validator);
            $expires = date('Y-m-d H:i:s', strtotime('+30 days'));

            // store the token in db
            $stmt = $conn->prepare("INSERT INTO auth_tokens (user_id, selector, hashed_validator, expires) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("isss", $user['user_id'], $selector, $hashedValidator, $expires);
            $stmt->execute();
            
            // set cookies
            setcookie(
                'remember',
                $selector . ':' . $validator,
                [
                    'expires' => time() + 60*60*24*30,
                    'path' => '/',
                    'secure' => isset($_SERVER['HTTPS']),
                    'httponly' => true,
                    'samesite' => 'Strict'
                ]
            );
        }

        ob_clean(); // Clear any unwanted output
        echo json_encode(['success' => true, 'message' => 'Login successful.']);
        exit;
    }
}

ob_clean(); // Clear any unwanted output
echo json_encode(['success' => false, 'error' => 'Invalid credentials.']);
exit;

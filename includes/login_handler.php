<?php
session_start();
ob_start(); // Start output buffering
header('Content-Type: application/json');

require_once('../config.php');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    ob_clean(); // Clear any unwanted output
    echo json_encode(['success' => false, 'error' => 'Invalid request method.']);
    exit;
}

$email = trim($_POST['email']);
$password = trim($_POST['password']);

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
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        ob_clean(); // Clear any unwanted output
        echo json_encode(['success' => true, 'message' => 'Login successful.']);
        exit;
    }
}

ob_clean(); // Clear any unwanted output
echo json_encode(['success' => false, 'error' => 'Invalid credentials.']);
exit;

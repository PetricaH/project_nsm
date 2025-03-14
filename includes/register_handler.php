<?php
ob_start(); // Start output buffering
header('Content-Type: application/json');

require_once('../config.php');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'error' => 'Invalid request method.']);
    exit;
}

$username = trim($_POST['username']);
$email = trim($_POST['email']);
$password = trim($_POST['password']);

if (empty($username) || empty($email) || empty($password)) {
    echo json_encode(['success' => false, 'error' => 'All fields are required.']);
    exit;
}

// Check if the username or email already exists **BEFORE** insertion
$stmt = $conn->prepare("SELECT user_id FROM users WHERE username = ? OR email = ?");
$stmt->bind_param("ss", $username, $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    echo json_encode(['success' => false, 'error' => 'Username or email already exists.']);
    $stmt->close(); 
    exit;
}

// Hash the password
$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

// Insert the new user
$stmt = $conn->prepare("INSERT INTO users (username, email, password_hash) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $username, $email, $hashedPassword);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Registration successful.']);
    exit;
} else {
    echo json_encode(['success' => false, 'error' => 'Registration failed.']);
}

$stmt->close(); // Close the statement after execution
exit;
?>
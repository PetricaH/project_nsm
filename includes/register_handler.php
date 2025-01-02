<?php
require_once(realpath(dirname(__FILE__) . '/../../../init.php')); // get the db info
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($email) || empty($password)) {
        echo json_encode(['success' => false, 'error' => 'All fileds are required.']);
        exit;
    }

    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $stmt = $conn->prepare("INSERT INTO users (email, password_hash, role) VALUES (?, ?, 'user')");
    $stmt->bind_param("ss", $email, $hashed_password);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Registration failed: ' . $stmt->error]);
    }
    $stmt->close();
}
?>
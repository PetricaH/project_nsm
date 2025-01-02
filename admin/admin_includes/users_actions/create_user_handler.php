<?php
require_once(realpath(dirname(__FILE__) . '/../init.php'));
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $role = $_POST['role'] ?? 'user'; // Default role to 'user'

    if (!empty($email) && !empty($password) && in_array($role, ['user', 'author', 'admin'])) {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $conn->prepare("INSERT INTO users (email, password_hash, role) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $email, $hashed_password, $role);

        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Error creating user: ' . $stmt->error]);
        }
        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'error' => 'All fields are required, and role must be valid.']);
    }
}
?>

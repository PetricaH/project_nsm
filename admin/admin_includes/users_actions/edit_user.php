<?php
require_once(realpath(dirname(__FILE__) . '/../init.php'));
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'] ?? null;
    $email = $_POST['email'] ?? '';
    $role = $_POST['role'] ?? '';

    if ($user_id && !empty($email) && in_array($role, ['user', 'author', 'admin'])) {
        $stmt = $conn->prepare("UPDATE users SET email = ?, role = ? WHERE user_id = ?");
        $stmt->bind_param("ssi", $email, $role, $user_id);

        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Error updating user.']);
        }
        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'error' => 'All fields are required, and role must be valid.']);
    }
}
?>
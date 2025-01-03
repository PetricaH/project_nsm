<?php
require_once(realpath(dirname(__FILE__) . '/../../../init.php'));

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'] ?? null;

    if ($user_id) {
        $stmt = $conn->prepare("DELETE FROM users WHERE user_id = ?");
        $stmt->bind_param("i", $user_id);

        if ($stmt->execute()) {
            // Redirect back to the user list with a success message
            header('Location: ../../manage_users.php?status=success');
            exit;
        } else {
            // Redirect with an error message
            header('Location: ../manage_users.php?status=error');
            exit;
        }
    } else {
        // Redirect if no user ID was provided
        header('Location: ../manage_users.php?status=invalid');
        exit;
    }
}
?>

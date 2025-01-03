<?php
require_once(realpath(dirname(__FILE__) . '/../../../init.php'));

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'] ?? null;

    if ($user_id) {
        $stmt = $conn->prepare("DELETE FROM users WHERE user_id = ?");
        $stmt->bind_param("i", $user_id);

        if ($stmt->execute()) {
            // Redirect back to the referring page with a success status
            header('Location: ../../admin.php?status=success');
            exit;
        } else {
            // Redirect back with an error status
            header('Location: ../../admin.php?status=error');
            exit;
        }
    } else {
        // Redirect back with an invalid ID status
        header('Location: ../../admin.php?status=invalid');
        exit;
    }
}
?>

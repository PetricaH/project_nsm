<?php
require_once('../../config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    $status = $_POST['status'] ?? null;

    if ($id && $status) {
        // Sanitize inputs
        $id = $conn->real_escape_string($id);
        $status = $conn->real_escape_string($status);

        // Update the booking status
        $query = "UPDATE bookings SET status = '$status' WHERE id = $id";
        if ($conn->query($query) === TRUE) {
            header("Location: ../manage_bookings.php?success=1");
        } else {
            header("Location: ../manage_bookings.php?error=1");
        }
    } else {
        header("Location: ../manage_bookings.php?error=1");
    }
} else {
    header("Location: ../manage_bookings.php");
}
?>

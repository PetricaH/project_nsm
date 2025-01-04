<?php
require_once(realpath(dirname(__FILE__) . '/../../../init.php'));


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $column = $_POST['column'];
    $value = $_POST['value'];

    // Validate the column name (optional)
    $allowed_columns = ['status'];
    if (!in_array($column, $allowed_columns)) {
        echo "error";
        exit;
    }

    // Update the record
    $stmt = $conn->prepare("UPDATE bookings SET $column = ? WHERE id = ?");
    $stmt->bind_param("si", $value, $id);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error";
    }

    $stmt->close();
}

$conn->close();
?>
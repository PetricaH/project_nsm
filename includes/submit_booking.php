<?php
require_once('../config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $service = htmlspecialchars(trim($_POST['service']));
    $date = htmlspecialchars(trim($_POST['date']));
    $time = htmlspecialchars(trim($_POST['time']));
    $description = htmlspecialchars(trim($_POST['description']));
    $privacyPolicy = isset($_POST['privacy_policy']) ? 1 : 0;

    if (empty($name) || empty($email) || empty($service) || empty($date) || empty($time) || empty($description)) {
        echo '<script>alert("All fields are required."); window.history.back();</script>';
        exit;
    }

    $bookingDateTime = $date . ' ' . $time;

    $stmt = $conn->prepare("INSERT INTO bookings (name, email, service, booking_datetime, description, privacy_policy) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssi", $name, $email, $service, $bookingDateTime, $description, $privacyPolicy);

    if ($stmt->execute()) {
        echo '<script>alert("Booking successfully submitted!"); window.location.href="../index.php";</script>';
    } else {
        echo '<script>alert("Failed to save booking."); window.history.back();</script>';
    }

    $stmt->close();
    $conn->close();
    exit;
}

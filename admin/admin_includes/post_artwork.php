<?php
require_once '../../config.php';

header('Content-Type: application/json'); // Respond with JSON

$conn = mysqli_connect("localhost", "ux7zizemfdtwd", "Ro545389###", "db81fxbpm4iycs");

if (!$conn) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed.']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $date = $_POST['date'];
    $image = $_FILES['image']['name'];
    $imageTmpName = $_FILES['image']['tmp_name'];
    $uploadDir = ROOT_PATH . '/static/artworks/';

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    $uniqueImageName = uniqid() . '_' . $image;
    $imageDestination = $uploadDir . $uniqueImageName;

    if (move_uploaded_file($imageTmpName, $imageDestination)) {
        $query = "INSERT INTO artworks (title, image, date) VALUES ('$title', '$uniqueImageName', '$date')";
        if (mysqli_query($conn, $query)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => mysqli_error($conn)]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to upload image.']);
    }
}
?>

<?php
require_once('../../../config.php');
header('Content-Type: application/json'); // Respond with JSON

// Define the upload directory 
$uploadDir = '../../../static/artworks/';

// Check if the form is submitted via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? null;
    $date = $_POST['date'] ?? null;
    $image = $_FILES['image']['name'] ?? null;

    // Validate input data
    if (!$title || !$date || !$image) {
        echo json_encode(['success' => false, 'message' => 'All fields are required.']);
        exit;
    }

    $uniqueImageName = uniqid() . '_' . basename($image);
    $imageTmpName = $_FILES['image']['tmp_name'];
    $imageDestination = $uploadDir . $uniqueImageName;

    // Move the uploaded file
    if (move_uploaded_file($imageTmpName, $imageDestination)) {
        // Insert data into the database
        $query = $conn->prepare("INSERT INTO artworks (title, image, date) VALUES (?, ?, ?)");
        $query->bind_param("sss", $title, $uniqueImageName, $date);

        if ($query->execute()) {
            echo json_encode(['success' => true, 'message' => 'Artwork posted successfully.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Database error: ' . $query->error]);
        }

        $query->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to upload the image.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}

$conn->close();
?>

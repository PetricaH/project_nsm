<?php
require_once('../../../config.php');
header('Content-Type: application/json');

// Define the upload directory
$uploadDir = '../../../static/artworks/';

if ($_SERVER['REQUEST_METHOD'] === 'DELETE' && isset($_GET['id'])) {
    $artworkId = (int)$_GET['id']; 

    try {
        // Step 1: Fetch image filename before deleting the database entry
        $stmt = $conn->prepare("SELECT image FROM artworks WHERE id = ?");
        $stmt->bind_param("i", $artworkId);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if (!$row) {
            echo json_encode(['success' => false, 'message' => 'Artwork not found.']);
            exit;
        }

        $imagePath = $uploadDir . $row['image'];

        // Step 2: Delete the image file
        if (file_exists($imagePath) && is_file($imagePath)) {
            if (unlink($imagePath)) {
                error_log("Image deleted successfully: " . $imagePath);
            } else {
                error_log("Failed to delete image: " . $imagePath . " - " . error_get_last()['message']);
                echo json_encode(['success' => false, 'message' => 'Failed to delete the image file.']);
                exit;
            }
        } else {
            error_log("Image file not found: " . $imagePath);
        }

        // Step 3: Delete the database entry
        $stmt = $conn->prepare("DELETE FROM artworks WHERE id = ?");
        $stmt->bind_param("i", $artworkId);
        $stmt->execute();

        echo json_encode(['success' => true, 'message' => 'Artwork deleted successfully.']);

    } catch (mysqli_sql_exception $e) {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
    }

    $stmt->close();
} else {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Invalid request.']);
}

$conn->close();
?>

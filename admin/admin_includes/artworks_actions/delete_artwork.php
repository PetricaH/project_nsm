<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once(realpath(dirname(__FILE__) . '/../../init.php'));

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id'])) {
        $id = intval($_POST['id']); // Sanitize input
        // Fetch the image file name from the database
        $query = $conn->prepare("SELECT image FROM artworks WHERE id = ?");
        $query->bind_param("i", $id);
        $query->execute();
        $query->bind_result($image);
        $query->fetch();
        $query->close();
        if ($image) {
            // File path on the server
            $filePath = __DIR__ . '/../static/artworks/' . $image;
            // Attempt to delete the file
            if (file_exists($filePath)) {
                if (!unlink($filePath)) {
                    echo json_encode(['success' => false, 'message' => 'Failed to delete the file.']);
                    exit;
                }
            }
            // Delete the record from the database
            $deleteQuery = $conn->prepare("DELETE FROM artworks WHERE id = ?");
            $deleteQuery->bind_param("i", $id);
            if ($deleteQuery->execute()) {
                echo json_encode(['success' => true, 'message' => 'Artwork deleted successfully.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to delete artwork from database.']);
            }
            $deleteQuery->close();
        } else {
            echo json_encode(['success' => false, 'message' => 'Artwork not found.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid or missing ID.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}json_encode(['success' => false, 'message' => 'Invalid request method.']);
?>
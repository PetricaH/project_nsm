<?php
// Include database connection
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../../config.php';

$artworksWebPath = '../static/artworks/';
$query = "SELECT id, title, image FROM artworks ORDER BY created_at DESC";
$result = $conn->query($query);

if ($result && $result->num_rows > 0) {
    $artworks = [];
    while ($row = $result->fetch_assoc()) {
        $row['image'] = $artworksWebPath . rawurlencode($row['image']); // Encode special characters
        $artworks[] = $row;
    }
    echo json_encode(['success' => true, 'artworks' => $artworks]);
} else {
    echo json_encode(['success' => false, 'message' => 'No artworks found.']);
}
?>

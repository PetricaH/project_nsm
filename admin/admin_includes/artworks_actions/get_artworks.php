<?php header('Content-Type: application/json');
require_once('../../../config.php');

$artworksWebPath = '../../../static/artworks/';
// Get query parameters
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Default to page 1
$limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 9; // Default to 9 items per page
$context = isset($_GET['context']) ? $_GET['context'] : 'index'; // Default context is 'index'
// Offset calculation for pagination
$offset = ($page - 1) * $limit;
try {
    if (!$conn) {
        throw new Exception("Database connection failed: " . mysqli_connect_error());
    }
    // Get the total number of artworks for pagination
    $totalQuery = "SELECT COUNT(*) AS total FROM artworks";
    $totalResult = $conn->query($totalQuery);
    $totalRow = $totalResult->fetch_assoc();
    $totalArtworks = $totalRow['total'];
    // Fetch artworks with LIMIT and OFFSET
    $query = "SELECT id, title, image FROM artworks ORDER BY created_at DESC LIMIT $limit OFFSET $offset";
    $result = $conn->query($query);
    if (!$result) {
        throw new Exception("Query Error: " . $conn->error);
    }
    $artworks = [];
    while ($row = $result->fetch_assoc()) {
        $row['image'] = $artworksWebPath . $row['image'];
        $artworks[] = $row;
    }
    // Build the response
    $response = [
        'success' => true,
        'artworks' => $artworks,
        'totalPages' => ceil($totalArtworks / $limit), // Total pages for pagination
        'currentPage' => $page
    ];
    echo json_encode($response);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
?>


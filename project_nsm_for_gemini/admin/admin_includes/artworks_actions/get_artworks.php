<?php
header('Content-Type: application/json');
require_once('../../../config.php');

// Function to dynamically generate the base URL
function getBaseUrl() {
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https://' : 'http://';
    $host = $_SERVER['HTTP_HOST'];
    $scriptDir = str_replace('/admin/admin_includes/artworks_actions', '', dirname($_SERVER['SCRIPT_NAME']));
    return $protocol . $host . $scriptDir . '/';
}

// Base URL for images
$artworksWebPath = getBaseUrl() . 'static/artworks/';

try {
    if (!$conn) {
        throw new Exception("Database connection failed: " . mysqli_connect_error());
    }

    // 1) Remove or comment out the limit-related logic
    // $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    // $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 9;
    // $offset = ($page - 1) * $limit;

    // 2) Fetch ALL artworks (no LIMIT/OFFSET)
    $query = "SELECT id, title, image FROM artworks ORDER BY created_at DESC";
    $result = $conn->query($query);
    if (!$result) {
        throw new Exception("Query Error: " . $conn->error);
    }

    $artworks = [];
    while ($row = $result->fetch_assoc()) {
        $row['image'] = $artworksWebPath . $row['image'];
        $artworks[] = $row;
    }

    // 3) Build the response (no need for totalPages/currentPage)
    $response = [
        'success'  => true,
        'artworks' => $artworks
    ];

    echo json_encode($response);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
?>

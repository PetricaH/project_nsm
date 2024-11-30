<?php 
require_once '../../config.php';

$conn = mysqli_connect("localhost", "root", "", "project_nsm", 3310);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $title = $_POST['title'];
    $date = $_POST['date'];
    $image = $_FILES['image']['name'];
    $imageTmpName = $_FILES['image']['tmp_name'];
    
    // Use ROOT_PATH to point to /static/artworks/
    $uploadDir = ROOT_PATH . '/static/artworks/';

    // Ensure the directory exists
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    // Generate unique file name to avoid overwriting
    $uniqueImageName = uniqid() . '_' . $image;
    $imageDestination = $uploadDir . $uniqueImageName;

    if (move_uploaded_file($imageTmpName, $imageDestination)) {
        $query = "INSERT INTO artworks (title, image, date) VALUES ('$title', '$uniqueImageName', '$date')";
        if (mysqli_query($conn, $query)) {
            // Redirect to avoid resubmission
            header("Location: post_artwork.php?success=1");
            exit;
        } else {
            echo "Database Error: " . mysqli_error($conn);
        }
    } else {
        echo "Failed to upload image.";
    }
}

// Display success message if redirected
if (isset($_GET['success']) && $_GET['success'] == 1) {
    echo "<p>Artwork posted successfully!</p>";
}
?>

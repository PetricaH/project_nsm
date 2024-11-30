<?php 
include 'configuration.php';

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $date = $_POST['date'];
    $image = $_FILES['image']['name'];
    $imageTmpName = $_FILES['image']['tmp_name'];
    $imageDestination = 'uploads/' . $image;

    // move the uploaded file to the server
    if (move_uploaded_file($imageTmpName, $imageDestination)) {
        $query = "INSERT INTO artworks (title, image, date) VALUES ('$title', '$image', '$date')";
        if (mysqli_query($conn, $query)) {
            echo  "Artwork posted successfully!";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "Failed to upload image.";
    }
}
?>
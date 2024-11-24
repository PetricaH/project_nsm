<h2>Manage Artwork</h2>
<form action="post_artwork.php" method="POST" enctype="multipart/form-data">
    <label for="title">Artwork Title:</label>
    <input type="text" name="title" id="title" required>

    <label for="image">Artwork Image:</label>
    <input type="file" name="image" id="image" required>

    <label for="date">Creation Date:</label>
    <input type="date" name="date" id="date" required>

    <button type="submit" name="submit">Post Artwork</button>
</form>
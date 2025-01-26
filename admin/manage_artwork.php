<?php
if ($_SESSION['role'] !== 'admin') {
    header('Location: ../index.php');
    exit;
}
?>
<h2 id="manage_artwork_h2">Manage Artwork</h2>

<form method="POST" enctype="multipart/form-data" id="manage_artwork_form">

    <div class="first_manage_artwork_form_input">  
        <label for="title">Artwork Title:</label>
        <input type="text" name="title" id="title" required>
    </div>

    <div class="second_manage_artwork_form_input">  
        <label for="image">Artwork Image:</label>
        <div id="drop_zone">
            <p>Drag & drop your image here, or click to select a file</p>
            <input type="file" name="image" id="image" required accept="image/*">
        </div>
        <div id="preview"></div>
    </div>

    <div class="third_manage_artwork_form_input">
        <label for="date">Creation Date:</label>
        <input type="date" name="date" id="date" required>
    </div>

    <button type="submit" name="submit">Post Artwork</button>

    <div id="notification" class="notification hidden">
        <span class="close" onclick="closeNotification()">X</span>
        <span id="notificationMessage"></span>
    </div>

</form>

<div id="artworks_container"></div>
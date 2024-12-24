<?php 

// connect to database
    $conn = mysqli_connect("localhost", "ux7zizemfdtwd", "Ro545389###", "db81fxbpm4iycs");
    
    if (!$conn) {
        die("Error connecting to database: " . mysqli_connect_error());
    }

    // define global constants 
    define ('ROOT_PATH', realpath(dirname(__FILE__)));
    define ('BASE_URL', 'https://hreniucpetrica.ro/'); 
?> 
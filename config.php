<?php 



// connect to database

$conn = mysqli_connect("localhost", "root", "", "project_nsm", "3310");

    

    if (!$conn) {

        die("Error connecting to database: " . mysqli_connect_error());

    }



    // define global constants 

    define ('ROOT_PATH', realpath(dirname(__FILE__)));

    define ('BASE_URL', 'https://hreniucpetrica.ro/'); 

?> 
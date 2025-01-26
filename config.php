<?php
// Enable error reporting at the VERY TOP
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Debug: Check if headers are already sent
if (headers_sent($file, $line)) {
    die("Headers already sent in $file on line $line");
}

// Start output buffering
ob_start();

// Database connection
$conn = mysqli_connect("localhost", "root", "", "project_nsm", 3310);

if (!$conn) {
    die("Error connecting to database: " . mysqli_connect_error());
}

// Define global constants
define('ROOT_PATH', realpath(dirname(__FILE__)));
define('BASE_URL', 'https://hreniucpetrica.ro/');

// Debug: Check for unintended output
if (ob_get_length() > 0) {
    die("Unexpected output detected: " . ob_get_clean());
}

// No closing
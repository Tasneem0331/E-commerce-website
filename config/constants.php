<?php

// start the session
session_start();

// Create constants to store non-repeating values
define('SITEURL','http://localhost/E-commerce-website/');
define('LOCALHOST', 'localhost');  // Constants are typically written in uppercase
define ('DB_USERNAME','root');
define('DB_PASSWORD','');
define('DB_NAME','e-commerce-website');
// 1. Connect to the database
$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check if the connection was successful
if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
}


?>

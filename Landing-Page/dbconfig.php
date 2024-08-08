<?php
$servername = "localhost"; // Typically 'localhost'
$username = "root";        // Your MySQL username
$password = "";            // Your MySQL password
$dbname = "repair-shop-locator"; // The database name

// Create connection
$connection = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

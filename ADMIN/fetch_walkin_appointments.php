<?php
// fetch_walkin_appointments.php

// Database configuration
$host = 'localhost'; // Change to your database host
$dbname = 'repair-shop-locator'; // Change to your database name
$username = 'root'; // Change to your database username
$password = ''; // Change to your database password

// Create a new mysqli instance
$mysqli = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($mysqli->connect_error) {
    die(json_encode(['error' => $mysqli->connect_error]));
}

// Fetch pending appointments
$query = "SELECT * FROM walkin_appointments WHERE status = 'pending'";
$result = $mysqli->query($query);

if ($result) {
    $appointments = [];
    while ($row = $result->fetch_assoc()) {
        $appointments[] = $row;
    }
    echo json_encode($appointments);
} else {
    echo json_encode(['error' => $mysqli->error]);
}

// Close the connection
$mysqli->close();
?>

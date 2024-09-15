<?php
// Database connection (update with your own credentials)
$mysqli = new mysqli("localhost", "root", "", "repair-shop-locator");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Query to fetch data
$query = "SELECT * FROM  delivered_products";
$result = $mysqli->query($query);

$data = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($data);

$mysqli->close();
?>

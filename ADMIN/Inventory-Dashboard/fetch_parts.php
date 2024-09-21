<?php
// Database connection
$servername = "localhost"; // Change as necessary
$username = "root"; // Change as necessary
$password = ""; // Change as necessary
$dbname = "repair-shop-locator"; // Change as necessary

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch parts with updated status
$query = "SELECT partID, partName, quantity, price, supplier, status FROM delivered_products WHERE status IN ('Received', 'Returned')";
$result = $conn->query($query);

$parts = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $parts[] = $row;
    }
}

$conn->close();

// Return the data as JSON
header('Content-Type: application/json');
echo json_encode($parts);
?>

<?php
// Database connection settings
$host = 'localhost'; // Your database host
$user = 'root'; // Your database username
$password = ''; // Your database password
$database = 'repair-shop-locator'; // Your database name

// Create a connection
$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to fetch returned damage items
$sql = "SELECT partID, partName, quantity, price, supplier, status, issue_details 
        FROM delivered_products 
        WHERE status = 'returned'"; // Adjust the table name as needed

$result = $conn->query($sql);

$items = [];

if ($result->num_rows > 0) {
    // Fetch all items and store them in an array
    while ($row = $result->fetch_assoc()) {
        $items[] = $row;
    }
}

// Convert the items array to JSON format
echo json_encode($items);

// Close the database connection
$conn->close();
?>

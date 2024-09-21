<?php
// Database configuration
$host = 'localhost'; // Your database host
$user = 'root'; // Your database username
$password = ''; // Your database password
$database = 'repair-shop-locator'; // Your database name

// Create a connection
$conn = new mysqli($host, $user, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the part ID from the request
if (isset($_GET['id'])) {
    $partID = $conn->real_escape_string($_GET['id']);

    // Prepare and execute the SQL statement
    $sql = "SELECT * FROM delivered_products WHERE partID = '$partID'";
    $result = $conn->query($sql);

    // Check if any results were returned
    if ($result->num_rows > 0) {
        // Fetch the data
        $row = $result->fetch_assoc();
        // Return the data as a JSON object
        echo json_encode($row);
    } else {
        // No product found
        echo json_encode(['error' => 'Product not found']);
    }
} else {
    echo json_encode(['error' => 'Invalid request']);
}

// Close the connection
$conn->close();
?>

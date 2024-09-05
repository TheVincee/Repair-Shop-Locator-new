<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "repair-shop-locator";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(["status" => "error", "message" => "Database connection failed: " . $conn->connect_error]));
}

// Prepare and execute the select statement
$sql = "SELECT product_id, vehicle_type, part_name, quantity, price FROM inventory_tb";
$result = $conn->query($sql);

// Check if any records were returned
if ($result->num_rows > 0) {
    $parts = [];
    while ($row = $result->fetch_assoc()) {
        $parts[] = $row; // Collect all rows in an array
    }
    // Return a JSON object with status 'success' and the data
    echo json_encode(["status" => "success", "parts" => $parts]);
} else {
    // Return a JSON object with status 'error' if no data is found
    echo json_encode(["status" => "error", "message" => "No parts found."]);
}

// Close the database connection
$conn->close();
?>

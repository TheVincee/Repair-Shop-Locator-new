<?php
// Database connection
$servername = "localhost"; // Update with your database server
$username = "root"; // Update with your database username
$password = ""; // Update with your database password
$dbname = "repair-shop-locator  "; // Update with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the JSON data from the request body
$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['product_id'])) {
    $product_id = $conn->real_escape_string($data['product_id']);

    // Prepare and execute the select statement
    $sql = "SELECT product_id, vehicle_type, part_name, quantity, price FROM inventory_tb WHERE product_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $part = $result->fetch_assoc();
        echo json_encode(["status" => "success", "part" => $part]);
    } else {
        echo json_encode(["status" => "error", "message" => "Part not found."]);
    }

    $stmt->close();
} else {
    echo json_encode(["status" => "error", "message" => "Invalid input."]);
}

$conn->close();
?>

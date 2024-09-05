<?php
// Database connection
$servername = "localhost"; // Update with your database server
$username = "root"; // Update with your database username
$password = ""; // Update with your database password
$dbname = "repair-shop-locator"; // Update with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the JSON data from the request body
$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['product_id']) && isset($data['vehicle_type']) && isset($data['part_name']) && isset($data['quantity']) && isset($data['price'])) {
    $product_id = $data['product_id'];
    $vehicle_type = $conn->real_escape_string($data['vehicle_type']);
    $part_name = $conn->real_escape_string($data['part_name']);
    $quantity = (int)$data['quantity'];
    $price = (float)$data['price'];

    // Prepare and execute the update statement
    $sql = "UPDATE inventory_tb SET vehicle_type = ?, part_name = ?, quantity = ?, price = ? WHERE product_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssidi", $vehicle_type, $part_name, $quantity, $price, $product_id);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Part updated successfully."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to update part."]);
    }

    $stmt->close();
} else {
    echo json_encode(["status" => "error", "message" => "Invalid input."]);
}

$conn->close();
?>

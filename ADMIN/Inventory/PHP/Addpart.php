<?php
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "repair-shop-locator";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(["status" => "error", "message" => "Connection failed: " . $conn->connect_error]));
}

// Get the JSON data from the request
$data = json_decode(file_get_contents("php://input"), true);

$vehicle_type = $data['vehicle_type'];
$part_name = $data['part_name'];
$quantity = $data['quantity'];
$price = $data['price'];

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO parts_inventory (vehicle_type, part_name, quantity, price) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssis", $vehicle_type, $part_name, $quantity, $price);

// Execute the query
if ($stmt->execute()) {
    echo json_encode(["status" => "success", "message" => "Part added successfully"]);
} else {
    echo json_encode(["status" => "error", "message" => "Error: " . $stmt->error]);
}

// Close connections
$stmt->close();
$conn->close();
?>

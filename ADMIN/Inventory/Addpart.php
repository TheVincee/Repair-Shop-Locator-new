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

if (!$data) {
    echo json_encode(["status" => "error", "message" => "Invalid input"]);
    exit;
}

$vehicle_type = $data['vehicle_type'] ?? null;
$part_name = $data['part_name'] ?? null;
$quantity = $data['quantity'] ?? null;
$price = $data['price'] ?? null;

// Validate input data
if (!$vehicle_type || !$part_name || !$quantity || !$price) {
    echo json_encode(["status" => "error", "message" => "All fields are required"]);
    exit;
}

// Ensure quantity is a valid integer
if (!is_numeric($quantity) || intval($quantity) < 0) {
    echo json_encode(["status" => "error", "message" => "Quantity must be a valid positive number"]);
    exit;
}

// Ensure price is a valid numeric value
if (!is_numeric($price) || floatval($price) < 0) {
    echo json_encode(["status" => "error", "message" => "Price must be a valid positive number"]);
    exit;
}

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO inventory_tb (vehicle_type, part_name, quantity, price) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssis", $vehicle_type, $part_name, $quantity, $price);

// Execute the query
if ($stmt->execute()) {
    // Get the inserted product ID
    $inserted_id = $stmt->insert_id;
    
    // Return success message with the inserted part details
    echo json_encode([
        "status" => "success", 
        "message" => "Part added successfully",
        "part" => [
            "product_id" => $inserted_id,
            "vehicle_type" => $vehicle_type,
            "part_name" => $part_name,
            "quantity" => $quantity,
            "price" => $price
        ]
    ]);
} else {
    echo json_encode(["status" => "error", "message" => "Error: " . $stmt->error]);
}

// Close connections
$stmt->close();
$conn->close();
?>

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
    die(json_encode(["status" => "error", "message" => "Connection failed: " . $conn->connect_error]));
}

// Get the JSON data from the request body
$data = json_decode(file_get_contents("php://input"), true);

// Check if JSON data is valid
if (json_last_error() !== JSON_ERROR_NONE) {
    echo json_encode(["status" => "error", "message" => "Invalid JSON data."]);
    exit;
}

// Check if required fields are set
if (isset($data['product_id'], $data['vehicle_type'], $data['part_name'], $data['quantity'], $data['price'])) {
    $product_id = (int) $data['product_id']; // Ensure product_id is an integer
    $vehicle_type = $data['vehicle_type'];
    $part_name = $data['part_name'];
    $quantity = (int) $data['quantity']; // Cast quantity to integer
    $price = (float) $data['price']; // Cast price to float

    // Prepare the update SQL statement
    $sql = "UPDATE inventory_tb SET vehicle_type = ?, part_name = ?, quantity = ?, price = ? WHERE product_id = ?";
    $stmt = $conn->prepare($sql);

    // Check if statement preparation is successful
    if ($stmt) {
        $stmt->bind_param("ssidi", $vehicle_type, $part_name, $quantity, $price, $product_id);

        // Execute the statement
        if ($stmt->execute()) {
            // Fetch updated part to return in the response
            $sql = "SELECT * FROM inventory_tb WHERE product_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $product_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $part = $result->fetch_assoc();

            echo json_encode([
                "status" => "success",
                "message" => "Part updated successfully.",
                "part" => $part
            ]);
        } else {
            echo json_encode(["status" => "error", "message" => "Failed to update part."]);
        }

        $stmt->close();
    } else {
        // Log error and send failure message
        error_log("SQL Error: " . $conn->error); // Logs SQL error to server log
        echo json_encode(["status" => "error", "message" => "SQL preparation failed."]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid input."]);
}

$conn->close();
?>

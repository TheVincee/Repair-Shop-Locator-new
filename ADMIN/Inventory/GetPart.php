<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "repair-shop-locator"; // Ensure the database name is correct

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(["status" => "error", "message" => "Database connection failed: " . $conn->connect_error]));
}

// Get the JSON data from the request body
$data = json_decode(file_get_contents("php://input"), true);

// Check if JSON data is valid
if (json_last_error() !== JSON_ERROR_NONE) {
    echo json_encode(["status" => "error", "message" => "Invalid JSON data."]);
    exit;
}

// Check if product_id is set and is a valid integer
if (isset($data['product_id']) && is_numeric($data['product_id'])) {
    $product_id = $conn->real_escape_string($data['product_id']);

    // Prepare the SQL statement
    $sql = "SELECT product_id, vehicle_type, part_name, quantity, price FROM inventory_tb WHERE product_id = ?";
    $stmt = $conn->prepare($sql);

    // Check if the SQL statement preparation was successful
    if ($stmt) {
        $stmt->bind_param("i", $product_id); // Bind product_id as an integer
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Fetch and return part details
            $part = $result->fetch_assoc();
            echo json_encode(["status" => "success", "part" => $part]);
        } else {
            // Return error if no part is found
            echo json_encode(["status" => "error", "message" => "Part not found."]);
        }

        $stmt->close();
    } else {
        // Log and return error if query preparation fails
        error_log("SQL Error: " . $conn->error); // Logs the actual SQL error for debugging
        echo json_encode(["status" => "error", "message" => "Failed to prepare the SQL statement."]);
    }
} else {
    // Return error for invalid or missing product_id
    echo json_encode(["status" => "error", "message" => "Invalid or missing product_id."]);
}

$conn->close();
?>

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
if (isset($data['product_id'])) {
    $product_id = (int) $data['product_id']; // Ensure product_id is an integer

    // Prepare the select SQL statement
    $sql = "SELECT * FROM inventory_tb WHERE product_id = ?";
    $stmt = $conn->prepare($sql);

    // Check if statement preparation is successful
    if ($stmt) {
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $part = $result->fetch_assoc();
            echo json_encode([
                "status" => "success",
                "part" => $part
            ]);
        } else {
            echo json_encode(["status" => "error", "message" => "Part not found."]);
        }

        $stmt->close();
    } else {
        echo json_encode(["status" => "error", "message" => "SQL preparation failed."]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid input."]);
}

$conn->close();
?>

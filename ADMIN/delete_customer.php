<?php
header('Content-Type: application/json');

// Get data from POST request
$data = json_decode(file_get_contents('php://input'), true);
$customer_id = $data['customer_id'];

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "repair-shop-locator";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and execute SQL query
$sql = "DELETE FROM customer_details WHERE customer_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $customer_id);
$success = $stmt->execute();

echo json_encode(['success' => $success]);

// Close connections
$stmt->close();
$conn->close();
?>

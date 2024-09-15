<?php
header('Content-Type: application/json');

$customerId = $_GET['customer_id'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "repair-shop-locator";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    echo json_encode(['error' => 'Database connection failed']);
    exit();
}

$sql = "SELECT * FROM customer_details WHERE customer_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $customerId);
$stmt->execute();
$result = $stmt->get_result();

$data = $result->fetch_assoc();
if ($data) {
    echo json_encode($data);
} else {
    echo json_encode(['error' => 'No data found']);
}

$stmt->close();
$conn->close();
?>

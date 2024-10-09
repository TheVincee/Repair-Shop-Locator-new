<?php
header('Content-Type: application/json');

// Database connection
$conn = new mysqli('localhost', 'root', '', 'repair-shop-locator');

if ($conn->connect_error) {
    echo json_encode(['error' => 'Database connection failed: ' . $conn->connect_error]);
    exit;
}

$sql = "SELECT * FROM customer_details";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $appointments = [];
    while ($row = $result->fetch_assoc()) {
        $appointments[] = $row;
    }
    echo json_encode($appointments);
} else {
    echo json_encode([]);
}

$conn->close();

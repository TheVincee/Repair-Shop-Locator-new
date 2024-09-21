<?php
header('Content-Type: application/json');
include 'db.php'; // Include your DB connection

$sql = "SELECT partID, partName, status FROM delivered_products WHERE status = 'Received'";
$result = $conn->query($sql);

if ($result === false) {
    echo json_encode(['error' => 'Query failed: ' . $conn->error]);
    exit;
}

if ($result->num_rows > 0) {
    $products = [];
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
    echo json_encode($products);
} else {
    echo json_encode(['error' => 'No received products found.']);
}

$conn->close();
?>

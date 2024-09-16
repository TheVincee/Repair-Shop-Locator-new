<?php
header('Content-Type: application/json');

// Database connection (adjust credentials as needed)
$mysqli = new mysqli('localhost', 'root', '', 'repair-shop-locator');

// Check connection
if ($mysqli->connect_error) {
    echo json_encode(['success' => false, 'error' => 'Database connection failed']);
    exit;
}

// Get customer ID from query parameters
$customer_id = isset($_GET['customer_id']) ? intval($_GET['customer_id']) : 0;

if ($customer_id <= 0) {
    echo json_encode(['success' => false, 'error' => 'Invalid customer ID']);
    exit;
}

// Fetch notification status for this customer
$query = "SELECT notification_status FROM notifications WHERE customer_id = ? LIMIT 1";
$stmt = $mysqli->prepare($query);
$stmt->bind_param('i', $customer_id);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    $notification_status = $row['notification_status'];
} else {
    $notification_status = 'No notifications found';
}

// Close the database connections
$stmt->close();
$mysqli->close();

// Return notification status in JSON format
echo json_encode(['success' => true, 'notification_status' => $notification_status]);
?>

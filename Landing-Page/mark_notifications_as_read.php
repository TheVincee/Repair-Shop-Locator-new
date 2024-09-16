<?php
header('Content-Type: application/json');

// Database connection (adjust credentials as needed)
$mysqli = new mysqli('localhost', 'root', '', 'repair-shop-locator');

// Check connection
if ($mysqli->connect_error) {
    echo json_encode(['success' => false, 'error' => 'Database connection failed']);
    exit;
}

// Get notification ID from query parameters
$notification_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($notification_id <= 0) {
    echo json_encode(['success' => false, 'error' => 'Invalid notification ID']);
    exit;
}

// Prepare SQL query to delete the notification
$query = "DELETE FROM notifications WHERE id = ?";
$stmt = $mysqli->prepare($query);

// Check if preparation was successful
if (!$stmt) {
    echo json_encode(['success' => false, 'error' => 'SQL preparation error: ' . $mysqli->error]);
    exit;
}

// Bind parameters and execute the statement
$stmt->bind_param('i', $notification_id);
$stmt->execute();

// Check if the notification was deleted
if ($stmt->affected_rows === 0) {
    echo json_encode(['success' => false, 'error' => 'Notification not found']);
    exit;
}

// Close the database connection
$stmt->close();
$mysqli->close();

// Return success
echo json_encode(['success' => true]);
?>

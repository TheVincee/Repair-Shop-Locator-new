<?php
header('Content-Type: application/json');

// Database connection (adjust credentials as needed)
$mysqli = new mysqli('localhost', 'root', '', 'repair-shop-locator');

// Check connection
if ($mysqli->connect_error) {
    echo json_encode(['success' => false, 'error' => 'Database connection failed']);
    exit;
}

// Prepare SQL query to fetch all notifications
$query = "SELECT id, message, is_read FROM notifications";
$result = $mysqli->query($query);

// Check for query errors
if (!$result) {
    echo json_encode(['success' => false, 'error' => 'SQL query error: ' . $mysqli->error]);
    exit;
}

// Fetch all notifications
$notifications = [];
while ($row = $result->fetch_assoc()) {
    $notifications[] = $row;
}

// Close the database connection
$mysqli->close();

// Return notifications in JSON format
echo json_encode(['success' => true, 'notifications' => $notifications]);
?>

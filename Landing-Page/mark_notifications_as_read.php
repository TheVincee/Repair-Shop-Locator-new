<?php
header('Content-Type: application/json');

// Database connection (adjust credentials as needed)
$mysqli = new mysqli('localhost', 'root', '', 'repair-shop-locator');

// Check connection
if ($mysqli->connect_error) {
    echo json_encode(['success' => false, 'error' => 'Database connection failed']);
    exit;
}

// Prepare SQL query to mark all notifications as read
$query = "DELETE FROM notifications"; // Assuming you want to delete all notifications
$stmt = $mysqli->prepare($query);

// Check if preparation was successful
if (!$stmt) {
    echo json_encode(['success' => false, 'error' => 'SQL preparation error: ' . $mysqli->error]);
    exit;
}

// Execute the statement
$stmt->execute();

// Close the statement and database connection
$stmt->close();
$mysqli->close();

// Return success response
echo json_encode(['success' => true]);
?>

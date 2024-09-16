<?php
// update_status.php

header('Content-Type: application/json');
$mysqli = new mysqli('localhost', 'root', '', 'repair-shop-locator');

if ($mysqli->connect_error) {
    echo json_encode(['error' => 'Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error]);
    exit;
}

$customer_id = isset($_POST['customer_id']) ? intval($_POST['customer_id']) : 0;
$status = isset($_POST['status']) ? $mysqli->real_escape_string($_POST['status']) : '';

if ($customer_id <= 0 || empty($status)) {
    echo json_encode(['error' => 'Invalid data']);
    exit;
}

// Update the status in customer_details table
$stmt = $mysqli->prepare("UPDATE customer_details SET Status = ? WHERE customer_id = ?");
$stmt->bind_param('si', $status, $customer_id);

if ($stmt->execute()) {
    // Insert a new notification into notifications table
    $message = "Your status has been updated to: " . $status;
    $notif_stmt = $mysqli->prepare("INSERT INTO notifications (customer_id, message) VALUES (?, ?)");
    $notif_stmt->bind_param('is', $customer_id, $message);
    $notif_stmt->execute();
    $notif_stmt->close();

    echo json_encode(['success' => true, 'message' => 'Status updated and notification sent.']);
} else {
    echo json_encode(['error' => 'Failed to update status.']);
}

$stmt->close();
$mysqli->close();
?>

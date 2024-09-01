<?php
// Include database connection file
require 'db_connection.php';

// Get the POST data
$customer_id = $_POST['customer_id'];
$status = $_POST['status'];

// Validate input
if (empty($customer_id) || empty($status)) {
    echo json_encode(['success' => false, 'message' => 'Invalid input']);
    exit();
}

// Prepare the SQL statement to update the status
$sql = "UPDATE walkin_appointments SET Status = ? WHERE customer_id = ?";

// Create a prepared statement
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $conn->error]);
    exit();
}

// Bind parameters
$stmt->bind_param('si', $status, $customer_id);

// Execute the statement
if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Status updated successfully']);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to update status']);
}

// Close statement and connection
$stmt->close();
$conn->close();
?>

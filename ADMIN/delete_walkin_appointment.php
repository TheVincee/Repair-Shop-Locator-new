<?php
// delete_appointment.php

include 'db_connection.php'; // Include your database connection

header('Content-Type: application/json'); // Set content type to JSON

// Ensure connection was successful
if ($conn->connect_error) {
    echo json_encode(['status' => 'error', 'message' => 'Database connection failed: ' . $conn->connect_error]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if customer_id is provided
    if (!isset($_POST['customer_id']) || empty($_POST['customer_id'])) {
        echo json_encode(['status' => 'error', 'message' => 'Customer ID is required.']);
        exit;
    }

    $customerId = $_POST['customer_id'];

    // Validate customer ID (numeric check)
    if (!is_numeric($customerId)) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid customer ID.']);
        exit;
    }

    // Prepare SQL statement to delete the appointment
    $stmt = $conn->prepare("DELETE FROM walkin_appointments WHERE customer_id = ?");

    if (!$stmt) {
        echo json_encode(['status' => 'error', 'message' => 'Failed to prepare SQL statement. Error: ' . $conn->error]);
        exit;
    }

    // Bind parameters
    $stmt->bind_param("i", $customerId);

    // Execute the statement
    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Appointment deleted successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to delete appointment. MySQL Error: ' . $stmt->error]);
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
?>

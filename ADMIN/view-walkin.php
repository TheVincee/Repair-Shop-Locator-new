<?php
// view_walkin.php

include 'db_connection.php'; // Include your database connection

header('Content-Type: application/json'); // Set content type to JSON

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Check if customer_id is provided
    if (!isset($_GET['customer_id']) || empty($_GET['customer_id'])) {
        echo json_encode(['status' => 'error', 'message' => 'Customer ID is required.']);
        exit;
    }

    $customerId = $_GET['customer_id'];

    // Validate customer ID (numeric check)
    if (!is_numeric($customerId)) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid customer ID.']);
        exit;
    }

    // Prepare SQL query to fetch walk-in appointment details
    $stmt = $conn->prepare("SELECT * FROM walkin_appointments WHERE customer_id = ?");
    $stmt->bind_param("i", $customerId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $appointment = $result->fetch_assoc();
        echo json_encode(['status' => 'success', 'data' => $appointment]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Appointment not found.']);
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
?>

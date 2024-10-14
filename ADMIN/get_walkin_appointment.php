<?php
require 'db_connection.php'; // Include your database connection

header('Content-Type: application/json'); // Set header for JSON response

if ($_SERVER['REQUEST_METHOD'] === 'GET') { // Change to 'GET' to match the AJAX request
    $customer_id = $_GET['customer_id'] ?? null; // Get customer_id from GET request

    // Validate customer_id
    if (empty($customer_id)) {
        echo json_encode(['status' => 'error', 'message' => 'Customer ID is required']);
        exit;
    }

    // Prepare the query to fetch appointment details
    $stmt = $conn->prepare("SELECT * FROM walkin_appointments WHERE customer_id = ?");
    
    // Bind customer_id as an integer (replace with 's' if it's a string in your database)
    $stmt->bind_param("i", $customer_id);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $appointment = $result->fetch_assoc(); // Fetch appointment details as an associative array

        if ($appointment) {
            echo json_encode(['status' => 'success', 'data' => $appointment]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No appointment found']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => $stmt->error]);
    }

    $stmt->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}

$conn->close();

<?php
require 'db_connection.php'; // Include your database connection

header('Content-Type: application/json'); // Set header for JSON response

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customer_id = $_POST['customer_id'] ?? null; // Get customer_id from POST request

    // Validate customer_id
    if (empty($customer_id)) {
        echo json_encode(['status' => 'error', 'message' => 'Customer ID is required']);
        exit;
    }

    // Prepare the query to fetch appointment details
    $stmt = $conn->prepare("SELECT * FROM walkin_appointments WHERE customer_id = ?");
    $stmt->bind_param("i", $customer_id); // Use appropriate type based on your database

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
?>

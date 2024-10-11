<?php
require 'db_connection.php'; // Include your database connection
header('Content-Type: application/json'); // Set header for JSON response

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the customer_id from the POST request
    $customer_id = $_POST['customer_id'] ?? null;

    if (empty($customer_id)) {
        echo json_encode(['status' => 'error', 'message' => 'Customer ID is required']);
        exit;
    }

    // Prepare and execute the select query
    $stmt = $conn->prepare("SELECT * FROM walkin_appointments WHERE customer_id = ?");
    $stmt->bind_param("i", $customer_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $appointment = $result->fetch_assoc();
        echo json_encode(['status' => 'success', 'data' => $appointment]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No appointment found for the provided Customer ID']);
    }

    $stmt->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}

$conn->close();
?>

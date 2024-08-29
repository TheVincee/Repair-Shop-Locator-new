<?php
require 'db_connection.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customer_id = $_POST['customer_id'];

    // Check for missing parameters
    if (empty($customer_id)) {
        echo json_encode(['success' => false, 'error' => 'Missing customer_id']);
        exit;
    }

    // Prepare and execute the delete query
    $stmt = $conn->prepare("DELETE FROM walkin_appointments WHERE customer_id = ?");
    $stmt->bind_param("i", $customer_id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $stmt->error]); // Return detailed error message
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
}

$conn->close();
?>

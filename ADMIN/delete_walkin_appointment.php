<?php
require 'db_connection.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customer_id = isset($_POST['customer_id']) ? intval($_POST['customer_id']) : null;

    if (!$customer_id) {
        echo json_encode(['success' => false, 'error' => 'Invalid or missing customer_id']);
        exit;
    }

    // Execute delete query
    $deleteQuery = "DELETE FROM walkin_appointments WHERE customer_id = ?";
    $stmt = $conn->prepare($deleteQuery);
    $stmt->bind_param("i", $customer_id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Appointment deleted successfully']);
    } else {
        echo json_encode(['success' => false, 'error' => 'Error executing deletion: ' . $stmt->error]);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
}

$conn->close();
?>

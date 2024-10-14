<?php
// Include database connection
require 'db_connection.php';

// Set content type to JSON
header('Content-Type: application/json');

// Initialize response array
$response = [
    'success' => false,
    'error' => '',
    'updated_status' => null,
];

try {
    // Get POST data and validate input
    $customer_id = isset($_POST['customer_id']) ? intval($_POST['customer_id']) : null;
    $status = isset($_POST['status']) ? trim($_POST['status']) : null;

    if ($customer_id === null || empty($status)) {
        throw new Exception('Invalid input data.');
    }

    // Prepare and execute the update statement
    $query = "UPDATE walkin_appointments SET Status = ? WHERE customer_id = ?";
    $stmt = $conn->prepare($query);

    if (!$stmt) {
        throw new Exception('Prepare statement failed: ' . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param('si', $status, $customer_id);

    // Execute and check for success
    if ($stmt->execute()) {
        $response['success'] = true;
        $response['updated_status'] = $status;
    } else {
        throw new Exception('Failed to update status: ' . $stmt->error);
    }

    // Close the statement
    $stmt->close();
} catch (Exception $e) {
    $response['error'] = $e->getMessage();
}

// Close the database connection
$conn->close();

// Send JSON response
echo json_encode($response);
?>

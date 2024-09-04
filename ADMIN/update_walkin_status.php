<?php
// Include database connection
require 'db_connection.php';

// Set content type to JSON
header('Content-Type: application/json');

$response = array();

try {
    // Get POST data
    $customer_id = isset($_POST['customer_id']) ? intval($_POST['customer_id']) : null;
    $status = isset($_POST['status']) ? trim($_POST['status']) : null;

    // Validate input
    if ($customer_id === null || empty($status)) {
        throw new Exception('Invalid input data.');
    }

    // Prepare and execute the update statement
    $query = "UPDATE walkin_appointments SET Status = ? WHERE customer_id = ?";
    $stmt = $conn->prepare($query);
    if (!$stmt) {
        throw new Exception('Prepare statement failed: ' . $conn->error);
    }

    $stmt->bind_param('si', $status, $customer_id);

    if ($stmt->execute()) {
        $response['success'] = true;
        $response['updated_status'] = $status;
    } else {
        throw new Exception('Failed to update status: ' . $stmt->error);
    }

    $stmt->close();
} catch (Exception $e) {
    $response['success'] = false;
    $response['error'] = $e->getMessage();
}

// Close the database connection
$conn->close();

// Send JSON response
echo json_encode($response);
?>

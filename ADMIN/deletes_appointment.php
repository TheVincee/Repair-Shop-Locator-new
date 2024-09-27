<?php
header('Content-Type: application/json');

// Include database connection
include('db_connection.php');

// Get the customer_id from the POST request
$customer_id = $_POST['customer_id'] ?? null;

// Ensure the customer_id is provided
if (!$customer_id) {
    echo json_encode(['success' => false, 'error' => 'Customer ID is required.']);
    exit;
}

// Prepare the delete statements for both tables
$stmt1 = $conn->prepare("DELETE FROM customer_details WHERE customer_id = ?");
$stmt2 = $conn->prepare("DELETE FROM walkin_appointments WHERE customer_id = ?");

// Bind the parameters
$stmt1->bind_param("i", $customer_id);
$stmt2->bind_param("i", $customer_id);

// Execute the first delete statement
$deleteFromCustomerDetails = $stmt1->execute();
$deleteFromWalkinAppointments = $stmt2->execute();

// Check for errors
if ($stmt1->error || $stmt2->error) {
    echo json_encode(['success' => false, 'error' => 'Failed to delete the appointment.']);
} else {
    // Check if at least one row was deleted from either table
    if ($deleteFromCustomerDetails || $deleteFromWalkinAppointments) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'No appointment found with the given Customer ID.']);
    }
}

// Close statements and connection
$stmt1->close();
$stmt2->close();
$conn->close();
?>

<?php
// delete_appointment.php
include 'db_connection.php'; // Include your database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the customer ID from the POST request
    $customerId = $_POST['customer_id'];

    // Prepare a SQL statement to delete the appointment
    $stmt = $conn->prepare("DELETE FROM walkin_appointments WHERE customer_id = ?");
    $stmt->bind_param("i", $customerId);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Appointment deleted successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to delete appointment.']);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
?>

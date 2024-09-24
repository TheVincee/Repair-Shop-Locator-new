<?php
// get_appointment_details.php
include 'db_connection.php'; // Include your database connection

if (isset($_GET['customer_id'])) {
    $customerId = $_GET['customer_id'];

    // Prepare a SQL statement to fetch appointment details
    $stmt = $conn->prepare("SELECT * FROM walkin_appointments WHERE customer_id = ?");
    $stmt->bind_param("i", $customerId); // 'i' denotes the variable type (integer)
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if any appointment details were found
    if ($result->num_rows > 0) {
        $appointment = $result->fetch_assoc();
        // Return appointment details as JSON
        echo json_encode([
            'status' => 'success',
            'data' => $appointment
        ]);
    } else {
        // No appointment found
        echo json_encode(['status' => 'error', 'message' => 'No appointment found for this customer ID.']);
    }
} else {
    // Invalid request
    echo json_encode(['status' => 'error', 'message' => 'Invalid request.']);
}
?>

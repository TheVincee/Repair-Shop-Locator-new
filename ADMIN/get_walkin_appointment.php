<?php
// get_walkin_appointment.php
require 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customer_id = $_POST['customer_id'];

    if (isset($customer_id)) {
        $stmt = $conn->prepare("SELECT * FROM walkin_appointments WHERE customer_id = ?");
        $stmt->bind_param("i", $customer_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $appointment = $result->fetch_assoc();
            echo json_encode(['status' => 'success', 'data' => $appointment]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No appointment found']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Customer ID not provided']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>

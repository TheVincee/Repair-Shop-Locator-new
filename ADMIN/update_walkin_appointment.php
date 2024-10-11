<?php
require 'db_connection.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if POST parameters are set
    if (!isset($_POST['customer_id'], $_POST['firstname'], $_POST['phoneNumber'], 
                $_POST['emailAddress'], $_POST['repairdetails'], $_POST['appointment_time'], 
                $_POST['appointment_date'], $_POST['service_type'], $_POST['carmodel'], 
                $_POST['total_payable'], $_POST['payment_type'], $_POST['payment_status'])) {
        echo json_encode(['status' => 'error', 'message' => 'Missing parameters']);
        exit;
    }

    $customer_id = $_POST['customer_id'];
    $firstname = $_POST['firstname'];
    $phoneNumber = $_POST['phoneNumber'];
    $emailAddress = $_POST['emailAddress'];
    $repairdetails = $_POST['repairdetails'];
    $appointment_time = $_POST['appointment_time'];
    $appointment_date = $_POST['appointment_date'];
    $service_type = $_POST['service_type'];
    $carmodel = $_POST['carmodel'];
    $total_payable = $_POST['total_payable'];
    $payment_type = $_POST['payment_type'];
    $payment_status = $_POST['payment_status'];

    // Prepare and execute the update query
    $stmt = $conn->prepare("UPDATE walkin_appointments 
        SET firstname = ?, phoneNumber = ?, emailAddress = ?, repairdetails = ?, 
            appointment_time = ?, appointment_date = ?, service_type = ?, 
            carmodel = ?, total_payable = ?, payment_type = ?, payment_status = ? 
        WHERE customer_id = ?");

    // Check for successful statement preparation
    if ($stmt === false) {
        echo json_encode(['status' => 'error', 'message' => 'Failed to prepare the SQL statement.']);
        exit;
    }

    // Bind parameters
    $stmt->bind_param("ssssssissssi", $firstname, $phoneNumber, $emailAddress, $repairdetails, 
        $appointment_time, $appointment_date, $service_type, $carmodel, 
        $total_payable, $payment_type, $payment_status, $customer_id);

    // Execute the statement and check for errors
    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No records were updated.']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => $stmt->error]); // Return detailed error message
    }

    $stmt->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}

$conn->close();
?>

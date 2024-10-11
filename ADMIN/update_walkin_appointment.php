<?php
header('Content-Type: application/json');
require 'db_connection.php'; // Include your database connection file

$response = ['status' => 'error', 'message' => 'Failed to update appointment.'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve data from the request
    $customer_id = $_POST['customer_id'];
    $firstname = $_POST['firstname'];
    $phoneNumber = $_POST['phoneNumber'];
    $emailAddress = $_POST['emailAddress'];
    $repairdetails = $_POST['repairdetails'];
    $appointment_time = $_POST['appointment_time'];
    $appointment_date = $_POST['appointment_date'];
    $carmodel = $_POST['carmodel'];
    $service_type = $_POST['service_type']; // Get service type
    $total_payable = $_POST['total_payable'];
    $payment_type = $_POST['payment_type'];
    $payment_status = $_POST['payment_status'];

    try {
        // Prepare the SQL update statement
        $query = "UPDATE walkin_appointments SET 
                    firstname = ?, 
                    phoneNumber = ?, 
                    emailAddress = ?, 
                    repairdetails = ?, 
                    appointment_time = ?, 
                    appointment_date = ?, 
                    carmodel = ?, 
                    service_type = ?, 
                    total_payable = ?, 
                    payment_type = ?, 
                    payment_status = ? 
                  WHERE customer_id = ?";
                  
        $stmt = $conn->prepare($query);
        $stmt->bind_param('sssssssssssi', $firstname, $phoneNumber, $emailAddress, $repairdetails, $appointment_time, $appointment_date, $carmodel, $service_type, $total_payable, $payment_type, $payment_status, $customer_id);

        // Execute the statement
        if ($stmt->execute()) {
            $response['status'] = 'success';
            $response['message'] = 'Appointment updated successfully.';
        } else {
            $response['message'] = 'Failed to update appointment.';
        }
    } catch (Exception $e) {
        $response['message'] = 'Error: ' . $e->getMessage();
    }
}

// Return JSON response
echo json_encode($response);
$conn->close();

<?php
include('dbconfig.php'); // Ensure this file contains your database connection settings

// Check if required data is set in the POST request
if (isset($_POST['customer_id'], $_POST['firstname'], $_POST['lastname'], $_POST['phoneNumber'], $_POST['emailAddress'], $_POST['carmake'], $_POST['carmodel'], $_POST['repairdetails'], $_POST['appointment_date'], $_POST['appointment_time'], $_POST['service_type'], $_POST['total_payment'], $_POST['payment_type'])) {

    // Sanitize and validate input data
    $customer_id = intval($_POST['customer_id']);
    $firstname = $conn->real_escape_string($_POST['firstname']);
    $lastname = $conn->real_escape_string($_POST['lastname']);
    $phoneNumber = $conn->real_escape_string($_POST['phoneNumber']);
    $emailAddress = $conn->real_escape_string($_POST['emailAddress']);
    $carmake = $conn->real_escape_string($_POST['carmake']);
    $carmodel = $conn->real_escape_string($_POST['carmodel']);
    $repairdetails = $conn->real_escape_string($_POST['repairdetails']);
    $appointment_date = $conn->real_escape_string($_POST['appointment_date']);
    $appointment_time = $conn->real_escape_string($_POST['appointment_time']);
    $service_type = $conn->real_escape_string($_POST['service_type']);
    $total_payment = $conn->real_escape_string($_POST['total_payment']);
    $payment_type = $conn->real_escape_string($_POST['payment_type']);

    // Prepare the SQL update statement
    $query = "UPDATE customer_details SET firstname=?, lastname=?, phoneNumber=?, emailAddress=?, carmake=?, carmodel=?, repairdetails=?, appointment_date=?, appointment_time=?, service_type=?, total_payment=?, payment_type=? WHERE customer_id=?";

    if ($stmt = $conn->prepare($query)) {
        // Bind parameters
        $stmt->bind_param("ssssssssssssi", $firstname, $lastname, $phoneNumber, $emailAddress, $carmake, $carmodel, $repairdetails, $appointment_date, $appointment_time, $service_type, $total_payment, $payment_type, $customer_id);

        // Execute the statement
        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Customer updated successfully!']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to update the customer.']);
        }

        // Close the statement
        $stmt->close();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to prepare SQL statement: ' . $conn->error]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}

// Close the connection
$conn->close();
?>

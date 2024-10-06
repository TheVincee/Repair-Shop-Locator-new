<?php
// insert.php

include('dbconfig.php');

// Enable error reporting for debugging (ensure this is turned off in production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve and sanitize form inputs
    $firstname = mysqli_real_escape_string($conn, trim($_POST['firstName']));
    $lastname = mysqli_real_escape_string($conn, trim($_POST['lastName']));    
    $address = mysqli_real_escape_string($conn, trim($_POST['address']));
    $phoneNumber = mysqli_real_escape_string($conn, trim($_POST['phoneNumber']));
    $emailAddress = mysqli_real_escape_string($conn, trim($_POST['emailAddress']));
    $carmake = mysqli_real_escape_string($conn, trim($_POST['carMake']));
    $carmodel = mysqli_real_escape_string($conn, trim($_POST['carModel']));
    $repairdetails = mysqli_real_escape_string($conn, trim($_POST['repairDetails']));
    $appointmentDate = mysqli_real_escape_string($conn, trim($_POST['appointmentDate']));
    $appointmentTime = mysqli_real_escape_string($conn, trim($_POST['appointmentTime']));
    $service_type = mysqli_real_escape_string($conn, trim($_POST['serviceType']));
    $total_payment = mysqli_real_escape_string($conn, trim($_POST['totalPayment']));
    $payment_type = mysqli_real_escape_string($conn, trim($_POST['paymentType']));
    $Status = 'Pending';
    $payment_status = 'Not Paid'; // Ensure this variable is set correctly

    // Check if all required fields are filled before proceeding
    if (empty($firstname) || empty($lastname) || empty($phoneNumber) || empty($emailAddress) ||
        empty($carmake) || empty($carmodel) || empty($repairdetails) || empty($appointmentDate) || 
        empty($appointmentTime) || empty($service_type) || empty($total_payment) || empty($payment_type) || empty($address)) {
        echo json_encode(['status' => 'error', 'message' => 'All fields are required.']);
        exit();
    }

    // Prepare an SQL statement to insert appointment
    $query = "INSERT INTO customer_details (firstname, lastname, phoneNumber, emailAddress, carmake, carmodel, repairdetails, appointment_date, appointment_time, Status, service_type, total_payment, payment_type, address, payment_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = mysqli_prepare($conn, $query)) {
        // Bind parameters to the prepared statement
        mysqli_stmt_bind_param($stmt, 'sssssssssssssss', $firstname, $lastname, $phoneNumber, $emailAddress, $carmake, $carmodel, $repairdetails, $appointmentDate, $appointmentTime, $Status, $service_type, $total_payment, $payment_type, $address, $payment_status); // Fixing the binding here

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            $customer_id = mysqli_insert_id($conn);
            if ($customer_id > 0) {
                $notifyQuery = "INSERT INTO appointment_notify (customer_id, firstname) VALUES (?, ?)";
                if ($notifyStmt = mysqli_prepare($conn, $notifyQuery)) {
                    mysqli_stmt_bind_param($notifyStmt, 'is', $customer_id, $firstname);
                    if (mysqli_stmt_execute($notifyStmt)) {
                        mysqli_stmt_close($notifyStmt);
                        $message = "New appointment from customer #{$customer_id}: {$firstname}";
                        echo json_encode(['status' => 'success', 'message' => $message]);
                    } else {
                        echo json_encode(['status' => 'error', 'message' => 'Error adding notification: ' . mysqli_error($conn)]);
                    }
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Failed to prepare notification statement: ' . mysqli_error($conn)]);
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to retrieve customer ID.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error inserting customer: ' . mysqli_error($conn)]);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to prepare statement: ' . mysqli_error($conn)]);
    }

    mysqli_close($conn);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
?>

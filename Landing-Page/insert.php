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
    $phoneNumber = mysqli_real_escape_string($conn, trim($_POST['phoneNumber']));
    $emailAddress = mysqli_real_escape_string($conn, trim($_POST['emailAddress']));
    $carmake = mysqli_real_escape_string($conn, trim($_POST['carMake']));
    $carmodel = mysqli_real_escape_string($conn, trim($_POST['carModel']));
    $repairdetails = mysqli_real_escape_string($conn, trim($_POST['repairDetails']));
    $appointmentDate = mysqli_real_escape_string($conn, trim($_POST['appointmentDate']));
    $appointmentTime = mysqli_real_escape_string($conn, trim($_POST['appointmentTime']));
    $service_type = mysqli_real_escape_string($conn, trim($_POST['serviceType'])); // New field
    $total_payment = mysqli_real_escape_string($conn, trim($_POST['totalPayment'])); // New field
    $payment_type = mysqli_real_escape_string($conn, trim($_POST['paymentType'])); // New field
    $Status = 'Pending'; // Default status is "Pending"

    // Check if all required fields are filled before proceeding
    if (empty($firstname) || empty($lastname) || empty($phoneNumber) || empty($emailAddress) ||
        empty($carmake) || empty($carmodel) || empty($repairdetails) || empty($appointmentDate) || 
        empty($appointmentTime) || empty($service_type) || empty($total_payment) || empty($payment_type)) {
        echo json_encode(['status' => 'error', 'message' => 'All fields are required.']);
        exit();
    }

    // Prepare an SQL statement to insert appointment
    $query = "INSERT INTO customer_details (firstname, lastname, phoneNumber, emailAddress, carmake, carmodel, repairdetails, appointment_date, appointment_time, Status, service_type, total_payment, payment_type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = mysqli_prepare($conn, $query)) {
        // Bind parameters to the prepared statement
        mysqli_stmt_bind_param($stmt, 'sssssssssssss', $firstname, $lastname, $phoneNumber, $emailAddress, $carmake, $carmodel, $repairdetails, $appointmentDate, $appointmentTime, $Status, $service_type, $total_payment, $payment_type);

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            // Get the last inserted customer_id
            $customer_id = mysqli_insert_id($conn);

            // Check if $customer_id was retrieved correctly
            if ($customer_id > 0) {
                // Insert notification for the admin
                $notifyQuery = "INSERT INTO appointment_notify (customer_id, firstname) VALUES (?, ?)";
                if ($notifyStmt = mysqli_prepare($conn, $notifyQuery)) {
                    mysqli_stmt_bind_param($notifyStmt, 'is', $customer_id, $firstname);
                    if (mysqli_stmt_execute($notifyStmt)) {
                        mysqli_stmt_close($notifyStmt);

                        // Send the success response with a custom message
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
            // If appointment insertion fails
            echo json_encode(['status' => 'error', 'message' => 'Error inserting customer: ' . mysqli_error($conn)]);
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to prepare statement: ' . mysqli_error($conn)]);
    }

    // Close the database connection
    mysqli_close($conn);
}
?>

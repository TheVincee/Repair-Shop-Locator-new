<?php
// insert.php

include('dbconfig.php');

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve and sanitize form inputs
    $firstname = mysqli_real_escape_string($conn, $_POST['firstName']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastName']);
    $phoneNumber = mysqli_real_escape_string($conn, $_POST['phoneNumber']);
    $emailAddress = mysqli_real_escape_string($conn, $_POST['emailAddress']);
    $carmake = mysqli_real_escape_string($conn, $_POST['carMake']);
    $carmodel = mysqli_real_escape_string($conn, $_POST['carModel']);
    $repairdetails = mysqli_real_escape_string($conn, $_POST['repairDetails']);
    $appointmentDate = mysqli_real_escape_string($conn, $_POST['appointmentDate']);
    $appointmentTime = mysqli_real_escape_string($conn, $_POST['appointmentTime']);
    $Status = 'Pending'; // Default status is "Pending"

    // Check if all fields are filled before proceeding
    if (empty($firstname) || empty($lastname) || empty($phoneNumber) || empty($emailAddress) ||
        empty($carmake) || empty($carmodel) || empty($repairdetails) || empty($appointmentDate) || empty($appointmentTime)) {
        echo json_encode(['status' => 'error', 'message' => 'All fields are required.']);
        exit();
    }

    // Prepare an SQL statement to insert appointment
    $query = "INSERT INTO customer_details (firstname, lastname, phoneNumber, emailAddress, carmake, carmodel, repairdetails, appointment_date, appointment_time, Status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = mysqli_prepare($conn, $query)) {
        // Bind parameters to the prepared statement
        mysqli_stmt_bind_param($stmt, 'ssssssssss', $firstname, $lastname, $phoneNumber, $emailAddress, $carmake, $carmodel, $repairdetails, $appointmentDate, $appointmentTime, $Status);

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
                    echo json_encode(['status' => 'error', 'message' => 'Failed to prepare notification statement.']);
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

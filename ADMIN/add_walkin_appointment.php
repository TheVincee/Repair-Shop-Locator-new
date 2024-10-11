<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'db_connection.php'; // Include your database connection file

header('Content-Type: application/json'); // Set the content type to JSON

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect and sanitize input data
    $firstname = $conn->real_escape_string($_POST['firstname']);
    $phoneNumber = $conn->real_escape_string($_POST['phoneNumber']);
    $emailAddress = $conn->real_escape_string($_POST['emailAddress']);
    $repairdetails = $conn->real_escape_string($_POST['repairdetails']);
    $appointment_time = $conn->real_escape_string($_POST['appointment_time']);
    $appointment_date = $conn->real_escape_string($_POST['appointment_date']);
    $carmodel = $conn->real_escape_string($_POST['carmodel']);
    $service_type = $conn->real_escape_string($_POST['service_type']);
    $total_payable = $conn->real_escape_string($_POST['total_payable']);
    $payment_type = $conn->real_escape_string($_POST['payment_type']);
    $payment_status = $conn->real_escape_string($_POST['payment_status']);
    
    // Prepare the SQL query to insert the data
    $query = "INSERT INTO walkin_appointments (firstname, phoneNumber, emailAddress, repairdetails, appointment_time, appointment_date, carmodel, service_type, total_payable, payment_type, payment_status) 
              VALUES ('$firstname', '$phoneNumber', '$emailAddress', '$repairdetails', '$appointment_time', '$appointment_date', '$carmodel', '$service_type', '$total_payable', '$payment_type', '$payment_status')";

    // Execute the query
    if ($conn->query($query) === TRUE) {
        echo json_encode(['status' => 'success', 'message' => 'Appointment added successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error: ' . $conn->error]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}

// Close the database connection
$conn->close();
?>

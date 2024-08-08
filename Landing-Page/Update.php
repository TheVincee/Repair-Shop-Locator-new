<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('dbconfig.php'); // Make sure this file contains your database connection settings

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve and sanitize input
    $customer_id = mysqli_real_escape_string($connection, $_POST['customer_id']);
    $firstname = mysqli_real_escape_string($connection, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($connection, $_POST['lastname']);
    $phoneNumber = mysqli_real_escape_string($connection, $_POST['phoneNumber']);
    $emailAddress = mysqli_real_escape_string($connection, $_POST['emailAddress']);
    $carmake = mysqli_real_escape_string($connection, $_POST['carmake']);
    $carmodel = mysqli_real_escape_string($connection, $_POST['carmodel']);
    $repairdetails = mysqli_real_escape_string($connection, $_POST['repairdetails']);
    $appointment_date = mysqli_real_escape_string($connection, $_POST['appointment_date']);
    $appointment_time = mysqli_real_escape_string($connection, $_POST['appointment_time']);

    // Update query
    $query = "UPDATE customer_details 
              SET firstname='$firstname', lastname='$lastname', phoneNumber='$phoneNumber', emailAddress='$emailAddress', 
                  carmake='$carmake', carmodel='$carmodel', repairdetails='$repairdetails', appointment_date='$appointment_date', 
                  appointment_time='$appointment_time' 
              WHERE customer_id='$customer_id'";
    
    // Execute query
    if (mysqli_query($connection, $query)) {
        echo "Customer updated successfully";
    } else {
        echo "Error updating record: " . mysqli_error($connection);
    }
} else {
    echo "Invalid request method";
}
?>

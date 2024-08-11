<?php
// insert.php

include('dbconfig.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstname = mysqli_real_escape_string($conn, $_POST['firstName']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastName']);
    $phoneNumber = mysqli_real_escape_string($conn, $_POST['phoneNumber']);
    $emailAddress = mysqli_real_escape_string($conn, $_POST['emailAddress']);
    $carmake = mysqli_real_escape_string($conn, $_POST['carMake']);
    $carmodel = mysqli_real_escape_string($conn, $_POST['carModel']);
    $repairdetails = mysqli_real_escape_string($conn, $_POST['repairDetails']);
    $appointmentDate = mysqli_real_escape_string($conn, $_POST['appointmentDate']);
    $appointmentTime = mysqli_real_escape_string($conn, $_POST['appointmentTime']);
    $Status = mysqli_real_escape_string($conn, $_POST['Status']);

    // Debug output
    var_dump($_POST);
    
    $query = "INSERT INTO customer_details (firstname, lastname, phoneNumber, emailAddress, carmake, carmodel, repairdetails, appointment_date, appointment_time, Status) VALUES ('$firstname', '$lastname', '$phoneNumber', '$emailAddress', '$carmake', '$carmodel', '$repairdetails', '$appointmentDate', '$appointmentTime', '$Status')";

    // Log SQL query
    echo $query;
    
    if (mysqli_query($conn, $query)) {
        echo 'Success';
    } else {
        echo 'Error: ' . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>

<?php
header('Content-Type: application/json');

// Database connection parameters
$servername = "localhost"; // Update with your server details
$username = "root";        // Update with your database username
$password = "";            // Update with your database password
$dbname = "repair-shop-locator"; // Update with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    echo json_encode(['status' => 'error', 'message' => 'Connection failed: ' . $conn->connect_error]);
    exit;
}

// Get POST data
$customer_id = isset($_POST['customer_id']) ? $conn->real_escape_string($_POST['customer_id']) : '';
$firstname = isset($_POST['firstname']) ? $conn->real_escape_string($_POST['firstname']) : '';
$phoneNumber = isset($_POST['phoneNumber']) ? $conn->real_escape_string($_POST['phoneNumber']) : '';
$emailAddress = isset($_POST['emailAddress']) ? $conn->real_escape_string($_POST['emailAddress']) : '';
$repairdetails = isset($_POST['repairdetails']) ? $conn->real_escape_string($_POST['repairdetails']) : '';
$appointment_time = isset($_POST['appointment_time']) ? $conn->real_escape_string($_POST['appointment_time']) : '';
$appointment_date = isset($_POST['appointment_date']) ? $conn->real_escape_string($_POST['appointment_date']) : '';
$status = isset($_POST['status']) ? $conn->real_escape_string($_POST['status']) : '';

// Validate input
if (empty($customer_id) || empty($firstname) || empty($phoneNumber) || empty($emailAddress) || empty($repairdetails) || empty($appointment_time) || empty($appointment_date)) {
    echo json_encode(['status' => 'error', 'message' => 'All fields are required.']);
    exit;
}

// Update query
$sql = "UPDATE walkin_appointments 
        SET firstname='$firstname', phoneNumber='$phoneNumber', emailAddress='$emailAddress', repairdetails='$repairdetails', appointment_time='$appointment_time', appointment_date='$appointment_date', Status='$status'
        WHERE customer_id='$customer_id'";

if ($conn->query($sql) === TRUE) {
    echo json_encode(['status' => 'success', 'message' => 'Appointment updated successfully.']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Error updating appointment: ' . $conn->error]);
}

$conn->close();
?>

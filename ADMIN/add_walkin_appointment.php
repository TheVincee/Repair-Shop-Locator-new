<?php
// Include database connection
require_once 'db_connection.php';

// Initialize response array
$response = array();

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize form data
    $firstname = isset($_POST['firstname']) ? mysqli_real_escape_string($conn, $_POST['firstname']) : null;
    $phoneNumber = isset($_POST['phoneNumber']) ? mysqli_real_escape_string($conn, $_POST['phoneNumber']) : null;
    $emailAddress = isset($_POST['emailAddress']) ? mysqli_real_escape_string($conn, $_POST['emailAddress']) : null;
    $repairdetails = isset($_POST['repairdetails']) ? mysqli_real_escape_string($conn, $_POST['repairdetails']) : null;
    $appointment_time = isset($_POST['appointment_time']) ? mysqli_real_escape_string($conn, $_POST['appointment_time']) : null;
    $appointment_date = isset($_POST['appointment_date']) ? mysqli_real_escape_string($conn, $_POST['appointment_date']) : null;

    // Check if all required fields are provided
    if ($firstname && $phoneNumber && $emailAddress && $repairdetails && $appointment_time && $appointment_date) {
        // Prepare and execute the insert query
        $query = "INSERT INTO walkin_appointments (firstname, phoneNumber, emailAddress, repairdetails, appointment_time, appointment_date, Status, created_at) 
                  VALUES ('$firstname', '$phoneNumber', '$emailAddress', '$repairdetails', '$appointment_time', '$appointment_date', 'Pending', NOW())";
        
        if (mysqli_query($conn, $query)) {
            $response['status'] = 'success';
            $response['message'] = 'Appointment added successfully.';
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Database query error: ' . mysqli_error($conn);
        }
    } else {
        $response['status'] = 'error';
        $response['message'] = 'All fields are required.';
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'Invalid request method.';
}

// Close the database connection
mysqli_close($conn);

// Set the content type to JSON and output the response
header('Content-Type: application/json');
echo json_encode($response);
?>

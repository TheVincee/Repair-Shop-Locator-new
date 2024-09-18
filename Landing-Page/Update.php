<?php
include('dbconfig.php'); // Include your database configuration file

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Set content type to JSON
header('Content-Type: application/json');

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Log incoming POST data for debugging
    $received_post_data = json_encode($_POST);
    error_log("Received POST data: " . $received_post_data);

    // Check if all required POST data is present
    if (isset($_POST['customer_id'], $_POST['firstname'], $_POST['lastname'], $_POST['phoneNumber'], $_POST['emailAddress'], $_POST['carmake'], $_POST['carmodel'], $_POST['repairdetails'], $_POST['appointment_date'], $_POST['appointment_time'])) {
        
        // Extract and escape POST data
        $customer_id = mysqli_real_escape_string($conn, $_POST['customer_id']);
        $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
        $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
        $phoneNumber = mysqli_real_escape_string($conn, $_POST['phoneNumber']);
        $emailAddress = mysqli_real_escape_string($conn, $_POST['emailAddress']);
        $carmake = mysqli_real_escape_string($conn, $_POST['carmake']);
        $carmodel = mysqli_real_escape_string($conn, $_POST['carmodel']);
        $repairdetails = mysqli_real_escape_string($conn, $_POST['repairdetails']);
        $appointment_date = mysqli_real_escape_string($conn, $_POST['appointment_date']);
        $appointment_time = mysqli_real_escape_string($conn, $_POST['appointment_time']);

        // Prepare the SQL query
        $query = "UPDATE customer_details SET
            firstname = '$firstname',
            lastname = '$lastname',
            phoneNumber = '$phoneNumber',
            emailAddress = '$emailAddress',
            carmake = '$carmake',
            carmodel = '$carmodel',
            repairdetails = '$repairdetails',
            appointment_date = '$appointment_date',
            appointment_time = '$appointment_time'
            WHERE customer_id = '$customer_id'";

        // Execute the query
        if (mysqli_query($conn, $query)) {
            echo json_encode(['status' => 'success', 'message' => 'Customer updated successfully!']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to update the customer. Error: ' . mysqli_error($conn)]);
        }

        // Close the connection
        mysqli_close($conn);
    } else {
        // Output missing fields for debugging
        $missing_fields = [];
        $required_fields = ['updateCustomerId', 'updateFirstName', 'updateLastName', 'updatePhoneNumber', 'updateEmailAddress', 'updateCarMake', 'updateCarModel', 'updateRepairDetails', 'updateAppointmentDate', 'updateAppointmentTime'];

        foreach ($required_fields as $field) {
            if (!isset($_POST[$field])) {
                $missing_fields[] = $field;
            }
        }

        echo json_encode([
            'status' => 'error',
            'message' => 'Missing required fields: ' . implode(', ', $missing_fields),
            'received_data' => $_POST // For debugging purposes
        ]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
?>

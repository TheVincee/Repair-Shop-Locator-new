<?php
header('Content-Type: application/json');
require 'db_connection.php'; // Include the database connection

$response = ['status' => 'error', 'data' => [], 'message' => ''];

try {
    // Prepare the query to fetch walk-in appointments
    $query = "SELECT customer_id, firstname, phoneNumber, emailAddress, repairdetails, 
                     appointment_time, appointment_date, Status, carmodel, 
                     service_type, total_payable, payment_type, payment_status 
              FROM walkin_appointments"; // Adjust the table name as necessary

    // Execute the query
    if ($result = $conn->query($query)) {
        if ($result->num_rows > 0) {
            $appointments = $result->fetch_all(MYSQLI_ASSOC);
            $response['status'] = 'success';
            $response['data'] = $appointments; // Store fetched appointments in the response
        } else {
            $response['status'] = 'success';
            $response['data'] = []; // Return empty array if no results
            $response['message'] = 'No appointments found.';
        }
    } else {
        throw new Exception("Query failed: " . $conn->error);
    }
} catch (Exception $e) {
    $response['message'] = 'Error: ' . $e->getMessage();
}

// Return the JSON response
echo json_encode($response);
$conn->close();
?>

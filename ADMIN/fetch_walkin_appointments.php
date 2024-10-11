<?php
header('Content-Type: application/json');
require 'db_connection.php'; // Include the database connection

$response = ['status' => 'error', 'data' => []];

try {
    // Fetch walk-in appointments with customer_id
    $query = "SELECT customer_id, firstname, phoneNumber, emailAddress, repairdetails, appointment_time, appointment_date, Status, carmodel, service_type, total_payable, payment_type, payment_status FROM walkin_appointments"; // Adjust the table name as necessary
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        $appointments = $result->fetch_all(MYSQLI_ASSOC);
        $response['status'] = 'success';
        $response['data'] = $appointments; // Store fetched appointments in the response
    } else {
        $response['status'] = 'success';
        $response['data'] = []; // Return empty array if no results
    }
} catch (Exception $e) {
    $response['message'] = 'Error: ' . $e->getMessage();
}

echo json_encode($response); // Return the JSON response
$conn->close();
?>

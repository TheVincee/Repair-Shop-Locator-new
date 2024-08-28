<?php
// fetch_appointment_details.php

// Include the database connection file
include('db_connection.php');

// Check if the 'customer_id' is provided
if (isset($_GET['customer_id'])) {
    $customer_id = intval($_GET['customer_id']); // Sanitize the input to avoid SQL injection

    // SQL query to fetch the appointment details for the given customer_id
    $query = "SELECT customer_id, firstname, phoneNumber, emailAddress, repairdetails, appointment_time, appointment_date, Status 
              FROM walkin_appointments 
              WHERE customer_id = ? LIMIT 1";

    // Prepare and execute the SQL statement
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param('i', $customer_id);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if the appointment exists
        if ($result->num_rows > 0) {
            // Fetch the appointment details
            $appointment = $result->fetch_assoc();

            // Return the details as a JSON response
            echo json_encode($appointment);
        } else {
            // If no appointment is found, return an error response
            echo json_encode(['status' => 'error', 'message' => 'Appointment not found']);
        }

        // Close the statement
        $stmt->close();
    } else {
        // If there was an error preparing the statement
        echo json_encode(['status' => 'error', 'message' => 'Database query failed']);
    }

} else {
    // If 'customer_id' is not provided
    echo json_encode(['status' => 'error', 'message' => 'No customer ID provided']);
}

// Close the database connection
$conn->close();
?>

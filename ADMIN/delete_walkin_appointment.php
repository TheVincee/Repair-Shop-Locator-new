<?php
// Include database connection
include 'db_connection.php';

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the customer_id from the POST data
    $customer_id = isset($_POST['customer_id']) ? intval($_POST['customer_id']) : 0;

    // Prepare the SQL query to delete the appointment
    $sql = "DELETE FROM walkin_appointments WHERE customer_id = ?";

    if ($stmt = $conn->prepare($sql)) {
        // Bind the customer_id parameter to the SQL query
        $stmt->bind_param("i", $customer_id);

        // Execute the query
        if ($stmt->execute()) {
            // Check if a row was affected
            if ($stmt->affected_rows > 0) {
                // Success response
                $response = array('status' => 'success', 'message' => 'Appointment deleted successfully.');
            } else {
                // No rows affected (appointment might not exist)
                $response = array('status' => 'error', 'message' => 'No appointment found with the provided ID.');
            }
        } else {
            // Query execution error
            $response = array('status' => 'error', 'message' => 'Failed to execute the query.');
        }

        // Close the statement
        $stmt->close();
    } else {
        // SQL preparation error
        $response = array('status' => 'error', 'message' => 'Failed to prepare the SQL statement.');
    }

    // Close the database connection
    $conn->close();

    // Return the JSON response
    echo json_encode($response);
} else {
    // Invalid request method
    echo json_encode(array('status' => 'error', 'message' => 'Invalid request method.'));
}
?>

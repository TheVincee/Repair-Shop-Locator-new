<?php
include('dbconfig.php'); // Include your database configuration

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Set content type to JSON
header('Content-Type: application/json');

if (isset($_POST['customer_id'])) {
    $customer_id = $_POST['customer_id'];

    // Prepare the SQL statement to fetch customer details
    $query = "SELECT * FROM customer_details WHERE customer_id = ?";

    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("i", $customer_id); // Assuming customer_id is an integer
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $customer = $result->fetch_assoc();
            $response = [
                'customer_id' => $customer['customer_id'],
                'firstname' => $customer['firstname'],
                'lastname' => $customer['lastname'],
                'phoneNumber' => $customer['phoneNumber'],
                'emailAddress' => $customer['emailAddress'],
                'address' => $customer['Address'], // Ensure the field name matches the database
                'carmake' => $customer['carmake'],
                'carmodel' => $customer['carmodel'],
                'repairdetails' => $customer['repairdetails'],
                'appointment_date' => $customer['appointment_date'],
                'appointment_time' => $customer['appointment_time'],
                'status' => $customer['Status'],
                'service_type' => $customer['service_type'],
                'total_payment' => $customer['total_payment'],
                'payment_type' => $customer['payment_type'],
                'payment_status' => $customer['payment_status'] // Ensure this field is included
            ];
            echo json_encode($response);
        } else {
            echo json_encode(['error' => 'No customer found.']);
        }

        // Close the prepared statement
        $stmt->close();
    } else {
        // Handle preparation error
        echo json_encode(['error' => 'Failed to prepare SQL statement: ' . $conn->error]);
    }
} else {
    echo json_encode(['error' => 'Invalid request.']);
}

// Close the database connection
$conn->close();
?>

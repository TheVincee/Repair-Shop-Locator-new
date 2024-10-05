<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'repair-shop-locator');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the request is a GET request (for viewing appointment details)
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['customer_id'])) {
    $customer_id = $_GET['customer_id'];

    // Fetch appointment details for the given customer ID
    $sql = "SELECT * FROM customer_details WHERE customer_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $customer_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        // Send the appointment details as JSON response
        echo json_encode([
            'customer_id' => $row['customer_id'],
            'firstname' => $row['firstname'],
            'lastname' => $row['lastname'],
            'address' => $row['Address'],
            'phoneNumber' => $row['phoneNumber'],
            'emailAddress' => $row['emailAddress'],
            'carmake' => $row['carmake'],
            'carmodel' => $row['carmodel'],
            'repairdetails' => $row['repairdetails'],
            'appointment_time' => $row['appointment_time'],
            'appointment_date' => $row['appointment_date'],
            'Status' => $row['Status'],
            'service_type' => $row['service_type'],
            'total_payment' => $row['total_payment'],
            'payment_type' => $row['payment_type'],
            'status_payment' => $row['Status_payment'], // Add this line to include Status_payment
        ]);
    } else {
        echo json_encode(['error' => 'No details found.']);
    }

    $stmt->close();
}

// Check if the request is a POST request (for updating payment type and status payment)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $customer_id = $_POST['customer_id'];
    $payment_type = $_POST['payment_type'];
    $status_payment = $_POST['status_payment']; // Get the status payment from the POST request

    // Update the payment type and status payment for the specified customer
    $sql = "UPDATE customer_details SET payment_type = ?, Status_payment = ? WHERE customer_id = ?"; // Add Status_payment to the query
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $payment_type, $status_payment, $customer_id); // Bind the status_payment

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Payment type and status updated successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error updating payment type and status.']);
    }

    $stmt->close();
}

$conn->close();
?>

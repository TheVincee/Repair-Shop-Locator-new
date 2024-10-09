<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'repair-shop-locator');

// Check for connection errors
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => "Connection failed: " . $conn->connect_error]));
}

// Check if the request is a GET request (for viewing appointment details)
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['customer_id'])) {
    $customer_id = intval($_GET['customer_id']); // Sanitize the customer_id

    // Fetch appointment details for the given customer ID
    $sql = "SELECT * FROM customer_details WHERE customer_id = ?";
    $stmt = $conn->prepare($sql);
    
    if ($stmt === false) {
        echo json_encode(['success' => false, 'message' => 'SQL preparation error: ' . $conn->error]);
        exit;
    }
    
    $stmt->bind_param("i", $customer_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        // Send the appointment details as JSON response
        echo json_encode([
            'success' => true,
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
            'payment_status' => isset($row['payment_status']) ? $row['payment_status'] : null, // Handle undefined key gracefully
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No details found for this customer.']);
    }

    $stmt->close();
}

// Check if the request is a POST request (for updating payment type and payment_status)
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['customer_id']) && isset($_POST['payment_type']) && isset($_POST['payment_status'])) {
    $customer_id = intval($_POST['customer_id']); // Sanitize the customer_id
    $payment_type = trim($_POST['payment_type']); // Sanitize the payment_type
    $payment_status = trim($_POST['payment_status']); // Sanitize the payment_status

    // Update the payment type and payment_status for the specified customer
    $sql = "UPDATE customer_details SET payment_type = ?, payment_status = ? WHERE customer_id = ?";
    $stmt = $conn->prepare($sql);
    
    if ($stmt === false) {
        echo json_encode(['success' => false, 'message' => 'SQL preparation error: ' . $conn->error]);
        exit;
    }
    
    $stmt->bind_param("ssi", $payment_type, $payment_status, $customer_id); // Bind the parameters

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Payment type and status updated successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error updating payment type and status: ' . $stmt->error]);
    }

    $stmt->close();
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo json_encode(['success' => false, 'message' => 'Required parameters missing.']);
}

$conn->close();
?>

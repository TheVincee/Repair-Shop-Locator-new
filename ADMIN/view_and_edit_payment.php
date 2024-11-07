<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'repair-shop-locator');

// Check connection
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'error' => "Connection failed: " . $conn->connect_error]);
    exit;
}

// Handle GET request to fetch customer details
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['customer_id'])) {
    $customer_id = intval($_GET['customer_id']);

    $sql = "SELECT customer_id, firstname, lastname, address, phoneNumber, emailAddress, carmake, carmodel, repairdetails, appointment_time, appointment_date, Status, service_type, total_payment, payment_type, payment_status FROM customer_details WHERE customer_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $customer_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        // Log the fetched row to check if 'address' is included
        error_log("Fetched customer data: " . print_r($row, true)); // Debugging: log data to server's error log
        echo json_encode(['success' => true, 'data' => $row]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Customer not found.']);
    }
    $stmt->close();
    exit;
}

// Handle POST request for updating payment status
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['customer_id'])) {
    $customer_id = intval($_POST['customer_id']);
    $payment_status = isset($_POST['payment_status']) ? $_POST['payment_status'] : null;

    if ($payment_status === 'Paid') {
        $sql = "UPDATE customer_details SET payment_status = ? WHERE customer_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $payment_status, $customer_id);
    } else {
        $sql = "UPDATE customer_details SET payment_status = NULL WHERE customer_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $customer_id);
    }

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => $payment_status === 'Paid' ? 'Payment status updated to Paid.' : 'Payment status cleared successfully.']);
    } else {
        echo json_encode(['success' => false, 'error' => 'Failed to update payment status: ' . $stmt->error]);
    }
    $stmt->close();
    exit;
}

echo json_encode(['success' => false, 'error' => 'Invalid request.']);
$conn->close();
?>

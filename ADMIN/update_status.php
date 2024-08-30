<?php
// update_status.php

header('Content-Type: application/json'); // Set content type to JSON

// Database connection
$mysqli = new mysqli('localhost', 'root', '', 'repair-shop-locator');

// Check connection
if ($mysqli->connect_error) {
    echo json_encode(['error' => 'Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error]);
    exit;
}

// Fetch POST data
$customer_id = isset($_POST['customer_id']) ? intval($_POST['customer_id']) : 0;
$status = isset($_POST['status']) ? $mysqli->real_escape_string($_POST['status']) : '';

// Validate input
if ($customer_id <= 0 || empty($status)) {
    echo json_encode(['error' => 'Invalid data']);
    $mysqli->close();
    exit;
}

// Initialize response
$response = ['success' => false, 'message' => ''];

// Insert into approvedappointments table if status is 'Approve'
if ($status === 'Approve') {
    // Check if the entry already exists
    $check_stmt = $mysqli->prepare("SELECT COUNT(*) FROM customer_details WHERE customer_id = ?");
    if (!$check_stmt) {
        $response['message'] = 'Prepare statement failed: ' . $mysqli->error;
        echo json_encode($response);
        $mysqli->close();
        exit;
    }
    
    $check_stmt->bind_param('i', $customer_id);
    $check_stmt->execute();
    $check_stmt->bind_result($count);
    $check_stmt->fetch();
    $check_stmt->close();

    if ($count == 0) {
        // Insert into approvedappointments
        $stmt = $mysqli->prepare("INSERT INTO approvedappointments (customer_id, status) VALUES (?, ?)");
        if (!$stmt) {
            $response['message'] = 'Prepare statement failed: ' . $mysqli->error;
            echo json_encode($response);
            $mysqli->close();
            exit;
        }
        
        $stmt->bind_param('is', $customer_id, $status);
        if (!$stmt->execute()) {
            $response['message'] = 'Execute failed: ' . $stmt->error;
            $stmt->close();
            echo json_encode($response);
            $mysqli->close();
            exit;
        }
        $stmt->close();
    }
}

// Update the status in walkin_appointments
$stmt = $mysqli->prepare("UPDATE customer_details SET Status = ? WHERE customer_id = ?");
if (!$stmt) {
    $response['message'] = 'Prepare statement failed: ' . $mysqli->error;
    echo json_encode($response);
    $mysqli->close();
    exit;
}

$stmt->bind_param('si', $status, $customer_id);
if (!$stmt->execute()) {
    $response['message'] = 'Execute failed: ' . $stmt->error;
    $stmt->close();
    echo json_encode($response);
    $mysqli->close();
    exit;
}
$stmt->close();

$response['success'] = true;
echo json_encode($response);

$mysqli->close();
?>

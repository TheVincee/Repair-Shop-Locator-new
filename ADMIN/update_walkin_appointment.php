<?php
require 'db_connection.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customer_id = $_POST['customer_id'];
    $firstname = $_POST['firstname'];
    $phoneNumber = $_POST['phoneNumber'];
    $emailAddress = $_POST['emailAddress'];
    $repairdetails = $_POST['repairdetails'];
    $appointment_time = $_POST['appointment_time'];
    $appointment_date = $_POST['appointment_date'];

    // Check for missing parameters
    if (empty($customer_id) || empty($firstname) || empty($phoneNumber) || empty($emailAddress) || empty($repairdetails) || empty($appointment_time) || empty($appointment_date)) {
        echo json_encode(['status' => 'error', 'message' => 'Missing parameters']);
        exit;
    }

    // Prepare and execute the update query
    $stmt = $conn->prepare("UPDATE walkin_appointments SET firstname = ?, phoneNumber = ?, emailAddress = ?, repairdetails = ?, appointment_time = ?, appointment_date = ? WHERE customer_id = ?");
    $stmt->bind_param("ssssssi", $firstname, $phoneNumber, $emailAddress, $repairdetails, $appointment_time, $appointment_date, $customer_id);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => $stmt->error]); // Return detailed error message
    }

    $stmt->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}

$conn->close();
?>

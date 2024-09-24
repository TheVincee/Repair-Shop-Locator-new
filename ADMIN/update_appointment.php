<?php
// update_appointment.php
include 'db_connection.php'; // Include your database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get data from the POST request
    $customerId = $_POST['customer_id'];
    $firstname = $_POST['firstname'];
    $phoneNumber = $_POST['phoneNumber'];
    $emailAddress = $_POST['emailAddress'];
    $repairDetails = $_POST['repairdetails'];
    $appointmentTime = $_POST['appointment_time'];
    $appointmentDate = $_POST['appointment_date'];
    $status = $_POST['status'];

    // Prepare a SQL statement to update the appointment details
    $stmt = $conn->prepare("UPDATE walkin_appointments SET firstname = ?, phoneNumber = ?, emailAddress = ?, repairdetails = ?, appointment_time = ?, appointment_date = ?, Status = ? WHERE customer_id = ?");
    $stmt->bind_param("sssssssi", $firstname, $phoneNumber, $emailAddress, $repairDetails, $appointmentTime, $appointmentDate, $status, $customerId);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Appointment updated successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to update appointment.']);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
?>

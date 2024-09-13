<?php
header('Content-Type: application/json');

$customer_id = isset($_GET['id']) ? $_GET['id'] : '';

if (empty($customer_id)) {
    echo json_encode(['error' => 'No customer ID provided']);
    exit;
}

// Database connection
$host = 'localhost';
$db = 'repair-shop-locator';
$user = 'root';
$pass = '';

$mysqli = new mysqli($host, $user, $pass, $db);

if ($mysqli->connect_error) {
    echo json_encode(['error' => 'Database connection error: ' . $mysqli->connect_error]);
    exit;
}

$query = "SELECT customer_id, firstname, lastname, phoneNumber, emailAddress, carmake, carmodel, repairdetails, appointment_time, appointment_date, Status FROM customer_details WHERE customer_id = ?";
$stmt = $mysqli->prepare($query);

if (!$stmt) {
    echo json_encode(['error' => 'Prepare error: ' . $mysqli->error]);
    exit;
}

$stmt->bind_param('i', $customer_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $appointment = $result->fetch_assoc();
    echo json_encode($appointment);
} else {
    echo json_encode(['error' => 'No appointment found']);
}

$stmt->close();
$mysqli->close();
?>

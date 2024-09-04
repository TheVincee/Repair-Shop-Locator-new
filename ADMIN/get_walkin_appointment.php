<?php
include 'db_connection.php';

$customer_id = $_GET['customer_id'];

$sql = "SELECT * FROM walkin_appointments WHERE customer_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $customer_id);
$stmt->execute();
$result = $stmt->get_result();

$data = $result->fetch_assoc();

if (!$data) {
    $data['error'] = "No appointment found with the given ID.";
}

echo json_encode($data);

$stmt->close();
$conn->close();
?>

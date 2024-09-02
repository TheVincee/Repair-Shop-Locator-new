<?php
// fetch_walkin_details.php

header('Content-Type: application/json');

if (isset($_POST['customer_id'])) {
    $customer_id = $_POST['customer_id'];

    // Database connection (replace with your actual database connection details)
    $conn = new mysqli('localhost', 'root', '', 'repair-shop-locator');

    if ($conn->connect_error) {
        echo json_encode(['error' => 'Database connection failed']);
        exit();
    }

    $sql = "SELECT * FROM walkin_appointments WHERE customer_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $customer_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        echo json_encode($data);
    } else {
        echo json_encode(['error' => 'No data found']);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['error' => 'Customer ID not provided']);
}
?>

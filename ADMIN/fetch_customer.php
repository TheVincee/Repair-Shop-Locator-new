<?php
// fetch_customer.php

header('Content-Type: application/json');

// Database connection
$mysqli = new mysqli('localhost', 'root', '', 'repair-shop-locator');

// Check connection
if ($mysqli->connect_error) {
    echo json_encode(['error' => 'Database connection failed']);
    exit;
}

// Fetch customer ID from GET request
$customer_id = isset($_GET['customer_id']) ? intval($_GET['customer_id']) : 0;

if ($customer_id > 0) {
    $stmt = $mysqli->prepare("SELECT * FROM customer_details WHERE customer_id = ?");
    
    if ($stmt) {
        $stmt->bind_param('i', $customer_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            echo json_encode($result->fetch_assoc());
        } else {
            echo json_encode(['error' => 'No data found']);
        }
        
        $stmt->close();
    } else {
        echo json_encode(['error' => 'Failed to prepare statement']);
    }
} else {
    echo json_encode(['error' => 'Invalid customer ID']);
}

$mysqli->close();
?>

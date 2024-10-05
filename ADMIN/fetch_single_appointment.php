<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'repair-shop-locator');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['customer_id'])) {
    $customer_id = $_GET['customer_id'];

    // Fetch the appointment details by customer_id
    $sql = "SELECT * FROM customer_details WHERE customer_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $customer_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        // Return the appointment data as JSON
        echo json_encode($row);
    } else {
        echo json_encode(['error' => 'No details found.']);
    }

    $stmt->close();
}

$conn->close();
?>

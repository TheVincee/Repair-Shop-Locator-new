<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'repair-shop-locator');

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if customer_id is set
if (isset($_POST['customer_id'])) {
    $customer_id = $_POST['customer_id'];

    // Prepare a delete statement
    $sql = "DELETE FROM customer_details WHERE customer_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $customer_id); // 'i' denotes the type as integer

    // Execute the statement
    if ($stmt->execute()) {
        echo "success"; // Return success
    } else {
        echo "error"; // Return error
    }

    $stmt->close();
} else {
    echo "no_id"; // Return if no ID was sent
}

$conn->close();
?>

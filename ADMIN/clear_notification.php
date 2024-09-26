<?php
// Database connection settings
$servername = "localhost";
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "repair-shop-locator"; // Replace with your actual database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(['status' => 'error', 'message' => 'Database connection failed: ' . $conn->connect_error]));
}

// Check if customer_id is set in the POST request
if (isset($_POST['customer_id'])) {
    $customer_id = $_POST['customer_id'];

    // Prepare SQL DELETE query
    $sql = "DELETE FROM appointment_notify WHERE customer_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $customer_id);

    // Execute the query and check if it was successful
    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Notification cleared successfully.']);
    } else {
        // Log the error for debugging
        error_log("SQL Error: " . $stmt->error); 
        echo json_encode(['status' => 'error', 'message' => 'Failed to clear notification: ' . $stmt->error]);
    }

    $stmt->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Customer ID not provided.']);
}

// Close connection
$conn->close();
?>

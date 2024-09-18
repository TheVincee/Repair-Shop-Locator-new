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

// Check if customer_id is provided
if (isset($_POST['customer_id'])) {
    $customer_id = intval($_POST['customer_id']); // Sanitize input

    // Prepare SQL statement to delete customer
    $sql = "DELETE FROM customer_details WHERE customer_id = ?";
    
    if ($stmt = $conn->prepare($sql)) {
        // Bind parameters
        $stmt->bind_param("i", $customer_id);
        
        // Execute statement
        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                echo json_encode(['status' => 'success', 'message' => 'Customer deleted successfully.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Customer not found or already deleted.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error executing SQL query: ' . $stmt->error]);
        }

        // Close the statement
        $stmt->close();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to prepare SQL statement: ' . $conn->error]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Customer ID not provided.']);
}

// Close the connection
$conn->close();
?>

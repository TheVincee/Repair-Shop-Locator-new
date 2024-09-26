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

// Check if it's a DELETE request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete') {
    // Check if customer_id is provided
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
            echo json_encode(['status' => 'error', 'message' => 'Failed to clear notification: ' . $conn->error]);
        }

        $stmt->close();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Customer ID not provided.']);
    }
} else {
    // If it's not a POST request, fetch the notifications (default GET behavior)
    
    // Prepare the SQL query to fetch notifications
    $sql = "SELECT customer_id, firstname, appointment_time, created_at FROM appointment_notify ORDER BY created_at DESC";
    $result = $conn->query($sql);

    // Check if the query was successful
    if ($result === false) {
        die(json_encode(['status' => 'error', 'message' => 'SQL query failed: ' . $conn->error]));
    }

    $notifications = [];

    if ($result->num_rows > 0) {
        // Loop through each notification and store the data in the notifications array
        while ($row = $result->fetch_assoc()) {
            // Handle null or empty appointment_time
            $appointment_time = !empty($row['appointment_time']) ? $row['appointment_time'] : 'No appointment time set';
            
            // Construct the notification message dynamically
            $message = "New Appointment from Customer ID: " . $row['customer_id'] . " (" . $row['firstname'] . ")";
            
            // Store notification details in the array
            $notifications[] = [
                'customer_id' => $row['customer_id'],
                'firstname' => $row['firstname'],
                'appointment_time' => $appointment_time,
                'created_at' => $row['created_at'],
                'message' => $message // Include the constructed message
            ];
        }
    }

    // Return notifications as a JSON response
    header('Content-Type: application/json');

    // Send the response as JSON
    echo json_encode([
        'status' => 'success',
        'notifications' => $notifications,
    ], JSON_PRETTY_PRINT); // Pretty print for better readability in the response
}

// Close the connection
$conn->close();
?>

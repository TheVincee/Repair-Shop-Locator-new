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

// Fetch notifications from the appointment_notify table
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
        // Handle null appointment_time
        $appointment_time = !empty($row['appointment_time']) ? $row['appointment_time'] : 'No appointment time set';
        
        // Construct the message dynamically
        $message = "New Appointment from Customer ID: " . $row['customer_id'] . " (" . $row['firstname'] . ")";
        
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
echo json_encode(['status' => 'success', 'notifications' => $notifications]);

// Close the connection
$conn->close();
?>

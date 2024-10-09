<?php
// Database connection
$servername = "localhost"; // Update with your server name
$username = "root"; // Update with your username
$password = ""; // Update with your password
$dbname = "repair-shop-locator"; // Update with your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch appointments with 'Paid' payment status
$sql = "SELECT * FROM customer_details WHERE payment_status = 'Paid'";
$result = $conn->query($sql);

$appointments = [];

if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        $appointments[] = $row;
    }
} 

// Return response in JSON format
header('Content-Type: application/json');
echo json_encode($appointments);

$conn->close();
?>

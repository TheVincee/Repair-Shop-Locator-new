<?php
// Database connection
$servername = "localhost"; // Your database server name
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "repair-shop-locator"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

header('Content-Type: application/json');

// Prepare the SQL statement to fetch rejected appointments
$sql = "SELECT customer_id, firstname, lastname, phoneNumber, emailAddress, carmake, carmodel, repairdetails, appointment_time, appointment_date, Status FROM customer_details WHERE Status = 'Reject'";
$result = $conn->query($sql);

$data = [];
if ($result->num_rows > 0) {
    // Fetch all rows as associative array
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
} else {
    // No records found
    $data = ["error" => "No rejected appointments found"];
}

// Return the data as JSON
echo json_encode($data);

// Close connection
$conn->close();
?>


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

// Prepare the SQL statement to fetch all approved appointments
$sql = "SELECT customer_id, firstname, lastname, phoneNumber, emailAddress, carmake, carmodel, repairdetails, appointment_time, appointment_date, Status FROM customer_details WHERE Status = 'Approve'";

// Execute the query
$result = $conn->query($sql);

$data = [];

if ($result->num_rows > 0) {
    // Fetch all rows as associative arrays
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
} else {
    // No records found
    $data = [];
}

// Return the data as JSON
header('Content-Type: application/json');
echo json_encode($data);

// Close the connection
$conn->close();
?>

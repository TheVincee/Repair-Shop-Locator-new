<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database connection
$servername = "localhost"; // Your database server name
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "repair-shop-locator"; // Your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(['status' => 'error', 'message' => 'Connection failed: ' . $conn->connect_error]));
}

// Fetch combined data using UNION
$sql = "
    SELECT customer_id, firstname, lastname, phoneNumber, emailAddress, carmake, carmodel, appointment_time, appointment_date, Status, 'customer' AS source 
    FROM customer_details 
    UNION ALL 
    SELECT customer_id, firstname, NULL AS lastname, phoneNumber, emailAddress, NULL AS carmake, NULL AS carmodel, appointment_time, appointment_date, Status, 'walkin' AS source 
    FROM walkin_appointments
";
$result = $conn->query($sql);

$data = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Return JSON response
echo json_encode([
    'status' => 'success',
    'data' => $data
]);

$conn->close();
?>

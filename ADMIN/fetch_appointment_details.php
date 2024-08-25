<?php
header('Content-Type: application/json');

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "repair-shop-locator";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

// SQL query to fetch pending appointments
$sql = "SELECT * FROM customer_details WHERE Status='Pending'";
$result = $conn->query($sql);

$appointments = array();

// Check if the query was successful
if (!$result) {
    die(json_encode(["error" => "Query failed: " . $conn->error]));
}

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $appointments[] = $row;
    }
}

// Output the JSON encoded appointments
echo json_encode($appointments);

$conn->close();
?>

<?php
// Enable error reporting for troubleshooting
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json');

// Check if customer_id is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo json_encode(['error' => 'Customer ID is required']);
    exit();
}

$customerId = $_GET['id'];

// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "repair-shop-locator";

// Create database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(['error' => 'Database connection failed']);
    exit();
}

// Prepare and execute the query
$sql = "SELECT customer_id, firstname, phoneNumber, emailAddress, repairdetails, appointment_time, appointment_date, payment_status FROM customer_details WHERE customer_id = ?";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("i", $customerId);
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch data and return JSON response
    $data = $result->fetch_assoc();
    if ($data) {
        echo json_encode($data);  // Successfully fetched
    } else {
        http_response_code(404);
        echo json_encode(['error' => 'No data found']);
    }

    $stmt->close();
} else {
    http_response_code(500);
    echo json_encode(['error' => 'Query preparation failed']);
}

$conn->close();
?>

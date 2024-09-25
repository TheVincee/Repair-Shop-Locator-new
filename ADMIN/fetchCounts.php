<?php
// Database connection
$servername = "localhost"; // Change as needed
$username = "root"; // Change as needed
$password = ""; // Change as needed
$dbname = "repair-shop-locator"; // Change as needed

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(['status' => 'error', 'message' => 'Connection failed: ' . $conn->connect_error]));
}

// Function to get counts
function getCounts($conn) {
    $counts = [];

    // Count for Approved
    $result = $conn->query("SELECT COUNT(*) as count FROM customer_details WHERE Status = 'Approved'");
    $counts['approved'] = $result->fetch_assoc()['count'];

    // Count for Rejected
    $result = $conn->query("SELECT COUNT(*) as count FROM customer_details WHERE Status = 'Reject'");
    $counts['rejected'] = $result->fetch_assoc()['count'];

    // Count for In Processing
    $result = $conn->query("SELECT COUNT(*) as count FROM customer_details WHERE Status = 'In Processing'");
    $counts['in_processing'] = $result->fetch_assoc()['count'];

    // Count for Total Walk-in Appointments
    $result = $conn->query("SELECT COUNT(*) as count FROM walkin_appointments");
    $counts['total_walkins'] = $result->fetch_assoc()['count'];

    // Debugging output
    error_log('Counts: ' . json_encode($counts)); // Logs to server error log

    return $counts;
}

// Handle AJAX requests
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['action']) && $_GET['action'] == 'getCounts') {
    echo json_encode(getCounts($conn));
}

// Close the database connection
$conn->close();
?>

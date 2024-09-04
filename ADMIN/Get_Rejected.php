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

// Get the customer ID from the request
$customer_id = $_GET['id'];

if (isset($customer_id)) {
    // Prepare the SQL statement to fetch the specific row
    $stmt = $conn->prepare("SELECT customer_id, firstname, lastname, phoneNumber, emailAddress, carmake, carmodel, repairdetails, appointment_time, appointment_date, Status FROM customer_details WHERE customer_id = ? AND Status = 'Reject'");
    $stmt->bind_param("i", $customer_id);
    
    // Execute the query
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch the row as an associative array
        $row = $result->fetch_assoc();

        // Return the data as JSON
        echo json_encode($row);
    } else {
        // No records found or status not rejected
        echo json_encode(["error" => "No rejected record found for the given customer ID"]);
    }

    // Close statement and connection
    $stmt->close();
} else {
    echo json_encode(["error" => "Invalid customer ID"]);
}

$conn->close();
?>

<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "repair-shop-locator"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the request is POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the data from POST request
    $id = $_POST['id'];
    $issue_details = $_POST['issue_details'];

    // Validate input
    if (empty($id) || empty($issue_details)) {
        echo "Error: Missing data.";
        exit;
    }

    // Prepare and bind
    $stmt = $conn->prepare("UPDATE delivered_products SET status = 'Returned', issue_details = ? WHERE partID = ?");
    $stmt->bind_param("si", $issue_details, $id);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Product status updated to Returned.";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>

<?php
header('Content-Type: application/json');

// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "repair-shop-locator";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if 'id' is provided via POST
if (isset($_POST['id'])) {
    $partID = $conn->real_escape_string($_POST['id']);

    // Prepare the SQL statement
    $sql = "SELECT * FROM delivered_products WHERE partID = '$partID'";
    $result = $conn->query($sql);

    // Check if the part exists
    if ($result->num_rows > 0) {
        // Fetch the part details
        $part = $result->fetch_assoc();
        echo json_encode($part);
    } else {
        echo json_encode(array("error" => "Part not found"));
    }
} else {
    echo json_encode(array("error" => "No ID provided"));
}

// Close the connection
$conn->close();
?>

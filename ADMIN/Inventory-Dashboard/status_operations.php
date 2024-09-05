<?php
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

// Handle actions
$action = isset($_GET['action']) ? $_GET['action'] : '';

if ($action == 'listByStatus') {
    $status = $_GET['status'];
    $sql = "SELECT * FROM inventory WHERE status='$status'";
    $result = $conn->query($sql);

    $parts = [];
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $parts[] = $row;
        }
    }
    echo json_encode($parts);
}

$conn->close();
?>

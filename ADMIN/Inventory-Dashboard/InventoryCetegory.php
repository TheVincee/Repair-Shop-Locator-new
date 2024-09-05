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

if ($action == 'list') {
    $sql = "SELECT * FROM inventory";
    $result = $conn->query($sql);

    $parts = [];
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $parts[] = $row;
        }
    }
    echo json_encode($parts);
}

if ($action == 'view') {
    $partID = $_GET['id'];
    $sql = "SELECT * FROM inventory WHERE partID='$partID'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo json_encode($result->fetch_assoc());
    } else {
        echo json_encode(['error' => 'No record found']);
    }
}

if ($action == 'delete') {
    $partID = $_GET['id'];
    $sql = "DELETE FROM inventory WHERE partID='$partID'";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(['success' => 'Record deleted successfully']);
    } else {
        echo json_encode(['error' => 'Error deleting record: ' . $conn->error]);
    }
}

$conn->close();
?>

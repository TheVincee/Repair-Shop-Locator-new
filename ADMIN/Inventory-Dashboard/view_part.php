<?php
// Database connection
$servername = "localhost"; // Change as necessary
$username = "root"; // Change as necessary
$password = ""; // Change as necessary
$dbname = "repair-shop-locator"; // Change as necessary

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$partID = $_GET['id'];
$query = "SELECT partID, partName, quantity, CAST(price AS DECIMAL(10,2)) as price, supplier, status, issue_details FROM delivered_products WHERE partID = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $partID);
$stmt->execute();
$result = $stmt->get_result();

$data = $result->fetch_assoc();
$stmt->close();
$conn->close();

header('Content-Type: application/json');
if ($data) {
    echo json_encode($data);
} else {
    echo json_encode(['error' => 'Part not found']);
}
?>

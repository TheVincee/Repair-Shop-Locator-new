<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$mysqli = new mysqli("localhost", "root", "", "repair-shop-locator");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$partID = $_GET['partID'];

$query = "SELECT partID, partName, status, issue_details FROM delivered_products WHERE partID = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("i", $partID);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $partDetails = $result->fetch_assoc();
    echo json_encode($partDetails);
} else {
    echo json_encode(['error' => 'No details found.']);
}

$stmt->close();
$mysqli->close();
?>

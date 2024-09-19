<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "repair-shop-locator";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$partID = $_POST['id'];
$status = $_POST['status'];
$issueDetails = isset($_POST['issue_details']) ? $_POST['issue_details'] : null;

$sql = "UPDATE delivered_products SET status = ?, issue_details = ? WHERE partID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssi", $status, $issueDetails, $partID);

if ($stmt->execute()) {
    echo "Status updated successfully.";
} else {
    echo "Error updating status: " . $conn->error;
}

$stmt->close();
$conn->close();
?>

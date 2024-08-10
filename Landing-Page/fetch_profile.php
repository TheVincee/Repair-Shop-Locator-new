<?php
// Start the session
session_start();

// Check if the user is logged in (ensure that this session variable is set when the user logs in)
if (!isset($_SESSION['id'])) {
    echo json_encode(["error" => "User not logged in"]);
    exit;
}

// Include the database connection file
require 'dbconfig.php';

// Fetch the user ID from the session
$id = $_SESSION['id'];

// Fetch user data from the database
$sql = "SELECT email, address, address2, city, state, zip FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    echo json_encode($user);
} else {
    echo json_encode(["error" => "User not found"]);
}

$stmt->close();
$conn->close();
?>

<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "repair-shop-locator";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
$action = $_POST['action'] ?? '';
if ($action === 'updateItem') {
    $partID = intval($_POST['partID']);
    $partName = $conn->real_escape_string($_POST['partName']);
    $category = $conn->real_escape_string($_POST['category']);
    $quantity = intval($_POST['quantity']);
    $price = floatval($_POST['price']);
    $supplier = $conn->real_escape_string($_POST['supplier']);
    $status = $conn->real_escape_string($_POST['status']);

    $sql = "UPDATE inventory SET partName='$partName', category='$category', quantity=$quantity, price=$price, supplier='$supplier', status='$status' WHERE partID=$partID";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $conn->error]);
    }
}

$conn->close();
?>

<?php
include 'db.php';

$partName = $_POST['partName'];
$category = $_POST['category'];
$quantity = $_POST['quantity'];
$price = $_POST['price'];
$supplier = $_POST['supplier'];

$sql = "INSERT INTO delivered_products (partName, category, quantity, price, supplier, status) 
        VALUES ('$partName', '$category', $quantity, $price, '$supplier', 'New')";

if ($conn->query($sql) === TRUE) {
    echo "New part added successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

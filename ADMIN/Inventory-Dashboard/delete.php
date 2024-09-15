<?php
include 'db.php';

$id = $_POST['id'];

$sql = "DELETE FROM delivered_products WHERE partID=$id";

if ($conn->query($sql) === TRUE) {
    echo "Part deleted successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

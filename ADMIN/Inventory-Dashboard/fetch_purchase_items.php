<?php
$conn = new mysqli('localhost', 'root', '', 'repair-shop-locator');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['transaction_id'])) {
    $transaction_id = $_POST['transaction_id'];

    $sql = "SELECT * FROM sold_products WHERE id = $transaction_id";
    $result = $conn->query($sql);

    $items = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $items[] = $row; // You can modify this based on your needs
        }
        echo json_encode($items);
    } else {
        echo json_encode([]);
    }
}

$conn->close();
?>

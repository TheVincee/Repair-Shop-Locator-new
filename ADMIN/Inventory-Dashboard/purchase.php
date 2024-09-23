<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'repair-shop-locator');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process purchase: insert cart items into sold_products and update inventory
if (isset($_POST['cart'])) {
    foreach ($_POST['cart'] as $item) {
        // Get item details from inventory
        $item_id = $item['id'];
        $sql = "SELECT * FROM inventory WHERE partID = $item_id";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();

        // Insert into sold_products
        $insert_sql = "INSERT INTO sold_products (product_name, price, sold_quantity)
                       VALUES ('".$row['partName']."', '".$row['price']."', 1)";
        $conn->query($insert_sql);

        // Update inventory (decrease quantity)
        $update_sql = "UPDATE inventory SET quantity = quantity - 1 WHERE partID = $item_id";
        $conn->query($update_sql);
    }

    // Clear cart
    unset($_SESSION['cart']);
    echo "Purchase successful!";
} else {
    echo "No items in cart.";
}

$conn->close();
?>

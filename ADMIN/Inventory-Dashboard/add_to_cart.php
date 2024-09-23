<?php
session_start();
$item_id = $_POST['item_id'];

// Add item to cart (session)
if (isset($_SESSION['cart'])) {
    $_SESSION['cart'][] = $item_id;
} else {
    $_SESSION['cart'] = array($item_id);
}

echo "Item added to cart successfully";
?>

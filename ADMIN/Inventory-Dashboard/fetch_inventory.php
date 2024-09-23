<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'repair-shop-locator');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch inventory items
$sql = "SELECT * FROM inventory";
$result = $conn->query($sql);

$output = '';
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $output .= '
            <tr>
                <td>'.$row["partID"].'</td>
                <td>'.$row["partName"].'</td>
                <td>'.$row["price"].'</td>
                <td>'.$row["quantity"].'</td>
                <td>
                    <button class="btn btn-primary addToCart" 
                            data-id="'.$row["partID"].'" 
                            data-name="'.$row["partName"].'" 
                            data-price="'.$row["price"].'" 
                            data-quantity="'.$row["quantity"].'">
                        Add to Cart
                    </button>
                </td>
            </tr>
        ';
    }
} else {
    $output = '<tr><td colspan="5">No items found in inventory</td></tr>';
}

echo $output;

$conn->close();
?>

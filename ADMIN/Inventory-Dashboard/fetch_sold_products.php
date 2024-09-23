<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'repair-shop-locator');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch sold products
$sql = "SELECT * FROM sold_products";
$result = $conn->query($sql);

$output = '';
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $output .= '
            <tr>
                <td>' . $row["id"] . '</td>
                <td>' . $row["product_name"] . '</td>
                <td>' . $row["price"] . '</td>
                <td>' . $row["sold_quantity"] . '</td>
                <td>' . ($row["sold_quantity"] * $row["price"]) . '</td>
                <td>
                    <button class="btn btn-info viewDetails" 
                            data-id="' . $row["id"] . '">View</button>
                </td>
            </tr>
        ';
    }
} else {
    $output = '<tr><td colspan="6">No sold products found</td></tr>';
}

echo $output;

$conn->close();
?>

<?php
include('dbconfig.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $customer_id = $_POST['customer_id'];

    $query = "DELETE FROM customer_details WHERE customer_id = '$customer_id'";

    if (mysqli_query($connection, $query)) {
        echo "Success";
    } else {
        echo "Error: " . mysqli_error($connection);
    }
}
?>

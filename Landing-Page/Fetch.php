<?php
include('dbconfig.php'); // Make sure this file contains your database connection settings

if (isset($_POST['customer_id'])) {
    $customer_id = mysqli_real_escape_string($connection, $_POST['customer_id']);
    
    $query = "SELECT * FROM customer_details WHERE customer_id = '$customer_id'";
    $result = mysqli_query($connection, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        echo json_encode($row);
    } else {
        echo json_encode(['error' => 'No record found']);
    }
} else {
    echo json_encode(['error' => 'Invalid request']);
}
?>

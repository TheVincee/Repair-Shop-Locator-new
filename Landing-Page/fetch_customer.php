<?php
include('dbconfig.php');

// Check if 'customer_id' is set in the POST request
if (isset($_POST['customer_id'])) {
    $customer_id = $_POST['customer_id'];

    // Prepare the SQL statement to prevent SQL injection
    $query = "SELECT * FROM customer_details WHERE customer_id = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("i", $customer_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch data as an associative array
    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        echo json_encode($data);
    } else {
        // Return an empty JSON object if no customer is found
        echo json_encode([]);
    }

    // Close the statement
    $stmt->close();
} else {
    // Handle the case where 'customer_id' is not set
    echo json_encode(['error' => 'Customer ID not provided.']);
}

// Close the database connection
$connection->close();
?>

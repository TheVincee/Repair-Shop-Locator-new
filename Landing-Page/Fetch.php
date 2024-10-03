<?php
include('dbconfig.php'); // Ensure this file contains your database connection settings

// Check if customer_id is set in the POST request
if (isset($_POST['customer_id'])) {
    // Sanitize and validate the customer_id
    $customer_id = intval($_POST['customer_id']); // Ensure it's an integer

    // Prepare the SQL statement
    $query = "SELECT * FROM customer_details WHERE customer_id = ?";
    
    if ($stmt = $conn->prepare($query)) {
        // Bind parameters
        $stmt->bind_param("i", $customer_id);

        // Execute the statement
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Fetch the record
            $row = $result->fetch_assoc();
            echo json_encode($row);
        } else {
            echo json_encode(['error' => 'No record found']);
        }

        // Close the statement
        $stmt->close();
    } else {
        echo json_encode(['error' => 'Failed to prepare SQL statement: ' . $conn->error]);
    }
} else {
    echo json_encode(['error' => 'Invalid request']);
}

// Close the connection
$conn->close();
?>

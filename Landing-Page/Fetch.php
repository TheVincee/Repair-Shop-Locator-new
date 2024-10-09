<?php
include('dbconfig.php'); // Include your database configuration

// Check if customer_id is set in the POST request
if (isset($_POST['customer_id'])) {
    // Sanitize and validate the customer_id
    $customer_id = intval($_POST['customer_id']); // Ensure it's an integer

    if ($customer_id > 0) { // Check if customer_id is valid
        // Prepare the SQL statement
        $query = "SELECT * FROM customer_details WHERE customer_id = ?";

        if ($stmt = $conn->prepare($query)) {
            // Bind the customer_id as an integer parameter
            $stmt->bind_param("i", $customer_id);

            // Execute the statement
            $stmt->execute();

            // Get the result
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                // Fetch the record as an associative array
                $row = $result->fetch_assoc();

                // Send the response as JSON
                echo json_encode($row);
            } else {
                // No record found for the provided customer_id
                echo json_encode(['error' => 'No record found for the provided customer_id.']);
            }

            // Close the statement
            $stmt->close();
        } else {
            // Handle SQL preparation error
            echo json_encode(['error' => 'Failed to prepare SQL statement: ' . $conn->error]);
        }
    } else {
        // Handle invalid customer_id
        echo json_encode(['error' => 'Invalid customer_id provided.']);
    }
} else {
    // Handle missing customer_id in the request
    echo json_encode(['error' => 'customer_id is missing in the request.']);
}

// Close the connection
$conn->close();
?>

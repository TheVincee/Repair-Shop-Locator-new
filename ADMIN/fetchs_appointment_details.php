<?php
// Set headers to handle JSON response and allow cross-origin requests
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

// Check if 'customer_id' is set in the GET request
if (isset($_GET['customer_id'])) {
    $customerId = $_GET['customer_id'];
    
    // Log the customer_id for debugging purposes
    error_log("Fetching details for customer_id: " . $customerId);

    // Connect to the MySQL database
    $conn = new mysqli('localhost', 'root', '', 'repair-shop-locator');

    // Check if the database connection is successful
    if ($conn->connect_error) {
        echo json_encode(['success' => false, 'error' => 'Database connection failed: ' . $conn->connect_error]);
        exit;
    }

    // SQL query to fetch customer details and associated walk-in appointment details
    $sql = "SELECT cd.customer_id, cd.firstname, cd.lastname, cd.phoneNumber, cd.emailAddress,
                   wa.repairdetails, wa.appointment_time, wa.appointment_date, wa.Status
            FROM customer_details cd
            JOIN walkin_appointments wa ON cd.customer_id = wa.customer_id
            WHERE cd.customer_id = ?";
    
    // Log the SQL query for debugging purposes
    error_log("SQL Query: " . $sql);

    // Prepare the SQL statement
    $stmt = $conn->prepare($sql);

    // Check if the SQL statement preparation was successful
    if ($stmt === false) {
        echo json_encode(['success' => false, 'error' => 'SQL Prepare Error: ' . $conn->error]);
        exit;
    }

    // Bind the customer ID to the SQL query
    $stmt->bind_param("i", $customerId);

    // Execute the SQL query
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        
        // Log the number of rows returned for debugging purposes
        error_log("Number of rows returned: " . $result->num_rows);

        // Check if any rows were returned
        if ($result->num_rows > 0) {
            // Fetch the details and return them as JSON
            $details = $result->fetch_assoc();
            echo json_encode(['success' => true, 'details' => $details]);
        } else {
            // Log the error if no details are found
            error_log("No details found for customer_id: " . $customerId);
            echo json_encode(['success' => false, 'error' => 'No details found for this customer ID.']);
        }
    } else {
        // Return an error message if the query execution failed
        echo json_encode(['success' => false, 'error' => 'Query execution failed: ' . $stmt->error]);
    }

    // Close the SQL statement and database connection
    $stmt->close();
    $conn->close();
} else {
    // Return an error if 'customer_id' is not set in the GET request
    echo json_encode(['success' => false, 'error' => 'Customer ID is not set.']);
}

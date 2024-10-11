<?php
// fetch_walkin_appointments.php
require 'db_connection.php'; // Include your database connection file

header('Content-Type: application/json'); // Set the content type to JSON

try {
    // Prepare the SQL query to fetch all walk-in appointments
    $query = "SELECT * FROM walkin_appointments";
    $stmt = $conn->prepare($query); // Use prepared statements
    $stmt->execute();

    // Get the result set from the prepared statement
    $result = $stmt->get_result();

    // Check if any appointments were found
    if ($result->num_rows > 0) {
        $appointments = [];

        // Fetch all rows as an associative array
        while ($row = $result->fetch_assoc()) {
            $appointments[] = $row;
        }

        // Output the results in JSON format
        echo json_encode(['status' => 'success', 'data' => $appointments]);
    } else {
        // If no appointments were found, return an empty array
        echo json_encode(['status' => 'success', 'data' => []]);
    }
} catch (Exception $e) {
    // If there was an error with the query, output an error message
    echo json_encode(['status' => 'error', 'message' => 'Error fetching data: ' . $e->getMessage()]);
}

// Close the database connection
$conn->close();
?>

<?php
// fetch_walkin_appointments.php
require 'db_connection.php'; // Include your database connection file

header('Content-Type: application/json'); // Set the content type to JSON

// Prepare and execute the SQL query to fetch all walk-in appointments
$query = "SELECT * FROM walkin_appointments";
$result = $conn->query($query);

// Check if the query was successful
if ($result) {
    $appointments = [];

    // Fetch all rows as an associative array
    while ($row = $result->fetch_assoc()) {
        $appointments[] = $row;
    }

    // Output the results in JSON format
    echo json_encode($appointments);
} else {
    // If there was an error with the query, output an error message
    echo json_encode(['status' => 'error', 'message' => 'Error fetching data']);
}

// Close the database connection
$conn->close();
?>

<?php
header('Content-Type: application/json');

// Include database connection
include('db_connection.php');

// Ensure the connection is successful
if ($conn->connect_error) {
    die(json_encode(['error' => 'Connection failed: ' . $conn->connect_error]));
}

// SQL UNION ALL query to fetch data from both tables
$query = "
    SELECT 
        cd.customer_id,
        cd.firstname,
        cd.lastname,
        cd.phoneNumber,
        cd.emailAddress,
        cd.carmake,
        cd.carmodel,
        cd.repairdetails,
        cd.appointment_time,
        cd.appointment_date,
        cd.Status
    FROM 
        customer_details cd

    UNION ALL

    SELECT 
        wa.customer_id,
        wa.firstname,
        NULL AS lastname,
        wa.phoneNumber,
        wa.emailAddress,
        NULL AS carmake,
        NULL AS carmodel,
        wa.repairdetails,
        wa.appointment_time,
        wa.appointment_date,
        wa.Status
    FROM 
        walkin_appointments wa;
";

$result = $conn->query($query);

// Check for SQL errors
if (!$result) {
    echo json_encode(['error' => $conn->error]);
    exit;
}

// Check number of rows returned
$rowCount = $result->num_rows;
echo json_encode(['rowCount' => $rowCount]); // Add this line for debugging

$data = [];

// Fetch the data
if ($rowCount > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Return the data as JSON
echo json_encode($data);
?>

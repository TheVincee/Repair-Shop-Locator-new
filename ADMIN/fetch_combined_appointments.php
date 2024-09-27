<?php
header('Content-Type: application/json');

// Include database connection
include('db_connection.php');

// Ensure the connection is successful
if ($conn->connect_error) {
    // Return connection error as JSON and exit
    echo json_encode(['error' => 'Connection failed: ' . $conn->connect_error]);
    exit;
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

// Prepare the response
$data = [];
$rowCount = $result->num_rows;

// Fetch the data if rows exist
if ($rowCount > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Return rowCount and data as a single JSON response
$response = [
    'rowCount' => $rowCount,
    'data' => $data
];

echo json_encode($response);
?>

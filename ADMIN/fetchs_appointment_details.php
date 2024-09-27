<?php
// Database connection
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'repair-shop-locator';

$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get customer_id from the request
$customer_id = isset($_GET['customer_id']) ? intval($_GET['customer_id']) : 0;

if ($customer_id > 0) {
    // Fetch specific appointment details for the given customer_id
    $sql = "
    SELECT 
        cd.customer_id,
        cd.firstname AS customer_firstname,
        cd.lastname,
        cd.phoneNumber,
        cd.emailAddress,
        cd.carmake,
        cd.carmodel,
        cd.repairdetails AS customer_repairdetails,
        cd.appointment_time AS customer_appointment_time,
        cd.appointment_date AS customer_appointment_date,
        cd.Status AS customer_status,
        NULL AS walkin_firstname,
        NULL AS walkin_phoneNumber,
        NULL AS walkin_emailAddress,
        NULL AS walkin_repairdetails,
        NULL AS walkin_appointment_time,
        NULL AS walkin_appointment_date,
        NULL AS walkin_status
    FROM customer_details cd
    WHERE cd.customer_id = ?
    
    UNION ALL
    
    SELECT 
        wa.customer_id,
        wa.firstname AS walkin_firstname,
        NULL AS lastname,
        wa.phoneNumber,
        wa.emailAddress,
        NULL AS carmake,
        NULL AS carmodel,
        wa.repairdetails AS walkin_repairdetails,
        wa.appointment_time AS walkin_appointment_time,
        wa.appointment_date AS walkin_appointment_date,
        wa.Status AS walkin_status,
        wa.firstname AS walkin_firstname,
        wa.phoneNumber AS walkin_phoneNumber,
        wa.emailAddress AS walkin_emailAddress,
        wa.repairdetails AS walkin_repairdetails,
        wa.appointment_time AS walkin_appointment_time,
        wa.appointment_date AS walkin_appointment_date,
        wa.Status AS walkin_status
    FROM walkin_appointments wa
    WHERE wa.customer_id = ?";

    // Prepare and bind the statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $customer_id, $customer_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        // Debugging: Output the fetched data
        error_log(print_r($row, true));

        // Return the fetched data as JSON
        echo json_encode([
            'success' => true,
            'data' => $row
        ]);
    } else {
        // No matching record found
        echo json_encode(['success' => false, 'error' => 'No appointment found.']);
    }

    $stmt->close();
} else {
    // Invalid customer_id
    echo json_encode(['success' => false, 'error' => 'Invalid customer ID.']);
}

// Close the database connection
$conn->close();
?>

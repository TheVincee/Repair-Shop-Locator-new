<?php
include('dbconfig.php'); // Include your database configuration

if (isset($_POST['customer_id'])) {
    $customer_id = $_POST['customer_id'];

    // Fetch customer details from the database
    $query = "SELECT * FROM customer_details WHERE customer_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $customer_id); // Assuming customer_id is an integer
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $customer = $result->fetch_assoc();
        $response = [
            'customer_id' => $customer['customer_id'],
            'firstname' => $customer['firstname'],
            'lastname' => $customer['lastname'],
            'phoneNumber' => $customer['phoneNumber'],
            'emailAddress' => $customer['emailAddress'],
            'address' => $customer['Address'], // Make sure the field name matches
            'carmake' => $customer['carmake'],
            'carmodel' => $customer['carmodel'],
            'repairdetails' => $customer['repairdetails'],
            'appointment_date' => $customer['appointment_date'],
            'appointment_time' => $customer['appointment_time'],
            'status' => $customer['Status'],
            'service_type' => $customer['service_type'],
            'total_payment' => $customer['total_payment'],
            'payment_type' => $customer['payment_type'],
            'payment_status' => $customer['payment_status'], // Ensure this field is included
        ];
        echo json_encode($response);
    } else {
        echo json_encode(['error' => 'No customer found.']);
    }
} else {
    echo json_encode(['error' => 'Invalid request.']);
}
?>

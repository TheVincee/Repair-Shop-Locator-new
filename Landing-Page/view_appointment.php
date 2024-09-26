<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'repair-shop-locator');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['customer_id'])) {
    $customer_id = $_GET['customer_id'];

    // Fetch customer details by ID
    $sql = "SELECT * FROM customer_details WHERE customer_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $customer_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        echo "<strong>Customer ID:</strong> " . $row['customer_id'] . "<br>";
        echo "<strong>Name:</strong> " . $row['firstname'] . " " . $row['lastname'] . "<br>";
        echo "<strong>Phone:</strong> " . $row['phoneNumber'] . "<br>";
        echo "<strong>Email:</strong> " . $row['emailAddress'] . "<br>";
        echo "<strong>Car Make:</strong> " . $row['carmake'] . "<br>";
        echo "<strong>Car Model:</strong> " . $row['carmodel'] . "<br>";
        echo "<strong>Repair Details:</strong> " . $row['repairdetails'] . "<br>";
        echo "<strong>Appointment Date:</strong> " . $row['appointment_date'] . "<br>";
        echo "<strong>Appointment Time:</strong> " . $row['appointment_time'] . "<br>";
        echo "<strong>Status:</strong> " . $row['Status'] . "<br>";
    } else {
        echo "No details found.";
    }

    $stmt->close();
}

$conn->close();
?>

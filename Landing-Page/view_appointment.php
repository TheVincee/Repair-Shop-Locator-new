<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'repair-shop-locator');

// Check for connection error
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if 'customer_id' is set and is a valid integer
if (isset($_GET['customer_id']) && is_numeric($_GET['customer_id'])) {
    $customer_id = (int)$_GET['customer_id'];  // Cast to integer for safety

    // Prepare SQL query to fetch customer details by ID
    $sql = "SELECT * FROM customer_details WHERE customer_id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Bind the customer_id parameter to the prepared statement
        $stmt->bind_param("i", $customer_id);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if a row is fetched
        if ($row = $result->fetch_assoc()) {
            // Display customer details
            echo "<strong>Customer ID:</strong> " . htmlspecialchars($row['customer_id']) . "<br>";
            echo "<strong>Name:</strong> " . htmlspecialchars($row['firstname']) . " " . htmlspecialchars($row['lastname']) . "<br>";
            echo "<strong>Phone:</strong> " . htmlspecialchars($row['phoneNumber']) . "<br>";
            echo "<strong>Email:</strong> " . htmlspecialchars($row['emailAddress']) . "<br>";
            echo "<strong>Car Make:</strong> " . htmlspecialchars($row['carmake']) . "<br>";
            echo "<strong>Car Model:</strong> " . htmlspecialchars($row['carmodel']) . "<br>";
            echo "<strong>Repair Details:</strong> " . htmlspecialchars($row['repairdetails']) . "<br>";
            echo "<strong>Appointment Date:</strong> " . htmlspecialchars($row['appointment_date']) . "<br>";
            echo "<strong>Appointment Time:</strong> " . htmlspecialchars($row['appointment_time']) . "<br>";
            echo "<strong>Status:</strong> " . htmlspecialchars($row['Status']) . "<br>";
            echo "<strong>Service Type:</strong> " . htmlspecialchars($row['service_type']) . "<br>";
            echo "<strong>Total Payment:</strong> ₱" . htmlspecialchars($row['total_payment']) . "<br>";
            echo "<strong>Payment Type:</strong> " . htmlspecialchars($row['payment_type']) . "<br>";
            echo "<strong>Address:</strong> " . htmlspecialchars($row['Address']) . "<br>";
        } else {
            echo "No details found for customer ID: " . $customer_id;
        }

        // Close statement
        $stmt->close();
    } else {
        // Handle SQL preparation error
        echo "Failed to prepare the statement: " . $conn->error;
    }
} else {
    echo "Invalid or missing customer ID.";
}

// Close database connection
$conn->close();
?>

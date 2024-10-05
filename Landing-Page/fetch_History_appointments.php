<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'repair-shop-locator');

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch customer appointments, including all specified fields
$sql = "SELECT customer_id, firstname, lastname, phoneNumber, emailAddress, carmake, carmodel, repairdetails, appointment_time, appointment_date, status, service_type, total_payment, payment_type FROM customer_details";
$result = $conn->query($sql);

// Check if the query was successful
if ($result === false) {
    die("Error in query: " . $conn->error);  // Show the SQL error
}

// Check for results
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['customer_id']}</td>
                <td>{$row['firstname']}</td>
                <td class='hidden-column'>{$row['lastname']}</td>
                <td>{$row['phoneNumber']}</td>
                <td class='hidden-column'>{$row['emailAddress']}</td>
                <td class='hidden-column'>{$row['carmake']}</td>
                <td class='hidden-column'>{$row['carmodel']}</td>
                <td class='hidden-column'>{$row['repairdetails']}</td>
                <td>{$row['appointment_time']}</td>
                <td>{$row['appointment_date']}</td>
                <td>{$row['status']}</td>
                <td>{$row['service_type']}</td>
                <td>{$row['total_payment']}</td>
                <td>{$row['payment_type']}</td>
                <td>
                    <button class='btn btn-primary viewBtn' data-id='{$row['customer_id']}'>View</button>
                    <button class='btn btn-danger deleteBtn' data-id='{$row['customer_id']}'>Delete</button>
                </td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='14'>No records found</td></tr>"; // Adjusted to match the number of columns
}

// Close the database connection
$conn->close();
?>

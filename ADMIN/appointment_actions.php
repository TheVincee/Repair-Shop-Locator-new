<?php
// Database connection
$host = 'localhost'; // Your database host
$user = 'root';      // Your database username
$password = '';      // Your database password
$database = 'your_database_name'; // Your database name

$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle GET request for viewing an appointment
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['customer_id'])) {
    $customer_id = $_GET['customer_id'];

    $sql = "SELECT * FROM customer_details WHERE customer_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $customer_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch appointment details
        $appointment = $result->fetch_assoc();
        echo json_encode($appointment);
    } else {
        echo json_encode(null); // No appointment found
    }
    $stmt->close();
}

// Handle POST request for deleting an appointment
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['customer_id'])) {
    $customer_id = $_POST['customer_id'];

    $sql = "DELETE FROM customer_details WHERE customer_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $customer_id);
    $success = $stmt->execute();

    if ($success) {
        echo json_encode(['message' => "Appointment with Customer ID: $customer_id deleted successfully."]);
    } else {
        echo json_encode(['message' => "Failed to delete appointment with Customer ID: $customer_id."]);
    }
    $stmt->close();
}

// Close the database connection
$conn->close();
?>

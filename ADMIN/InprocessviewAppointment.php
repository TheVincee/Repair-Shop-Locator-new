<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include your database connection file
include 'db_connection.php';

// Check if ID is provided
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    try {
        // Prepare and execute the query
        $query = "SELECT * FROM customer_details WHERE customer_id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$id]);

        // Fetch the appointment
        $appointment = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if appointment is found
        if ($appointment) {
            // Return JSON response
            header('Content-Type: application/json');
            echo json_encode($appointment);
        } else {
            // No appointment found
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Appointment not found']);
        }
    } catch (Exception $e) {
        // Handle any exceptions
        header('Content-Type: application/json');
        echo json_encode(['error' => 'An error occurred: ' . $e->getMessage()]);
    }
} else {
    // Handle the case where no ID is provided
    header('Content-Type: application/json');
    echo json_encode(['error' => 'No appointment ID provided']);
}
?>

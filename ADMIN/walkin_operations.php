<?php
// Database connection
$servername = "localhost"; // Change as needed
$username = "root"; // Change as needed
$password = ""; // Change as needed
$dbname = "repair-shop-locator"; // Change as needed

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(['status' => 'error', 'message' => 'Connection failed: ' . $conn->connect_error]));
}

// Function to fetch combined data from customer_details and walkin_appointments using UNION
function fetchCombinedData($conn) {
    $sql = "
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
        cd.Status,
        'customer_details' AS source
    FROM customer_details cd
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
        wa.Status,
        'walkin_appointments' AS source
    FROM walkin_appointments wa
    WHERE wa.customer_id NOT IN (SELECT customer_id FROM customer_details)";

    $result = $conn->query($sql);
    $combinedData = [];
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $combinedData[] = $row;
        }
    }
    return $combinedData;
}

// Function to fetch a single appointment by customer_id using UNION
function fetchAppointmentById($conn, $id) {
    $sql = "
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
        cd.Status,
        'customer_details' AS source
    FROM customer_details cd
    WHERE cd.customer_id = ?
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
        wa.Status,
        'walkin_appointments' AS source
    FROM walkin_appointments wa
    WHERE wa.customer_id = ? AND wa.customer_id NOT IN (SELECT customer_id FROM customer_details)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $id, $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

// Updated function to handle the update of the Status field only
function updateStatus($conn, $data) {
    // Start transaction
    $conn->begin_transaction();
    
    try {
        // Check if customer exists in customer_details
        $checkSql = "SELECT customer_id FROM customer_details WHERE customer_id = ?";
        $stmtCheck = $conn->prepare($checkSql);
        if (!$stmtCheck) {
            throw new Exception("Failed to prepare statement: " . $conn->error);
        }
        $stmtCheck->bind_param("i", $data['customer_id']);
        $stmtCheck->execute();
        $resultCheck = $stmtCheck->get_result();

        if ($resultCheck->num_rows > 0) {
            // If the customer exists in customer_details, update only the Status in customer_details
            $sql = "UPDATE customer_details SET Status = ? WHERE customer_id = ?";
            $stmt = $conn->prepare($sql);
        } else {
            // If not, update the Status in walkin_appointments
            $sql = "UPDATE walkin_appointments SET Status = ? WHERE customer_id = ?";
            $stmt = $conn->prepare($sql);
        }

        if (!$stmt) {
            throw new Exception("Failed to prepare update statement: " . $conn->error);
        }

        // Bind parameters and execute update statement
        $stmt->bind_param("si", $data['Status'], $data['customer_id']);
        
        if (!$stmt->execute()) {
            throw new Exception("Update failed: " . $stmt->error);
        }

        // Commit transaction
        $conn->commit();
        return true;
    } catch (Exception $e) {
        // Rollback if there is an error
        $conn->rollback();
        error_log("Error updating Status: " . $e->getMessage()); // Log the error
        return false;
    }
}

// Function to delete an appointment from both tables using UNION logic
function deleteAppointment($conn, $id) {
    // Start transaction to ensure both delete operations succeed
    $conn->begin_transaction();
    
    try {
        // Delete from customer_details if exists
        $sql1 = "DELETE FROM customer_details WHERE customer_id = ?";
        $stmt1 = $conn->prepare($sql1);
        $stmt1->bind_param("i", $id);
        $stmt1->execute();

        // Delete from walkin_appointments if exists
        $sql2 = "DELETE FROM walkin_appointments WHERE customer_id = ?";
        $stmt2 = $conn->prepare($sql2);
        $stmt2->bind_param("i", $id);
        $stmt2->execute();

        // Commit transaction
        $conn->commit();
        return true;
    } catch (Exception $e) {
        // Rollback if there is an error
        $conn->rollback();
        error_log("Deletion failed: " . $e->getMessage()); // Log the error
        return false;
    }
}

// Handle AJAX requests
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action'])) {
        if ($_POST['action'] == 'updateStatus') { // Handle Status update action
            if (updateStatus($conn, $_POST)) {
                echo json_encode(['status' => 'success', 'message' => 'Status updated successfully!']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to update Status.']);
            }
        } elseif ($_POST['action'] == 'deleteAppointment') {
            if (deleteAppointment($conn, $_POST['id'])) {
                echo json_encode(['status' => 'success', 'message' => 'Appointment deleted successfully!']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to delete appointment.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid action.']);
        }
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'getAppointment' && isset($_GET['id'])) {
            $appointment = fetchAppointmentById($conn, $_GET['id']);
            echo json_encode($appointment);
        } elseif ($_GET['action'] == 'getCombinedData') {
            echo json_encode(fetchCombinedData($conn));
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid action or missing parameters.']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No action specified.']);
    }
}

// Close the database connection
$conn->close();
?>

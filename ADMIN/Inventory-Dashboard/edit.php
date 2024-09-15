<?php
include 'db.php'; // Ensure this file correctly establishes the $conn connection

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if all required fields are provided and not empty
if (isset($_POST['id'], $_POST['partName'], $_POST['category'], $_POST['quantity'], $_POST['price'], $_POST['supplier']) 
    && !empty($_POST['id']) 
    && !empty($_POST['partName']) 
    && !empty($_POST['category']) 
    && !empty($_POST['quantity']) 
    && !empty($_POST['price']) 
    && !empty($_POST['supplier'])) {
    
    // Sanitize and store the data
    $id = $_POST['id'];
    $partName = $_POST['partName'];
    $category = $_POST['category'];
    $quantity = (int) $_POST['quantity']; // Cast to integer
    $price = (float) $_POST['price']; // Cast to float
    $supplier = $_POST['supplier'];

    // Prepare the SQL statement to avoid SQL injection
    $stmt = $conn->prepare("UPDATE delivered_products 
                            SET partName = ?, category = ?, quantity = ?, price = ?, supplier = ? 
                            WHERE partID = ?");
    
    // Check if the statement was prepared successfully
    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }
    
    // Bind the parameters (s for string, i for integer, d for double)
    $stmt->bind_param("ssidsi", $partName, $category, $quantity, $price, $supplier, $id);

    // Execute the statement and check for success
    if ($stmt->execute()) {
        echo "Part updated successfully";
    } else {
        // Error handling
        echo "Error updating part: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();

} else {
    // Missing required data
    echo "Error: Missing or invalid input data.";
}

// Close the database connection
$conn->close();
?>

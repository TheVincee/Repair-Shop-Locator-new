<?php
header('Content-Type: application/json');
include 'db.php'; // Include your DB connection

if (isset($_POST['id'])) {
    $id = intval($_POST['id']); // Sanitize input
    $sql = "SELECT partID, partName, status FROM delivered_products WHERE partID = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
        echo json_encode($product);
    } else {
        echo json_encode(['error' => 'Product not found.']);
    }
    
    $stmt->close();
} else {
    echo json_encode(['error' => 'No ID provided.']);
}

$conn->close();
?>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "repair-shop-locator";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    http_response_code(500);
    die(json_encode(['error' => 'Connection failed: ' . $conn->connect_error]));
}

// Handle actions
$action = isset($_GET['action']) ? $_GET['action'] : '';

switch ($action) {
    case 'listByStatus':
        $status = $_GET['status'];
        $stmt = $conn->prepare("SELECT * FROM delivered_products WHERE status = ?");
        $stmt->bind_param('s', $status);
        $stmt->execute();
        $result = $stmt->get_result();

        $parts = [];
        while ($row = $result->fetch_assoc()) {
            $parts[] = $row;
        }
        echo json_encode($parts);
        break;

    case 'view':
        $partID = $_GET['id'];
        $stmt = $conn->prepare("SELECT * FROM delivered_products WHERE partID = ?");
        $stmt->bind_param('i', $partID);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo json_encode($result->fetch_assoc());
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'No part found']);
        }
        break;

    case 'insert':
        $partName = $_POST['partName'];
        $category = $_POST['category'];
        $quantity = $_POST['quantity'];
        $price = $_POST['price'];
        $supplier = $_POST['supplier'];
        $status = 'Pending'; // Default status

        $stmt = $conn->prepare("INSERT INTO delivered_products (partName, category, quantity, price, supplier, status) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('ssidsi', $partName, $category, $quantity, $price, $supplier, $status);

        if ($stmt->execute()) {
            echo json_encode(['success' => 'New part added successfully']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Error: ' . $stmt->error]);
        }
        break;

    case 'update':
        $partID = $_POST['partID'];
        $partName = $_POST['partName'];
        $category = $_POST['category'];
        $quantity = $_POST['quantity'];
        $price = $_POST['price'];
        $supplier = $_POST['supplier'];

        $stmt = $conn->prepare("UPDATE delivered_products SET partName = ?, category = ?, quantity = ?, price = ?, supplier = ? WHERE partID = ?");
        $stmt->bind_param('ssidsi', $partName, $category, $quantity, $price, $supplier, $partID);

        if ($stmt->execute()) {
            echo json_encode(['success' => 'Part updated successfully']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Error: ' . $stmt->error]);
        }
        break;

    case 'delete':
        $partID = $_GET['id'];

        $stmt = $conn->prepare("DELETE FROM delivered_products WHERE partID = ?");
        $stmt->bind_param('i', $partID);

        if ($stmt->execute()) {
            echo json_encode(['success' => 'Part deleted successfully']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Error: ' . $stmt->error]);
        }
        break;

    default:
        http_response_code(400);
        echo json_encode(['error' => 'Invalid action']);
        break;
}

$conn->close();
?>

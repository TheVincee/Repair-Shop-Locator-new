<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "repair-shop-locator";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle actions
$action = isset($_GET['action']) ? $_GET['action'] : (isset($_POST['action']) ? $_POST['action'] : '');

if ($action == 'list') {
    $sql = "SELECT * FROM inventory";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['partID']}</td>
                    <td>{$row['partName']}</td>
                    <td>{$row['category']}</td>
                    <td>{$row['quantity']}</td>
                    <td>{$row['price']}</td>
                    <td>{$row['supplier']}</td>
                    <td>
                        <button class='view-btn' data-id='{$row['partID']}'>View</button>
                        <button class='edit-btn' data-id='{$row['partID']}'>Edit</button>
                        <button class='delete-btn' data-id='{$row['partID']}'>Delete</button>
                    </td>
                </tr>";
        }
    } else {
        echo "<tr><td colspan='7'>No records found</td></tr>";
    }
}

if ($action == 'add') {
    $partName = $_POST['partName'];
    $category = $_POST['category'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $supplier = $_POST['supplier'];

    $sql = "INSERT INTO inventory (partName, category, quantity, price, supplier) VALUES ('$partName', '$category', '$quantity', '$price', '$supplier')";
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if ($action == 'edit') {
    $partID = $_POST['partID'];
    $partName = $_POST['partName'];
    $category = $_POST['category'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $supplier = $_POST['supplier'];

    $sql = "UPDATE inventory SET partName='$partName', category='$category', quantity='$quantity', price='$price', supplier='$supplier' WHERE partID='$partID'";
    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if ($action == 'delete') {
    $partID = $_POST['partID'];
    $sql = "DELETE FROM inventory WHERE partID='$partID'";
    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if ($action == 'view') {
    $partID = $_GET['id'];
    $sql = "SELECT * FROM inventory WHERE partID='$partID'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo json_encode($result->fetch_assoc());
    } else {
        echo json_encode(['error' => 'No record found']);
    }
}

$conn->close();
?>

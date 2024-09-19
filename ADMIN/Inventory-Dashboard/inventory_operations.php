<?php
header('Content-Type: application/json');

$action = $_GET['action'] ?? '';

$host = 'localhost'; // Database host
$db = 'repair-shop-locator'; // Database name
$user = 'root'; // Database username
$pass = ''; // Database password

$mysqli = new mysqli($host, $user, $pass, $db);

if ($mysqli->connect_error) {
    echo json_encode(['error' => 'Database connection failed']);
    exit();
}

switch ($action) {
    case 'listAllItems':
        $query = "
            SELECT partID, partName, category, quantity, price, supplier, NULL as status
            FROM inventory
            UNION ALL
            SELECT partID, partName, category, quantity, price, supplier, status
            FROM delivered_products
        ";
        $result = $mysqli->query($query);

        if ($result) {
            $items = [];
            while ($row = $result->fetch_assoc()) {
                $items[] = $row;
            }
            echo json_encode($items);
        } else {
            echo json_encode(['error' => 'Failed to fetch data', 'details' => $mysqli->error]);
        }
        break;

    case 'viewItem':
        $id = $mysqli->real_escape_string($_GET['id']);
        $query = "
            SELECT partID, partName, category, quantity, price, supplier, NULL as status
            FROM inventory 
            WHERE partID='$id'
            UNION ALL
            SELECT partID, partName, category, quantity, price, supplier, status 
            FROM delivered_products 
            WHERE partID='$id'
        ";
        $result = $mysqli->query($query);

        if ($result && $result->num_rows > 0) {
            echo json_encode($result->fetch_assoc());
        } else {
            echo json_encode(['error' => 'Item not found']);
        }
        break;

    case 'deleteItem':
        $id = $mysqli->real_escape_string($_GET['id']);
        $query = "
            DELETE FROM delivered_products WHERE partID='$id';
            DELETE FROM inventory WHERE partID='$id';
        ";
        if ($mysqli->multi_query($query)) {
            do {
                // While there are results, process them
                if ($result = $mysqli->store_result()) {
                    $result->free();
                }
            } while ($mysqli->more_results() && $mysqli->next_result());
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => $mysqli->error]);
        }
        break;

    default:
        echo json_encode(['error' => 'Invalid action']);
        break;
}

$mysqli->close();
?>

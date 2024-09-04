<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Table</title>
    <link rel="stylesheet" href="Product.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="header">
        <a href="Dashboard.php" class="back-button">Back</a>
        <h1>Parts Inventory</h1>
            <button class="add-button" onclick="openModal('Add')">Add New Part</button>
        </div>
        <table class="inventory-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Type</th>
                    <th>Part Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Car</td>
                    <td>Brake Pads</td>
                    <td>20</td>
                    <td>$50</td>
                    <td>
                        <button class="action-button" onclick="openModal('Edit', 1)">Edit</button>
                        <button class="action-button" onclick="openModal('Delete', 1)">Delete</button>
                        <button class="action-button" onclick="openModal('View', 1)">View</button>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Motorcycle</td>
                    <td>Oil Filter</td>
                    <td>15</td>
                    <td>$25</td>
                    <td>
                        <button class="action-button" onclick="openModal('Edit', 2)">Edit</button>
                        <button class="action-button" onclick="openModal('Delete', 2)">Delete</button>
                        <button class="action-button" onclick="openModal('View', 2)">View</button>
                    </td>
                </tr>
                <!-- Additional rows can be added here -->
            </tbody>
        </table>
    </div>

    <!-- Modal Structure -->
    <div id="modal" class="modal">
        <div class="modal-content">
            <span class="close-button" onclick="closeModal()">&times;</span>
            <h2 id="modal-title">Modal Title</h2>
            <div id="modal-form" style="display: none;">
                <form id="part-form">
                    
                    <div class="row">
                        <div class="col">
                            <input type="text" id="part-type" name="part-type" class="form-control" placeholder="Type">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <input type="text" id="part-name" name="part-name" class="form-control" placeholder="Part Name">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <input type="number" id="part-quantity" name="part-quantity" class="form-control" placeholder="Quantity">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <input type="text" id="part-price" name="part-price" class="form-control" placeholder="Price">
                        </div>
                    </div>
                </form>
            </div>
            <p id="modal-message">Modal content goes here.</p>
            <div id="modal-buttons">
                <button id="modal-confirm" class="modal-button">Confirm</button>
                <button id="modal-cancel" class="modal-button" onclick="closeModal()">Cancel</button>
                <button id="modal-back" class="modal-button" onclick="goBack()" style="display: none;">Back</button>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="script.js"></script>
</body>
</html>

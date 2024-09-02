<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory System</title>
    <link rel="stylesheet" href="Inventory.css">
</head>
<body>
    <div class="container">
        <a href="previous-page.html" class="btn btn-back">Back</a> <!-- Link to previous page -->
        <h1>Inventory System</h1>
        <button class="btn btn-add" onclick="openModal('add-modal')">Add Product</button>
        <table class="inventory-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Item A</td>
                    <td>20</td>
                    <td>$30</td>
                    <td>
                        <button class="btn btn-view" onclick="openModal('view-modal')">View</button>
                        <button class="btn btn-update" onclick="openModal('update-modal')">Update</button>
                        <button class="btn btn-delete" onclick="openModal('delete-modal')">Delete</button>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Item B</td>
                    <td>15</td>
                    <td>$45</td>
                    <td>
                        <button class="btn btn-view" onclick="openModal('view-modal')">View</button>
                        <button class="btn btn-update" onclick="openModal('update-modal')">Update</button>
                        <button class="btn btn-delete" onclick="openModal('delete-modal')">Delete</button>
                    </td>
                </tr>
                <!-- Add more example rows as needed -->
            </tbody>
        </table>
    </div>

    <!-- View Modal -->
    <div id="view-modal" class="modal-overlay">
        <div class="modal-content">
            <div class="modal-header">
                <h2>View Item</h2>
                <span class="close" onclick="closeModal('view-modal')">&times;</span>
            </div>
            <div class="modal-body">
                <p><strong>ID:</strong> <span id="view-id">1</span></p>
                <p><strong>Name:</strong> <span id="view-name">Item A</span></p>
                <p><strong>Quantity:</strong> <span id="view-quantity">20</span></p>
                <p><strong>Price:</strong> <span id="view-price">$30</span></p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-close" onclick="closeModal('view-modal')">Close</button>
            </div>
        </div>
    </div>

    <!-- Update Modal -->
    <div id="update-modal" class="modal-overlay">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Update Item</h2>
                <span class="close" onclick="closeModal('update-modal')">&times;</span>
            </div>
            <div class="modal-body">
                <form id="update-form">
                    <label for="update-id">ID:</label>
                    <input type="text" id="update-id" name="update-id" disabled>

                    <label for="update-name">Name:</label>
                    <input type="text" id="update-name" name="update-name" required>

                    <label for="update-quantity">Quantity:</label>
                    <input type="number" id="update-quantity" name="update-quantity" required>

                    <label for="update-price">Price:</label>
                    <input type="text" id="update-price" name="update-price" required>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-save" onclick="saveUpdates()">Save</button>
                <button class="btn btn-close" onclick="closeModal('update-modal')">Cancel</button>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div id="delete-modal" class="modal-overlay">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Delete Item</h2>
                <span class="close" onclick="closeModal('delete-modal')">&times;</span>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this item?</p>
                <p><strong>ID:</strong> <span id="delete-id">1</span></p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-confirm" onclick="confirmDelete()">Delete</button>
                <button class="btn btn-close" onclick="closeModal('delete-modal')">Cancel</button>
            </div>
        </div>
    </div>

    <!-- Add Product Modal -->
    <div id="add-modal" class="modal-overlay">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Add Product</h2>
                <span class="close" onclick="closeModal('add-modal')">&times;</span>
            </div>
            <div class="modal-body">
                <form id="add-form">
                    <label for="add-name">Name:</label>
                    <input type="text" id="add-name" name="add-name" required>

                    <label for="add-quantity">Quantity:</label>
                    <input type="number" id="add-quantity" name="add-quantity" required>

                    <label for="add-price">Price:</label>
                    <input type="text" id="add-price" name="add-price" required>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-add" onclick="addProduct()">Add</button>
                <button class="btn btn-close" onclick="closeModal('add-modal')">Cancel</button>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Repair Shop Inventory</title>
    <style>
        /* Add your styles here */
        .modal {
            display: none; 
            position: fixed; 
            z-index: 1; 
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto; 
            background-color: rgb(0,0,0); 
            background-color: rgba(0,0,0,0.4); 
            padding-top: 60px;
        }
        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>
    <h1>Repair Shop Inventory</h1>
    <button id="addBtn">Add Part</button>
    <table>
        <thead>
            <tr>
                <th>Part ID</th>
                <th>Part Name</th>
                <th>Category</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Supplier</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="inventoryTable">
            <!-- Dynamic rows will be loaded here -->
        </tbody>
    </table>

    <!-- Add Modal -->
    <div id="addModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeAdd">&times;</span>
            <h2>Add New Part</h2>
            <form id="addForm">
                <label for="partName">Part Name:</label>
                <input type="text" id="partName" name="partName" required><br><br>
                <label for="category">Category:</label>
                <select id="category" name="category" required>
                    <option value="Motorcycle">Motorcycle</option>
                    <option value="Car">Car</option>
                </select><br><br>
                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" name="quantity" required><br><br>
                <label for="price">Price:</label>
                <input type="number" id="price" name="price" step="0.01" required><br><br>
                <label for="supplier">Supplier:</label>
                <input type="text" id="supplier" name="supplier" required><br><br>
                <input type="submit" value="Add Part">
            </form>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeEdit">&times;</span>
            <h2>Edit Part</h2>
            <form id="editForm">
                <input type="hidden" id="editPartID" name="partID">
                <label for="editPartName">Part Name:</label>
                <input type="text" id="editPartName" name="partName" required><br><br>
                <label for="editCategory">Category:</label>
                <select id="editCategory" name="category" required>
                    <option value="Motorcycle">Motorcycle</option>
                    <option value="Car">Car</option>
                </select><br><br>
                <label for="editQuantity">Quantity:</label>
                <input type="number" id="editQuantity" name="quantity" required><br><br>
                <label for="editPrice">Price:</label>
                <input type="number" id="editPrice" name="price" step="0.01" required><br><br>
                <label for="editSupplier">Supplier:</label>
                <input type="text" id="editSupplier" name="supplier" required><br><br>
                <input type="submit" value="Save Changes">
            </form>
        </div>
    </div>

    <!-- Delete Modal -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeDelete">&times;</span>
            <h2>Delete Part</h2>
            <p>Are you sure you want to delete this part?</p>
            <form id="deleteForm">
                <input type="hidden" id="deletePartID" name="partID">
                <input type="submit" value="Delete">
            </form>
        </div>
    </div>

    <!-- View Modal -->
    <div id="viewModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeView">&times;</span>
            <h2>View Part</h2>
            <div id="viewDetails">
                <!-- Part details will be loaded here -->
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Open Add Modal
            document.getElementById('addBtn').onclick = function() {
                document.getElementById('addModal').style.display = 'block';
            }

            // Close Modals
            document.getElementById('closeAdd').onclick = function() {
                document.getElementById('addModal').style.display = 'none';
            }
            document.getElementById('closeEdit').onclick = function() {
                document.getElementById('editModal').style.display = 'none';
            }
            document.getElementById('closeDelete').onclick = function() {
                document.getElementById('deleteModal').style.display = 'none';
            }
            document.getElementById('closeView').onclick = function() {
                document.getElementById('viewModal').style.display = 'none';
            }

            // Fetch inventory and populate table
            function loadInventory() {
                const xhr = new XMLHttpRequest();
                xhr.open('GET', 'inventory.php?action=list', true);
                xhr.onload = function() {
                    if (this.status == 200) {
                        document.getElementById('inventoryTable').innerHTML = this.responseText;
                    }
                }
                xhr.send();
            }
            loadInventory();

            // Add Part
            document.getElementById('addForm').onsubmit = function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                const xhr = new XMLHttpRequest();
                xhr.open('POST', 'inventory.php?action=add', true);
                xhr.onload = function() {
                    if (this.status == 200) {
                        loadInventory();
                        document.getElementById('addModal').style.display = 'none';
                    }
                }
                xhr.send(formData);
            }

            // Edit Part
            document.addEventListener('click', function(e) {
                if (e.target.classList.contains('edit-btn')) {
                    const partID = e.target.getAttribute('data-id');
                    const xhr = new XMLHttpRequest();
                    xhr.open('GET', `inventory.php?action=view&id=${partID}`, true);
                    xhr.onload = function() {
                        if (this.status == 200) {
                            const data = JSON.parse(this.responseText);
                            document.getElementById('editPartID').value = data.partID;
                            document.getElementById('editPartName').value = data.partName;
                            document.getElementById('editCategory').value = data.category;
                            document.getElementById('editQuantity').value = data.quantity;
                            document.getElementById('editPrice').value = data.price;
                            document.getElementById('editSupplier').value = data.supplier;
                            document.getElementById('editModal').style.display = 'block';
                        }
                    }
                    xhr.send();
                }
            });

            document.getElementById('editForm').onsubmit = function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                const xhr = new XMLHttpRequest();
                xhr.open('POST', 'inventory.php?action=edit', true);
                xhr.onload = function() {
                    if (this.status == 200) {
                        loadInventory();
                        document.getElementById('editModal').style.display = 'none';
                    }
                }
                xhr.send(formData);
            }

            // Delete Part
            document.addEventListener('click', function(e) {
                if (e.target.classList.contains('delete-btn')) {
                    const partID = e.target.getAttribute('data-id');
                    document.getElementById('deletePartID').value = partID;
                    document.getElementById('deleteModal').style.display = 'block';
                }
            });

            document.getElementById('deleteForm').onsubmit = function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                const xhr = new XMLHttpRequest();
                xhr.open('POST', 'inventory.php?action=delete', true);
                xhr.onload = function() {
                    if (this.status == 200) {
                        loadInventory();
                        document.getElementById('deleteModal').style.display = 'none';
                    }
                }
                xhr.send(formData);
            }

            // View Part
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('view-btn')) {
        const partID = e.target.getAttribute('data-id');
        const xhr = new XMLHttpRequest();
        xhr.open('GET', `inventory.php?action=view&id=${partID}`, true);
        xhr.onload = function() {
            if (this.status == 200) {
                const data = JSON.parse(this.responseText);
                if (!data.error) {
                    document.getElementById('viewDetails').innerHTML = `
                        <p><strong>Part ID:</strong> ${data.partID}</p>
                        <p><strong>Part Name:</strong> ${data.partName}</p>
                        <p><strong>Category:</strong> ${data.category}</p>
                        <p><strong>Quantity:</strong> ${data.quantity}</p>
                        <p><strong>Price:</strong> $${data.price.toFixed(2)}</p>
                        <p><strong>Supplier:</strong> ${data.supplier}</p>
                    `;
                    document.getElementById('viewModal').style.display = 'block';
                } else {
                    alert(data.error);
                }
            }
        }
        xhr.send();
    }
});

document.getElementById('closeView').onclick = function() {
    document.getElementById('viewModal').style.display = 'none';
}

        });
    </script>
</body>
</html>

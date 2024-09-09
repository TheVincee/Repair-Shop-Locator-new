<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Repair Shop Inventory</title>
    <style>
        /* Add your styles here */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
        }
        button, input[type="submit"] {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s, box-shadow 0.3s;
        }
        button:hover, input[type="submit"]:hover {
            background-color: #0056b3;
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
        }
        .modal {
            display: none; 
            position: fixed; 
            z-index: 1; 
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto; 
            background-color: rgba(0, 0, 0, 0.4); 
            padding-top: 60px;
        }
        .modal-content {
            background-color: #fff;
            margin: 5% auto;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 70%;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }
        .close:hover {
            color: #000;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            border: 2px solid #ddd;
        }
        th, td {
            border: 2px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .back-btn {
            display: inline-block;
            margin: 20px 0;
            text-decoration: none;
            color: #007bff;
            font-size: 18px;
            font-weight: bold;
            border: 1px solid #007bff;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }
        .back-btn:hover {
            background-color: #007bff;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Repair Shop Inventory</h1>
        <a href="DashboardInventory.php" class="back-btn">&larr; Back</a>
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
                            try {
                                const data = JSON.parse(this.responseText);

                                // Ensure price is a valid number before calling .toFixed()
                                const price = parseFloat(data.price);
                                const formattedPrice = isNaN(price) ? "N/A" : `$${price.toFixed(2)}`;

                                // Display part details in the view modal
                                document.getElementById('viewDetails').innerHTML = `
                                    <p><strong>Part ID:</strong> ${data.partID || 'N/A'}</p>
                                    <p><strong>Part Name:</strong> ${data.partName || 'N/A'}</p>
                                    <p><strong>Category:</strong> ${data.category || 'N/A'}</p>
                                    <p><strong>Quantity:</strong> ${data.quantity || 'N/A'}</p>
                                    <p><strong>Price:</strong> ${formattedPrice}</p>
                                    <p><strong>Supplier:</strong> ${data.supplier || 'N/A'}</p>
                                `;
                                document.getElementById('viewModal').style.display = 'block';
                            } catch (error) {
                                console.error("Error parsing JSON data:", error);
                            }
                        } else {
                            console.error('Error loading part data:', this.statusText);
                        }
                    }
                    xhr.onerror = function() {
                        console.error('Request failed');
                    };
                    xhr.send();
                }
            });
        });
    </script>
</body>
</html>

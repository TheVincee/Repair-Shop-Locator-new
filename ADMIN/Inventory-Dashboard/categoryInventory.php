<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* General Styles */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        h1 {
            text-align: center;
            margin-top: 20px;
            color: #333;
        }

        /* Table Styles */
        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
            background-color: #fff;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        th {
            background-color: #007BFF;
            color: #fff;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #e2e2e2;
            transform: scale(1.02);
        }

        /* Button Styles */
        button {
            background-color: #007BFF;
            color: #fff;
            border: none;
            padding: 12px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        button:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        /* Modal Styles */
        .modal {
            display: none; 
            position: fixed; 
            z-index: 1000; 
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto; 
            background-color: rgba(0,0,0,0.4); 
            padding-top: 60px;
        }
        .modal-content {
            background-color: #fff;
            margin: 5% auto;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            width: 80%;
            max-width: 500px;
            transform: translateY(-20px);
            opacity: 0;
            transition: opacity 0.3s ease, transform 0.3s ease;
        }
        .modal-content.show {
            opacity: 1;
            transform: translateY(0);
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
        }
        .modal-content input[type="text"],
        .modal-content input[type="number"],
        .modal-content select {
            width: calc(100% - 20px);
            padding: 10px;
            margin: 10px 0;
            border-radius: 4px;
            border: 1px solid #ddd;
        }
        .modal-content input[type="submit"] {
            background-color: #007BFF;
            color: #fff;
            border: none;
            padding: 12px 20px;
            cursor: pointer;
            border-radius: 4px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        .modal-content input[type="submit"]:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <h1>Inventory Management</h1>
    
    <!-- Motorcycle Table -->
    <h2>Motorcycle Parts</h2>
    <table id="motorcycleTable">
        <thead>
            <tr>
                <th>Part ID</th>
                <th>Part Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Supplier</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="motorcycleTableBody">
            <!-- Table rows will be populated here via AJAX -->
        </tbody>
    </table>

    <!-- Car Table -->
    <h2>Car Parts</h2>
    <table id="carTable">
        <thead>
            <tr>
                <th>Part ID</th>
                <th>Part Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Supplier</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="carTableBody">
            <!-- Table rows will be populated here via AJAX -->
        </tbody>
    </table>

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

    <!-- Edit Modal -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeEdit">&times;</span>
            <h2>Edit Part</h2>
            <form id="editForm">
                <input type="hidden" id="editPartID" name="partID">
                <label for="editPartName">Part Name:</label>
                <input type="text" id="editPartName" name="partName" required><br>
                <label for="editCategory">Category:</label>
                <select id="editCategory" name="category" required>
                    <option value="Motorcycle">Motorcycle</option>
                    <option value="Car">Car</option>
                </select><br>
                <label for="editQuantity">Quantity:</label>
                <input type="number" id="editQuantity" name="quantity" required><br>
                <label for="editPrice">Price:</label>
                <input type="number" id="editPrice" name="price" step="0.01" required><br>
                <label for="editSupplier">Supplier:</label>
                <input type="text" id="editSupplier" name="supplier" required><br>
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

    <!-- JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Load inventory tables
            function loadInventory() {
                const xhr = new XMLHttpRequest();
                xhr.open('GET', 'InventoryCetegory.php?action=list', true);
                xhr.onload = function() {
                    if (this.status == 200) {
                        const data = JSON.parse(this.responseText);
                        if (!data.error) {
                            let motorcycleHtml = '';
                            let carHtml = '';

                            data.forEach(part => {
                                const row = `<tr>
                                    <td>${part.partID}</td>
                                    <td>${part.partName}</td>
                                    <td>${part.quantity}</td>
                                    <td>${part.price}</td>
                                    <td>${part.supplier}</td>
                                    <td>
                                        <button class='view-btn' data-id='${part.partID}'>View</button>
                                        <button class='edit-btn' data-id='${part.partID}'>Edit</button>
                                        <button class='delete-btn' data-id='${part.partID}'>Delete</button>
                                    </td>
                                </tr>`;

                                if (part.category === 'Motorcycle') {
                                    motorcycleHtml += row;
                                } else if (part.category === 'Car') {
                                    carHtml += row;
                                }
                            });

                            document.getElementById('motorcycleTableBody').innerHTML = motorcycleHtml;
                            document.getElementById('carTableBody').innerHTML = carHtml;
                        } else {
                            alert(data.error);
                        }
                    }
                }
                xhr.send();
            }

            loadInventory();

            // View Part
            document.addEventListener('click', function(e) {
                if (e.target.classList.contains('view-btn')) {
                    const partID = e.target.getAttribute('data-id');
                    const xhr = new XMLHttpRequest();
                    xhr.open('GET', `InventoryCetegory.php?action=view&id=${partID}`, true);
                    xhr.onload = function() {
                        if (this.status == 200) {
                            const data = JSON.parse(this.responseText);
                            if (!data.error) {
                                document.getElementById('viewDetails').innerHTML = `
                                    <p><strong>Part ID:</strong> ${data.partID}</p>
                                    <p><strong>Part Name:</strong> ${data.partName}</p>
                                    <p><strong>Category:</strong> ${data.category}</p>
                                    <p><strong>Quantity:</strong> ${data.quantity}</p>
                                    <p><strong>Price:</strong> $${data.price}</p>
                                    <p><strong>Supplier:</strong> ${data.supplier}</p>
                                `;
                                document.getElementById('viewModal').querySelector('.modal-content').classList.add('show');
                                document.getElementById('viewModal').style.display = 'block';
                            } else {
                                alert(data.error);
                            }
                        }
                    }
                    xhr.send();
                }

                if (e.target.classList.contains('edit-btn')) {
                    const partID = e.target.getAttribute('data-id');
                    const xhr = new XMLHttpRequest();
                    xhr.open('GET', `InventoryCetegory.php?action=view&id=${partID}`, true);
                    xhr.onload = function() {
                        if (this.status == 200) {
                            const data = JSON.parse(this.responseText);
                            if (!data.error) {
                                document.getElementById('editPartID').value = data.partID;
                                document.getElementById('editPartName').value = data.partName;
                                document.getElementById('editCategory').value = data.category;
                                document.getElementById('editQuantity').value = data.quantity;
                                document.getElementById('editPrice').value = data.price;
                                document.getElementById('editSupplier').value = data.supplier;
                                document.getElementById('editModal').querySelector('.modal-content').classList.add('show');
                                document.getElementById('editModal').style.display = 'block';
                            } else {
                                alert(data.error);
                            }
                        }
                    }
                    xhr.send();
                }

                if (e.target.classList.contains('delete-btn')) {
                    const partID = e.target.getAttribute('data-id');
                    document.getElementById('deletePartID').value = partID;
                    document.getElementById('deleteModal').querySelector('.modal-content').classList.add('show');
                    document.getElementById('deleteModal').style.display = 'block';
                }
            });

            document.getElementById('closeView').onclick = function() {
                document.getElementById('viewModal').style.display = 'none';
                document.getElementById('viewModal').querySelector('.modal-content').classList.remove('show');
            }

            document.getElementById('closeEdit').onclick = function() {
                document.getElementById('editModal').style.display = 'none';
                document.getElementById('editModal').querySelector('.modal-content').classList.remove('show');
            }

            document.getElementById('closeDelete').onclick = function() {
                document.getElementById('deleteModal').style.display = 'none';
                document.getElementById('deleteModal').querySelector('.modal-content').classList.remove('show');
            }

            window.onclick = function(event) {
                if (event.target === document.getElementById('viewModal') ||
                    event.target === document.getElementById('editModal') ||
                    event.target === document.getElementById('deleteModal')) {
                    document.getElementById('viewModal').style.display = 'none';
                    document.getElementById('editModal').style.display = 'none';
                    document.getElementById('deleteModal').style.display = 'none';
                    document.getElementById('viewModal').querySelector('.modal-content').classList.remove('show');
                    document.getElementById('editModal').querySelector('.modal-content').classList.remove('show');
                    document.getElementById('deleteModal').querySelector('.modal-content').classList.remove('show');
                }
            }

            // Edit Part
            document.getElementById('editForm').onsubmit = function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                const xhr = new XMLHttpRequest();
                xhr.open('POST', 'InventoryCetegory.php?action=edit', true);
                xhr.onload = function() {
                    if (this.status == 200) {
                        loadInventory();
                        document.getElementById('editModal').style.display = 'none';
                        document.getElementById('editModal').querySelector('.modal-content').classList.remove('show');
                    }
                }
                xhr.send(formData);
            }

            // Delete Part
            document.getElementById('deleteForm').onsubmit = function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                const xhr = new XMLHttpRequest();
                xhr.open('POST', 'InventoryCetegory.php?action=delete', true);
                xhr.onload = function() {
                    if (this.status == 200) {
                        loadInventory();
                        document.getElementById('deleteModal').style.display = 'none';
                        document.getElementById('deleteModal').querySelector('.modal-content').classList.remove('show');
                    }
                }
                xhr.send(formData);
            }
        });
    </script>
</body>
</html>

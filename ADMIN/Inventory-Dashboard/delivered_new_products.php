    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Delivered New Products</title>
        <link rel="stylesheet" href="./CSS/DeliveryInventory.css">
    </head>
    <body>
        <h1>Delivered New Products</h1>

        <!-- Back Button -->
        <a href="previousPage.html" class="back-button">Back</a>
        <button id="addNewPartBtn" class="action-btn">Add New Part</button>

        <!-- Delivered New Products Table -->
        <table id="deliveredNewProductsTable">
            <thead>
                <tr>
                    <th>Part ID</th>
                    <th>Part Name</th>
                    <th>Category</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Supplier</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="deliveredNewProductsTableBody">
                <!-- Table rows will be populated here via AJAX -->
            </tbody>
        </table>

        <!-- Add New Part Button -->

        <!-- Add Modal -->
        <div id="addModal" class="modal">
            <div class="modal-content">
                <span class="close" id="closeAdd">&times;</span>
                <h2>Add New Part</h2>
                <form id="addForm">
                    <input type="text" id="addPartName" placeholder="Part Name" required>
                    <input type="text" id="addCategory" placeholder="Category" required>
                    <input type="number" id="addQuantity" placeholder="Quantity" required>
                    <input type="number" id="addPrice" placeholder="Price" step="0.01" required>
                    <input type="text" id="addSupplier" placeholder="Supplier" required>
                    <button type="submit" class="submit-btn">Add Part</button>
                </form>
            </div>
        </div>

        <!-- Edit Modal -->
        <div id="editModal" class="modal">
            <div class="modal-content">
                <span class="close" id="closeEdit">&times;</span>
                <h2>Edit Part</h2>
                <form id="editForm">
                    <input type="hidden" id="editPartID">
                    <input type="text" id="editPartName" placeholder="Part Name" required>
                    <input type="text" id="editCategory" placeholder="Category" required>
                    <input type="number" id="editQuantity" placeholder="Quantity" required>
                    <input type="number" id="editPrice" placeholder="Price" step="0.01" required>
                    <input type="text" id="editSupplier" placeholder="Supplier" required>
                    <button type="submit" class="submit-btn">Save Changes</button>
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
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!-- JavaScript -->
        <script>
        $(document).ready(function() {
        // Load delivered new products
        function loadDeliveredNewProducts() {
            $.ajax({
                url: 'status_operations.php',
                method: 'GET',
                data: { action: 'listByStatus', status: 'Delivered New' },
                success: function(response) {
                    const data = JSON.parse(response);
                    if (Array.isArray(data)) {
                        let html = '';
                        data.forEach(function(part) {
                            html += `<tr>
                                <td>${part.partID}</td>
                                <td>${part.partName}</td>
                                <td>${part.category}</td>
                                <td>${part.quantity}</td>
                                <td>${part.price}</td>
                                <td>${part.supplier}</td>
                                <td>${part.status}</td>
                                <td>
                                    <button class='view-btn' data-id='${part.partID}'>View</button>
                                    <button class='edit-btn' data-id='${part.partID}'>Edit</button>
                                    <button class='delete-btn' data-id='${part.partID}'>Delete</button>
                                </td>
                            </tr>`;
                        });
                        $('#deliveredNewProductsTableBody').html(html);
                    } else {
                        alert('Error fetching data');
                    }
                }
            });
        }

        loadDeliveredNewProducts();

        // Show Add Modal
        $('#addNewPartBtn').click(function() {
            $('#addModal').show();
        });

        // Close Add Modal
        $('#closeAdd').click(function() {
            $('#addModal').hide();
        });

        // Add New Part Form Submission
        $('#addForm').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: 'status_operations.php',
                method: 'POST',
                data: {
                    action: 'insert',
                    partName: $('#addPartName').val(),
                    category: $('#addCategory').val(),
                    quantity: $('#addQuantity').val(),
                    price: $('#addPrice').val(),
                    supplier: $('#addSupplier').val()
                },
                success: function(response) {
                    const data = JSON.parse(response);
                    if (data.success) {
                        alert(data.success);
                        loadDeliveredNewProducts();
                        $('#addModal').hide();
                    } else {
                        alert(data.error);
                    }
                }
            });
        });

        // Event delegation for View, Edit, and Delete buttons
        $(document).on('click', '.view-btn', function() {
            const partID = $(this).data('id');
            $.ajax({
                url: 'status_operations.php',
                method: 'GET',
                data: { action: 'view', id: partID },
                success: function(response) {
                    const data = JSON.parse(response);
                    if (!data.error) {
                        $('#viewDetails').html(`
                            <p><strong>Part ID:</strong> ${data.partID}</p>
                            <p><strong>Part Name:</strong> ${data.partName}</p>
                            <p><strong>Category:</strong> ${data.category}</p>
                            <p><strong>Quantity:</strong> ${data.quantity}</p>
                            <p><strong>Price:</strong> $${data.price.toFixed(2)}</p>
                            <p><strong>Supplier:</strong> ${data.supplier}</p>
                            <p><strong>Status:</strong> ${data.status}</p>
                        `);
                        $('#viewModal').show();
                    } else {
                        alert(data.error);
                    }
                }
            });
        });

        $(document).on('click', '.edit-btn', function() {
            const partID = $(this).data('id');
            $.ajax({
                url: 'status_operations.php',
                method: 'GET',
                data: { action: 'view', id: partID },
                success: function(response) {
                    const data = JSON.parse(response);
                    if (!data.error) {
                        $('#editPartID').val(data.partID);
                        $('#editPartName').val(data.partName);
                        $('#editCategory').val(data.category);
                        $('#editQuantity').val(data.quantity);
                        $('#editPrice').val(data.price);
                        $('#editSupplier').val(data.supplier);
                        $('#editModal').show();
                    } else {
                        alert(data.error);
                    }
                }
            });
        });

        // Close Edit Modal
        $('#closeEdit').click(function() {
            $('#editModal').hide();
        });

        // Edit Form Submission
        $('#editForm').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: 'status_operations.php',
                method: 'POST',
                data: {
                    action: 'update',
                    partID: $('#editPartID').val(),
                    partName: $('#editPartName').val(),
                    category: $('#editCategory').val(),
                    quantity: $('#editQuantity').val(),
                    price: $('#editPrice').val(),
                    supplier: $('#editSupplier').val()
                },
                success: function(response) {
                    const data = JSON.parse(response);
                    if (data.success) {
                        alert(data.success);
                        loadDeliveredNewProducts();
                        $('#editModal').hide();
                    } else {
                        alert(data.error);
                    }
                }
            });
        });

        $(document).on('click', '.delete-btn', function() {
            const partID = $(this).data('id');
            if (confirm('Are you sure you want to delete this part?')) {
                $.ajax({
                    url: 'status_operations.php',
                    method: 'GET',
                    data: { action: 'delete', id: partID },
                    success: function(response) {
                        const data = JSON.parse(response);
                        if (data.success) {
                            alert(data.success);
                            loadDeliveredNewProducts();
                        } else {
                            alert(data.error);
                        }
                    }
                });
            }
        });

        // Close View Modal
        $('#closeView').click(function() {
            $('#viewModal').hide();
        });

        // Close Modals when clicking outside
        $(window).click(function(event) {
            if ($(event.target).is('#addModal, #editModal, #viewModal')) {
                $(event.target).hide();
            }
        });
    });

        </script>
    </body>
    </html>

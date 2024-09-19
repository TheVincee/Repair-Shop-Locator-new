<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Items</title>
    <link rel="stylesheet" href="CSS/styles.css"> <!-- Custom CSS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        /* Basic styling for the page */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .back-button {
            display: inline-block;
            margin: 20px;
            font-size: 16px;
            text-decoration: none;
            color: #007bff;
        }

        h1 {
            text-align: center;
            margin: 20px 0;
        }

        .table-container {
            width: 90%;
            margin: 0 auto;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 10px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .btn {
            padding: 5px 10px;
            font-size: 14px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            margin: 2px;
        }

        .view-btn {
            background-color: #17a2b8;
            color: white;
        }

        .edit-btn {
            background-color: #ffc107;
            color: black;
        }

        .delete-btn {
            background-color: #dc3545;
            color: white;
        }

        /* Modal styling */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            width: 80%;
            max-width: 600px;
        }

        .close {
            position: absolute;
            top: 10px;
            right: 20px;
            font-size: 24px;
            cursor: pointer;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 3px;
        }

        .btn-primary {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 15px;
            font-size: 16px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <!-- Back Button -->
    <a href="DashboardInventory.php" class="back-button">← Back</a>

    <h1>All Items</h1>

    
    <!-- All Items Table -->
    <div class="table-container">
        <table id="allItemsTable">
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
            <tbody id="allItemsTableBody">
                <!-- Table rows will be populated here via AJAX -->
            </tbody>
        </table>
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

    <!-- Edit Modal -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeEdit">&times;</span>
            <h2>Edit Part</h2>
            <form id="editForm">
                <input type="hidden" id="editPartID" name="partID">
                <div class="form-group">
                    <label for="editPartName">Part Name:</label>
                    <input type="text" id="editPartName" name="partName" required>
                </div>
                <div class="form-group">
                    <label for="editCategory">Category:</label>
                    <input type="text" id="editCategory" name="category" required>
                </div>
                <div class="form-group">
                    <label for="editQuantity">Quantity:</label>
                    <input type="number" id="editQuantity" name="quantity" required>
                </div>
                <div class="form-group">
                    <label for="editPrice">Price:</label>
                    <input type="text" id="editPrice" name="price" required>
                </div>
                <div class="form-group">
                    <label for="editSupplier">Supplier:</label>
                    <input type="text" id="editSupplier" name="supplier" required>
                </div>
                <div class="form-group">
                    <label for="editStatus">Status:</label>
                    <input type="text" id="editStatus" name="status" required>
                </div>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </form>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        $(document).ready(function() {
            function loadAllItems() {
                $.ajax({
                    url: 'inventory_operations.php',
                    type: 'GET',
                    data: { action: 'listAllItems' },
                    dataType: 'json',
                    success: function(data) {
                        if (Array.isArray(data)) {
                            var html = '';
                            $.each(data, function(index, item) {
                                html += '<tr>' +
                                    '<td>' + item.partID + '</td>' +
                                    '<td>' + item.partName + '</td>' +
                                    '<td>' + item.category + '</td>' +
                                    '<td>' + item.quantity + '</td>' +
                                    '<td>$' + parseFloat(item.price).toFixed(2) + '</td>' +
                                    '<td>' + item.supplier + '</td>' +
                                    '<td>' + (item.status !== null ? item.status : 'N/A') + '</td>' +
                                    '<td>' +
                                    '<button class="view-btn" data-id="' + item.partID + '">View</button>' +
                                    '<button class="edit-btn" data-id="' + item.partID + '">Edit</button>' +
                                    '<button class="delete-btn" data-id="' + item.partID + '">Delete</button>' +
                                    '</td>' +
                                    '</tr>';
                            });
                            $('#allItemsTableBody').html(html);
                        } else {
                            console.error('Invalid data format');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching data: ' + error);
                    }
                });
            }

            loadAllItems();

            $(document).on('click', '.view-btn', function() {
                var id = $(this).data('id');
                $.ajax({
                    url: 'inventory_operations.php',
                    type: 'GET',
                    data: { action: 'viewItem', id: id },
                    dataType: 'json',
                    success: function(data) {
                        if (data) {
                            $('#viewDetails').html(
                                '<p><strong>Part ID:</strong> ' + data.partID + '</p>' +
                                '<p><strong>Part Name:</strong> ' + data.partName + '</p>' +
                                '<p><strong>Category:</strong> ' + data.category + '</p>' +
                                '<p><strong>Quantity:</strong> ' + data.quantity + '</p>' +
                                '<p><strong>Price:</strong> $' + parseFloat(data.price).toFixed(2) + '</p>' +
                                '<p><strong>Supplier:</strong> ' + data.supplier + '</p>' +
                                '<p><strong>Status:</strong> ' + (data.status !== null ? data.status : 'N/A') + '</p>'
                            );
                            $('#viewModal').show();
                        } else {
                            console.error('Invalid data format');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching data: ' + error);
                    }
                });
            });

            $(document).on('click', '.edit-btn', function() {
                var id = $(this).data('id');
                $.ajax({
                    url: 'inventory_operations.php',
                    type: 'GET',
                    data: { action: 'viewItem', id: id },
                    dataType: 'json',
                    success: function(data) {
                        if (data) {
                            $('#editPartID').val(data.partID);
                            $('#editPartName').val(data.partName);
                            $('#editCategory').val(data.category);
                            $('#editQuantity').val(data.quantity);
                            $('#editPrice').val(data.price);
                            $('#editSupplier').val(data.supplier);
                            $('#editStatus').val(data.status || 'N/A');
                            $('#editModal').show();
                        } else {
                            console.error('Invalid data format');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching data: ' + error);
                    }
                });
            });

            $(document).on('click', '.delete-btn', function() {
                var id = $(this).data('id');
                if (confirm('Are you sure you want to delete this item?')) {
                    $.ajax({
                        url: 'inventory_operations.php',
                        type: 'GET',
                        data: { action: 'deleteItem', id: id },
                        dataType: 'json',
                        success: function(data) {
                            if (data.success) {
                                loadAllItems();
                            } else {
                                console.error('Error deleting item: ' + data.error);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Error deleting item: ' + error);
                        }
                    });
                }
            });

            $('#editForm').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: 'inventory_edit_operations.php',
                    type: 'POST',
                    data: $(this).serialize() + '&action=updateItem',
                    dataType: 'json',
                    success: function(data) {
                        if (data.success) {
                            $('#editModal').hide();
                            loadAllItems();
                        } else {
                            console.error('Error updating item: ' + data.error);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error updating item: ' + error);
                    }
                });
            });

            $('#closeView').on('click', function() {
                $('#viewModal').hide();
            });

            $('#closeEdit').on('click', function() {
                $('#editModal').hide();
            });

            $(window).on('click', function(event) {
                if ($(event.target).is('#viewModal')) {
                    $('#viewModal').hide();
                }
                if ($(event.target).is('#editModal')) {
                    $('#editModal').hide();
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // When search button is clicked
            $('#customSearchButton').on('click', function() {
                var searchQuery = $('#customSearchInput').val();
                var categoryFilter = $('#categoryFilter').val();

                // Perform AJAX request to fetch filtered items
                $.ajax({
                    url: 'FilterSearch.php',
                    type: 'GET',
                    data: { 
                        search: searchQuery, 
                        category: categoryFilter 
                    },
                    success: function(response) {
                        $('#itemsTable tbody').html(response); // Populate table body with the response
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX Error: " + status + error);
                    }
                });
            });
        });
    </script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parts Inventory</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
        }
        .header {
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .back-button, .add-button {
            font-size: 16px;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            color: white;
            background-color: #007bff;
            transition: background-color 0.3s ease;
        }
        .back-button:hover, .add-button:hover {
            background-color: #0056b3;
        }
        .inventory-table {
            width: 100%;
            border-collapse: collapse;
        }
        .inventory-table th, .inventory-table td {
            padding: 15px;
            text-align: center;
            border: 1px solid #dee2e6;
        }
        .inventory-table thead {
            background-color: #007bff;
            color: white;
        }
        .inventory-table tbody tr:hover {
            background-color: #f1f1f1;
        }
        .action-button {
            font-size: 14px;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 8px 12px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .action-button.edit {
            background-color: #ffc107;
        }
        .action-button.delete {
            background-color: #dc3545;
        }
        .action-button.view {
            background-color: #28a745;
        }
        .action-button:hover {
            opacity: 0.9;
        }
        .modal-content {
            border-radius: 8px;
        }
        .modal-button {
            font-size: 16px;
            padding: 10px 20px;
            border-radius: 5px;
            border: none;
            color: white;
            background-color: #007bff;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .modal-button:hover {
            background-color: #0056b3;
        }
        .close-button {
            font-size: 24px;
            color: #333;
            cursor: pointer;
        }
        .close-button:hover {
            color: #007bff;
        }
    </style>
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
            <tbody id="inventoryTableBody">
                <!-- Data will be populated here via AJAX -->
            </tbody>
        </table>
    </div>

    <!-- Modal Structure -->
    <div id="modal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="modal-title" class="modal-title">Modal Title</h5>
                    <button type="button" class="close close-button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="modal-body" class="modal-body">
                    <form id="part-form" style="display: none;">
                        <div class="form-group">
                            <input type="text" id="part-type" name="part-type" class="form-control" placeholder="Type">
                        </div>
                        <div class="form-group">
                            <input type="text" id="part-name" name="part-name" class="form-control" placeholder="Part Name">
                        </div>
                        <div class="form-group">
                            <input type="number" id="part-quantity" name="part-quantity" class="form-control" placeholder="Quantity">
                        </div>
                        <div class="form-group">
                            <input type="text" id="part-price" name="part-price" class="form-control" placeholder="Price">
                        </div>
                    </form>
                    <p id="modal-message">Modal content goes here.</p>
                </div>
                <div class="modal-footer">
                    <button id="modal-confirm" class="modal-button">Confirm</button>
                    <button id="modal-cancel" class="modal-button" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery, Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // Function to open modal
        function openModal(action, id = null) {
            $('#modal').modal('show');
            $('#modal-title').text(action + ' Part');
            $('#modal-form').hide();
            $('#modal-message').show();
            $('#modal-confirm').off('click'); // Clear previous event handlers

            if (action === 'Add') {
                $('#modal-form').show();
                $('#modal-message').hide();
                $('#modal-confirm').text('Add Part').on('click', function() {
                    var formData = {
                        type: $('#part-type').val(),
                        part_name: $('#part-name').val(),
                        quantity: $('#part-quantity').val(),
                        price: $('#part-price').val()
                    };
                    $.post('add_part.php', formData, function(response) {
                        if (response.success) {
                            alert('Part added successfully!');
                            location.reload();
                        } else {
                            alert('Error: ' + response.error);
                        }
                    }, 'json');
                });
            } else if (action === 'Edit') {
                $('#modal-form').show();
                $('#modal-message').hide();
                $('#modal-confirm').text('Update Part').on('click', function() {
                    var formData = {
                        id: id,
                        type: $('#part-type').val(),
                        part_name: $('#part-name').val(),
                        quantity: $('#part-quantity').val(),
                        price: $('#part-price').val()
                    };
                    $.post('update_part.php', formData, function(response) {
                        if (response.success) {
                            alert('Part updated successfully!');
                            location.reload();
                        } else {
                            alert('Error: ' + response.error);
                        }
                    }, 'json');
                });
            } else if (action === 'Delete') {
                $('#modal-message').text('Are you sure you want to delete this part?');
                $('#modal-confirm').text('Delete Part').on('click', function() {
                    $.post('delete_part.php', { id: id }, function(response) {
                        if (response.success) {
                            alert('Part deleted successfully!');
                            location.reload();
                        } else {
                            alert('Error: ' + response.error);
                        }
                    }, 'json');
                });
            } else if (action === 'View') {
                $('#modal-form').hide();
                $('#modal-message').show();
                $.get('fetch_inventory.php', function(response) {
                    var part = response.find(item => item.id == id);
                    if (part) {
                        $('#modal-message').html(`
                            <p><strong>Type:</strong> ${part.type}</p>
                            <p><strong>Part Name:</strong> ${part.part_name}</p>
                            <p><strong>Quantity:</strong> ${part.quantity}</p>
                            <p><strong>Price:</strong> $${part.price}</p>
                        `);
                    }
                }, 'json');
                $('#modal-confirm').hide();
            }
        }

        // Function to close modal
        function closeModal() {
            $('#modal').modal('hide');
        }

        // Refresh the table with data
        function refreshTable() {
            $.get('fetch_inventory.php', function(data) {
                var rows = '';
                data.forEach(function(item) {
                    rows += `<tr>
                        <td>${item.id}</td>
                        <td>${item.type}</td>
                        <td>${item.part_name}</td>
                        <td>${item.quantity}</td>
                        <td>$${item.price}</td>
                        <td>
                            <button class="action-button edit" onclick="openModal('Edit', ${item.id})">Edit</button>
                            <button class="action-button delete" onclick="openModal('Delete', ${item.id})">Delete</button>
                            <button class="action-button view" onclick="openModal('View', ${item.id})">View</button>
                        </td>
                    </tr>`;
                });
                $('#inventoryTableBody').html(rows);
            }, 'json');
        }

        // Initial table load
        $(document).ready(function() {
            refreshTable();
        });
    </script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parts Inventory</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
                    <th>Product ID</th>
                    <th>Vehicle Type</th>
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
                    <h5 id="modal-title" class="modal-title">Add New Part</h5>
                    <button type="button" class="close close-button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="modal-body" class="modal-body">
                    <form id="part-form">
                        <div class="form-group">
                            <label for="vehicle-type">Vehicle Type</label>
                            <input type="text" id="vehicle-type" name="vehicle-type" class="form-control" placeholder="Vehicle Type" required>
                        </div>
                        <div class="form-group">
                            <label for="part-name">Part Name</label>
                            <input type="text" id="part-name" name="part-name" class="form-control" placeholder="Part Name" required>
                        </div>
                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input type="number" id="quantity" name="quantity" class="form-control" placeholder="Quantity" required>
                        </div>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="text" id="price" name="price" class="form-control" placeholder="Price" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button id="modal-confirm" class="modal-button">Add Part</button>
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
    $('#part-form').show();
    $('#modal-confirm').off('click'); // Clear previous event handlers

    if (action === 'Add') {
        $('#part-form')[0].reset(); // Clear the form fields
        $('#modal-confirm').text('Add Part').on('click', function() {
            var formData = {
                vehicle_type: $('#vehicle-type').val(),
                part_name: $('#part-name').val(),
                quantity: $('#quantity').val(),
                price: $('#price').val()
            };
            $.ajax({
                url: 'Addpart.php',
                type: 'POST',
                data: JSON.stringify(formData),
                contentType: 'application/json',
                success: function(response) {
                    if (response.status === 'success') {
                        addToTable(response.part); 
                        $('#modal').modal('hide'); // Close the modal
                    } else {
                        alert('Error: ' + response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
    } else if (action === 'Edit') {
        $.ajax({
            url: 'GetPart.php', // Fetch existing part data
            type: 'POST',
            data: JSON.stringify({ product_id: id }),
            contentType: 'application/json',
            success: function(response) {
                if (response.status === 'success') {
                    $('#vehicle-type').val(response.part.vehicle_type);
                    $('#part-name').val(response.part.part_name);
                    $('#quantity').val(response.part.quantity);
                    $('#price').val(response.part.price);

                    $('#modal-confirm').text('Update Part').on('click', function() {
                        var formData = {
                            product_id: id,
                            vehicle_type: $('#vehicle-type').val(),
                            part_name: $('#part-name').val(),
                            quantity: $('#quantity').val(),
                            price: $('#price').val()
                        };
                        $.ajax({
                            url: 'UpdatePart.php',
                            type: 'POST',
                            data: JSON.stringify(formData),
                            contentType: 'application/json',
                            success: function(response) {
                                if (response.status === 'success') {
                                    updateTableRow(id, response.part); 
                                    $('#modal').modal('hide'); // Close the modal
                                } else {
                                    alert('Error: ' + response.message);
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error(error);
                            }
                        });
                    });
                } else {
                    alert('Error: ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }
}

// Function to update an existing table row
function updateTableRow(id, part) {
    var row = `
        <tr>
            <td>${part.product_id}</td>
            <td>${part.vehicle_type}</td>
            <td>${part.part_name}</td>
            <td>${part.quantity}</td>
            <td>$${part.price}</td>
            <td>
                <button class="action-button edit" onclick="openModal('Edit', ${part.product_id})">Edit</button>
                <button class="action-button delete" onclick="openModal('Delete', ${part.product_id})">Delete</button>
                <button class="action-button view" onclick="openModal('View', ${part.product_id})">View</button>
            </td>
        </tr>`;
    $('#inventoryTableBody tr').filter(function() {
        return $(this).find('td').eq(0).text() == id;
    }).replaceWith(row);
}

    </script>
</body>
</html>

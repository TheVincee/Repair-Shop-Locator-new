<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parts Inventory</title>
    <link rel="stylesheet" href="Product.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 30px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .back-button, .add-button {
            font-size: 16px;
            padding: 10px 20px;
            text-decoration: none;
            color: #fff;
            border-radius: 8px;
            transition: background-color 0.3s, transform 0.3s;
        }

        .back-button {
            background-color: #007bff;
        }

        .back-button:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        .add-button {
            background-color: #28a745;
        }

        .add-button:hover {
            background-color: #218838;
            transform: scale(1.05);
        }

        .inventory-table {
            width: 100%;
            border-collapse: collapse;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
            background-color: #fff;
        }

        .inventory-table th, .inventory-table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        .inventory-table th {
            background-color: #007bff;
            color: #fff;
            font-weight: 500;
        }

        .inventory-table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .inventory-table tr:hover {
            background-color: #e9ecef;
        }

        .action-button {
            padding: 6px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s;
        }

        .edit {
            background-color: #ffc107;
            color: #fff;
        }

        .edit:hover {
            background-color: #e0a800;
            transform: scale(1.05);
        }

        .delete {
            background-color: #dc3545;
            color: #fff;
        }

        .delete:hover {
            background-color: #c82333;
            transform: scale(1.05);
        }

        .view {
            background-color: #17a2b8;
            color: #fff;
        }

        .view:hover {
            background-color: #138496;
            transform: scale(1.05);
        }

        /* Modal Styles */
        .modal-content {
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .modal-header {
            border-bottom: 1px solid #ddd;
        }

        .modal-footer {
            border-top: 1px solid #ddd;
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

    <!-- Modal -->
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="part-form">
                        <div class="form-group">
                            <label for="vehicle-type">Vehicle Type</label>
                            <input type="text" class="form-control" id="vehicle-type" required>
                        </div>
                        <div class="form-group">
                            <label for="part-name">Part Name</label>
                            <input type="text" class="form-control" id="part-name" required>
                        </div>
                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input type="number" class="form-control" id="quantity" required>
                        </div>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="number" step="0.01" class="form-control" id="price" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="modal-confirm"></button>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script>
       // Function to open the modal for adding or editing parts
// Function to open the modal for adding or editing parts
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
                url: 'AddPart.php',
                type: 'POST',
                data: JSON.stringify(formData),
                contentType: 'application/json',
                success: function(response) {
                    console.log('Add Part Response:', response);
                    try {
                        response = JSON.parse(response);
                        if (response.status === 'success') {
                            addToTable(response.part); // Add part to the table
                            $('#modal').modal('hide'); // Close the modal on success
                        } else {
                            alert('Error: ' + response.message);
                        }
                    } catch (e) {
                        console.error('Failed to parse response:', response);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error adding part:', error);
                    console.error('Response Text:', xhr.responseText);
                }
            });
        });
    } else if (action === 'Edit') {
        $.ajax({
            url: 'GetPart.php',
            type: 'POST',
            data: JSON.stringify({ product_id: id }),
            contentType: 'application/json',
            success: function(response) {
                console.log('Fetch Part Response:', response);
                try {
                    response = JSON.parse(response);
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
                                    console.log('Update Part Response:', response);
                                    if (typeof response === 'string') {
                                        try {
                                            response = JSON.parse(response); // Parse if response is string
                                        } catch (e) {
                                            console.error('Failed to parse response:', response);
                                            return;
                                        }
                                    }

                                    if (response.status === 'success') {
                                        if (response.part && response.part.product_id) {
                                            updateTableRow(id, response.part); // Update the table row
                                            $('#modal').modal('hide'); // Close the modal
                                        } else {
                                            console.error('Error: part object is missing or invalid in the response');
                                        }
                                    } else {
                                        alert('Error: ' + response.message);
                                    }
                                },
                                error: function(xhr, status, error) {
                                    console.error('Error updating part:', error);
                                    console.error('Response Text:', xhr.responseText);
                                }
                            });
                        });
                    } else {
                        alert('Error: ' + response.message);
                    }
                } catch (e) {
                    console.error('Failed to parse response:', response);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error fetching part:', error);
                console.error('Response Text:', xhr.responseText);
            }
        });
    }
}

// Function to add a new part to the table
function addToTable(part) {
    var row = `
        <tr data-id="${part.product_id}">
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
    $('#inventoryTableBody').append(row); // Add the new part row to the table
}

// Function to update an existing table row
function updateTableRow(id, part) {
    var row = `
        <tr data-id="${part.product_id}">
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
        return $(this).data('id') == id;
    }).replaceWith(row);
}

// Function to fetch and display all parts
function fetchParts() {
    $.ajax({
        url: 'fetchParts.php',
        type: 'GET',
        success: function(response) {
            console.log('Fetch Parts Response:', response);
            try {
                response = JSON.parse(response);
                if (response.status === 'success') {
                    response.parts.forEach(part => addToTable(part)); // Add each part to the table
                } else {
                    alert('Error: ' + response.message);
                }
            } catch (e) {
                console.error('Failed to parse response:', response);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error fetching parts:', error);
            console.error('Response Text:', xhr.responseText);
        }
    });
}

// Call fetchParts() when the page loads to populate the table
$(document).ready(function() {
    fetchParts();
});

    </script>


</body>
</html>

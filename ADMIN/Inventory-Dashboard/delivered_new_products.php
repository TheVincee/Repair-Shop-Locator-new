<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivered New Products</title>
    <link rel="stylesheet" href="./CSS/DeliveryInventory.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
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
        .submit-btn {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }
        .submit-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Delivered New Products</h1>

    <!-- Back Button -->
    <a href="DashboardInventory.php" class="btn btn-secondary">Back</a>
    <button id="addNewPartBtn" class="btn btn-primary">Add New Part</button>

    <!-- Delivered New Products Table -->
    <table id="deliveredNewProductsTable" class="table table-striped">
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

    <!-- Status Update Modal -->
    <div id="statusModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeStatus">&times;</span>
            <h2>Update Status</h2>
            <form id="statusForm">
                <input type="hidden" id="statusPartID">
                <label for="statusOptions">Select Status:</label>
                <select id="statusOptions" required>
                    <option value="">Select Status</option>
                    <option value="Received">Received</option>
                    <option value="Returned">Returned</option>
                </select>
                
                <div id="issueDetailsSection" style="display:none;">
                    <label for="issueDetails">Issue Details:</label>
                    <textarea id="issueDetails" placeholder="Describe the issue" rows="4"></textarea> <!-- Keep it without required -->
                </div>

                <button type="submit" class="submit-btn">Update Status</button>
            </form>
        </div>
    </div>

    <!-- Returned Status Modal -->
    <div id="returnedModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeReturned">&times;</span>
            <h2>Returned Product</h2>
            <form id="returnedForm">
                <input type="hidden" id="returnedPartID">
                <label for="returnedIssueDetails">Issue Details:</label>
                <textarea id="returnedIssueDetails" placeholder="Describe the issue" rows="4" required></textarea>
                <button type="submit" class="submit-btn">Submit</button>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        fetchTableData();

        function fetchTableData() {
            $.ajax({
                url: 'fetch.php', // Ensure this path is correct
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    var tableBody = $('#deliveredNewProductsTableBody');
                    tableBody.empty();
                    $.each(data, function(index, item) {
                        var row = '<tr>' +
                            '<td>' + item.partID + '</td>' +
                            '<td>' + item.partName + '</td>' +
                            '<td>' + item.category + '</td>' +
                            '<td>' + item.quantity + '</td>' +
                            '<td>' + item.price + '</td>' +
                            '<td>' + item.supplier + '</td>' +
                            '<td>' + item.status + '</td>' +
                            '<td>' +
                            '<button class="edit-btn" data-id="' + item.partID + '">Edit</button>' +
                            '<button class="view-btn" data-id="' + item.partID + '">View</button>' +
                            '<button class="delete-btn" data-id="' + item.partID + '">Delete</button>' +
                            '<button class="status-btn" data-id="' + item.partID + '">Update Status</button>' +
                            '</td>' +
                            '</tr>';
                        tableBody.append(row);
                    });
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                }
            });
        }

        // Show Status Modal
        $(document).on('click', '.status-btn', function() {
            var id = $(this).data('id');
            $('#statusPartID').val(id); // Set part ID for status update
            $('#statusModal').show();
        });

        // Toggle issue details based on selected status
        $('#statusOptions').change(function() {
            if ($(this).val() === 'Issue') {
                $('#issueDetailsSection').show();
                $('#issueDetails').attr('required', true); // Add required attribute
            } else {
                $('#issueDetailsSection').hide();
                $('#issueDetails').removeAttr('required'); // Remove required attribute
            }
        });

        // Handle status form submission
        $('#statusForm').submit(function(e) {
            e.preventDefault();
            var status = $('#statusOptions').val();
            var issueDetails = $('#issueDetails').val();

            $.ajax({
                url: 'UpdateStatus.php', // Ensure this path is correct
                type: 'POST',
                data: {
                    id: $('#statusPartID').val(),
                    status: status,
                    issue_details: (status === 'Issue') ? issueDetails : null
                },
                success: function(response) {
                    if (status === 'Returned') {
                        $('#statusModal').hide();
                        $('#returnedPartID').val($('#statusPartID').val()); // Set part ID for returned form
                        $('#returnedModal').show(); // Show the Returned status modal
                    } else {
                        alert(response);
                        $('#statusModal').hide();
                        fetchTableData(); // Refresh table data after status update
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                }
            });
        });

        // Handle returned form submission
        $('#returnedForm').submit(function(e) {
            e.preventDefault();
            var partID = $('#returnedPartID').val();
            var issueDetails = $('#returnedIssueDetails').val();

            $.ajax({
                url: 'update_returned.php', // Ensure this path is correct
                type: 'POST',
                data: {
                    id: partID,
                    issue_details: issueDetails
                },
                success: function(response) {
                    alert(response);
                    $('#returnedModal').hide();
                    fetchTableData(); // Refresh table data after issue details update
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                }
            });
        });

        // Close modals on clicking the close button
        $(document).on('click', '.close', function() {
            $(this).closest('.modal').hide();
        });

        // Show Add Modal
        $('#addNewPartBtn').click(function() {
            $('#addModal').show();
        });

        // Handle add form submission
        $('#addForm').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: 'add.php', // Ensure this path is correct
                type: 'POST',
                data: {
                    part_name: $('#addPartName').val(),
                    category: $('#addCategory').val(),
                    quantity: $('#addQuantity').val(),
                    price: $('#addPrice').val(),
                    supplier: $('#addSupplier').val()
                },
                success: function(response) {
                    alert(response);
                    $('#addModal').hide();
                    fetchTableData(); // Refresh table data after adding new part
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                }
            });
        });
    });
    </script>
</body>
</html>

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
        .close:hover, .close:focus {
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

    <!-- Modals -->
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

    <div id="viewModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeView">&times;</span>
            <h2>View Part Details</h2>
            <div id="viewModalBody"></div>
        </div>
    </div>

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
                <button type="submit" class="submit-btn">Update Part</button>
            </form>
        </div>
    </div>

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
                    <textarea id="issueDetails" placeholder="Describe the issue" rows="4"></textarea>
                </div>

                <button type="submit" class="submit-btn">Update Status</button>
            </form>
        </div>
    </div>

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
            url: 'fetch.php',
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
        $('#statusPartID').val(id);
        $('#statusModal').show();
    });

    // Toggle issue details based on selected status
    $('#statusOptions').change(function() {
        $('#issueDetailsSection').toggle($(this).val() === 'Returned');
    });

    // Handle status form submission
    $('#statusForm').submit(function(e) {
        e.preventDefault();
        var status = $('#statusOptions').val();
        var issueDetails = status === 'Returned' ? $('#issueDetails').val() : null;

        $.ajax({
            url: 'UpdateStatus.php',
            type: 'POST',
            data: {
                id: $('#statusPartID').val(),
                status: status,
                issue_details: issueDetails
            },
            success: function(response) {
                alert(response);
                $('#statusModal').hide();
                fetchTableData();
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', status, error);
            }
        });
    });

    // Show Add Modal
    $('#addNewPartBtn').click(function() {
        $('#addModal').show();
    });

    // Close Add Modal
    $('#closeAdd').click(function() {
        $('#addModal').hide();
    });

    // Handle Add Form Submission
    $('#addForm').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: 'add.php',
            type: 'POST',
            data: {
                partName: $('#addPartName').val(),
                category: $('#addCategory').val(),
                quantity: $('#addQuantity').val(),
                price: $('#addPrice').val(),
                supplier: $('#addSupplier').val()
            },
            success: function(response) {
                alert(response);
                $('#addModal').hide();
                fetchTableData();
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', status, error);
            }
        });
    });

    // Close View Modal
    $('#closeView').click(function() {
        $('#viewModal').hide();
    });

    // Close Edit Modal
    $('#closeEdit').click(function() {
        $('#editModal').hide();
    });

    // Show View Modal
    // Show View Modal
// Show View Modal
$(document).on('click', '.view-btn', function() {
    var id = $(this).data('id');
    $.ajax({
        url: 'view.php',
        type: 'POST', // Use POST method
        data: { id: id },
        dataType: 'json', // Expect JSON response
        success: function(response) {
            if (response.error) {
                // Handle error
                $('#viewModalBody').html('<p>' + response.error + '</p>');
            } else {
                // Populate modal with part details
                $('#viewModalBody').html(`
                    <p>Part Name: ${response.partName}</p>
                    <p>Category: ${response.category}</p>
                    <p>Quantity: ${response.quantity}</p>
                    <p>Price: ${response.price}</p>
                    <p>Supplier: ${response.supplier}</p>
                    <p>Status: ${response.status}</p>
                `);
            }
            $('#viewModal').show(); // Ensure the modal is displayed
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', status, error);
        }
    });
});



    // Show Edit Modal
    $(document).on('click', '.edit-btn', function() {
        var id = $(this).data('id');
        $.ajax({
            url: 'fetch_single.php',
            type: 'GET',
            data: { id: id },
            dataType: 'json',
            success: function(item) {
                $('#editPartID').val(item.partID);
                $('#editPartName').val(item.partName);
                $('#editCategory').val(item.category);
                $('#editQuantity').val(item.quantity);
                $('#editPrice').val(item.price);
                $('#editSupplier').val(item.supplier);
                $('#editModal').show();
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', status, error);
            }
        });
    });

    // Handle Edit Form Submission
    $('#editForm').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: 'edit.php',
            type: 'POST',
            data: {
                id: $('#editPartID').val(),
                partName: $('#editPartName').val(),
                category: $('#editCategory').val(),
                quantity: $('#editQuantity').val(),
                price: $('#editPrice').val(),
                supplier: $('#editSupplier').val()
            },
            success: function(response) {
                alert(response);
                $('#editModal').hide();
                fetchTableData();
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', status, error);
            }
        });
    });

    // Handle Delete
    $(document).on('click', '.delete-btn', function() {
        var id = $(this).data('id');
        if (confirm('Are you sure you want to delete this part?')) {
            $.ajax({
                url: 'delete.php',
                type: 'POST',
                data: { id: id },
                success: function(response) {
                    alert(response);
                    fetchTableData();
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                }
            });
        }
    });

    // Close Returned Modal
    $('#closeReturned').click(function() {
        $('#returnedModal').hide();
    });

    // Show Returned Modal
    $(document).on('click', '.returned-btn', function() {
        var id = $(this).data('id');
        $('#returnedPartID').val(id);
        $('#returnedModal').show();
    });

    // Handle Returned Form Submission
    $('#returnedForm').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: 'update_returned.php',
            type: 'POST',
            data: {
                id: $('#returnedPartID').val(),
                issueDetails: $('#returnedIssueDetails').val()
            },
            success: function(response) {
                alert(response);
                $('#returnedModal').hide();
                fetchTableData();
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', status, error);
            }
        });
    });

    // Close all modals when clicking outside of them
    $(window).click(function(event) {
        if ($(event.target).hasClass('modal')) {
            $('.modal').hide();
        }
    });
});
    </script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delivered New Products</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Optional: Include a custom font -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            font-weight: bold;
            color: #0d6efd;
        }

        /* 3D button hover effect */
        .btn {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        /* Table styling */
        .table th {
            background-color: #0d6efd;
            color: #fff;
            text-align: center;
        }

        .table-striped > tbody > tr:nth-of-type(odd) {
            background-color: #f2f2f2;
        }

        /* Modal custom styling */
        .modal-content {
            border-radius: 10px;
        }

        .modal-header {
            background-color: #0d6efd;
            color: #fff;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        /* Form control styling */
        .form-control {
            border-radius: 5px;
            padding: 10px;
        }

        .actions {
            display: flex;
            justify-content: center;
            gap: 5px;
        }

        .actions .btn {
            flex: 1;
        }
    </style>
</head>
<body>

    <h1>Delivered New Products</h1>

    <!-- Back and Add buttons -->
    <div class="d-flex justify-content-between mb-3">
        <a href="DashboardInventory.php" class="btn btn-secondary">Back</a>
        <button id="addNewPartBtn" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Add New Part</button>
    </div>

    <!-- Table -->
    <div class="table-responsive">
        <table id="deliveredNewProductsTable" class="table table-striped table-bordered">
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
                <!-- Rows will be populated via AJAX -->
            </tbody>
        </table>
    </div>

    <!-- Modals -->

    <!-- Add New Part Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5>Add New Part</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="addForm">
              <div class="mb-3">
                <label for="addPartName" class="form-label">Part Name</label>
                <input type="text" class="form-control" id="addPartName" required>
              </div>
              <div class="mb-3">
                <label for="addCategory" class="form-label">Category</label>
                <input type="text" class="form-control" id="addCategory" required>
              </div>
              <div class="mb-3">
                <label for="addQuantity" class="form-label">Quantity</label>
                <input type="number" class="form-control" id="addQuantity" required>
              </div>
              <div class="mb-3">
                <label for="addPrice" class="form-label">Price</label>
                <input type="number" step="0.01" class="form-control" id="addPrice" required>
              </div>
              <div class="mb-3">
                <label for="addSupplier" class="form-label">Supplier</label>
                <input type="text" class="form-control" id="addSupplier" required>
              </div>
              <button type="submit" class="btn btn-primary w-100">Add Part</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- View Part Details Modal -->
    <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5>Part Details</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" id="viewModalBody">
            <!-- Part details will be populated here -->
          </div>
        </div>
      </div>
    </div>

    <!-- Edit Part Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5>Edit Part</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="editForm">
              <input type="hidden" id="editPartID">
              <div class="mb-3">
                <label for="editPartName" class="form-label">Part Name</label>
                <input type="text" class="form-control" id="editPartName" required>
              </div>
              <div class="mb-3">
                <label for="editCategory" class="form-label">Category</label>
                <input type="text" class="form-control" id="editCategory" required>
              </div>
              <div class="mb-3">
                <label for="editQuantity" class="form-label">Quantity</label>
                <input type="number" class="form-control" id="editQuantity" required>
              </div>
              <div class="mb-3">
                <label for="editPrice" class="form-label">Price</label>
                <input type="number" step="0.01" class="form-control" id="editPrice" required>
              </div>
              <div class="mb-3">
                <label for="editSupplier" class="form-label">Supplier</label>
                <input type="text" class="form-control" id="editSupplier" required>
              </div>
              <button type="submit" class="btn btn-primary w-100">Update Part</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Update Status Modal -->
    <div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5>Update Status</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="statusForm">
              <input type="hidden" id="statusPartID">
              <div class="mb-3">
                <label for="statusOptions" class="form-label">Select Status</label>
                <select id="statusOptions" class="form-select" required>
                  <option value="">Select Status</option>
                  <option value="Received">Received</option>
                  <option value="Returned">Returned</option>
                </select>
              </div>
              <div class="mb-3" id="issueDetailsSection" style="display:none;">
                <label for="issueDetails" class="form-label">Issue Details</label>
                <textarea id="issueDetails" class="form-control" rows="3"></textarea>
              </div>
              <button type="submit" class="btn btn-primary w-100">Update Status</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery (necessary for AJAX requests) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Custom JavaScript with AJAX calls -->
    <script>
        $(document).ready(function() {
            fetchTableData();

            // Function to fetch and display data in the table
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
                                '<td class="actions">' +
                                    '<button class="btn btn-info btn-sm view-btn" data-id="' + item.partID + '">View</button>' +
                                    '<button class="btn btn-warning btn-sm edit-btn" data-id="' + item.partID + '">Edit</button>' +
                                    '<button class="btn btn-danger btn-sm delete-btn" data-id="' + item.partID + '">Delete</button>' +
                                    '<button class="btn btn-secondary btn-sm status-btn" data-id="' + item.partID + '">Update Status</button>' +
                                '</td>' +
                                '</tr>';
                            tableBody.append(row);
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching data:', error);
                    }
                });
            }

            // Add New Part
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
                        $('#addForm')[0].reset();
                        $('#addModal').modal('hide');
                        fetchTableData();
                    },
                    error: function(xhr, status, error) {
                        console.error('Error adding part:', error);
                    }
                });
            });

            // View Part Details
            $(document).on('click', '.view-btn', function() {
                var id = $(this).data('id');
                $.ajax({
                    url: 'view.php',
                    type: 'POST',
                    data: { id: id },
                    dataType: 'json',
                    success: function(response) {
                        if (response.error) {
                            $('#viewModalBody').html('<p>' + response.error + '</p>');
                        } else {
                            $('#viewModalBody').html(
                                '<p><strong>Part Name:</strong> ' + response.partName + '</p>' +
                                '<p><strong>Category:</strong> ' + response.category + '</p>' +
                                '<p><strong>Quantity:</strong> ' + response.quantity + '</p>' +
                                '<p><strong>Price:</strong> $' + response.price + '</p>' +
                                '<p><strong>Supplier:</strong> ' + response.supplier + '</p>' +
                                '<p><strong>Status:</strong> ' + response.status + '</p>'
                            );
                        }
                        $('#viewModal').modal('show');
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching part details:', error);
                    }
                });
            });

            // Edit Part
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
                        $('#editModal').modal('show');
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching part data:', error);
                    }
                });
            });

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
                        $('#editForm')[0].reset();
                        $('#editModal').modal('hide');
                        fetchTableData();
                    },
                    error: function(xhr, status, error) {
                        console.error('Error updating part:', error);
                    }
                });
            });

            // Delete Part
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
                            console.error('Error deleting part:', error);
                        }
                    });
                }
            });

            // Update Status
            $(document).on('click', '.status-btn', function() {
                var id = $(this).data('id');
                $('#statusPartID').val(id);
                $('#statusOptions').val('');
                $('#issueDetails').val('');
                $('#issueDetailsSection').hide();
                $('#statusModal').modal('show');
            });

            $('#statusOptions').change(function() {
                if ($(this).val() === 'Returned') {
                    $('#issueDetailsSection').show();
                } else {
                    $('#issueDetailsSection').hide();
                }
            });

            $('#statusForm').submit(function(e) {
                e.preventDefault();
                var status = $('#statusOptions').val();
                var issueDetails = status === 'Returned' ? $('#issueDetails').val() : '';
                $.ajax({
                    url: 'update_status.php',
                    type: 'POST',
                    data: {
                        id: $('#statusPartID').val(),
                        status: status,
                        issue_details: issueDetails
                    },
                    success: function(response) {
                        alert(response);
                        $('#statusForm')[0].reset();
                        $('#statusModal').modal('hide');
                        fetchTableData();
                    },
                    error: function(xhr, status, error) {
                        console.error('Error updating status:', error);
                    }
                });
            });

        });
    </script>

</body>
</html>

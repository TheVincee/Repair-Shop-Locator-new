<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivered Products</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            background-color: #f0f4f8;
            font-family: 'Arial', sans-serif;
        }
        .container {
            margin-top: 30px;
        }
        h1 {
            margin-bottom: 30px;
            font-weight: 600;
            color: #333;
        }
        .btn {
            transition: background-color 0.3s, transform 0.2s;
        }
        .btn:hover {
            background-color: #0069d9;
            transform: scale(1.05);
        }
        .table {
            border-radius: 10px;
            overflow: hidden;
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.7);
        }
        .modal-content {
            background-color: #ffffff;
            border-radius: 10px;
            margin: 5% auto;
            padding: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            animation: fadeIn 0.3s;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }
        .card:hover {
            transform: scale(1.03);
        }
        .modal-header {
            border-bottom: none;
        }
        .modal-footer {
            border-top: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Delivered Products</h1>
        <a href="DashboardInventory.php" class="btn btn-secondary mb-3">Back</a>
        <div class="table-responsive">
            <table id="deliveredProductsTable" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Part ID</th>
                        <th>Product Name</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="deliveredProductsTableBody">
                    <!-- Table rows will be populated here via AJAX -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- View Modal -->
    <div id="viewModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>View Product Details</h2>
                <span class="close" id="closeView">&times;</span>
            </div>
            <div class="modal-body" id="viewModalBody"></div>
            <div class="modal-footer">
                <button class="btn btn-secondary" id="closeModalBtn">Close</button>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            fetchDeliveredProducts();

            function fetchDeliveredProducts() {
                $.ajax({
                    url: 'fetchDeliveredProducts.php',
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        var tableBody = $('#deliveredProductsTableBody');
                        tableBody.empty();
                        if (data.error) {
                            alert('Error: ' + data.error);
                        } else {
                            $.each(data, function(index, item) {
                                var row = `<tr>
                                                <td>${item.partID}</td>
                                                <td>${item.partName}</td>
                                                <td>${item.status}</td>
                                                <td>
                                                    <button class="btn btn-info view-btn" data-id="${item.partID}">View</button>
                                                </td>
                                            </tr>`;
                                tableBody.append(row);
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', status, error);
                    }
                });
            }

            // Show View Modal
            $(document).on('click', '.view-btn', function() {
                var id = $(this).data('id');
                $.ajax({
                    url: 'getProductDetails.php',
                    type: 'POST',
                    data: { id: id },
                    dataType: 'json',
                    success: function(response) {
                        if (response.error) {
                            $('#viewModalBody').html('<p>' + response.error + '</p>');
                        } else {
                            $('#viewModalBody').html(`
                                <div class="card">
                                    <div class="card-body">
                                        <p><strong>Part ID:</strong> ${response.partID}</p>
                                        <p><strong>Product Name:</strong> ${response.partName}</p>
                                        <p><strong>Status:</strong> ${response.status}</p>
                                    </div>
                                </div>
                            `);
                        }
                        $('#viewModal').show();
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', status, error);
                    }
                });
            });

            // Close View Modal
            $('#closeView, #closeModalBtn').click(function() {
                $('#viewModal').hide();
            });

            // Close modal when clicking outside
            $(window).click(function(event) {
                if ($(event.target).hasClass('modal')) {
                    $('.modal').hide();
                }
            });
        });
    </script>
</body>
</html>

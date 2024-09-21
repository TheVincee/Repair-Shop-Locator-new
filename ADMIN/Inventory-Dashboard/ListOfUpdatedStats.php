<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management - Updated Status</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        body {
            background-color: #eaeef1;
            font-family: 'Arial', sans-serif;
            color: #333;
        }
        h2 {
            text-align: center;
            margin: 40px 0;
            font-weight: bold;
        }
        .table-responsive {
            margin: 20px auto;
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1050;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.8);
        }
        .modal-content {
            background-color: #fff;
            border-radius: 12px;
            margin: 5% auto;
            padding: 20px;
            max-width: 500px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            animation: fadeIn 0.3s;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .close {
            cursor: pointer;
            color: #aaa;
            float: right;
            font-size: 24px;
            font-weight: bold;
        }
        .close:hover {
            color: #000;
        }
        .view-btn {
            transition: background-color 0.3s;
        }
        .view-btn:hover {
            background-color: #0056b3;
            color: white;
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .table thead th {
            background-color: #007bff;
            color: white;
        }
        .back-btn {
            display: inline-block;
            margin-bottom: 20px;
            background-color: #6c757d;
            color: white;
            font-weight: bold;
            padding: 12px 24px;
            border-radius: 8px;
            text-decoration: none;
        }
        .back-btn:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>

    <div class="container mt-4">
        <a href="DashboardInventory.php" class="back-btn">Back</a>
        <h2>Updated Product Status</h2>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Part ID</th>
                        <th>Part Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Supplier</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="updatedTableBody">
                    <!-- Table rows will be populated here via AJAX -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- View Modal -->
    <div id="viewModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeView">&times;</span>
            <h3>View Part</h3>
            <div id="viewDetails">
                <!-- Part details will be loaded here -->
            </div>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- JavaScript -->
    <script>
        $(document).ready(function() {
            // Load parts with updated status
            function loadParts() {
                $.ajax({
                    url: 'fetch_parts.php',
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        const tableBody = $('#updatedTableBody');
                        tableBody.empty(); // Clear existing rows

                        data.forEach(part => {
                            tableBody.append(`
                                <tr>
                                    <td>${part.partID}</td>
                                    <td>${part.partName}</td>
                                    <td>${part.quantity}</td>   
                                    <td>$${parseFloat(part.price).toFixed(2)}</td>
                                    <td>${part.supplier}</td>
                                    <td>${part.status}</td>
                                    <td>
                                        <button class='btn btn-primary view-btn' data-id='${part.partID}'>View</button>
                                    </td>
                                </tr>
                            `);
                        });
                    }
                });
            }

            // View Part details
            $(document).on('click', '.view-btn', function() {
                const partID = $(this).data('id');
                $.ajax({
                    url: `view_part.php?id=${partID}`,
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        if (!data.error) {
                            $('#viewDetails').html(`
                                <p><strong>Part ID:</strong> ${data.partID}</p>
                                <p><strong>Part Name:</strong> ${data.partName}</p>
                                <p><strong>Quantity:</strong> ${data.quantity}</p>
                                <p><strong>Price:</strong> $${parseFloat(data.price).toFixed(2)}</p>
                                <p><strong>Status:</strong> ${data.status}</p>
                                <p><strong>Issue Details:</strong> ${data.issue_details}</p>
                            `);
                            $('#viewModal').css('display', 'block'); // Show the modal
                        } else {
                            alert(data.error);
                        }
                    }
                });
            });

            // Close modal
            $('#closeView').click(function() {
                $('#viewModal').css('display', 'none'); // Hide the modal
            });
            
            // Load parts on page load
            loadParts();
        });
    </script>
</body>
</html>

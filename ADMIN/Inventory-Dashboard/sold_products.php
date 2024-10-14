<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sold Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Sold Products</h1>
        <a href="DashboardInventory.php" class="btn btn-secondary mb-3">Back</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Quantity Sold</th>
                    <th>Total Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="soldProductsTable">
                <!-- Sold products data will be loaded here -->
            </tbody>
        </table>
    </div>

    <!-- Modal for displaying purchased items -->
    <div class="modal fade" id="purchaseModal" tabindex="-1" aria-labelledby="purchaseModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="purchaseModalLabel">Purchased Items</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                            </tr>
                        </thead>
                        <tbody id="purchaseItemsTable">
                            <!-- Purchased items will be displayed here -->
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Fetch Sold Products
            fetchSoldProducts();

            function fetchSoldProducts() {
                $.ajax({
                    url: 'fetch_sold_products.php',
                    method: 'GET',
                    success: function(data) {
                        $('#soldProductsTable').html(data);
                    }
                });
            }

            // Handle View button click
            $(document).on('click', '.viewDetails', function() {
                var transactionId = $(this).data('id');

                $.ajax({
                    url: 'fetch_purchase_items.php',
                    method: 'POST',
                    data: {transaction_id: transactionId},
                    success: function(data) {
                        var items = JSON.parse(data);
                        $('#purchaseItemsTable').empty(); // Clear previous items

                        if (items.length > 0) {
                            items.forEach(function(item) {
                                $('#purchaseItemsTable').append(`
                                    <tr>
                                        <td>${item.product_name}</td>
                                        <td>${item.price}</td>
                                        <td>${item.sold_quantity}</td>
                                    </tr>
                                `);
                            });
                        } else {
                            $('#purchaseItemsTable').append('<tr><td colspan="3" class="text-center">No items found for this transaction</td></tr>');
                        }

                        $('#purchaseModal').modal('show');
                    }
                });
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

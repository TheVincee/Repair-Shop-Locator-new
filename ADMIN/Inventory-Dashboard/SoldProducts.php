<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sold Products</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Inventory</h1>
        <a href="previous_page.php" class="btn btn-secondary mb-3">Back</a> <!-- Change to your desired URL -->
        <!-- Table to display Inventory items -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Item ID</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="inventoryTable">
                <!-- Inventory data will be loaded here -->
            </tbody>
        </table>
        <button id="purchaseButton" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#purchaseModal">Purchase</button>
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
                    <!-- Purchased items will be displayed here -->
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Quantity</th>
                                <th>Total Price</th>
                            </tr>
                        </thead>
                        <tbody id="cartItemsTable">
                            <!-- Cart items data will be loaded here -->
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="confirmPurchaseButton" class="btn btn-primary">Confirm Purchase</button>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery and Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        var cart = []; // Array to hold items in the cart

        $(document).ready(function() {
            // Fetch Inventory Items
            fetchInventory();

            function fetchInventory() {
                $.ajax({
                    url: 'fetch_inventory.php', // Backend PHP to fetch data
                    method: 'GET',
                    success: function(data) {
                        $('#inventoryTable').html(data); // Load inventory into table
                    }
                });
            }

            // Handle Add to Cart button click
            $(document).on('click', '.addToCart', function() {
                var item_id = $(this).data('id');
                var product_name = $(this).data('name');
                var price = $(this).data('price');
                var quantity = $(this).data('quantity');

                if (quantity > 0) {
                    // Add item to the cart array
                    cart.push({
                        id: item_id,
                        name: product_name,
                        price: price,
                        quantity: 1 // You can later modify this to handle different quantities
                    });

                    alert(product_name + " added to cart");
                } else {
                    alert('Item is out of stock');
                }
            });

            // Display cart items in the modal when "Purchase" button is clicked
            $('#purchaseButton').click(function() {
                $('#cartItemsTable').empty(); // Clear previous cart data

                // Check if cart is not empty
                if (cart.length > 0) {
                    // Loop through cart and display items
                    cart.forEach(function(item) {
                        $('#cartItemsTable').append(`
                            <tr>
                                <td>${item.name}</td>
                                <td>${item.quantity}</td>
                                <td>${(item.price * item.quantity).toFixed(2)}</td>
                            </tr>
                        `);
                    });
                } else {
                    $('#cartItemsTable').append('<tr><td colspan="3" class="text-center">No items in cart</td></tr>');
                }
            });

            // Handle Confirm Purchase button click
            $('#confirmPurchaseButton').click(function() {
                if (cart.length > 0) {
                    $.ajax({
                        url: 'purchase.php',
                        method: 'POST',
                        data: {cart: cart},
                        success: function(response) {
                            alert(response); // Alert response from purchase.php
                            cart = []; // Clear the cart after purchase
                            $('#cartItemsTable').empty(); // Clear the modal cart table
                            fetchInventory(); // Reload inventory after purchase
                            $('#purchaseModal').modal('hide'); // Hide the modal after purchase
                        }
                    });
                } else {
                    alert('Your cart is empty');
                }
            });
        });
    </script>
</body>
</html>

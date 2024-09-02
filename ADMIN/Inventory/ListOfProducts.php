<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Table</title>
    <link rel="stylesheet" href="list.css">
</head>
<body>
    <div class="container">
        <button class="btn btn-back" onclick="goBack()">Back</button>
        <h1>Product Table</h1>
        <table class="product-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Smart Watch</td>
                    <td>25</td>
                    <td>$199.99</td>
                    <td><button class="btn btn-view" onclick="viewProduct(1)">View</button></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Bluetooth Headphones</td>
                    <td>40</td>
                    <td>$89.99</td>
                    <td><button class="btn btn-view" onclick="viewProduct(2)">View</button></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Laptop Stand</td>
                    <td>15</td>
                    <td>$29.99</td>
                    <td><button class="btn btn-view" onclick="viewProduct(3)">View</button></td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Wireless Mouse</td>
                    <td>30</td>
                    <td>$19.99</td>
                    <td><button class="btn btn-view" onclick="viewProduct(4)">View</button></td>
                </tr>
                <!-- Add more rows as needed -->
            </tbody>
        </table>
    </div>

    <script>
        function goBack() {
            window.history.back();
        }

        function viewProduct(id) {
            // Implement view product functionality here
            alert('Viewing product with ID: ' + id);
        }
    </script>
</body>
</html>

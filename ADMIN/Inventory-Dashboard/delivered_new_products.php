<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivered New Products</title>
    <link rel="stylesheet" href="./CSS/DeliveryInventory.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

</head>
<body>
    <h1>Delivered New Products</h1>

    <!-- Back Button -->
    <a href="previousPage.html" class="back-button">Back</a>
    <button id="addNewPartBtn" class="action-btn">Add New Part</button>

    <!-- Delivered New Products Table -->
    <table id="deliveredNewProductsTable">
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

    <!-- Edit Modal -->
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
                <button type="submit" class="submit-btn">Save Changes</button>
            </form>
        </div>
    </div>

    <!-- View Modal -->
    <div id="viewModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeView">&times;</span>
            <h2>View Part</h2>
            <div id="viewDetails">
                <!-- Part details will be loaded here -->
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
    // Fetch initial table data
    fetchTableData();

    function fetchTableData() {
        $.ajax({
            url: 'fetch.php', // Ensure this file exists and returns the correct data
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                console.log(data); // Log data for debugging
                var tableBody = $('#deliveredNewProductsTableBody');
                tableBody.empty(); // Clear existing rows
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
                        '</td>' +
                        '</tr>';
                    tableBody.append(row);
                });
            },
            error: function(xhr, status, error) {
                console.error("Error in fetching data:", status, error);
                console.log(xhr.responseText); // Log response for debugging
            }
        });
    }

    // Show Add Modal
    $('#addNewPartBtn').click(function() {
        $('#addModal').show();
    });

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
                $('#addModal').hide();
                fetchTableData(); // Refresh table data
            }
        });
    });

    // Show Edit Modal and load part data
    $(document).on('click', '.edit-btn', function() {
        var id = $(this).data('id');
        $.ajax({
            url: 'Editview.php',
            type: 'POST',
            data: { id: id },
            dataType: 'json',
            success: function(data) {
                if (data.error) {
                    alert(data.error);
                } else {
                    $('#editPartID').val(data.partID);
                    $('#editPartName').val(data.partName);
                    $('#editCategory').val(data.category);
                    $('#editQuantity').val(data.quantity);
                    $('#editPrice').val(data.price);
                    $('#editSupplier').val(data.supplier);
                    $('#editModal').show();
                }
            }
        });
    });

    // Save edited part
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
                fetchTableData(); // Refresh table data
            }
        });
    });

    // Show View Modal with part details
    $(document).on('click', '.view-btn', function() {
        var id = $(this).data('id');
        $.ajax({
            url: 'view.php',
            type: 'POST',
            data: { id: id },
            dataType: 'json',
            success: function(data) {
                if (data.error) {
                    alert(data.error);
                } else {
                    var viewDetails = '<p>Part ID: ' + data.partID + '</p>' +
                        '<p>Part Name: ' + data.partName + '</p>' +
                        '<p>Category: ' + data.category + '</p>' +
                        '<p>Quantity: ' + data.quantity + '</p>' +
                        '<p>Price: ' + data.price + '</p>' +
                        '<p>Supplier: ' + data.supplier + '</p>';
                    $('#viewDetails').html(viewDetails);
                    $('#viewModal').show();
                }
            }
        });
    });

    // Delete Part
    $(document).on('click', '.delete-btn', function() {
        if (confirm('Are you sure you want to delete this part?')) {
            var id = $(this).data('id');
            $.ajax({
                url: 'delete.php',
                type: 'POST',
                data: { id: id },
                success: function(response) {
                    alert(response);
                    fetchTableData(); // Refresh table data
                }
            });
        }
    });

    // Close modals
    $('.close').click(function() {
        $(this).closest('.modal').hide();
    });

});
</script>

    </script>
</body>
</html>

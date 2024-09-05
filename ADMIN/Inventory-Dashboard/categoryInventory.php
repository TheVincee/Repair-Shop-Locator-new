<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Inventory Management</h1>
    
    <!-- Motorcycle Table -->
    <h2>Motorcycle Parts</h2>
    <table id="motorcycleTable">
        <thead>
            <tr>
                <th>Part ID</th>
                <th>Part Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Supplier</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="motorcycleTableBody">
            <!-- Table rows will be populated here via AJAX -->
        </tbody>
    </table>

    <!-- Car Table -->
    <h2>Car Parts</h2>
    <table id="carTable">
        <thead>
            <tr>
                <th>Part ID</th>
                <th>Part Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Supplier</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="carTableBody">
            <!-- Table rows will be populated here via AJAX -->
        </tbody>
    </table>

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

    <!-- JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Load inventory tables
            function loadInventory() {
                const xhr = new XMLHttpRequest();
                xhr.open('GET', 'InventoryCetegory.php?action=list', true);
                xhr.onload = function() {
                    if (this.status == 200) {
                        const data = JSON.parse(this.responseText);
                        if (!data.error) {
                            let motorcycleHtml = '';
                            let carHtml = '';

                            data.forEach(part => {
                                const row = `<tr>
                                    <td>${part.partID}</td>
                                    <td>${part.partName}</td>
                                    <td>${part.quantity}</td>
                                    <td>${part.price}</td>
                                    <td>${part.supplier}</td>
                                    <td>
                                        <button class='view-btn' data-id='${part.partID}'>View</button>
                                        <button class='edit-btn' data-id='${part.partID}'>Edit</button>
                                        <button class='delete-btn' data-id='${part.partID}'>Delete</button>
                                    </td>
                                </tr>`;

                                if (part.category === 'Motorcycle') {
                                    motorcycleHtml += row;
                                } else if (part.category === 'Car') {
                                    carHtml += row;
                                }
                            });

                            document.getElementById('motorcycleTableBody').innerHTML = motorcycleHtml;
                            document.getElementById('carTableBody').innerHTML = carHtml;
                        } else {
                            alert(data.error);
                        }
                    }
                }
                xhr.send();
            }

            loadInventory();

            // View Part
            document.addEventListener('click', function(e) {
                if (e.target.classList.contains('view-btn')) {
                    const partID = e.target.getAttribute('data-id');
                    const xhr = new XMLHttpRequest();
                    xhr.open('GET', `InventoryCetegory.php?action=view&id=${partID}`, true);
                    xhr.onload = function() {
                        if (this.status == 200) {
                            const data = JSON.parse(this.responseText);
                            if (!data.error) {
                                document.getElementById('viewDetails').innerHTML = `
                                    <p><strong>Part ID:</strong> ${data.partID}</p>
                                    <p><strong>Part Name:</strong> ${data.partName}</p>
                                    <p><strong>Category:</strong> ${data.category}</p>
                                    <p><strong>Quantity:</strong> ${data.quantity}</p>
                                    <p><strong>Price:</strong> $${data.price.toFixed(2)}</p>
                                    <p><strong>Supplier:</strong> ${data.supplier}</p>
                                `;
                                document.getElementById('viewModal').style.display = 'block';
                            } else {
                                alert(data.error);
                            }
                        }
                    }
                    xhr.send();
                }

                if (e.target.classList.contains('edit-btn')) {
                    // Handle edit functionality here
                }

                if (e.target.classList.contains('delete-btn')) {
                    const partID = e.target.getAttribute('data-id');
                    if (confirm('Are you sure you want to delete this part?')) {
                        const xhr = new XMLHttpRequest();
                        xhr.open('GET', `InventoryCetegory.php?action=delete&id=${partID}`, true);
                        xhr.onload = function() {
                            if (this.status == 200) {
                                loadInventory();
                            }
                        }
                        xhr.send();
                    }
                }
            });

            document.getElementById('closeView').onclick = function() {
                document.getElementById('viewModal').style.display = 'none';
            }

            window.onclick = function(event) {
                if (event.target === document.getElementById('viewModal')) {
                    document.getElementById('viewModal').style.display = 'none';
                }
            }
        });
    </script>
</body>
</html>

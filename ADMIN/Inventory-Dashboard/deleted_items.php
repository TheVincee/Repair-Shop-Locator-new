<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deleted Items</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Deleted Items</h1>

    <!-- Deleted Items Table -->
    <table id="deletedTable">
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
        <tbody id="deletedTableBody">
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
            // Load deleted items
            function loadDeletedItems() {
                const xhr = new XMLHttpRequest();
                xhr.open('GET', 'status_operations.php?action=listByStatus&status=Deleted', true);
                xhr.onload = function() {
                    if (this.status == 200) {
                        const data = JSON.parse(this.responseText);
                        if (!data.error) {
                            let html = '';
                            data.forEach(part => {
                                html += `<tr>
                                    <td>${part.partID}</td>
                                    <td>${part.partName}</td>
                                    <td>${part.quantity}</td>
                                    <td>${part.price}</td>
                                    <td>${part.supplier}</td>
                                    <td>${part.status}</td>
                                    <td>
                                        <button class='view-btn' data-id='${part.partID}'>View</button>
                                        <button class='edit-btn' data-id='${part.partID}'>Edit</button>
                                        <button class='delete-btn' data-id='${part.partID}'>Delete</button>
                                    </td>
                                </tr>`;
                            });
                            document.getElementById('deletedTableBody').innerHTML = html;
                        } else {
                            alert(data.error);
                        }
                    }
                }
                xhr.send();
            }

            // Load deleted items initially
            loadDeletedItems();

            // View Part
            document.addEventListener('click', function(e) {
                if (e.target.classList.contains('view-btn')) {
                    const partID = e.target.getAttribute('data-id');
                    const xhr = new XMLHttpRequest();
                    xhr.open('GET', `inventory_operations.php?action=view&id=${partID}`, true);
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
                                    <p><strong>Status:</strong> ${data.status}</p>
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
                        xhr.open('GET', `inventory_operations.php?action=delete&id=${partID}`, true);
                        xhr.onload = function() {
                            if (this.status == 200) {
                                loadDeletedItems();
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

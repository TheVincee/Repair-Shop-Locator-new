<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Damaged Items</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
            color: #333;
        }
        h1 {
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
        .view-btn, .edit-btn, .delete-btn {
            margin: 0 5px;
        }
        .view-btn {
            background-color: #007bff;
            color: white;
        }
        .edit-btn {
            background-color: #ffc107;
            color: black;
        }
        .delete-btn {
            background-color: #dc3545;
            color: white;
        }
        .view-btn:hover, .edit-btn:hover, .delete-btn:hover {
            opacity: 0.9;
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .table thead th {
            background-color: #007bff;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <h1>Damaged Items</h1>

        <!-- Damaged Items Table -->
        <div class="table-responsive">
            <table class="table table-striped table-hover" id="damagedTable">
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
    </div>

    <!-- JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Load damaged items
            function loadDamagedItems() {
                const xhr = new XMLHttpRequest();
                xhr.open('GET', 'status_operations.php?action=listByStatus&status=Damaged', true);
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
                                    <td>$${parseFloat(part.price).toFixed(2)}</td>
                                    <td>${part.supplier}</td>
                                    <td>${part.status}</td>
                                    <td>
                                        <button class='btn view-btn' data-id='${part.partID}'>View</button>
                                        <button class='btn edit-btn' data-id='${part.partID}'>Edit</button>
                                        <button class='btn delete-btn' data-id='${part.partID}'>Delete</button>
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

            // Load damaged items initially
            loadDamagedItems();

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
                                loadDamagedItems();
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

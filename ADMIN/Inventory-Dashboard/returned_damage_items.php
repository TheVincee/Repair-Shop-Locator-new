<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Returned Damage Items</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        #backButton {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-bottom: 20px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        #backButton:hover {
            background-color: #0056b3;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            overflow: hidden;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: #fff;
            margin: 15% auto;
            padding: 20px;
            border-radius: 8px;
            width: 80%;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            animation: slideIn 0.3s ease;
        }

        @keyframes slideIn {
            from { opacity: 0; transform: translateY(-30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            transition: color 0.3s;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }

        .modal p {
            margin: 10px 0;
        }

        /* Button Styles */
        button {
            padding: 10px 15px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
        }

        button:hover {
            background-color: #218838;
            transform: translateY(-2px);
        }

        button:active {
            transform: translateY(0);
        }
    </style>
</head>
<body>
    <h1>Returned Damage Items</h1>

    <a id="backButton" href="dashboard.php">Back to Dashboard</a>

    <!-- Returned Damage Items Table -->
    <table id="returnedDamageTable">
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
        <tbody id="returnedDamageTableBody">
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

    <script>
        $(document).ready(function() {
            // Fetch returned damage items on page load
            fetchReturnedDamageItems();

            function fetchReturnedDamageItems() {
                $.ajax({
                    url: 'fetchReturnedDamageItems.php',
                    type: 'GET',
                    success: function(response) {
                        const items = JSON.parse(response);
                        const tableBody = $('#returnedDamageTableBody');
                        tableBody.empty(); // Clear existing rows

                        items.forEach(item => {
                            const row = `
                                <tr>
                                    <td>${item.partID}</td>
                                    <td>${item.partName}</td>
                                    <td>${item.quantity}</td>
                                    <td>${item.price}</td>
                                    <td>${item.supplier}</td>
                                    <td>${item.status}</td>
                                    <td>
                                        <button onclick="viewPart(${item.partID})">View</button>
                                    </td>
                                </tr>
                            `;
                            tableBody.append(row);
                        });
                    },
                    error: function() {
                        alert('Failed to load items.');
                    }
                });
            }

            window.viewPart = function(partID) {
                $.ajax({
                    url: 'fetchPartDetails.php',
                    type: 'GET',
                    data: { partID: partID },
                    success: function(response) {
                        try {
                            const partDetails = JSON.parse(response);
                            $('#viewDetails').html(`
                                <p><strong>Part ID:</strong> ${partDetails.partID}</p>
                                <p><strong>Part Name:</strong> ${partDetails.partName}</p>
                                <p><strong>Status:</strong> ${partDetails.status}</p>
                                <p><strong>Issue Details:</strong> ${partDetails.issue_details}</p>
                            `);
                            $('#viewModal').show(); // Show the modal
                        } catch (e) {
                            console.error('Error parsing JSON:', e);
                            alert('Failed to load part details. Please try again.');
                        }
                    },
                    error: function() {
                        alert('Failed to fetch part details.');
                    }
                });
            };

            $('#closeView').click(function() {
                $('#viewModal').hide(); // Hide the modal when close button is clicked
            });
        });
    </script>
</body>
</html>

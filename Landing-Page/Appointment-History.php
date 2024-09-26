<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment History</title>
    
    <!-- Bootstrap & jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Custom Styling -->
    <style>
        body {
            background-color: #f0f2f5;
            font-family: 'Poppins', sans-serif;
        }

        .container {
            margin-top: 30px;
            padding: 20px;
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .back-btn {
            font-size: 18px;
            display: inline-block;
            color: #007bff;
            text-decoration: none;
            transition: color 0.3s ease-in-out;
        }

        .back-btn i {
            margin-right: 8px;
        }

        .back-btn:hover {
            color: #0056b3;
            text-decoration: underline;
        }

        h2 {
            text-align: center;
            font-weight: 600;
            color: #333;
            margin-bottom: 30px;
        }

        /* Table Styling */
        .table-responsive {
            margin-top: 20px;
        }

        .table thead th {
            background-color: #007bff;
            color: white;
            text-align: center;
            font-weight: bold;
            font-size: 16px;
        }

        .table tbody td {
            text-align: center;
            color: #555;
            vertical-align: middle;
        }

        .table tbody tr:hover {
            background-color: #f1f1f1;
        }

        .btn {
            padding: 6px 12px;
            border-radius: 25px;
            font-size: 14px;
            transition: all 0.3s ease-in-out;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .btn-danger {
            background-color: #dc3545;
            border: none;
        }

        .btn-primary:hover, .btn-danger:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        /* View Modal Custom Styling */
        .modal-content {
            border-radius: 20px;
        }

        .modal-header {
            background-color: #007bff;
            color: white;
        }

        .modal-title {
            font-weight: bold;
            text-transform: uppercase;
        }

        .modal-body {
            font-size: 16px;
            color: #333;
        }

        .modal-footer .btn-secondary {
            background-color: #6c757d;
            border-radius: 20px;
        }

        /* Hidden columns */
        .hidden-column {
            display: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="map.php" class="back-btn"><i class="fas fa-arrow-left"></i>Back to Previous Page</a>
        <h2>Customer Appointment History</h2>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">First Name</th>
                        <th scope="col" class="hidden-column">Last Name</th>
                        <th scope="col">Phone Number</th>
                        <th scope="col" class="hidden-column">Email Address</th>
                        <th scope="col" class="hidden-column">Car Make</th>
                        <th scope="col" class="hidden-column">Car Model</th>
                        <th scope="col">Repair Details</th>
                        <th scope="col">Appointment Date and Time</th>
                        <th scope="col">Status</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody id="appointmentTableBody">
                    <!-- Table rows will be populated here via AJAX -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal for viewing customer details -->
    <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewModalLabel">Customer Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="customerDetails"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- AJAX and animations logic -->
    <script>
       $(document).ready(function() {
            fetchAppointments();

            // Function to fetch customer appointments
            function fetchAppointments() {
                $.ajax({
                    url: 'fetch_History_appointments.php',
                    type: 'GET',
                    success: function(response) {
                        $('#appointmentTableBody').html(response);  // Populate table with rows
                    },
                    error: function() {
                        alert("Failed to fetch appointment history.");
                    }
                });
            }

            // Delete function
            $(document).on('click', '.deleteBtn', function() {
    var customer_id = $(this).data('id'); // Get the customer ID from the button's data attribute
    if (confirm("Are you sure you want to delete this record?")) {
        $.ajax({
            url: 'delete_appointment.php',
            type: 'POST',
            data: { customer_id: customer_id },
            success: function(response) {
                if (response === "success") {
                    alert("Record deleted successfully.");
                    fetchAppointments();  // Reload table after deletion
                } else {
                    alert("Failed to delete the record: " + response);
                }
            },
            error: function() {
                alert("Error deleting the record.");
            }
        });
    }
});


            // View function
            $(document).on('click', '.viewBtn', function() {
                var customer_id = $(this).data('id');
                $.ajax({
                    url: 'view_appointment.php',
                    type: 'GET',
                    data: { customer_id: customer_id },
                    success: function(response) {
                        $('#customerDetails').html(response);
                        $('#viewModal').modal('show');  // Show the modal with animation
                    },
                    error: function() {
                        alert("Failed to retrieve customer details.");
                    }
                });
            });
        });
    </script>
</body>
</html>

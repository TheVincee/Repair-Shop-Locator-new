<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enhanced Task Management</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        /* Custom CSS for Enhanced Design */
        .table {
            margin-top: 20px;
            border-radius: 0.75rem;
            overflow: hidden;
            box-shadow: 0 6px 12px rgba(0,0,0,0.15);
            font-size: 0.85rem; /* Adjusted font size */
        }
        
        .table thead th {
            text-align: center;
            padding: 0.75rem;
            font-weight: bold;
            font-size: 0.85rem; /* Adjusted font size */
        }
        .table tbody tr {
            transition: background-color 0.3s, transform 0.3s;
        }
        .table tbody tr:hover {
            background-color: #f1f1f1;
            transform: scale(1.02);
        }
        .table tbody tr.success {
            background-color: #28a745;
        }
        .table tbody tr.danger {
            background-color: #f8d7da;
        }
        .table tbody tr.warning {
            background-color: #fff3cd;
        }
        .table td, .table th {
            vertical-align: middle;
            padding: 0.75rem;
            text-align: center;
            font-size: 0.85rem; /* Adjusted font size */
        }
        .status-icon {
            font-size: 1rem; /* Slightly adjusted icon size */
            vertical-align: middle;
        }
        .status-text {
            font-weight: 500;
            font-size: 0.85rem; /* Adjusted font size */
            vertical-align: middle;
            margin-left: 0.5rem;
        }
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .table td, .table th {
                padding: 0.5rem;
            }
            .status-icon {
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <!-- Back Button -->
        <div class="mb-4">
            <a href="Dashboard.php" class="btn btn-primary">
                <i class="bi bi-arrow-left-circle"></i> Back to Dashboard
            </a>
        </div>

        <h1 class="mt-4 mb-4">Customer Details</h1>
        <table class="table table-striped" id="customerDetailsTable">
            <thead class="bg-success text-light">
                <tr>
                    <th scope="col">Customer ID</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Car Model</th>
                    <th scope="col">Repair Details</th>
                    <th scope="col">Appointment Time</th>
                    <th scope="col">Appointment Date</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                <!-- Rows will be dynamically inserted here -->
            </tbody>
        </table>

        <h1 class="mt-4 mb-4">Walk-in Appointments</h1>
        <table class="table table-striped" id="walkinAppointmentsTable">
            <thead class="bg-success text-light">
                <tr>
                    <th scope="col">Customer ID</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Repair Details</th>
                    <th scope="col">Appointment Time</th>
                    <th scope="col">Appointment Date</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                <!-- Rows will be dynamically inserted here -->
            </tbody>
        </table>
    </div>

    <!-- Modal for Viewing Customer Details -->
    <div class="modal fade" id="customerDetailsModal" tabindex="-1" aria-labelledby="customerDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="customerDetailsModalLabel">Customer Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="customerDetailsContent">
                    <!-- Customer details will be inserted here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- jQuery (necessary for AJAX) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
    $(document).ready(function() {
        // Fetch and display customer details
        $.ajax({
            url: 'fetch_appointment_details.php', // Adjust path if necessary
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                var customerTableBody = $('#customerDetailsTable tbody');
                customerTableBody.empty();
                $.each(data, function(index, customer) {
                    customerTableBody.append(
                        '<tr>' +
                            '<td>' + customer.customer_id + '</td>' +
                            '<td>' + customer.firstname + '</td>' +
                            '<td>' + customer.carmodel + '</td>' +
                            '<td>' + customer.repairdetails + '</td>' +
                            '<td>' + customer.appointment_time + '</td>' +
                            '<td>' + customer.appointment_date + '</td>' +
                            '<td>' + customer.Status + '</td>' +
                        '</tr>'
                    );
                });

                // Attach click event to view details buttons
                $('.view-details').on('click', function() {
                    var customerId = $(this).data('customer-id');
                    $.ajax({
                        url: 'fetch_customer_details.php',
                        type: 'POST',
                        data: { customer_id: customerId },
                        dataType: 'json',
                        success: function(customer) {
                            var customerDetails = '<p><strong>Customer ID:</strong> ' + customer.customer_id + '</p>' +
                                '<p><strong>First Name:</strong> ' + customer.firstname + '</p>' +
                                '<p><strong>Car Model:</strong> ' + customer.carmodel + '</p>' +
                                '<p><strong>Repair Details:</strong> ' + customer.repairdetails + '</p>' +
                                '<p><strong>Appointment Time:</strong> ' + customer.appointment_time + '</p>' +
                                '<p><strong>Appointment Date:</strong> ' + customer.appointment_date + '</p>' +
                                '<p><strong>Status:</strong> ' + customer.Status + '</p>';
                            $('#customerDetailsContent').html(customerDetails);
                            var myModal = new bootstrap.Modal(document.getElementById('customerDetailsModal'));
                            myModal.show();
                        },
                        error: function(xhr, status, error) {
                            console.error('Error fetching customer details:', error);
                        }
                    });
                });
            },
            error: function(xhr, status, error) {
                console.error('Error fetching customer details:', error);
            }
        });

        // Fetch and display walk-in appointments
        $.ajax({
            url: 'fetch_walkin_appointments.php', // Adjust path if necessary
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                var walkinTableBody = $('#walkinAppointmentsTable tbody');
                walkinTableBody.empty();
                $.each(data, function(index, appointment) {
                    var statusClass = '';
                    var statusText = '';

                    switch (appointment.status) {
                        case 'Approved':
                            statusClass = 'success';
                            statusText = '<i class="bi bi-check-circle status-icon"></i><span class="status-text">Approved</span>';
                            break;
                        case 'Rejected':
                            statusClass = 'danger';
                            statusText = '<i class="bi bi-x-circle status-icon"></i><span class="status-text">Rejected</span>';
                            break;
                        case 'Pending':
                            statusClass = 'warning';
                            statusText = '<i class="bi bi-hourglass status-icon"></i><span class="status-text">Pending</span>';
                            break;
                    }

                    walkinTableBody.append(
                        '<tr class="' + statusClass + '">' +
                            '<td>' + appointment.customer_id + '</td>' +
                            '<td>' + appointment.first_name + '</td>' +
                            '<td>' + appointment.repair_details + '</td>' +
                            '<td>' + appointment.appointment_time + '</td>' +
                            '<td>' + appointment.appointment_date + '</td>' +
                            '<td>' + statusText + '</td>' +
                        '</tr>'
                    );
                });

                // Attach click event to view details buttons in walk-in appointments table
                $('.view-details').on('click', function() {
                    var customerId = $(this).data('customer-id');
                    $.ajax({
                        url: 'fetch_customer_details.php',
                        type: 'POST',
                        data: { customer_id: customerId },
                        dataType: 'json',
                        success: function(customer) {
                            var customerDetails = '<p><strong>Customer ID:</strong> ' + customer.customer_id + '</p>' +
                                '<p><strong>First Name:</strong> ' + customer.firstname + '</p>' +
                                '<p><strong>Car Model:</strong> ' + customer.carmodel + '</p>' +
                                '<p><strong>Repair Details:</strong> ' + customer.repairdetails + '</p>' +
                                '<p><strong>Appointment Time:</strong> ' + customer.appointment_time + '</p>' +
                                '<p><strong>Appointment Date:</strong> ' + customer.appointment_date + '</p>' +
                                '<p><strong>Status:</strong> ' + customer.Status + '</p>';
                            $('#customerDetailsContent').html(customerDetails);
                            var myModal = new bootstrap.Modal(document.getElementById('customerDetailsModal'));
                            myModal.show();
                        },
                        error: function(xhr, status, error) {
                            console.error('Error fetching customer details:', error);
                        }
                    });
                });
            },
            error: function(xhr, status, error) {
                console.error('Error fetching walk-in appointments:', error);
            }
        });
    });
    </script>
</body>
</html>

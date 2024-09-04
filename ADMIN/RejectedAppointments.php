<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rejected Appointments</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        /* Custom CSS */
        .container {
            margin-top: 20px;
        }
        .back-button {
            margin-bottom: 20px;
        }
        .table {
            border-collapse: separate;
            border-spacing: 0;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border: 2px solid #dc3545;
        }
        .table thead th {
            background-color: #dc3545;
            color: #ffffff;
            font-weight: bold;
            border-bottom: 2px solid #dc3545;
        }
        .table tbody tr {
            background-color: #f8f9fa;
        }
        .table tbody tr:nth-child(even) {
            background-color: #e9ecef;
        }
        .table th, .table td {
            text-align: center;
            vertical-align: middle;
            border: 1px solid #dc3545;
        }
        .table .status-icon {
            color: #dc3545;
            font-size: 1.2rem;
        }
        .img-thumbnail {
            max-width: 80px;
            height: auto;
        }
        .modal-content {
            border-radius: 15px;
        }
        .modal-header {
            background-color: #dc3545;
            color: #ffffff;
            border-bottom: none;
        }
        .modal-body {
            padding: 2rem;
        }
        .btn-primary {
            background-color: #dc3545;
            border-color: #dc3545;
        }
        .btn-primary:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }
        .btn-secondary {
            border-radius: 0.375rem;
        }
        .btn-info, .btn-danger {
            border-radius: 0.375rem;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .card-body {
            padding: 1.5rem;
        }

        /* Hide specific columns */
        .table .hide-col {
            display: none;
        }
    </style>
</head>
<body>
    
    <div class="container">
        <!-- Back Button -->
        <div class="back-button">
            <a href="Dashboard.php" class="btn btn-secondary">Back to Dashboard</a>
        </div>

        <!-- Rejected Appointments Table -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-4">Rejected Appointments</h5>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Customer ID</th>
                            <th>First Name</th>
                            <th class="hide-col">Last Name</th>
                            <th>Phone Number</th>
                            <th class="hide-col">Email Address</th>
                            <th class="hide-col">Car Make</th>
                            <th class="hide-col">Car Model</th>
                            <th>Repair Details</th>
                            <th>Appointment Time</th>
                            <th>Appointment Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="appointmentsTableBody">
                        <!-- Dynamic rows will be injected here by JavaScript -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- View Modal -->
    <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewModalLabel">Appointment Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="modalContent">
                        <p><strong>Customer ID:</strong> <span id="modalCustomerId"></span></p>
                        <p><strong>First Name:</strong> <span id="modalFirstName"></span></p>
                        <p><strong>Last Name:</strong> <span id="modalLastName"></span></p>
                        <p><strong>Phone Number:</strong> <span id="modalPhoneNumber"></span></p>
                        <p><strong>Email Address:</strong> <span id="modalEmailAddress"></span></p>
                        <p><strong>Car Make:</strong> <span id="modalCarMake"></span></p>
                        <p><strong>Car Model:</strong> <span id="modalCarModel"></span></p>
                        <p><strong>Repair Details:</strong> <span id="modalRepairDetails"></span></p>
                        <p><strong>Appointment Time:</strong> <span id="modalAppointmentTime"></span></p>
                        <p><strong>Appointment Date:</strong> <span id="modalAppointmentDate"></span></p>
                        <p><strong>Status:</strong> <span id="modalStatus"></span></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
       $(document).ready(function () {
    // Fetch and display rejected appointments on page load
    $.ajax({
        url: 'fetch_rejected_appointments.php', // Correct URL to your PHP script
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            if (Array.isArray(data) && data.length === 0) {
                $('#appointmentsTableBody').html('<tr><td colspan="12" class="text-center">No rejected appointments found</td></tr>');
            } else if (data.error) {
                $('#appointmentsTableBody').html('<tr><td colspan="12" class="text-center">' + data.error + '</td></tr>');
            } else {
                var rows = '';
                $.each(data, function (index, appointment) {
                    rows += '<tr>';
                    rows += '<td>' + appointment.customer_id + '</td>';
                    rows += '<td>' + appointment.firstname + '</td>';
                    rows += '<td class="hide-col">' + appointment.lastname + '</td>';
                    rows += '<td>' + appointment.phoneNumber + '</td>';
                    rows += '<td class="hide-col">' + appointment.emailAddress + '</td>';
                    rows += '<td class="hide-col">' + appointment.carmake + '</td>';
                    rows += '<td class="hide-col">' + appointment.carmodel + '</td>';
                    rows += '<td>' + appointment.repairdetails + '</td>';
                    rows += '<td>' + appointment.appointment_time + '</td>';
                    rows += '<td>' + appointment.appointment_date + '</td>';
                    rows += '<td><span class="status-icon">&#10060;</span> ' + appointment.Status + '</td>';
                    rows += '<td><button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#viewModal" data-id="' + appointment.customer_id + '">View</button></td>';
                    rows += '</tr>';
                });
                $('#appointmentsTableBody').html(rows);
            }
        },
        error: function (xhr, status, error) {
            console.error('AJAX Error:', status, error);
            $('#appointmentsTableBody').html('<tr><td colspan="12" class="text-center">Failed to fetch data. Please try again.</td></tr>');
        }
    });

    // Set up the modal to load data when shown
    $('#viewModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var customerId = button.data('id');

        // AJAX request to fetch the details of the selected appointment
        $.ajax({
            url: 'Get_Rejected.php', // Correct URL to your PHP script
            type: 'GET',
            data: { id: customerId },
            dataType: 'json',
            success: function (appointment) {
                if (appointment.error) {
                    $('#modalContent').html('<p class="text-danger">' + appointment.error + '</p>');
                } else {
                    $('#modalCustomerId').text(appointment.customer_id);
                    $('#modalFirstName').text(appointment.firstname);
                    $('#modalLastName').text(appointment.lastname);
                    $('#modalPhoneNumber').text(appointment.phoneNumber);
                    $('#modalEmailAddress').text(appointment.emailAddress);
                    $('#modalCarMake').text(appointment.carmake);
                    $('#modalCarModel').text(appointment.carmodel);
                    $('#modalRepairDetails').text(appointment.repairdetails);
                    $('#modalAppointmentTime').text(appointment.appointment_time);
                    $('#modalAppointmentDate').text(appointment.appointment_date);
                    $('#modalStatus').text(appointment.Status);
                }
            },
            error: function (xhr, status, error) {
                console.error('AJAX Error:', status, error);
                $('#modalContent').html('<p class="text-danger">Failed to fetch appointment details. Please try again.</p>');
            }
        });
    });
});

    </script>
</body>
</html>

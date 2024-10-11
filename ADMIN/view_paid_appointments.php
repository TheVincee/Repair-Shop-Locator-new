<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paid Appointments</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            background: #f4f4f4;
            font-family: 'Arial', sans-serif;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .table-container {
            background: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .back-button {
            display: inline-block;
            margin-bottom: 20px;
            color: #007bff;
            text-decoration: none;
            font-size: 0.9em;
        }

        .back-button:hover {
            text-decoration: underline;
        }

        table {
            width: 100%;
            border-radius: 10px;
            overflow: hidden;
        }

        table th,
        table td {
            padding: 10px;
            text-align: left;
            vertical-align: middle;
            font-size: 0.9em;
        }

        table th {
            background: #007bff;
            color: #ffffff;
            font-weight: bold;
        }

        table tbody tr {
            transition: background 0.2s ease-in-out;
        }

        table tbody tr:hover {
            background: #f1f1f1;
        }

        .status-paid {
            background: #28a745;
            color: #ffffff;
            padding: 4px 8px;
            border-radius: 3px;
            display: inline-block;
            font-size: 0.8em;
        }

        .btn-view {
            font-weight: bold;
            color: #ffffff;
            background: #007bff;
            border-radius: 5px;
            padding: 4px 10px;
            border: none;
            font-size: 0.8em;
            transition: background 0.3s ease;
        }

        .btn-view:hover {
            background: #0056b3;
        }

        .modal-content {
            border-radius: 10px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
            padding: 15px;
        }

        .modal-title {
            font-size: 1.1em;
        }

        .modal-body p {
            margin-bottom: 10px;
        }
    </style>
</head>

<body>

    <div class="container">
        <a href="Dashboard.php" class="back-button"><i class="fas fa-arrow-left"></i> Back to Previous Page</a>
        <div class="table-container">
            <h2 class="mb-4 text-center">Paid Appointments</h2>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Customer ID</th>
                        <th>First Name</th>
                        <th>Phone Number</th>
                        <th>Email Address</th>
                        <th>Repair Details</th>
                        <th>Appointment Time</th>
                        <th>Appointment Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="appointmentsTableBody">
                    <!-- Rows will be dynamically inserted here -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Structure -->
    <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewModalLabel">Appointment Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Customer ID:</strong> <span id="modalCustomerId"></span></p>
                    <p><strong>First Name:</strong> <span id="modalFirstName"></span></p>
                    <p><strong>Phone Number:</strong> <span id="modalPhoneNumber"></span></p>
                    <p><strong>Email Address:</strong> <span id="modalEmailAddress"></span></p>
                    <p><strong>Repair Details:</strong> <span id="modalRepairDetails"></span></p>
                    <p><strong>Appointment Time:</strong> <span id="modalAppointmentTime"></span></p>
                    <p><strong>Appointment Date:</strong> <span id="modalAppointmentDate"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (Optional, for interactive elements like modals) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <!-- jQuery (Required for AJAX) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
    $(document).ready(function () {
        // Fetch and display paid appointments on page load
        $.ajax({
            url: 'fetchPaidAppointments.php', // URL to your PHP script
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                if (data.length === 0) {
                    $('#appointmentsTableBody').html('<tr><td colspan="9" class="text-center">No paid appointments found</td></tr>');
                } else {
                    var rows = '';
                    $.each(data, function (index, appointment) {
                        rows += '<tr>';
                        rows += '<td>' + appointment.customer_id + '</td>';
                        rows += '<td>' + appointment.firstname + '</td>';
                        rows += '<td>' + appointment.phoneNumber + '</td>';
                        rows += '<td>' + appointment.emailAddress + '</td>';
                        rows += '<td>' + appointment.repairdetails + '</td>';
                        rows += '<td>' + appointment.appointment_time + '</td>';
                        rows += '<td>' + appointment.appointment_date + '</td>';
                        rows += '<td><span class="status-paid">' + appointment.payment_status + '</span></td>'; // Adjust status to payment_status
                        rows += '<td><button type="button" class="btn btn-view" data-bs-toggle="modal" data-bs-target="#viewModal" data-id="' + appointment.customer_id + '">View</button></td>';
                        rows += '</tr>';
                    });
                    $('#appointmentsTableBody').html(rows);
                }
            },
            error: function (xhr, status, error) {
                console.error('AJAX Error:', status, error);
                $('#appointmentsTableBody').html('<tr><td colspan="9" class="text-center">Failed to fetch data. Please try again.</td></tr>');
            }
        });

        // Set up the modal to load data when shown
        $('#viewModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var customerId = button.data('id'); // Extract info from data-id attribute

            // Fetch the appointment details
            $.ajax({
                url: 'getAppointmentDetails.php',
                type: 'GET',
                data: { id: customerId },
                dataType: 'json',
                success: function (data) {
                    if (data.error) {
                        alert(data.error);
                    } else {
                        $('#modalCustomerId').text(data.customer_id);
                        $('#modalFirstName').text(data.firstname);
                        $('#modalPhoneNumber').text(data.phoneNumber);
                        $('#modalEmailAddress').text(data.emailAddress);
                        $('#modalRepairDetails').text(data.repairdetails);
                        $('#modalAppointmentTime').text(data.appointment_time);
                        $('#modalAppointmentDate').text(data.appointment_date);
                    }
                },
                error: function (xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                    alert('Failed to fetch data. Please try again.');
                }
            });
        });
    });
    </script>
</body>

</html>

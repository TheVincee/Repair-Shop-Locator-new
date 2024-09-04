<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>In Processing Appointments</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: #f0f2f5;
            margin: 0;
            padding: 20px;
        }
        .card {
            background: linear-gradient(135deg, #ffffff 0%, #f0f0f0 100%);
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 25px;
            margin-bottom: 20px;
            transition: transform 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .card-title {
            font-size: 28px;
            color: #333;
            margin-bottom: 20px;
        }
        .back-btn {
            display: inline-block;
            background-color: #007bff;
            color: white;
            padding: 12px 25px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 16px;
            margin-bottom: 20px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        .back-btn:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }
        th {
            background-color: #007bff;
            color: white;
            font-weight: 500;
        }
        tr:nth-child(even) {
            background-color: #fafafa;
        }
        tr:hover {
            background-color: #f1f5ff;
        }
        .hide-col {
            display: none;
        }
        .action-buttons {
            display: flex;
            gap: 10px;
        }
        .action-link {
            display: inline-block;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 14px;
            color: #fff;
            text-align: center;
            transition: background-color 0.3s ease, transform 0.3s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .action-link.view {
            background-color: #17a2b8;
        }
        .action-link.update {
            background-color: #ffc107;
        }
        .action-link.delete {
            background-color: #dc3545;
        }
        .action-link:hover {
            opacity: 0.85;
            transform: translateY(-2px);
        }
        .status-icon {
            display: inline-block;
            margin-right: 8px;
            vertical-align: middle;
        }
    </style>
</head>
<body>
    <a href="Dashboard.php" class="back-btn">Back</a>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">In Processing Appointments</h5>
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
                    <!-- Data will be populated here via AJAX -->
                </tbody>
            </table>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            // Fetch and display "In Processing" appointments on page load
            $.ajax({
                url: 'InProcessingFetch.php', // Correct URL to your PHP script
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    if (Array.isArray(data) && data.length === 0) {
                        $('#appointmentsTableBody').html('<tr><td colspan="12" class="text-center">No "In Processing" appointments found</td></tr>');
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
                            rows += '<td>';
                            rows += '<div class="action-buttons">';
                            rows += '<a href="#" class="action-link view" data-bs-toggle="modal" data-bs-target="#viewModal" data-id="' + appointment.customer_id + '">View</a>';
                            rows += '<a href="#" class="action-link update">Update</a>';
                            rows += '<a href="#" class="action-link delete">Delete</a>';
                            rows += '</div>';
                            rows += '</td>';
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
                    url: 'Get_In_Processing.php', // Correct URL to your PHP script
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
                        $('#modalContent').html('<p class="text-danger">Failed to fetch data. Please try again.</p>');
                    }
                });
            });
        });
    </script>
</body>
</html>

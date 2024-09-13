<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>In Processing Appointments</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
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
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2);
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
        .action-btn {
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
        .action-btn.view {
            background-color: #17a2b8;
        }
        .action-btn:hover {
            opacity: 0.85;
            transform: translateY(-2px);
        }
        .status-icon {
            display: inline-block;
            margin-right: 8px;
            vertical-align: middle;
        }
        .status-in-processing {
            color: #007bff;
            font-weight: bold;
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

   <!-- View Modal -->
<div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewModalLabel">Appointment Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="modal-detail">
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
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
     $(document).ready(function () {
    function fetchAppointments() {
        $.ajax({
            url: 'InProcessingFetch.php', // URL to the PHP backend script
            type: 'GET',
            dataType: 'json', // Expect JSON response
            success: function (data) {
                let rows = '';

                // Loop through each appointment and create rows for the table
                $.each(data, function (index, appointment) {
                    rows += '<tr>';
                    rows += '<td>' + appointment.customer_id + '</td>';  // Customer ID
                    rows += '<td>' + appointment.firstname + '</td>';   // First Name
                    rows += '<td class="hide-col">' + appointment.lastname + '</td>';  // Last Name (hidden)
                    rows += '<td>' + appointment.phoneNumber + '</td>';  // Phone Number
                    rows += '<td class="hide-col">' + appointment.emailAddress + '</td>';  // Email Address (hidden)
                    rows += '<td class="hide-col">' + appointment.carmake + '</td>';  // Car Make (hidden)
                    rows += '<td class="hide-col">' + appointment.carmodel + '</td>';  // Car Model (hidden)
                    rows += '<td>' + appointment.repairdetails + '</td>';  // Repair Details
                    rows += '<td>' + appointment.appointment_time + '</td>';  // Appointment Time
                    rows += '<td>' + appointment.appointment_date + '</td>';  // Appointment Date
                    rows += '<td><span class="status-approved">' + appointment.Status + '</span></td>';  // Status
                    rows += '<td><button type="button" class="btn btn-view" data-bs-toggle="modal" data-bs-target="#viewModal" data-id="' + appointment.customer_id + '">View</button></td>';  // View button
                    rows += '</tr>';
                });
                $('#appointmentsTableBody').html(rows);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error('AJAX Error:', textStatus, errorThrown);
                alert('Failed to load appointments.');
            }
        });
    }

    // Call fetchAppointments when the page is ready
    fetchAppointments();

    $(document).on('click', '.btn-view', function () {
        const appointmentId = $(this).data('id'); // Fetch the customer_id from the button's data-id attribute

        $.ajax({
            url: 'InprocessviewAppointment.php',  // Path to your PHP script
            type: 'GET',
            dataType: 'json',  // Expect JSON response
            data: { id: appointmentId },  // Send the customer_id as GET parameter
            success: function (response) {
                // Check for errors in the response
                if (response.error) {
                    alert(response.error);
                    return;
                }

                // Fill modal fields with the fetched data
                $('#modalCustomerId').text(response.customer_id || 'N/A');
                $('#modalFirstName').text(response.firstname || 'N/A');
                $('#modalLastName').text(response.lastname || 'N/A');
                $('#modalPhoneNumber').text(response.phoneNumber || 'N/A');
                $('#modalEmailAddress').text(response.emailAddress || 'N/A');
                $('#modalCarMake').text(response.carmake || 'N/A');
                $('#modalCarModel').text(response.carmodel || 'N/A');
                $('#modalRepairDetails').text(response.repairdetails || 'N/A');
                $('#modalAppointmentTime').text(response.appointment_time || 'N/A');
                $('#modalAppointmentDate').text(response.appointment_date || 'N/A');
                $('#modalStatus').text(response.Status || 'N/A');

                // Show the modal
                const viewModal = new bootstrap.Modal(document.getElementById('viewModal'));
                viewModal.show();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error('AJAX Error:', textStatus, errorThrown);
                alert('Failed to load appointment details.');
            }
        });
    });
});

    </script>
</body>
</html>

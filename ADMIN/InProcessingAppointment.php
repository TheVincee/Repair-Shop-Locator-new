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
            background-color: #f8f9fa;
            color: #333;
            padding: 20px;
            
        }
        .hide-col {
    display: none;
}


        .back-btn {
            display: inline-block;
            margin-bottom: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 30px;
            transition: background-color 0.3s ease;
        }

        .back-btn:hover {
            background-color: #0056b3;
        }

        .card {
            background-color: #fff;
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .card-body {
            padding: 20px;
        }

        .card-title {
            font-size: 24px;
            font-weight: 500;
            margin-bottom: 20px;
            text-align: center;
        }

        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
            border-collapse: separate;
            border-spacing: 0 10px;
        }

        .table thead th {
            border: none;
            background-color: #007bff;
            color: #fff;
            padding: 15px;
            font-weight: 500;
            text-align: center;
        }

        .table tbody tr {
            transition: transform 0.3s ease;
        }

        .table tbody tr:hover {
            transform: scale(1.02);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .table tbody td {
            background-color: #fff;
            border: none;
            padding: 15px;
            text-align: center;
        }

        .table tbody td:first-child {
            border-top-left-radius: 10px;
            border-bottom-left-radius: 10px;
        }

        .table tbody td:last-child {
            border-top-right-radius: 10px;
            border-bottom-right-radius: 10px;
        }

        .btn-view {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 30px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .btn-view:hover {
            background-color: #0056b3;
            transform: translateY(-3px);
        }

        .modal-header {
            background-color: #007bff;
            color: #fff;
            border-bottom: none;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .modal-footer {
            border-top: none;
        }

        .btn-close {
            color: #fff;
            font-size: 1.5rem;
        }

        .status-approved {
            background-color: #28a745;
            color: #fff;
            padding: 5px 10px;
            border-radius: 30px;
            font-weight: 500;
        }

        /* Animations */
        .modal-content {
            opacity: 0;
            transform: translateY(-50px);
            animation: fadeIn 0.4s forwards;
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }    
        @media (max-width: 768px) {
    .hide-col {
        display: none;
    }
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
            url: 'InProcessingFetch.php',
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                let rows = '';

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
                    rows += '<td><span class="status-approved">' + appointment.Status + '</span></td>';
                    rows += '<td><button type="button" class="btn btn-view" data-bs-toggle="modal" data-bs-target="#viewModal" data-id="' + appointment.customer_id + '">View</button></td>';
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

    fetchAppointments();

    $(document).ready(function () {
    $(document).on('click', '.btn-view', function () {
        const appointmentId = $(this).data('id');

        $.ajax({
            url: 'InprocessviewAppointment.php',
            type: 'GET',
            dataType: 'json',
            data: { id: appointmentId },
            success: function (response) {
                if (response.error) {
                    alert(response.error);
                    return;
                }

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

                const viewModal = new bootstrap.Modal(document.getElementById('viewModal'));
                viewModal.show();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error('AJAX Error:', textStatus, errorThrown);
                alert('Failed to load appointment details.');
            }
        });
    });

    // Reset modal content when it is closed
    $('#viewModal').on('hidden.bs.modal', function () {
        $('#modalCustomerId').text('');
        $('#modalFirstName').text('');
        $('#modalLastName').text('');
        $('#modalPhoneNumber').text('');
        $('#modalEmailAddress').text('');
        $('#modalCarMake').text('');
        $('#modalCarModel').text('');
        $('#modalRepairDetails').text('');
        $('#modalAppointmentTime').text('');
        $('#modalAppointmentDate').text('');
        $('#modalStatus').text('');
    });
});

});

    </script>
</body>
</html>

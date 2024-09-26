<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Appointment History</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        .table {
            margin-top: 20px;
            border-radius: 0.75rem;
            overflow: hidden;
            box-shadow: 0 6px 12px rgba(0,0,0,0.15);
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <div class="mb-4">
            <a href="Dashboard.php" class="btn btn-primary">Back to Dashboard</a>
        </div>

        <h1 class="mb-4">Customer Appointment History</h1>

        <table class="table table-striped" id="appointmentHistoryTable">
            <thead class="bg-success text-light">
                <tr>
                    <th scope="col">Customer ID</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Phone Number</th>
                    <th scope="col">Email Address</th>
                    <th scope="col">Car Make</th>
                    <th scope="col">Car Model</th>
                    <th scope="col">Repair Details</th>
                    <th scope="col">Appointment Time</th>
                    <th scope="col">Appointment Date</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                <!-- Rows will be injected here by AJAX -->
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
      $(document).ready(function() {
    $.ajax({
        url: 'fetch_combined_appointments.php', // Update to your PHP script path
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            console.log(data); // Check the data received
            if (data.error) {
                console.error(data.error); // Log any SQL errors
            } else if (data.rowCount && data.rowCount > 0) {
                // Populate your table with data
                $.each(data.data, function(index, appointment) {
                    $('#appointmentHistoryTable tbody').append(
                        `<tr>
                            <td>${index + 1}</td>
                            <td>${appointment.firstname}</td>
                            <td>${appointment.lastname}</td>
                            <td>${appointment.phoneNumber}</td>
                            <td>${appointment.emailAddress}</td>
                            <td>${appointment.carmake}</td>
                            <td>${appointment.carmodel}</td>
                            <td>${appointment.repairdetails}</td>
                            <td>${appointment.appointment_time}</td>
                            <td>${appointment.appointment_date}</td>
                            <td>${appointment.Status}</td>
                        </tr>`
                    );
                });
            } else {
                $('#appointmentHistoryTable tbody').append('<tr><td colspan="11" class="text-center">No appointments found.</td></tr>');
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('AJAX Error:', textStatus, errorThrown);
        }
    });
});
his closing bracket matches with the opening one


    </script>
</body>
</html>

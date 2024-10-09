<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="paid.css"> <!-- Link to your CSS file -->
    <title>Paid Appointments</title>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Paid Appointments</h2>

        <!-- Back button -->
        <div class="text-end mb-3">
            <a href="Dashboard.php" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>

        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Customer ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Phone Number</th>
                    <th>Email Address</th>
                    <th>Repair Details</th>
                    <th>Car Model</th>
                    <th>Service Type</th>
                    <th>Total Payable</th>
                    <th>Payment Type</th>
                    <th>Payment Status</th>
                </tr>
            </thead>
            <tbody>
                <!-- Data will be inserted here by JavaScript -->
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            fetchPaidAppointments();
        });

        function fetchPaidAppointments() {
            $.ajax({
                url: 'fetch_paid_appointments.php',
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    const tbody = $('tbody');
                    tbody.empty(); // Clear existing data

                    if (Array.isArray(response)) {
                        response.forEach(appointment => {
                            const row = `
                                <tr>
                                    <td>${appointment.customer_id}</td>
                                    <td>${appointment.firstname}</td>
                                    <td>${appointment.lastname}</td>
                                    <td>${appointment.phoneNumber}</td>
                                    <td>${appointment.emailAddress}</td>
                                    <td>${appointment.repairdetails}</td>
                                    <td>${appointment.carmodel}</td>
                                    <td>${appointment.service_type}</td>
                                    <td>${appointment.total_payable}</td>
                                    <td>${appointment.payment_type}</td>
                                    <td>${appointment.payment_status}</td>
                                </tr>
                            `;
                            tbody.append(row);
                        });
                    } else {
                        console.error('Invalid response structure:', response);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX error:', status, error);
                }
            });
        }
    </script> <!-- Link to your JavaScript file -->
</body>
</html>

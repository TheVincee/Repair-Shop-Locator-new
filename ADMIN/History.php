<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Appointment History</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="icon" href="data:,"> <!-- Prevent favicon 404 error -->
    <style>
        .table {
            margin-top: 20px;
            border-radius: 0.75rem;
            overflow: hidden;
            box-shadow: 0 6px 12px rgba(0,0,0,0.15);
        }

        /* Hide columns globally */
        .hidden-col {
            display: none;
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
                    <th scope="col" class="hidden-col">Last Name</th> <!-- Hidden Column -->
                    <th scope="col">Phone Number</th>
                    <th scope="col" class="hidden-col">Email Address</th> <!-- Hidden Column -->
                    <th scope="col" class="hidden-col">Car Make</th> <!-- Hidden Column -->
                    <th scope="col" class="hidden-col">Car Model</th> <!-- Hidden Column -->
                    <th scope="col">Repair Details</th>
                    <th scope="col">Appointment Time</th>
                    <th scope="col">Appointment Date</th>
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th> <!-- Action Column for View/Delete -->
                </tr>
            </thead>
            <tbody>
                <!-- Rows will be injected here by AJAX -->
            </tbody>
        </table>
    </div>

    <!-- View Modal -->
    <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewModalLabel">Appointment Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="appointmentDetails">Loading...</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript and jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
$(document).ready(function() {
    // Fetch appointment data
    $.ajax({
        url: 'fetch_combined_appointments.php',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            if (data.error) {
                console.error(data.error);
            } else if (data.rowCount && data.rowCount > 0) {
                $.each(data.data, function(index, appointment) {
                    $('#appointmentHistoryTable tbody').append(
                        `<tr>
                            <td>${appointment.customer_id}</td>
                            <td>${appointment.firstname}</td>
                            <td class="hidden-col">${appointment.lastname}</td>
                            <td>${appointment.phoneNumber}</td>
                            <td class="hidden-col">${appointment.emailAddress}</td>
                            <td class="hidden-col">${appointment.carmake}</td>
                            <td class="hidden-col">${appointment.carmodel}</td>
                            <td>${appointment.repairdetails}</td>
                            <td>${appointment.appointment_time}</td>
                            <td>${appointment.appointment_date}</td>
                            <td>${appointment.Status}</td>
                            <td>
                                <button class="btn btn-info btn-sm view-btn" data-id="${appointment.customer_id}">View</button>
                                <button class="btn btn-danger btn-sm delete-btn" data-id="${appointment.customer_id}">Delete</button>
                            </td>
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

    // View button click event
    $(document).on('click', '.view-btn', function() {
    var customerId = $(this).data('id'); // Get customer ID
    $.ajax({
        url: 'fetchs_appointment_details.php',
        type: 'GET',
        data: { customer_id: customerId }, // Send customer_id to server
        dataType: 'json', // Expect JSON response
        success: function(data) {
            if (data.success) {
                let appointment = data.data; // Access the appointment data

                // Populate the modal with appointment details
                $('#appointmentDetails').html(`
                    <strong>First Name:</strong> ${appointment.customer_firstname || appointment.walkin_firstname || 'N/A'}<br>
                    <strong>Last Name:</strong> ${appointment.lastname || 'N/A'}<br>
                    <strong>Phone Number:</strong> ${appointment.phoneNumber || appointment.walkin_phoneNumber || 'N/A'}<br>
                    <strong>Email Address:</strong> ${appointment.emailAddress || appointment.walkin_emailAddress || 'N/A'}<br>
                    <strong>Car Make:</strong> ${appointment.carmake || 'N/A'}<br>
                    <strong>Car Model:</strong> ${appointment.carmodel || 'N/A'}<br>
                    <strong>Repair Details:</strong> ${appointment.customer_repairdetails || appointment.walkin_repairdetails || 'N/A'}<br>
                    <strong>Appointment Time:</strong> ${appointment.customer_appointment_time || appointment.walkin_appointment_time || 'N/A'}<br>
                    <strong>Appointment Date:</strong> ${appointment.customer_appointment_date || appointment.walkin_appointment_date || 'N/A'}<br>
                    <strong>Status:</strong> ${appointment.customer_status || appointment.walkin_status || 'N/A'}
                `);
                $('#viewModal').modal('show'); // Show the modal
            } else {
                alert('Failed to fetch details: ' + data.error);
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('AJAX Error:', textStatus, errorThrown);
            alert('Error fetching appointment details.');
        }
    });
});



    // Delete button click event
    $(document).on('click', '.delete-btn', function() {
        var customerId = $(this).data('id');
        var row = $(this).closest('tr');

        if (confirm('Are you sure you want to delete this appointment?')) {
            $.ajax({
                url: 'deletes_appointment.php', // Ensure this path is correct
                type: 'POST',
                data: { customer_id: customerId },
                success: function(response) {
                    if (response.success) {
                        row.remove();
                        alert('Appointment deleted successfully.');
                    } else {
                        alert('Failed to delete the appointment. ' + (response.error || 'Unknown error.'));
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('AJAX Error:', textStatus, errorThrown);
                    alert('Error occurred while deleting the appointment.');
                }
            });
        }
    });
});

</script>

</body>
</html>

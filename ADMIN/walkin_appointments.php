<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Walk-in Appointments</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
            padding: 20px;
        }
        .table-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0px 10px 25px rgba(0, 0, 0, 0.15);
            margin-bottom: 20px;
        }
        .back-button {
            display: inline-block;
            margin-bottom: 20px;
            font-weight: bold;
            color: #007bff;
            text-decoration: none;
        }
        .back-button i {
            margin-right: 5px;
        }
        .table th, .table td {
            vertical-align: middle;
            text-align: center;
        }
        .btn-delete, .btn-update, .btn-add {
            font-weight: bold;
            color: #ffffff;
        }
        .btn-delete {
            background-color: #dc3545;
        }
        .btn-update {
            background-color: #ffc107;
        }
        .btn-add {
            background-color: #28a745;
        }
        .btn-sm {
            font-size: 0.875rem;
            padding: 0.25rem 0.5rem;
            border-radius: 0.2rem;
        }
        .action-buttons {
            display: flex;
            gap: 0.5rem;
            justify-content: center;
        }
    </style>
</head>
<body>

<div class="container">
    <a href="Dashboard.php" class="back-button"><i class="fas fa-arrow-left"></i> Back to Previous Page</a>
    
    <!-- Add Walk-in Appointment Button -->
    <div class="d-flex justify-content-end mb-3">
        <button type="button" class="btn btn-add" data-bs-toggle="modal" data-bs-target="#addWalkinModal">
            Add Walk-in Appointment
        </button>
    </div>

    <div class="table-container">
        <h2 class="mb-4 text-center">Walk-in Appointments (Pending)</h2>
        <table class="table table-hover">
            <thead class="table-light">
                <tr>
                    <th scope="col">Customer ID</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Phone Number</th>
                    <th scope="col">Email Address</th>
                    <th scope="col">Repair Details</th>
                    <th scope="col">Appointment Time</th>
                    <th scope="col">Appointment Date</th>
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Data will be populated here by AJAX -->
            </tbody>
        </table>
    </div>
</div>

<!-- Add Walk-in Appointment Modal -->
<div class="modal fade" id="addWalkinModal" tabindex="-1" aria-labelledby="addWalkinModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addWalkinModalLabel">Add Walk-in Appointment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addWalkinForm">
                    <div class="mb-3">
                        <label for="firstname" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name" required>
                    </div>
                    <div class="mb-3">
                        <label for="phoneNumber" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" placeholder="Phone Number" required>
                    </div>
                    <div class="mb-3">
                        <label for="emailAddress" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="emailAddress" name="emailAddress" placeholder="Email Address" required>
                    </div>
                    <div class="mb-3">
                        <label for="repairdetails" class="form-label">Repair Details</label>
                        <textarea class="form-control" id="repairdetails" name="repairdetails" rows="3" placeholder="Repair Details" required></textarea>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="appointment_time" class="form-label">Appointment Time</label>
                            <input type="time" class="form-control" id="appointment_time" name="appointment_time" required>
                        </div>
                        <div class="col">
                            <label for="appointment_date" class="form-label">Appointment Date</label>
                            <input type="date" class="form-control" id="appointment_date" name="appointment_date" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Update Walk-in Appointment Modal -->
<div class="modal fade" id="updateWalkinModal" tabindex="-1" aria-labelledby="updateWalkinModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateWalkinModalLabel">Update Walk-in Appointment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="updateWalkinForm">
                    <input type="hidden" id="update_customer_id" name="customer_id">
                    <div class="mb-3">
                        <label for="update_firstname" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="update_firstname" name="firstname" placeholder="First Name" required>
                    </div>
                    <div class="mb-3">
                        <label for="update_phoneNumber" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" id="update_phoneNumber" name="phoneNumber" placeholder="Phone Number" required>
                    </div>
                    <div class="mb-3">
                        <label for="update_emailAddress" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="update_emailAddress" name="emailAddress" placeholder="Email Address" required>
                    </div>
                    <div class="mb-3">
                        <label for="update_repairdetails" class="form-label">Repair Details</label>
                        <textarea class="form-control" id="update_repairdetails" name="repairdetails" rows="3" placeholder="Repair Details" required></textarea>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="update_appointment_time" class="form-label">Appointment Time</label>
                            <input type="time" class="form-control" id="update_appointment_time" name="appointment_time" required>
                        </div>
                        <div class="col">
                            <label for="update_appointment_date" class="form-label">Appointment Date</label>
                            <input type="date" class="form-control" id="update_appointment_date" name="appointment_date" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="update_Status" class="form-label">Status</label>
                        <select class="form-select" id="update_Status" name="Status" required>
                            <option value="Pending">Pending</option>
                            <option value="Approved">Approved</option>
                            <option value="Rejected">Rejected</option>
                            <option value="In Processing">In Processing</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteWalkinModal" tabindex="-1" aria-labelledby="deleteWalkinModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteWalkinModalLabel">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this appointment?</p>
                <input type="hidden" id="delete_customer_id">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteButton">Delete</button>
            </div>
        </div>
    </div>
</div>



<!-- Bootstrap JS (Optional, for interactive elements like dropdowns) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Function to fetch walk-in appointments with a status of 'pending'
    function fetchWalkinAppointments() {
        $.ajax({
            url: 'fetch_walkin_appointments.php',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                var tableBody = $('table tbody');
                tableBody.empty(); // Clear existing rows

                // Iterate over the data and create table rows
                $.each(data, function(index, appointment) {
                    var row = '<tr>' +
                        '<td>' + appointment.customer_id + '</td>' +
                        '<td>' + appointment.firstname + '</td>' +
                        '<td>' + appointment.phoneNumber + '</td>' +
                        '<td>' + appointment.emailAddress + '</td>' +
                        '<td>' + appointment.repairdetails + '</td>' +
                        '<td>' + appointment.appointment_time + '</td>' +
                        '<td>' + appointment.appointment_date + '</td>' +
                        '<td>' + appointment.Status + '</td>' +
                        '<td class="action-buttons">' +
                            '<button type="button" class="btn btn-delete btn-sm" data-id="' + appointment.customer_id + '">Delete</button>' +
                            '<button type="button" class="btn btn-update btn-sm" data-id="' + appointment.customer_id + '">Update</button>' +
                        '</td>' +
                    '</tr>';
                    tableBody.append(row);
                });
            },
            error: function(xhr, status, error) {
                console.error('Error fetching data:', error);
            }
        });
    }

    // Call the fetchWalkinAppointments function on page load
    fetchWalkinAppointments();

    $('#addWalkinForm').on('submit', function(event) {
        event.preventDefault(); // Prevent the default form submission

        var formData = $(this).serialize();
        console.log('Form Data:', formData); // Log the serialized data

        $.ajax({
            url: 'add_walkin_appointment.php',
            type: 'POST',
            data: formData,
            dataType: 'json', // Expect JSON response
            success: function(response) {
                if (response.status === 'success') {
                    $('#addWalkinModal').modal('hide'); // Hide the modal after submission
                    fetchWalkinAppointments(); // Refresh the table
                } else {
                    console.error('Error adding appointment:', response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error adding appointment:', error);
            }
        });
    });
});


$(document).on('click', '.btn-update', function() {
    var customerId = $(this).data('id');
    
    // Fetch current details for the appointment
    $.ajax({
        url: 'fetch_appointments_details.php',
        type: 'GET',
        data: { customer_id: customerId },
        dataType: 'json',
        success: function(data) {
            if (data) {
                $('#update_customer_id').val(data.customer_id);
                $('#update_firstname').val(data.firstname);
                $('#update_phoneNumber').val(data.phoneNumber);
                $('#update_emailAddress').val(data.emailAddress);
                $('#update_repairdetails').val(data.repairdetails);
                $('#update_appointment_time').val(data.appointment_time);
                $('#update_appointment_date').val(data.appointment_date);
                $('#update_Status').val(data.Status);
                $('#updateWalkinModal').modal('show');
            }
        },
        error: function(xhr, status, error) {
            console.error('Error fetching appointment details:', error);
        }
    });
});


$('#updateWalkinForm').on('submit', function(event) {
    event.preventDefault(); // Prevent the default form submission

    var formData = $(this).serialize();
    console.log('Form Data:', formData); // Log the serialized data

    $.ajax({
        url: 'update_walkin_appointment.php',
        type: 'POST',
        data: formData,
        dataType: 'json', // Expect JSON response
        success: function(response) {
            if (response.status === 'success') {
                $('#updateWalkinModal').modal('hide'); // Hide the modal after submission
                fetchWalkinAppointments(); // Refresh the table
            } else {
                console.error('Error updating appointment:', response.message);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error updating appointment:', error);
        }
    });
});



$(document).on('click', '.btn-delete', function() {
    var customerId = $(this).data('id');
    $('#delete_customer_id').val(customerId);
    $('#deleteWalkinModal').modal('show');
});

$('#confirmDeleteButton').on('click', function() {
    var customerId = $('#delete_customer_id').val();

    $.ajax({
        url: 'delete_walkin_appointment.php',
        type: 'POST',
        data: { customer_id: customerId },
        dataType: 'json',
        success: function(response) {
            if (response.status === 'success') {
                $('#deleteWalkinModal').modal('hide'); // Hide the modal after deletion
                fetchWalkinAppointments(); // Refresh the table
            } else {
                console.error('Error deleting appointment:', response.message);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error deleting appointment:', error);
        }
    });
});

</script>

</body>
</html>
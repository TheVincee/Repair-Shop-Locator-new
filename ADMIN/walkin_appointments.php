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
        <h2 class="mb-4 text-center">Admin Walk-in Appointments (Pending)</h2>
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
                    <div class="row mb-3">
                        <div class="col">
                            <label for="firstname" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name" required>
                        </div>
                        <div class="col">
                            <label for="phoneNumber" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" placeholder="Phone Number" required>
                        </div>
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
                            <label for="carmodel" class="form-label">Car Model</label>
                            <input type="text" class="form-control" id="carmodel" name="carmodel" placeholder="Car Model" required>
                        </div>
                        <div class="col">
                            <label for="service_type" class="form-label">Service Type</label>
                            <select class="form-select" id="service_type" name="service_type" required>
                                <option value="" disabled selected>Select Service Type</option>
                                <option value="Oil Change">Oil Change</option>
                                <option value="Tire Rotation">Tire Rotation</option>
                                <option value="Brake Inspection">Brake Inspection</option>
                                <option value="Battery Replacement">Battery Replacement</option>
                                <!-- Add more service types as needed -->
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="total_payable" class="form-label">Total Payable</label>
                            <input type="number" step="0.01" class="form-control" id="total_payable" name="total_payable" placeholder="Total Payable" required>
                        </div>
                        <div class="col">
                            <label for="payment_type" class="form-label">Payment Type</label>
                            <select class="form-select" id="payment_type" name="payment_type" required>
                                <option value="" disabled selected>Select Payment Type</option>
                                <option value="Cash">Cash</option>
                                <option value="Credit Card">Credit Card</option>
                                <option value="Debit Card">Debit Card</option>
                                <option value="Mobile Payment">Mobile Payment</option>
                                <!-- Add more payment types as needed -->
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="payment_status" class="form-label">Payment Status</label>
                        <select class="form-select" id="payment_status" name="payment_status" required>
                            <option value="" disabled selected>Select Payment Status</option>
                            <option value="Paid">Paid</option>
                            <option value="Not Paid">Not Paid</option>
                        </select>
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
                    
                    <div class="row mb-3">
                        <div class="col">
                            <label for="update_firstname" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="update_firstname" name="firstname" placeholder="First Name" required>
                        </div>
                        <div class="col">
                            <label for="update_lastname" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="update_lastname" name="lastname" placeholder="Last Name" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label for="update_phoneNumber" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" id="update_phoneNumber" name="phoneNumber" placeholder="Phone Number" required>
                        </div>
                        <div class="col">
                            <label for="update_emailAddress" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="update_emailAddress" name="emailAddress" placeholder="Email Address" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="update_repairdetails" class="form-label">Repair Details</label>
                        <textarea class="form-control" id="update_repairdetails" name="repairdetails" rows="3" placeholder="Repair Details" required></textarea>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label for="update_carmodel" class="form-label">Car Model</label>
                            <input type="text" class="form-control" id="update_carmodel" name="carmodel" placeholder="Car Model" required>
                        </div>
                        <div class="col">
                            <label for="update_service_type" class="form-label">Service Type</label>
                            <select class="form-select" id="update_service_type" name="service_type" required>
                                <option value="" disabled selected>Select Service Type</option>
                                <option value="Oil Change">Oil Change</option>
                                <option value="Tire Rotation">Tire Rotation</option>
                                <option value="Brake Inspection">Brake Inspection</option>
                                <option value="Battery Replacement">Battery Replacement</option>
                                <!-- Add more service types as needed -->
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label for="update_total_payable" class="form-label">Total Payable</label>
                            <input type="number" step="0.01" class="form-control" id="update_total_payable" name="total_payable" placeholder="Total Payable" required>
                        </div>
                        <div class="col">
                            <label for="update_payment_type" class="form-label">Payment Type</label>
                            <select class="form-select" id="update_payment_type" name="payment_type" required>
                                <option value="" disabled selected>Select Payment Type</option>
                                <option value="Cash">Cash</option>
                                <option value="Credit Card">Credit Card</option>
                                <option value="Debit Card">Debit Card</option>
                                <option value="Mobile Payment">Mobile Payment</option>
                                <!-- Add more payment types as needed -->
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="update_payment_status" class="form-label">Payment Status</label>
                        <select class="form-select" id="update_payment_status" name="payment_status" required>
                            <option value="" disabled selected>Select Payment Status</option>
                            <option value="Paid">Paid</option>
                            <option value="Not Paid">Not Paid</option>
                        </select>
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

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- View Walk-in Appointment Modal -->
<div class="modal fade" id="viewWalkinModal" tabindex="-1" aria-labelledby="viewWalkinModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewWalkinModalLabel">View Walk-in Appointment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="viewWalkinForm">
                    <input type="hidden" id="view_customer_id" name="customer_id">

                    <div class="mb-3">
                        <label for="view_firstname" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="view_firstname" name="firstname" placeholder="First Name" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="view_lastname" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="view_lastname" name="lastname" placeholder="Last Name" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="view_phoneNumber" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" id="view_phoneNumber" name="phoneNumber" placeholder="Phone Number" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="view_emailAddress" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="view_emailAddress" name="emailAddress" placeholder="Email Address" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="view_repairdetails" class="form-label">Repair Details</label>
                        <textarea class="form-control" id="view_repairdetails" name="repairdetails" rows="3" placeholder="Repair Details" readonly></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="view_carmodel" class="form-label">Car Model</label>
                        <input type="text" class="form-control" id="view_carmodel" name="carmodel" placeholder="Car Model" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="view_service_type" class="form-label">Service Type</label>
                        <input type="text" class="form-control" id="view_service_type" name="service_type" placeholder="Service Type" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="view_total_payable" class="form-label">Total Payable</label>
                        <input type="number" step="0.01" class="form-control" id="view_total_payable" name="total_payable" placeholder="Total Payable" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="view_payment_type" class="form-label">Payment Type</label>
                        <input type="text" class="form-control" id="view_payment_type" name="payment_type" placeholder="Payment Type" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="view_payment_status" class="form-label">Payment Status</label>
                        <input type="text" class="form-control" id="view_payment_status" name="payment_status" placeholder="Payment Status" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="view_appointment_time" class="form-label">Appointment Time</label>
                        <input type="time" class="form-control" id="view_appointment_time" name="appointment_time" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="view_appointment_date" class="form-label">Appointment Date</label>
                        <input type="date" class="form-control" id="view_appointment_date" name="appointment_date" readonly>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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

<!-- Bootstrap JS Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
$(document).ready(function() {
    // Fetch appointments on page load
    fetchAppointments();

    // Add appointment form submission
    $('#addWalkinForm').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: 'add_walkin_appointment.php',
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                if (response.status === 'success') {
                    $('#addWalkinModal').modal('hide');
                    fetchAppointments();
                } else {
                    console.error('Failed to add appointment:', response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX error:', status, error);
            }
        });
    });

    // Update appointment form submission
    $('#updateWalkinForm').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: 'update_walkin_appointment.php',
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                if (response.status === 'success') {
                    $('#updateWalkinModal').modal('hide');
                    fetchAppointments();
                } else {
                    console.error('Failed to update appointment:', response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX error:', status, error);
            }
        });
    });

    $(document).ready(function() {
    // Delete appointment button click
    $('#confirmDeleteButton').click(function() {
        const customerId = $('#delete_customer_id').val();
        $.ajax({
            url: 'delete_walkin_appointment.php',
            method: 'POST',
            data: { customer_id: customerId },
            dataType: 'json',
            success: function(response) {
                console.log('Response:', response); // Log the response to check its structure
                if (response.success) {
                    $('#deleteWalkinModal').modal('hide');
                    fetchAppointments();
                } else {
                    console.error('Failed to delete appointment:', response.error || 'Unknown error');
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX error:', status, error);
                console.error('Response:', xhr.responseText); // Log the response text
            }
        });
    });
});

});


function fetchAppointments() {
    $.ajax({
        url: 'fetch_walkin_appointments.php',
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            console.log(response); // Log the response to check its structure
            const tbody = $('tbody');
            tbody.empty(); // Clear the existing table data

            if (Array.isArray(response)) {
                response.forEach(appointment => {
                    const row = `
                        <tr>
                            <td>${appointment.customer_id}</td>
                            <td>${appointment.firstname}</td>
                            <td>${appointment.phoneNumber}</td>
                            <td>${appointment.emailAddress}</td>
                            <td>${appointment.repairdetails}</td>
                            <td>${appointment.appointment_time}</td>
                            <td>${appointment.appointment_date}</td>
                            <td>${appointment.Status}</td>
                            <td class="action-buttons">
                                <button class="btn btn-update btn-sm" data-id="${appointment.customer_id}" data-bs-toggle="modal" data-bs-target="#updateWalkinModal"><i class="fas fa-edit"></i> Update</button>
                                <button class="btn btn-delete btn-sm" data-id="${appointment.customer_id}" data-bs-toggle="modal" data-bs-target="#deleteWalkinModal"><i class="fas fa-trash"></i> Delete</button>
                            </td>
                        </tr>
                    `;
                    tbody.append(row);
                });

                // Bind update and delete button click events
                $('.btn-update').click(function() {
    const customerId = $(this).data('id');
    $.ajax({
        url: 'get_walkin_appointment.php',
        method: 'POST',
        data: { customer_id: customerId },
        dataType: 'json',
        success: function(response) {
            console.log(response); // Log the response to see its structure
            if (response.status === 'success') {
                const appointment = response.data;
                $('#update_customer_id').val(appointment.customer_id);
                $('#update_firstname').val(appointment.firstname);
                $('#update_phoneNumber').val(appointment.phoneNumber);
                $('#update_emailAddress').val(appointment.emailAddress);
                $('#update_repairdetails').val(appointment.repairdetails);
                $('#update_appointment_time').val(appointment.appointment_time);
                $('#update_appointment_date').val(appointment.appointment_date);
            } else {
                console.error('Failed to fetch appointment details:', response.message);
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX error:', status, error);
        }
    });
});


                $('.btn-delete').click(function() {
                    const customerId = $(this).data('id');
                    $('#delete_customer_id').val(customerId);
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
</script>
<script>
    
</script>

</body>
</html>

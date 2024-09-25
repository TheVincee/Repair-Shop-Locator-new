<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Walk-in Appointments</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        /* Basic styling for the page */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .back-button {
            display: inline-block;
            margin: 20px;
            font-size: 16px;
            text-decoration: none;
            color: #007bff;
        }

        h1 {
            text-align: center;
            margin: 20px 0;
        }

        .table-container {
            width: 90%;
            margin: 0 auto;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 10px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .btn {
            padding: 5px 10px;
            font-size: 14px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            margin: 2px;
        }

        .view-btn {
            background-color: #17a2b8;
            color: white;
        }

        .edit-btn {
            background-color: #ffc107;
            color: black;
        }

        .delete-btn {
            background-color: #dc3545;
            color: white;
        }

        /* Modal styling */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            width: 80%;
            max-width: 600px;
            position: relative;
        }

        .close {
            position: absolute;
            top: 10px;
            right: 20px;
            font-size: 24px;
            cursor: pointer;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 3px;
        }

        .btn-primary {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 15px;
            font-size: 16px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <!-- Back Button -->
    <a href="Dashboard.php" class="back-button">← Back</a>

    <h1>Walk-in Appointments</h1>

    <!-- Appointments Table -->
    <div class="table-container">
        <table id="appointmentsTable">
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
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="appointmentsTableBody">
                <!-- Table rows will be populated here via AJAX -->
            </tbody>
        </table>
    </div>

    <!-- View Modal -->
    <div id="viewModal" class="modal">
    <div class="modal-content">
        <span id="closeView" class="close">&times;</span>
        <h2>Appointment Details</h2>
        <div id="viewDetails"></div>
    </div>
</div>


    <!-- Edit Modal -->
    <div id="editModal" class="modal">
    <div class="modal-content">
        <span id="closeEdit" class="close">&times;</span>
        <h2>Edit Appointment Status</h2>
        <form id="editForm">
            <!-- Visible Customer ID field -->
            <label for="editCustomerID">Customer ID:</label>
            <input type="text" id="editCustomerID" readonly> <!-- Read-only to prevent modification -->

            <!-- Dropdown for Status -->
            <label for="editStatus">Status:</label>
            <select id="editStatus" required>
                <option value="Pending">Pending</option>
                <option value="Approved">Approved</option>
                <option value="Rejected">Rejected</option>
                <option value="In Processing">In Processing</option>
            </select>
            
            <button type="submit">Save Changes</button>
        </form>
    </div>
</div>





    <script>
    $(document).ready(function() {
    loadAppointments();

    function loadAppointments() {
        $.ajax({
            url: 'walkin_operations.php?action=getCombinedData',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                console.log('Loaded appointments:', data);
                var tbody = $('#appointmentsTableBody');
                tbody.empty();
                $.each(data, function(index, appointment) {
                    tbody.append(
                        '<tr>' +
                            '<td>' + (appointment.customer_id || 'N/A') + '</td>' +
                            '<td>' + (appointment.firstname || 'N/A') + '</td>' +
                            '<td>' + (appointment.phoneNumber || 'N/A') + '</td>' +
                            '<td>' + (appointment.emailAddress || 'N/A') + '</td>' +
                            '<td>' + (appointment.repairdetails || 'N/A') + '</td>' +
                            '<td>' + (appointment.appointment_time || 'N/A') + '</td>' +
                            '<td>' + (appointment.appointment_date || 'N/A') + '</td>' +
                            '<td>' + (appointment.Status || 'N/A') + '</td>' +
                            '<td>' +
                                '<button class="btn view-btn" data-id="' + (appointment.customer_id || '') + '">View</button>' +
                                '<button class="btn edit-btn" data-id="' + (appointment.customer_id || '') + '">Edit</button>' +
                                '<button class="btn delete-btn" data-id="' + (appointment.customer_id || '') + '">Delete</button>' +
                            '</td>' +
                        '</tr>'
                    );
                });
            },
            error: function(xhr, status, error) {
                console.error("Error loading appointments: " + error);
                console.log("Response:", xhr.responseText);
            }
        });
    }

    // View appointment details
    $(document).on('click', '.view-btn', function() {
        var id = $(this).data('id');
        $.ajax({
            url: 'walkin_operations.php',
            type: 'GET',
            data: { action: 'getAppointment', id: id },
            dataType: 'json',
            success: function(data) {
                console.log('View appointment details:', data);
                if (data) {
                    $('#viewDetails').html(
                        '<p><strong>Customer ID:</strong> ' + (data.customer_id || 'N/A') + '</p>' +
                        '<p><strong>First Name:</strong> ' + (data.firstname || 'N/A') + '</p>' +
                        '<p><strong>Phone Number:</strong> ' + (data.phoneNumber || 'N/A') + '</p>' +
                        '<p><strong>Email Address:</strong> ' + (data.emailAddress || 'N/A') + '</p>' +
                        '<p><strong>Repair Details:</strong> ' + (data.repairdetails || 'N/A') + '</p>' +
                        '<p><strong>Appointment Time:</strong> ' + (data.appointment_time || 'N/A') + '</p>' +
                        '<p><strong>Appointment Date:</strong> ' + (data.appointment_date || 'N/A') + '</p>' +
                        '<p><strong>Status:</strong> ' + (data.Status || 'N/A') + '</p>'
                    );
                    $('#viewModal').fadeIn();
                }
            },
            error: function(xhr, status, error) {
                console.error("Error loading appointment details: " + error);
            }
        });
    });

    // Edit appointment
    $(document).on('click', '.edit-btn', function() {
        var id = $(this).data('id');
        $.ajax({
            url: 'walkin_operations.php',
            type: 'GET',
            data: { action: 'getAppointment', id: id },
            dataType: 'json',
            success: function(data) {
                console.log('Edit appointment details:', data);
                if (data) {
                    $('#editCustomerID').val(data.customer_id || '');
                    $('#editStatus').val(data.Status || '');
                    $('#editModal').fadeIn(); 
                } else {
                    alert("No data found for the selected appointment.");
                }
            },
            error: function(xhr, status, error) {
                console.error("Error loading appointment for editing: " + error);
                alert("Failed to load appointment details. Please try again.");
            }
        });
    });

    // Submit the edit form
    $(document).on('submit', '#editForm', function(event) {
        event.preventDefault();
        
        var formData = {
            customer_id: $('#editCustomerID').val(),
            Status: $('#editStatus').val(),
            action: 'updateStatus' // Updated action to match your PHP
        };

        $.ajax({
            url: 'walkin_operations.php',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                console.log(response);
                if (response.status === 'success') {
                    alert(response.message);
                    $('#editModal').fadeOut();
                    loadAppointments(); 
                } else {
                    alert("Update failed: " + response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error("Error updating appointment: " + error);
                alert("Failed to update appointment. Please try again.");
            }
        });
    });

    // Delete appointment
    $(document).on('click', '.delete-btn', function() {
        var id = $(this).data('id');
        if (confirm('Are you sure you want to delete this appointment?')) {
            $.ajax({
                url: 'walkin_operations.php',
                type: 'POST',
                data: { action: 'deleteAppointment', id: id },
                success: function(response) {
                    alert(response);
                    loadAppointments();
                },
                error: function(xhr, status, error) {
                    console.error("Error deleting appointment: " + error);
                }
            });
        }
    });

    // Modal close handlers
    $(document).on('click', '#closeView', function() {
        $('#viewModal').fadeOut();
    });

    $(document).on('click', '#closeEdit', function() {
        $('#editModal').fadeOut();
    });

    // Close modal when clicking outside
    $(window).on('click', function(event) {
        if ($(event.target).is('#viewModal') || $(event.target).is('#editModal')) {
            $('#viewModal, #editModal').fadeOut();
        }
    });

    // Future date validation for the appointment date field
    $('#editAppointmentDate').attr('min', new Date().toISOString().split('T')[0]);
});


    </script>
</body>
</html>

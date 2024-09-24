<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer and Walk-in Appointments</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<div class="container mt-5">
    <h2 class="mb-4">Customers and Walk-in Appointments</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Customer ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Phone Number</th>
                <th>Email Address</th>
                <th>Car Make</th>
                <th>Car Model</th>
                <th>Appointment Time</th>
                <th>Appointment Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="customerTable">
            <!-- Data will be populated here -->
        </tbody>
    </table>
</div>

<!-- Edit Customer Modal -->
<div class="modal fade" id="editCustomerModal" tabindex="-1" aria-labelledby="editCustomerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCustomerModalLabel">Edit Customer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editCustomerForm">
                    <input type="hidden" id="editCustomerId">
                    <div class="mb-3">
                        <label for="editFirstname" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="editFirstname" required>
                    </div>
                    <div class="mb-3">
                        <label for="editLastname" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="editLastname">
                    </div>
                    <div class="mb-3">
                        <label for="editPhoneNumber" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" id="editPhoneNumber" required>
                    </div>
                    <div class="mb-3">
                        <label for="editEmailAddress" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="editEmailAddress" required>
                    </div>
                    <div class="mb-3">
                        <label for="editCarMake" class="form-label">Car Make</label>
                        <input type="text" class="form-control" id="editCarMake">
                    </div>
                    <div class="mb-3">
                        <label for="editCarModel" class="form-label">Car Model</label>
                        <input type="text" class="form-control" id="editCarModel">
                    </div>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Customer Modal -->
<div class="modal fade" id="deleteCustomerModal" tabindex="-1" aria-labelledby="deleteCustomerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteCustomerModalLabel">Delete Customer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this customer?</p>
                <input type="hidden" id="deleteCustomerId">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteButton">Delete</button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    function loadCustomers() {
        $.ajax({
            url: 'fetch_combined_data.php', // Your PHP script
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    let customers = response.data;
                    let tableBody = $('#customerTable');
                    tableBody.empty(); // Clear existing table data

                    // Populate table with new data
                    $.each(customers, function(index, customer) {
                        tableBody.append(`
                            <tr>
                                <td>${customer.customer_id}</td>
                                <td>${customer.firstname}</td>
                                <td>${customer.lastname || ''}</td>
                                <td>${customer.phoneNumber}</td>
                                <td>${customer.emailAddress}</td>
                                <td>${customer.carmake || ''}</td>
                                <td>${customer.carmodel || ''}</td>
                                <td>${customer.appointment_time}</td>
                                <td>${customer.appointment_date}</td>
                                <td>${customer.Status}</td>
                                <td>
                                    <button class="btn btn-warning" onclick="openEditModal(${customer.customer_id})">Edit</button>
                                    <button class="btn btn-danger" onclick="openDeleteModal(${customer.customer_id})">Delete</button>
                                </td>
                            </tr>
                        `);
                    });
                } else {
                    alert('Error fetching data: ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                alert('AJAX error: ' + error);
            }
        });
    }

    loadCustomers();

    // Function to open the edit modal and populate it with customer data
    window.openEditModal = function(customerId) {
        $.ajax({
            url: 'fetch_customer_data.php', // Your PHP script to fetch individual customer data
            method: 'GET',
            data: { id: customerId },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    let customer = response.data;
                    $('#editCustomerId').val(customer.customer_id);
                    $('#editFirstname').val(customer.firstname);
                    $('#editLastname').val(customer.lastname || '');
                    $('#editPhoneNumber').val(customer.phoneNumber);
                    $('#editEmailAddress').val(customer.emailAddress);
                    $('#editCarMake').val(customer.carmake || '');
                    $('#editCarModel').val(customer.carmodel || '');
                    $('#editCustomerModal').modal('show');
                } else {
                    alert('Error fetching customer data: ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                alert('AJAX error: ' + error);
            }
        });
    };

    // Handle the edit form submission
    $('#editCustomerForm').on('submit', function(event) {
        event.preventDefault(); // Prevent the default form submission
        let customerId = $('#editCustomerId').val();
        let data = {
            id: customerId,
            firstname: $('#editFirstname').val(),
            lastname: $('#editLastname').val(),
            phoneNumber: $('#editPhoneNumber').val(),
            emailAddress: $('#editEmailAddress').val(),
            carmake: $('#editCarMake').val(),
            carmodel: $('#editCarModel').val()
        };

        $.ajax({
            url: 'update_customer.php', // Your PHP script for updating customer data
            method: 'POST',
            data: data,
            success: function(response) {
                alert(response.message);
                $('#editCustomerModal').modal('hide');
                loadCustomers(); // Reload customers after editing
            },
            error: function(xhr, status, error) {
                alert('Error updating customer: ' + error);
            }
        });
    });

    // Function to open the delete modal
    window.openDeleteModal = function(customerId) {
        $('#deleteCustomerId').val(customerId);
        $('#deleteCustomerModal').modal('show');
    };

    // Handle delete confirmation
    $('#confirmDeleteButton').on('click', function() {
        let customerId = $('#deleteCustomerId').val();
        $.ajax({
            url: 'delete_customer.php', // Your PHP script for deletion
            method: 'POST',
            data: { id: customerId },
            success: function(response) {
                alert(response.message);
                $('#deleteCustomerModal').modal('hide');
                loadCustomers(); // Reload customers after deletion
            },
            error: function(xhr, status, error) {
                alert('Error deleting customer: ' + error);
            }
        });
    });
});
</script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.1/js/bootstrap.min.js"></script>
</body>
</html>

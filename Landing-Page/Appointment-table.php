<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Details Form in Modal - Car Repair Shop</title>
    <link rel="stylesheet" href="new.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>


<style>
   .table th:nth-child(3), /* Last Name */
.table td:nth-child(3) {
    display: none;
}

.table th:nth-child(4), /* Phone Number */
.table td:nth-child(4) {
    display: none;
}

.table th:nth-child(6), /* Car Make */
.table td:nth-child(6) {
    display: none;
}

.table th:nth-child(8), /* Repair Details */
.table td:nth-child(8) {
    display: none;
}
.table th:nth-child(6), /* Car Make */
.table td:nth-child(6),
.table th:nth-child(9), /* Address */
.table td:nth-child(9) {
    display: none;
}


</style>
<a href="map.php" class="btn btn-secondary mb-3">Back</a>

    <div class="container">
        <h1 class="mt-4 mb-4">Repair Shop Service Records</h1>
        <div id="alertPlaceholder"></div>
        <div class="d-flex justify-content-end mb-3">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Add Customer Details
            </button>
        </div>

        <div class="table-container">
    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Address</th>
                <th scope="col">Phone Number</th>
                <th scope="col">Email Address</th>
                <th scope="col">Car Make</th>
                <th scope="col">Car Model</th>
                <th scope="col">Repair Details</th>
                <th scope="col">Appointment Date</th>
                <th scope="col">Appointment Time</th>
                <th scope="col">Status</th>               
                <th scope="col">Payment Type</th>                 
                 <th scope="col">Payment Status</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php
// Include your database connection file here
include('dbconfig.php');

// Fetch customer details from the database
$query = "SELECT * FROM customer_details";
$result = mysqli_query($conn, $query);

// Check if any records were fetched
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['customer_id']) . "</td>";
        echo "<td>" . htmlspecialchars($row['firstname']) . "</td>";
        echo "<td>" . htmlspecialchars($row['lastname']) . "</td>";        
        echo "<td>" . htmlspecialchars($row['Address']) . "</td>"; // Address
        echo "<td>" . htmlspecialchars($row['phoneNumber']) . "</td>";
        echo "<td>" . htmlspecialchars($row['emailAddress']) . "</td>";        
        echo "<td>" . htmlspecialchars($row['carmake']) . "</td>";
        echo "<td>" . htmlspecialchars($row['carmodel']) . "</td>";
        echo "<td>" . htmlspecialchars($row['repairdetails']) . "</td>";
        echo "<td>" . htmlspecialchars($row['appointment_date']) . "</td>"; // Appointment Date
        echo "<td>" . htmlspecialchars($row['appointment_time']) . "</td>"; // Appointment Time
        echo "<td>" . htmlspecialchars($row['Status']) . "</td>"; // Status
        echo "<td>" . htmlspecialchars($row['payment_type']) . "</td>"; // Payment Type
        echo "<td>" . htmlspecialchars($row['payment_status']) . "</td>"; // Status Payment
        echo "<td>
                <div class='btn-group' role='group' aria-label='Action buttons'>
                    <button type='button' class='btn btn-success btn-sm' data-bs-toggle='modal' data-bs-target='#UpdateModal' data-customer_id='" . htmlspecialchars($row['customer_id']) . "'>Update</button>
                    <button type='button' class='btn btn-danger btn-sm' onclick='deleteCustomer(" . htmlspecialchars($row['customer_id']) . ")'>Delete</button>
                    <button type='button' class='btn btn-info btn-sm' data-bs-toggle='modal' data-bs-target='#viewCustomerModal' data-customer_id='" . htmlspecialchars($row['customer_id']) . "'>View</button>
                </div>
              </td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='14' class='text-center'>No records found</td></tr>"; // Updated colspan to match total columns
}
?>

        </tbody>
    </table>
</div>


<!-- Add Customer Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Customer Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="customerForm">
                    <div class="row mb-3">
                        <div class="col">
                            <label for="firstNameModal" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="firstNameModal" name="firstName" placeholder="Enter first name" required>
                        </div>
                        <div class="col">
                            <label for="lastNameModal" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="lastNameModal" name="lastName" placeholder="Enter last name" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="addressModal" class="form-label">Address</label>
                            <input type="text" class="form-control" id="addressModal" name="address" placeholder="Enter address" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="phoneModal" class="form-label">Phone Number</label>
                            <input type="tel" class="form-control" id="phoneModal" name="phoneNumber" placeholder="Enter phone number" required>
                        </div>
                        <div class="col">
                            <label for="emailModal" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="emailModal" name="emailAddress" placeholder="Enter email address" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="carMakeModal" class="form-label">Car Make</label>
                            <input type="text" class="form-control" id="carMakeModal" name="carMake" placeholder="Enter car make" required>
                        </div>
                        <div class="col">
                            <label for="carModelModal" class="form-label">Car Model</label>
                            <input type="text" class="form-control" id="carModelModal" name="carModel" placeholder="Enter car model" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="serviceTypeModal" class="form-label">Service Type</label>
                            <select class="form-select" id="serviceTypeModal" name="serviceType" required>
                                <option value="" disabled selected>Select service type</option>
                                <option value="Oil Change" data-cost="500">Oil Change (₱500)</option>
                                <option value="Tire Rotation" data-cost="700">Tire Rotation (₱700)</option>
                                <option value="Engine Repair" data-cost="2500">Engine Repair (₱2500)</option>
                                <option value="Brake Service" data-cost="1500">Brake Service (₱1500)</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="repairDetailsModal" class="form-label">Repair Details</label>
                            <textarea class="form-control" id="repairDetailsModal" name="repairDetails" rows="3" placeholder="Describe repair details"></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="appointmentDateModal" class="form-label">Appointment Date</label>
                            <input type="date" class="form-control" id="appointmentDateModal" name="appointmentDate" required>
                        </div>
                        <div class="col">
                            <label for="appointmentTimeModal" class="form-label">Appointment Time</label>
                            <input type="time" class="form-control" id="appointmentTimeModal" name="appointmentTime" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="mechanicFeeModal" class="form-label">Mechanic Fee (₱)</label>
                            <input type="number" class="form-control" id="mechanicFeeModal" name="mechanicFee" placeholder="Mechanic fee" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="totalPaymentModal" class="form-label">Total Payment (₱)</label>
                            <input type="text" class="form-control" id="totalPaymentModal" name="totalPayment" placeholder="Enter total payment in Peso" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="paymentTypeModal" class="form-label">Payment Type</label>
                            <select class="form-select" id="paymentTypeModal" name="paymentType" required>
                                <option value="" disabled selected>Select payment type</option>
                                <option value="Cash">Cash</option>
                                <option value="GCash">GCash</option>
                                <option value="Card">Debit Card</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div><!-- Add Customer Modal -->

    <!-- Update Customer Modal -->
    <div class="modal fade" id="UpdateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Update Customer Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="updateForm">
                    <input type="hidden" id="updateCustomerId" name="customer_id">

                    <div class="row mb-3">
                        <div class="col">
                            <label for="updateFirstName" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="updateFirstName" name="firstname" required>
                        </div>
                        <div class="col">
                            <label for="updateLastName" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="updateLastName" name="lastname" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                    <div class="form-group">
    <label for="updateAddress">Address</label>
    <input type="text" class="form-control" id="updateAddress" name="address" required>
</div>

                        <div class="col">
                            <label for="updatePhoneNumber" class="form-label">Phone Number</label>
                            <input type="tel" class="form-control" id="updatePhoneNumber" name="phoneNumber" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label for="updateEmailAddress" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="updateEmailAddress" name="emailAddress" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label for="updateCarMake" class="form-label">Car Make</label>
                            <input type="text" class="form-control" id="updateCarMake" name="carmake" required>
                        </div>
                        <div class="col">
                            <label for="updateCarModel" class="form-label">Car Model</label>
                            <input type="text" class="form-control" id="updateCarModel" name="carmodel" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label for="updateRepairDetails" class="form-label">Repair Details</label>
                            <textarea class="form-control" id="updateRepairDetails" name="repairdetails" rows="3" required></textarea>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label for="updateAppointmentDate" class="form-label">Appointment Date</label>
                            <input type="date" class="form-control" id="updateAppointmentDate" name="appointment_date" required>
                        </div>
                        <div class="col">
                            <label for="updateAppointmentTime" class="form-label">Appointment Time</label>
                            <input type="time" class="form-control" id="updateAppointmentTime" name="appointment_time" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label for="updateServiceType" class="form-label">Service Type</label>
                            <select class="form-select" id="updateServiceType" name="service_type" required>
                                <option value="" disabled selected>Select Service Type</option>
                                <option value="Repair">Repair</option>
                                <option value="Maintenance">Maintenance</option>
                                <option value="Inspection">Inspection</option>
                                <option value="Detailing">Detailing</option>
                                <option value="Oil Change">Oil Change</option>
                                <option value="Brake Service">Brake Service</option>
                                <option value="Transmission Service">Transmission Service</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label for="updateTotalPayment" class="form-label">Total Payment</label>
                            <input type="number" class="form-control" id="updateTotalPayment" name="total_payment" disabled required>
                        </div>
                        <div class="col">
                            <label for="updatePaymentType" class="form-label">Payment Type</label>
                            <select class="form-select" id="updatePaymentType" name="payment_type" required>
                                <option value="" disabled selected>Select Payment Type</option>
                                <option value="Cash">Cash</option>
                                <option value="GCash">GCash</option>
                                <option value="Card">Debit Card</option>
                            </select>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- View Customer Modal -->
<div class="modal fade" id="viewCustomerModal" tabindex="-1" aria-labelledby="viewCustomerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="viewCustomerModalLabel">Customer Details</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <dl class="row">
                    <dt class="col-sm-4">ID:</dt>
                    <dd class="col-sm-8" id="viewCustomerId"></dd>

                    <dt class="col-sm-4">First Name:</dt>
                    <dd class="col-sm-8" id="viewFirstName"></dd>

                    <dt class="col-sm-4">Last Name:</dt>
                    <dd class="col-sm-8" id="viewLastName"></dd>

                    <dt class="col-sm-4">Phone Number:</dt>
                    <dd class="col-sm-8" id="viewPhone"></dd>

                    <dt class="col-sm-4">Email Address:</dt>
                    <dd class="col-sm-8" id="viewEmail"></dd>

                    <dt class="col-sm-4">Address:</dt>
                    <dd class="col-sm-8" id="viewAddress"></dd>

                    <dt class="col-sm-4">Car Make:</dt>
                    <dd class="col-sm-8" id="viewCarMake"></dd>

                    <dt class="col-sm-4">Car Model:</dt>
                    <dd class="col-sm-8" id="viewCarModel"></dd>

                    <dt class="col-sm-4">Repair Details:</dt>
                    <dd class="col-sm-8" id="viewRepairDetails"></dd>

                    <dt class="col-sm-4">Appointment Date:</dt>
                    <dd class="col-sm-8" id="viewAppointmentDate"></dd>

                    <dt class="col-sm-4">Appointment Time:</dt>
                    <dd class="col-sm-8" id="viewAppointmentTime"></dd>

                    <dt class="col-sm-4">Status:</dt>
                    <dd class="col-sm-8" id="viewStatus"></dd>

                    <dt class="col-sm-4">Service Type:</dt>
                    <dd class="col-sm-8" id="viewServiceType"></dd>

                    <dt class="col-sm-4">Total Payment:</dt>
                    <dd class="col-sm-8" id="viewTotalPayment"></dd>

                    <dt class="col-sm-4">Payment Type:</dt>
                    <dd class="col-sm-8" id="viewPaymentType"></dd>

                    <dt class="col-sm-4">Payment Status:</dt>
                    <dd class="col-sm-8" id="viewPaymentStatus"></dd>
                </dl>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>





    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
 $(document).ready(function () {
    // Handle form submission for adding a customer
    $("#customerForm").on("submit", function (e) {
        e.preventDefault(); // Prevent the default form submission
        const $submitButton = $(this).find("button[type='submit']");
        $submitButton.prop("disabled", true).text("Submitting...");

        $.ajax({
            type: "POST",
            url: "insert.php", // URL of the server-side script
            data: $(this).serialize(), // Serialize the form data
            dataType: "json", // Expect JSON response from the server
            success: function (response) {
                console.log("Response from server:", response); // Log the response

                // Check if the response contains a valid status
                if (response && response.status === 'success') {
                    $("#exampleModal").modal("hide"); // Hide modal on success
                    alert(response.message || "Customer added successfully!");
                    $("#customerForm")[0].reset(); // Reset the form
                    location.reload(); // Reload the page to show updated data
                } else {
                    alert(response.message || "Failed to add the customer. Please check the input data and try again.");
                }
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error:", error);
                console.log("Response text:", xhr.responseText); // Log the response text for debugging
                alert("An unexpected error occurred while adding the customer. Please try again later.");
            },
            complete: function () {
                $submitButton.prop("disabled", false).text("Submit");
            }
        });
    });

    $(document).ready(function () {
    // Fetch and populate data when opening the update modal
    $('#UpdateModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var customerId = button.data('customer_id'); // Extract customer_id from data-* attributes

        // Fetch customer details for the given customer_id
        $.ajax({
            type: "POST",
            url: "Fetch.php", // URL for fetching customer details
            data: { customer_id: customerId },
            dataType: "json",
            success: function (response) {
                console.log(response); // Log the response to verify data
                if (response.error) {
                    alert(response.error); // Display an error message if there's an issue
                } else {
                    // Populate modal fields with fetched data
                    $('#updateCustomerId').val(response.customer_id);
                    $('#updateFirstName').val(response.firstname);
                    $('#updateLastName').val(response.lastname);
                    $('#updatePhoneNumber').val(response.phoneNumber);
                    $('#updateEmailAddress').val(response.emailAddress);
                    $('#updateAddress').val(response.Address); // Use 'Address' with correct case
                    $('#updateCarMake').val(response.carmake);
                    $('#updateCarModel').val(response.carmodel);
                    $('#updateRepairDetails').val(response.repairdetails);
                    $('#updateAppointmentDate').val(response.appointment_date);
                    $('#updateAppointmentTime').val(response.appointment_time);
                    $('#updateServiceType').val(response.service_type); // New field
                    $('#updateTotalPayment').val(response.total_payment); // New field
                    $('#updatePaymentType').val(response.payment_type); // New field
                }
            },
            error: function (xhr, status, error) {
                console.error("An error occurred: " + error);
                alert("An error occurred while fetching the customer data.");
            }
        });
    });

    // Handle form submission for updating a customer
    $("#updateForm").on("submit", function (e) {
        e.preventDefault(); // Prevent the default form submission
        const $submitButton = $(this).find("button[type='submit']");
        $submitButton.prop("disabled", true).text("Updating..."); // Disable the button

        $.ajax({
            type: "POST",
            url: "Update.php", // URL of the PHP script
            data: $(this).serialize(), // Serialize the form data
            dataType: "json", // Expect JSON response from the server
            success: function (response) {
                if (response.status === 'success') {
                    $("#UpdateModal").modal("hide"); // Hide modal on success
                    alert(response.message || "Customer updated successfully!");
                    location.reload(); // Reload the page to show updated data
                } else {
                    alert(response.message || "Failed to update the customer. Please try again.");
                }
            },
            error: function (xhr, status, error) {
                console.error("An error occurred: " + error); // Log the error details
                alert("An error occurred while updating the customer. Please try again.");
            },
            complete: function () {
                // Re-enable the submit button after AJAX call completes
                $submitButton.prop("disabled", false).text("Update");
            }
        });
    });
});


    // Handle customer deletion
    window.deleteCustomer = function (customerId) {
        if (confirm("Are you sure you want to delete this customer?")) {
            $.ajax({
                type: "POST",
                url: "Delete.php", // URL for deleting customer
                data: { customer_id: customerId },
                dataType: "json",
                success: function (response) {
                    if (response.status === 'success') {
                        alert(response.message);
                        location.reload(); // Reload the page to reflect changes
                    } else {
                        alert(response.message || "Failed to delete the customer. Please try again.");
                    }
                },
                error: function (xhr, status, error) {
                    console.error("AJAX Error:", error);
                    console.log("Response text:", xhr.responseText); // Log the error response for debugging
                    alert("An error occurred while deleting the customer. Please try again later.");
                }
            });
        }
    };

    // View customer details
    $('#viewCustomerModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var customerId = button.data('customer_id');

        if (!customerId) {
            console.error("No customer ID provided for view.");
            return;
        }

        $.ajax({
            type: "POST",
            url: "fetch_customer.php",
            data: { customer_id: customerId },
            dataType: "json",
            success: function (response) {
                if (response.error) {
                    alert(response.error);
                } else {
                    $('#viewCustomerId').text(response.customer_id);
                    $('#viewFirstName').text(response.firstname);
                    $('#viewLastName').text(response.lastname);
                    $('#viewPhone').text(response.phoneNumber);
                    $('#viewEmail').text(response.emailAddress);
                    $('#viewAddress').text(response.address); // Add Address
                    $('#viewCarMake').text(response.carmake);
                    $('#viewCarModel').text(response.carmodel);
                    $('#viewRepairDetails').text(response.repairdetails);
                    $('#viewAppointmentDate').text(response.appointment_date);
                    $('#viewAppointmentTime').text(response.appointment_time);
                    $('#viewStatus').text(response.status);
                    $('#viewServiceType').text(response.service_type);
                    $('#viewTotalPayment').text(response.total_payment);
                    $('#viewPaymentType').text(response.payment_type);
                    $('#viewPaymentStatus').text(response.payment_status); // Add Payment Status
                }
            },
            error: function (xhr, status, error) {
                console.error("An error occurred: " + error);
                console.log("Response text:", xhr.responseText); // Log the error response for debugging
                alert("An unexpected error occurred while fetching the customer details.");
            }
        });
    });
});



    </script>

    
    <script>
    // Define the costs associated with specific repair keywords
const repairCosts = {
    'oil change': 500,
    'tire rotation': 700,
    'engine repair': 2500,
    'brake service': 1500
};

// Fixed mechanic fee (you can adjust it to the default fee if necessary)
const mechanicFee = 1000;

document.getElementById('serviceTypeModal').addEventListener('change', function() {
    const selectedOption = this.options[this.selectedIndex];
    const cost = parseInt(selectedOption.getAttribute('data-cost')) || 0;
    
    // Automatically set the mechanic fee based on the selected service
    document.getElementById('mechanicFeeModal').value = mechanicFee;

    // Calculate total payment
    calculateTotalPayment(cost);
});

// Event listener for the Repair Details input
document.getElementById('repairDetailsModal').addEventListener('input', function() {
    const repairDetails = this.value.toLowerCase();
    let totalRepairCost = 5;

    // Check for each repair keyword and add its cost to totalRepairCost
    for (const repair in repairCosts) {
        if (repairDetails.includes(repair)) {
            totalRepairCost += repairCosts[repair];
        }
    }

    // Calculate the total payment including mechanic fee
    const mechanicFeeValue = parseInt(document.getElementById('mechanicFeeModal').value) || 0;
    calculateTotalPayment(totalRepairCost + mechanicFeeValue);
});

// Function to calculate and update the total payment
function calculateTotalPayment(serviceCost) {
    const mechanicFeeValue = parseInt(document.getElementById('mechanicFeeModal').value) || 0;
    const totalPayment = serviceCost + mechanicFeeValue;

    // Update the total payment input
    document.getElementById('totalPaymentModal').value = totalPayment;
}

// Set default mechanic fee when the modal is opened
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('mechanicFeeModal').value = mechanicFee; // Set initial mechanic fee
});

    </script>
    
</body>
</html>
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
<div class="sidebar close">
    <div class="logo-details">
        <i class='bx bxl-c-plus-plus'></i>
        <span class="logo_name">CodingLab</span>
    </div>
    <ul class="nav-links">
        <li>
            <a href="#">
                <i class='bx bx-grid-alt'></i>
                <span class="link_name">Dashboard</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="#">Dashboard</a></li>
            </ul>
        </li>
        <li>
            <div class="iocn-link">
                <a href="#">
                    <i class='bx bx-collection'></i>
                    <span class="link_name">Category</span>
                </a>
                <i class='bx bxs-chevron-down arrow'></i>
            </div>
            <ul class="sub-menu">
                <li><a class="link_name" href="#">Category</a></li>
                <li><a href="map.php">Map</a></li>
                <li><a href="#">JavaScript</a></li>
                <li><a href="#">PHP & MySQL</a></li>
            </ul>
        </li>
        <li>
            <div class="iocn-link">
                <a href="#">
                    <i class='bx bx-book-alt'></i>
                    <span class="link_name">Posts</span>
                </a>
                <i class='bx bxs-chevron-down arrow'></i>
            </div>
            <ul class="sub-menu">
                <li><a class="link_name" href="#">Posts</a></li>
                <li><a href="#">Web Design</a></li>
                <li><a href="#">Login Form</a></li>
                <li><a href="#">Card Design</a></li>
            </ul>
        </li>
        <li>
            <a href="#">
                <i class='bx bx-pie-chart-alt-2'></i>
                <span class="link_name">Analytics</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="#">Analytics</a></li>
            </ul>
        </li>
        <li>
            <a href="#">
                <i class='bx bx-line-chart'></i>
                <span class="link_name">Chart</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="#">Chart</a></li>
            </ul>
        </li>
        <li>
            <div class="iocn-link">
                <a href="#">
                    <i class='bx bx-plug'></i>
                    <span class="link_name">Plugins</span>
                </a>
                <i class='bx bxs-chevron-down arrow'></i>
            </div>
            <ul class="sub-menu">
                <li><a class="link_name" href="#">Plugins</a></li>
                <li><a href="#">UI Face</a></li>
                <li><a href="#">Pigments</a></li>
                <li><a href="#">Box Icons</a></li>
            </ul>
        </li>
        <li>
            <a href="#">
                <i class='bx bx-compass'></i>
                <span class="link_name">Explore</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="#">Explore</a></li>
            </ul>
        </li>
        <li>
            <a href="#">
                <i class='bx bx-history'></i>
                <span class="link_name">History</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="#">History</a></li>
            </ul>
        </li>
        <li>
            <a href="#">
                <i class='bx bx-cog'></i>
                <span class="link_name">Settings</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="#">Settings</a></li>
            </ul>
        </li>
        <li>
            <div class="profile-details">
                <div class="profile-content">
                    <img src="image/profile.jpg" alt="profileImg">
                </div>
                <div class="name-job">
                    <div class="profile_name">Prem Shahi</div>
                    <div class="job">Web Designer</div>
                </div>
                <i class='bx bx-log-out'></i>
            </div>
        </li>
    </ul>
</div>
<section class="home-section">
    <div class="home-content">
        <i class='bx bx-menu'></i>
        <span class="text">Drop Down Sidebar</span>
    </div>

<style>
    .table th:nth-child(4), /* Phone Number */
    .table td:nth-child(4) {
        display: none;
    }

    .table th:nth-child(3), /* Last Name */
    .table td:nth-child(3) {
        display: none;
    }

    .table th:nth-child(6), /* Car Make */
    .table td:nth-child(6) {
        display: none;
    }
</style>
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
                    <th scope="col">Phone Number</th>
                    <th scope="col">Email Address</th>
                    <th scope="col">Car Make</th>
                    <th scope="col">Car Model</th>
                    <th scope="col">Repair Details</th>
                    <th scope="col">Appointment Date and Time</th>
                    <th scope="col">Status</th>
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
                        echo "<td>" . htmlspecialchars($row['phoneNumber']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['emailAddress']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['carmake']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['carmodel']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['repairdetails']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['appointment_date']) . " " . htmlspecialchars($row['appointment_time']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['Status']) . "</td>";
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
                    echo "<tr><td colspan='11' class='text-center'>No records found</td></tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
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
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

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
                            <div class="col">
                                <label for="updatePhoneNumber" class="form-label">Phone Number</label>
                                <input type="tel" class="form-control" id="updatePhoneNumber" name="phoneNumber" required>
                            </div>
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
            <div class="modal-header">
                <h5 class="modal-title" id="viewCustomerModalLabel">Customer Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <dl class="row">
                    <dt class="col-sm-3">ID:</dt>
                    <dd class="col-sm-9" id="viewCustomerId"></dd>

                    <dt class="col-sm-3">First Name:</dt>
                    <dd class="col-sm-9" id="viewFirstName"></dd>

                    <dt class="col-sm-3">Last Name:</dt>
                    <dd class="col-sm-9" id="viewLastName"></dd>

                    <dt class="col-sm-3">Phone Number:</dt>
                    <dd class="col-sm-9" id="viewPhone"></dd>

                    <dt class="col-sm-3">Email Address:</dt>
                    <dd class="col-sm-9" id="viewEmail"></dd>

                    <dt class="col-sm-3">Car Make:</dt>
                    <dd class="col-sm-9" id="viewCarMake"></dd>

                    <dt class="col-sm-3">Car Model:</dt>
                    <dd class="col-sm-9" id="viewCarModel"></dd>

                    <dt class="col-sm-3">Repair Details:</dt>
                    <dd class="col-sm-9" id="viewRepairDetails"></dd>

                    <dt class="col-sm-3">Appointment Date:</dt>
                    <dd class="col-sm-9" id="viewAppointmentDate"></dd>

                    <dt class="col-sm-3">Appointment Time:</dt>
                    <dd class="col-sm-9" id="viewAppointmentTime"></dd>

                    <dt class="col-sm-3">Status:</dt>
                    <dd class="col-sm-9" id="viewStatus"></dd>
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
        $(document).ready(function() {
            // Handle form submission for adding a customer
            $("#customerForm").on("submit", function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "insert.php",
                    data: $(this).serialize(),
                    success: function(response) {
                        $("#exampleModal").modal("hide");
                        alert("Customer added successfully!");
                        location.reload();
                    },
                    error: function() {
                        alert("An error occurred while adding the customer.");
                    }
                });
            });

            // Handle form submission for updating a customer
            $("#updateForm").on("submit", function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "Update.php",
                    data: $(this).serialize(),
                    success: function(response) {
                        $("#UpdateModal").modal("hide");
                        alert("Customer updated successfully!");
                        location.reload();
                    },
                    error: function() {
                        alert("An error occurred while updating the customer.");
                    }
                });
            });

            $('#UpdateModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var customerId = button.data('customer_id'); // Extract info from data-* attributes

    // Fetch customer details for the given customer_id
    $.ajax({
        type: "POST",
        url: "fetch.php",
        data: { customer_id: customerId },
        dataType: "json",
        success: function(response) {
            if (response.error) {
                alert(response.error);
            } else {
                // Populate the modal fields with the fetched data
                $('#updateCustomerId').val(response.customer_id);
                $('#updateFirstName').val(response.firstname);
                $('#updateLastName').val(response.lastname);
                $('#updatePhoneNumber').val(response.phoneNumber);
                $('#updateEmailAddress').val(response.emailAddress);
                $('#updateCarMake').val(response.carmake);
                $('#updateCarModel').val(response.carmodel);
                $('#updateRepairDetails').val(response.repairdetails);
                $('#updateAppointmentDate').val(response.appointment_date);
                $('#updateAppointmentTime').val(response.appointment_time);
            }
        },
        error: function() {
            alert("An error occurred while fetching the customer data.");
        }
    });
});


            // Handle customer deletion
            window.deleteCustomer = function(customerId) {
                if (confirm("Are you sure you want to delete this customer?")) {
                    $.ajax({
                        type: "POST",
                        url: "delete.php",
                        data: { customer_id: customerId },
                        success: function(response) {
                            alert("Customer deleted successfully!");
                            location.reload();
                        },
                        error: function() {
                            alert("An error occurred while deleting the customer.");
                        }
                    });
                }
            };
        });

        $(document).ready(function() {
    // Handle the "View" button click event
    $('#viewCustomerModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var customerId = button.data('customer_id'); // Extract customer_id from data-* attributes

        // Fetch customer details for the given customer_id
        $.ajax({
            type: "POST",
            url: "fetch_customer.php",
            data: { customer_id: customerId },
            dataType: "json",
            success: function(response) {
                if (response.error) {
                    alert(response.error); // Display an error message if there's an issue
                } else {
                    // Populate the modal fields with the fetched data
                    $('#viewCustomerId').text(response.customer_id);
                    $('#viewFirstName').text(response.firstname);
                    $('#viewLastName').text(response.lastname);
                    $('#viewPhone').text(response.phoneNumber);
                    $('#viewEmail').text(response.emailAddress);
                    $('#viewCarMake').text(response.carmake);
                    $('#viewCarModel').text(response.carmodel);
                    $('#viewRepairDetails').text(response.repairdetails);
                    $('#viewAppointmentDate').text(response.appointment_date);
                    $('#viewAppointmentTime').text(response.appointment_time);
                    $('#viewStatus').text(response.Status);
                }
            },
            error: function(xhr, status, error) {
                console.error("An error occurred: " + error); // Log the error
            }
        });
    });
});
    </script>
    <script>
        let arrow = document.querySelectorAll(".arrow");
  for (var i = 0; i < arrow.length; i++) {
    arrow[i].addEventListener("click", (e)=>{
   let arrowParent = e.target.parentElement.parentElement;//selecting main parent of arrow
   arrowParent.classList.toggle("showMenu");
    });
  }
  let sidebar = document.querySelector(".sidebar");
  let sidebarBtn = document.querySelector(".bx-menu");
  console.log(sidebarBtn);
  sidebarBtn.addEventListener("click", ()=>{
    sidebar.classList.toggle("close");
  });
    </script>
</body>
</html>
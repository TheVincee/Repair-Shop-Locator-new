<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard with Sidebar and Modal</title>
    <link rel="stylesheet" href="Dashboard.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="Modal.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <style>
        .hide-column {
    display: none;
}
.edit-btn {
    background-color: #4CAF50;
    color: white;
    border: none;
    padding: 5px 10px;
    cursor: pointer;
    margin-right: 5px;
}

        /* Basic styling for the table */
        .appointments-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 16px;
            text-align: left;
        }
        .appointments-table th, .appointments-table td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }
        .appointments-table th {
            background-color: #f4f4f4;
        }
        .appointments-table tr:hover {
            background-color: #f1f1f1;
        }
        .appointments-table .action-btn {
            padding: 6px 12px;
            border: none;
            color: #fff;
            cursor: pointer;
            border-radius: 4px;
            font-size: 14px;
        }
        .appointments-table .view-btn {
            background-color: #007bff;
        }
        .appointments-table .view-btn:hover {
            background-color: #0056b3;
        }

        /* Hide specific columns */
        .appointments-table td.hide, .appointments-table th.hide {
            display: none;
        }
        /* The Modal (background) */
/* The Modal (background) */
/* Modal background */
.editModal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgba(0, 0, 0, 0.5); /* Black with opacity */
}

/* Modal content */
.editModal-content {
    background-color: #fff;
    margin: 15% auto; /* 15% from the top and centered */
    padding: 20px;
    border: 1px solid #888;
    width: 80%; /* Could be more or less, depending on screen size */
    max-width: 500px;
    box-shadow: 0px 4px 8px rgba(0,0,0,0.1);
}

/* Close button */
.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}

.btn {
    background-color: #007bff; /* Bootstrap button color */
    color: white;
    border: none;
    padding: 10px 20px;
    cursor: pointer;
    margin-top: 10px;
}

.btn:hover {
    background-color: #0056b3;
}


    </style>
    <style>
         /* Modern Table Styles */
         .walkin-appointments-table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .walkin-appointments-table th, .walkin-appointments-table td {
            border: none;
            padding: 12px 15px;
            text-align: left;
            background-color: #fff;
            transition: background-color 0.3s ease;
        }
        .walkin-appointments-table th {
            background-color: #f7f9fc;
            font-weight: bold;
            cursor: pointer;
        }
        .walkin-appointments-table th:hover {
            background-color: #e1e9f4;
        }
        .walkin-appointments-table tr:hover td {
            background-color: #f1f5fb;
        }
        .walkin-appointments-table td {
            border-bottom: 1px solid #e0e0e0;
        }
        /* Responsive Design */
        @media screen and (max-width: 768px) {
            .walkin-appointments-table thead {
                display: none;
            }
            .walkin-appointments-table, .walkin-appointments-table tbody, .walkin-appointments-table tr, .walkin-appointments-table td {
                display: block;
                width: 100%;
            }
            .walkin-appointments-table tr {
                margin-bottom: 15px;
            }
            .walkin-appointments-table td {
                text-align: right;
                padding-left: 50%;
                position: relative;
            }
            .walkin-appointments-table td::before {
                content: attr(data-label);
                position: absolute;
                left: 15px;
                font-weight: bold;
                text-transform: uppercase;
            }
        }
    </style>
</head>
<body>
    <div class="sidebar close">
        <div class="logo-details">
            <i class='bx bxl-c-plus-plus'></i>
            <span class="logo_name">CodingLab</span>
        </div>
        <ul class="nav-links">
            <li>
                <a href="Dashboard.php">
                    <i class='bx bx-grid-alt'></i>
                    <span class="link_name">Dashboard</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="Dashboard.php">Dashboard</a></li>
                </ul>
            </li>
            <li>
                <div class="iocn-link">
                    <a href="http://localhost/Repair-Shop-Locator-new/ADMIN/Inventory-Dashboard/DashboardInventory.php">
                        <i class='bx bx-collection'></i>
                        <span class="link_name">Inventory</span>
                    </a>
                    <i class='bx bxs-chevron-down arrow'></i>
                </div>
                <ul class="sub-menu">
                    <li><a class="link_name" href="http://localhost/Repair-Shop-Locator-new/ADMIN/Inventory-Dashboard/DashboardInventory.php">Inventory</a></li>
                    <li><a href="http://localhost/Repair-Shop-Locator-new/ADMIN/Inventory-Dashboard/all_items.php">InventoryItems</a></li>
                    <li><a href="http://localhost/Repair-Shop-Locator-new/ADMIN/Inventory-Dashboard/InventoryTable.php">InventoryTable</a></li>
                    <li><a href="http://localhost/Repair-Shop-Locator-new/ADMIN/Inventory-Dashboard/delivered_new_products.php">Delivered</a></li>
                </ul>
            </li>
        
            <li>
                <a href="walkin_appointments.php">
                    <i class='bx bx-pie-chart-alt-2'></i>
                    <span class="link_name">Walk-in</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="walkin_appointments.php">Walk-in</a></li>
                </ul>
            </li>
            <li>
                <a href="AppointmentNotifications.php">
                    <i class='bx bx-line-chart'></i>
                    <span class="link_name">Notification</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="AppointmentNotifications.php">Notification</a></li>
                </ul>
            </li>
            <li>
                <div class="iocn-link">
                    <a href="ListOfStatus.php">
                        <i class='bx bx-book'></i>
                        <span class="link_name">Appointments</span>
                    </a>
                    <i class='bx bxs-chevron-down arrow'></i>
                </div>
                <ul class="sub-menu">
                    <li><a class="link_name" href="ListOfStatus.php">ListOfStatus</a></li>
                    <li><a href="InProcessingAppointment.php">In Processing</a></li>
                    <li><a href="ApprovedAppoitnments.php">Approve</a></li>
                    <li><a href="RejectedAppointments.php">Reject</a></li>
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
                <a href="History.php">
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
                    <span class="link_name">Setting</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="#">Setting</a></li>
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
    <!-- Wrap the logout icon with a link to the logout page -->
    <a href="../LOGIN/Sign-in.php" class="logout-link">
        <i class='bx bx-log-out'></i>
    </a>
</div>
            </li>
        </ul>
    </div>

        <section class="dashboard-section">
            <div class="dashboard-content">
                <i class='bx bx-menu' id="hamburgerMenu"></i>
                <div class="metrics-boxes">
                    <div class="metric-box">
                    <div class="metric-details">
                        <div class="box-topic">Approved</div>
                    <div class="number" id="approvedCount">0</div>
                    </div>
                    </div>
                    <div class="metric-box">
                    <div class="metric-details">
                        <div class="box-topic">Rejected</div>
                        <div class="number" id="rejectedCount">0</div>
                        </div>
                    </div>
                    <div class="metric-box">
                    <div class="metric-details">
            <div class="box-topic">In Processing</div>
            <div class="number" id="inProcessingCount">0</div>
        </div>
                    </div>
                    <div class="metric-box">
                    <div class="metric-details">
            <div class="box-topic">Total Walk-in Appointments</div>
            <div class="number" id="walkinCount">0</div>
        </div>
                        </div>
                </div>
            </div>

            <div class="pending-appointments">
    <h2>User Pending Appointments</h2>
    <table class="appointments-table">
        <thead>
            <tr>
                <th>Customer ID</th>
                <th>First Name</th>
                <th class="hide">Last Name</th>
                <th class=>Address</th>
                <th>Email Address</th>
                <th>Phone Number</th>
                <th class="hide">Address</th>
                <th class="hide">Car Make</th>
                <th class="hide">Car Model</th>
                <th class>Repair Details</th>
                <th>Appointment Time</th>
                <th>Appointment Date</th>
                <th>Status</th>
                <th>Service Type</th> <!-- Corrected the class name from 'hidde' to 'hide' -->
                <th>Total Payment</th>
                <th>Payment Type</th>
                <th>Payment Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="appointments-tbody">
            <!-- Rows will be inserted here by JavaScript -->
        </tbody>
    </table>
</div>



    <table id="walkin-appointments-table" class="walkin-appointments-table">
    <thead>
        <tr>
            <th>Customer ID</th>
            <th>First Name</th>
            <th class="hide-column">Last Name</th>
            <th>Phone Number</th>
            <th>Email Address</th>
            <th class="hide-column">Car Make</th>
            <th class="hide-column">Car Model</th>
            <th>Repair Details</th>
            <th>Appointment Time</th>
            <th>Appointment Date</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody id="walkin-appointments-tbody">
        <!-- Rows will be dynamically added here -->
    </tbody>
</table>


    </section>
    
    <div class="modal-overlay" id="modal-overlay" style="display: none;">
    <div class="modal">
        <div class="modal-header">
            <h2><i class="fas fa-info-circle"></i> Customer Details</h2>
            <button class="close-btn" id="close-btn"><i class="fas fa-times"></i></button>
        </div>
        <form id="appointment-form">
            <div class="modal-body">
                <!-- Display Customer ID -->
                <div class="form-group">
                    <label for="customer-id"><i class="fas fa-user"></i> Customer ID</label>
                    <input type="text" id="customer-id" name="customer-id" readonly>
                </div>

                <!-- Dropdown for Status -->
                <div class="form-group">
                    <label for="status-dropdown"><i class="fas fa-exchange-alt"></i> Change Status</label>
                    <select id="status-dropdown" name="status-dropdown" class="form-control">
                        <option value="Approve">Approve</option>
                        <option value="Reject">Reject</option>
                        <option value="In Processing">In Processing</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="submit-btn"><i class="fas fa-paper-plane"></i> Submit</button>
            </div>
        </form>
    </div>
</div>
<!-- Edit Modal Structure -->
<div id="editModal" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close" id="editCloseBtn">&times;</span>
        <h2>Edit Appointment Details</h2>
        
        <p><strong>Customer ID:</strong> <span id="editCustomerId"></span></p>
        <p><strong>First Name:</strong> <span id="editFirstName"></span></p>
        <p><strong>Last Name:</strong> <span id="editLastName"></span></p>
        <p><strong>Address:</strong> <span id="editAddress"></span></p>
        <p><strong>Phone Number:</strong> <span id="editPhoneNumber"></span></p>
        <p><strong>Email Address:</strong> <span id="editEmailAddress"></span></p>
        <p><strong>Car Make:</strong> <span id="editCarMake"></span></p>
        <p><strong>Car Model:</strong> <span id="editCarModel"></span></p>
        <p><strong>Repair Details:</strong> <span id="editRepairDetails"></span></p>
        <p><strong>Appointment Time:</strong> <span id="editAppointmentTime"></span></p>
        <p><strong>Appointment Date:</strong> <span id="editAppointmentDate"></span></p>
        <p><strong>Status:</strong> <span id="editStatus"></span></p>
        <p><strong>Service Type:</strong> <span id="editServiceType"></span></p>
        <p><strong>Total Payment:</strong> ₱<span id="editTotalPayment"></span></p>
        <p><strong>Payment Type:</strong> <span id="editPaymentType"></span></p>

        <h3>Update Payment Type</h3>
        <form id="editPaymentForm">
            <input type="hidden" id="editCustomerIdInput" />
            <label for="editPaymentTypeInput">Payment Type:</label>
            <select id="editPaymentTypeInput" required>
                <option value="Fully paid">Fully paid</option>
                <option value="Not yet Paid">Not yet Paid</option>
            </select>
            <button type="submit" class="btn">Update Payment</button>
        </form>
    </div>
</div>


<div id="walkin-modal-container" class="modal-overlay">
    <div id="walkin-modal-content" class="modal">
        <div class="modal-header">
            <h2>Update Status</h2>
            <span id="walkin-modal-close" class="close-btn">&times;</span>
        </div>
        <div class="modal-body">
            <form id="walkin-modal-form">
                <div class="form-group">
                    <label for="walkin-modal-customer-id">Customer ID:</label>
                    <input type="text" id="walkin-modal-customer-id" readonly>
                </div>
                <div class="form-group">
                    <label for="walkin-modal-status-dropdown">Status:</label>
                    <select id="walkin-modal-status-dropdown" class="custom-dropdown">
                        <option value="In Progress">In Progress</option>
                        <option value="Approved">Approved</option>
                        <option value="Rejected">Rejected</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="submit-btn">Update Status</button>
                </div>
            </form>
        </div>
    </div>
</div>


   <script>
   document.addEventListener('DOMContentLoaded', function() {
    // Sidebar toggle
    let arrow = document.querySelectorAll(".arrow");
    arrow.forEach(function(item) {
        item.addEventListener("click", (e) => {
            let arrowParent = e.target.closest(".arrow-parent"); // Adjusted selector for clarity
            arrowParent.classList.toggle("showMenu");
        });
    });

    let sidebar = document.querySelector(".sidebar");
    let sidebarBtn = document.querySelector(".bx-menu");
    sidebarBtn.addEventListener("click", () => {
        sidebar.classList.toggle("close");
    });

    // Modal visibility for view modal
    const modalOverlay = document.getElementById('modal-overlay');
    const closeBtn = document.getElementById('close-btn');
    const form = document.getElementById('appointment-form');

    // Function to show modal with customer details
    function showModal(customerId) {
        fetch(`fetch_customer.php?customer_id=${customerId}`)
            .then(response => response.json())
            .then(data => {
                if (!data.error) {
                    document.getElementById('customer-id').value = data.customer_id;
                    document.getElementById('status-dropdown').value = data.Status;
                    modalOverlay.style.display = 'flex';
                    setTimeout(() => {
                        modalOverlay.classList.add('show');
                    }, 10);
                } else {
                    alert(data.error);
                }
            })
            .catch(error => console.error('Error fetching customer data:', error));
    }

    // Close the modal when clicking the close button
    if (closeBtn) {
        closeBtn.addEventListener('click', function() {
            modalOverlay.classList.remove('show');
            setTimeout(() => {
                modalOverlay.style.display = 'none';
            }, 300);
        });
    }

    // Handle form submission for updating appointment status
    if (form) {
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            const customerId = document.getElementById('customer-id').value;
            const status = document.getElementById('status-dropdown').value;

            fetch('update_status.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: new URLSearchParams({
                    'customer_id': customerId,
                    'status': status
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Status updated successfully!');
                    modalOverlay.classList.remove('show');
                    setTimeout(() => {
                        modalOverlay.style.display = 'none';
                    }, 300);
                    fetchAppointments(); // Refresh appointments
                } else {
                    alert('Error updating status: ' + data.error);
                }
            });
        });
    }

    // Fetch appointments and handle view/edit button clicks
    function fetchAppointments() {
        $.ajax({
            url: 'fetch_appointment_details.php',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                $('#appointments-tbody').empty();

                if (data.length > 0) {
                    data.forEach(function(appointment) {
                        var row = $('<tr>');
                        row.append($('<td>').text(appointment.customer_id));
                        row.append($('<td>').text(appointment.firstname));
                        row.append($('<td class="hide">').text(appointment.lastname));
                        row.append($('<td>').text(appointment.Address));
                        row.append($('<td>').text(appointment.emailAddress));
                        row.append($('<td>').text(appointment.phoneNumber));
                        row.append($('<td class="hide">').text(appointment.carmake));
                        row.append($('<td class="hide">').text(appointment.carmodel));
                        row.append($('<td>').text(appointment.repairdetails));
                        row.append($('<td>').text(appointment.appointment_time));
                        row.append($('<td>').text(appointment.appointment_date));
                        row.append($('<td>').text(appointment.Status));
                        row.append($('<td>').text(appointment.service_type));
                        row.append($('<td>').text("₱" + appointment.total_payment));
                        row.append($('<td>').text(appointment.payment_type));
                        row.append($('<td>').text(appointment.status_payment || 'Not yet Paid'));

                        // Create action buttons
                        var actionCell = $('<td>');
                        var editButton = $('<button>')
                            .addClass('edit-btn')
                            .text('Edit')
                            .attr('data-id', appointment.customer_id)
                            .on('click', function() {
                                showEditModal(appointment.customer_id);
                            });
                        actionCell.append(editButton);

                        var viewButton = $('<button>')
                            .addClass('view-btn')
                            .text('View')
                            .attr('data-id', appointment.customer_id)
                            .on('click', function() {
                                showModal(appointment.customer_id);
                            });
                        actionCell.append(viewButton);

                        row.append(actionCell);
                        $('#appointments-tbody').append(row);
                    });
                } else {
                    $('#appointments-tbody').append($('<tr>').append($('<td colspan="16">').text('No pending appointments found.')));
                }
            },
            error: function(xhr, status, error) {
                console.error('Error fetching data:', error);
                console.log(xhr.responseText);
            }
        });
    }

    fetchAppointments(); // Initial fetch of appointments

    // Show edit modal with customer data
    function showEditModal(customerId) {
        fetch(`view_and_edit_payment.php?customer_id=${customerId}`)
            .then(response => response.json())
            .then(data => {
                if (!data.error) {
                    // Populate edit modal fields
                    document.getElementById('editCustomerId').textContent = data.customer_id || 'N/A';
                    document.getElementById('editFirstName').textContent = data.firstname || 'N/A';
                    document.getElementById('editLastName').textContent = data.lastname || 'N/A';
                    document.getElementById('editAddress').textContent = data.address || 'N/A';
                    document.getElementById('editPhoneNumber').textContent = data.phone_number || 'N/A';
                    document.getElementById('editEmailAddress').textContent = data.email_address || 'N/A';
                    document.getElementById('editCarMake').textContent = data.car_make || 'N/A';
                    document.getElementById('editCarModel').textContent = data.car_model || 'N/A';
                    document.getElementById('editRepairDetails').textContent = data.repair_details || 'N/A';
                    document.getElementById('editAppointmentTime').textContent = data.appointment_time || 'N/A';
                    document.getElementById('editAppointmentDate').textContent = data.appointment_date || 'N/A';
                    document.getElementById('editStatus').textContent = data.status || 'N/A';
                    document.getElementById('editServiceType').textContent = data.service_type || 'N/A';
                    document.getElementById('editTotalPayment').textContent = data.total_payment || 'N/A';
                    document.getElementById('editPaymentType').textContent = data.payment_type || 'N/A';

                    // Set hidden input value for updating payment type
                    document.getElementById('editCustomerIdInput').value = data.customer_id;

                    // Set the dropdown value for payment type based on the fetched data
                    const paymentTypeInput = document.getElementById('editPaymentTypeInput');
                    paymentTypeInput.value = data.payment_type;

                    // Display edit modal
                    const editModal = document.getElementById('editModal');
                    editModal.style.display = 'block';
                } else {
                    alert(data.error);
                }
            })
            .catch(error => console.error('Error fetching customer data for edit:', error));
    }

    // Close the edit modal when clicking the close button
    document.getElementById('editCloseBtn').addEventListener('click', function() {
        document.getElementById('editModal').style.display = 'none';
    });

    // Close the edit modal when clicking outside of modal content
    window.addEventListener('click', function(event) {
        const editModal = document.getElementById('editModal');
        if (event.target === editModal) {
            editModal.style.display = 'none';
        }
    });

    // Handle form submission for updating the payment type
    document.getElementById('editPaymentForm').addEventListener('submit', function(event) {
        event.preventDefault();

        const customerId = document.getElementById('editCustomerIdInput').value;
        const paymentType = document.getElementById('editPaymentTypeInput').value;

        fetch('edit_update_status.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: new URLSearchParams({
                'customer_id': customerId,
                'payment_type': paymentType
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Payment type updated successfully!');
                fetchAppointments(); // Refresh the appointments table
                document.getElementById('editModal').style.display = 'none'; // Close the modal
            } else {
                alert('Error updating payment: ' + data.error);
            }
        });
    });

});



   </script>
<script>
   $(document).ready(function() {
    const modalContainer = $('#walkin-modal-container');
    const modalForm = $('#walkin-modal-form');

    function showModal(customerId) {
        $.ajax({
            url: `get_walkin_appointment.php`,
            method: 'GET',
            data: { customer_id: customerId },
            dataType: 'json',
            success: function(data) {
                if (!data.error) {
                    $('#walkin-modal-customer-id').val(data.customer_id);
                    $('#walkin-modal-status-dropdown').val(data.Status);
                    modalContainer.fadeIn();  // Show modal with a fade-in effect
                } else {
                    alert(data.error);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error fetching customer data:', error);
            }
        });
    }

    $('#walkin-modal-close').on('click', function() {
        modalContainer.fadeOut();  // Fade out to hide modal
    });

    modalForm.on('submit', function(event) {
        event.preventDefault();

        const customerId = $('#walkin-modal-customer-id').val();
        const status = $('#walkin-modal-status-dropdown').val();

        $.ajax({
            url: 'update_walkin_status.php',
            method: 'POST',
            data: {
                customer_id: customerId,
                status: status
            },
            dataType: 'json',
            success: function(data) {
                if (data.success) {
                    alert('Status updated successfully!');
                    modalContainer.fadeOut();  // Fade out the modal after a successful update
                    fetchAppointments();  // Refresh the appointments table
                } else {
                    alert('Error updating status: ' + data.error);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error updating status:', error);
            }
        });
    });

    function fetchAppointments() {
        $.ajax({
            url: 'fetch_walkin_appointments.php',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                $('#walkin-appointments-tbody').empty();

                if (data.length > 0) {
                    data.forEach(function(appointment) {
                        var row = $('<tr>');
                        row.append($('<td>').text(appointment.customer_id));
                        row.append($('<td>').text(appointment.firstname));
                        row.append($('<td class="hide-column">').text(appointment.lastname));  // Hidden column
                        row.append($('<td>').text(appointment.phoneNumber));
                        row.append($('<td>').text(appointment.emailAddress));
                        row.append($('<td class="hide-column">').text(appointment.carmake));  // Hidden column
                        row.append($('<td class="hide-column">').text(appointment.carmodel));  // Hidden column
                        row.append($('<td>').text(appointment.repairdetails));
                        row.append($('<td>').text(appointment.appointment_time));
                        row.append($('<td>').text(appointment.appointment_date));
                        row.append($('<td>').text(appointment.Status));

                        var actionCell = $('<td>');
                        var viewButton = $('<button>')
                            .addClass('view-btn')
                            .text('View')
                            .attr('data-id', appointment.customer_id);
                        actionCell.append(viewButton);
                        row.append(actionCell);

                        $('#walkin-appointments-tbody').append(row);
                    });
                } else {
                    $('#walkin-appointments-tbody').append(
                        $('<tr>').append(
                            $('<td colspan="12">').text('No pending appointments found.')
                        )
                    );
                }
            },
            error: function(xhr, status, error) {
                console.error('Error fetching data:', error);
            }
        });
    }

    // Call fetchAppointments on page load to populate the table
    fetchAppointments();

    // Handle view button click to show the modal
    $('#walkin-appointments-tbody').on('click', '.view-btn', function() {
        var customerId = $(this).data('id');
        showModal(customerId);
    });
});

</script>

    <script>
       document.addEventListener('DOMContentLoaded', function () {
    const customerId = <?php echo json_encode($customerId); ?>; // Dynamic customer ID from PHP
    const notificationContainer = document.getElementById('notification-container');

    // Function to fetch notifications via AJAX
    function fetchNotifications() {
        fetch('fetch_notifications.php?customer_id=' + customerId)
            .then(response => response.text()) 
            .then(data => {
                console.log('Raw response:', data); 
                try {
                    const jsonData = JSON.parse(data); 
                    if (jsonData.success && jsonData.notifications.length > 0) {
                        jsonData.notifications.forEach(notification => {
                            displayNotification(notification.message);
                        });
                    } else {
                        console.log('No notifications or success flag is false.');
                    }
                } catch (error) {
                    console.error('Error parsing JSON:', error);
                }
            })
            .catch(error => {
                console.error('Error fetching notifications:', error);
            });
    }

    // Function to display notifications
    function displayNotification(message) {
        const notificationElement = document.createElement('div');
        notificationElement.className = 'notification';
        notificationElement.textContent = message;

        notificationContainer.appendChild(notificationElement);

        // Auto-remove notification after 5 seconds
        setTimeout(() => {
            notificationContainer.removeChild(notificationElement);
        }, 5000);
    }

    // Polling for new notifications every 5 seconds
    setInterval(fetchNotifications, 5000);
});

    </script>
     

</body>
</html>
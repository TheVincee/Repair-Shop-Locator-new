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
.walk-in-appointments-table {
    width: 100%;
    border-collapse: collapse;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}
.walk-in-appointments-table th, .walk-in-appointments-table td {
    border: none;
    padding: 12px 15px;
    text-align: left;
    background-color: #fff;
    transition: background-color 0.3s ease;
}
.walk-in-appointments-table th {
    background-color: #f7f9fc;
    font-weight: bold;
    cursor: pointer;
}
.walk-in-appointments-table th:hover {
    background-color: #e1e9f4;
}
.walk-in-appointments-table tr:hover td {
    background-color: #f1f5fb;
}
.walk-in-appointments-table td {
    border-bottom: 1px solid #e0e0e0;
}

/* Responsive Design */
@media screen and (max-width: 768px) {
    .walk-in-appointments-table thead {
        display: none;
    }
    .walk-in-appointments-table, .walk-in-appointments-table tbody, .walk-in-appointments-table tr, .walk-in-appointments-table td {
        display: block;
        width: 100%;
    }
    .walk-in-appointments-table tr {
        margin-bottom: 15px;
    }
    .walk-in-appointments-table td {
        text-align: right;
        padding-left: 50%;
        position: relative;
    }
    .walk-in-appointments-table td::before {
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
            <span class="logo_name">Dashboard</span>
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
                <a href="view_paid_appointments.php">
                    <i class='bx bx-dollar'></i>
                    <span class="link_name">Explore</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="view_paid_appointments.php">Explore</a></li>
                </ul>
            </li>
            <li>
                <a href="History.php">
                    <i class='bx bx-history'></i>
                    <span class="link_name">History</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="History.php">History</a></li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class='bx bx-cog'></i>
                    <span class="link_name">Ratings</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="#">Ratings</a></li>
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

<div class="walkin-appointments">
    <h2>Walk-in Appointments</h2>
    <table class="walk-in-appointments-table"> <!-- Updated class name -->
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
                <th>Car Model</th>
                <th>Service Type</th>
                <th>Total Payable</th>
                <th>Payment Type</th>
                <th>Payment Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="walkin-appointments-tbody">
            <!-- Rows will be inserted here by JavaScript -->
        </tbody>
    </table>
</div>


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

        <p><strong>Customer ID:</strong> <span id="editCustomerId">N/A</span></p>
        <p><strong>First Name:</strong> <span id="editFirstName">N/A</span></p>
        <p><strong>Last Name:</strong> <span id="editLastName">N/A</span></p>
        <p><strong>Address:</strong> <span id="editAddress">N/A</span></p>
        <p><strong>Phone Number:</strong> <span id="editPhoneNumber">N/A</span></p>
        <p><strong>Email Address:</strong> <span id="editEmailAddress">N/A</span></p>
        <p><strong>Car Make:</strong> <span id="editCarMake">N/A</span></p>
        <p><strong>Car Model:</strong> <span id="editCarModel">N/A</span></p>
        <p><strong>Repair Details:</strong> <span id="editRepairDetails">N/A</span></p>
        <p><strong>Appointment Time:</strong> <span id="editAppointmentTime">N/A</span></p>
        <p><strong>Appointment Date:</strong> <span id="editAppointmentDate">N/A</span></p>
        <p><strong>Status:</strong> <span id="editStatus">N/A</span></p>
        <p><strong>Service Type:</strong> <span id="editServiceType">N/A</span></p>
        <p><strong>Total Payment:</strong> ₱<span id="editTotalPayment">0.00</span></p>
        <p><strong>Payment Type:</strong> <span id="editPaymentType">N/A</span></p>

        <form id="editPaymentForm" action="#" method="POST">
            <input type="hidden" id="editCustomerIdInput" name="customer_id" />
            <label for="editPaymentStatusInput">Payment Status:</label>
            <select id="editPaymentStatusInput" name="payment_status" required>
                <option value="">Select Payment Status</option>
                <option value="Paid">Paid</option>
                <option value="Not Paid">Not Paid</option>
            </select>
            <button type="submit" class="btn">Update Payment</button>
        </form>
    </div>
</div>


<div id="walkin-modal-container" class="modal-overlay">
    <div id="walkin-modal-content" class="modal">
        <div class="modal-header">
            <h2>Update Appointment Status</h2>
            <span id="walkin-modal-close" class="close-btn">&times;</span>
        </div>
        <div class="modal-body">
            <form id="walkin-modal-form">
                <div class="form-group">
                    <label for="walkin-modal-customer-id">Customer ID:</label>
                    <input type="text" id="walkin-modal-customer-id" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="walkin-modal-status-dropdown">Status:</label>
                    <select id="walkin-modal-status-dropdown" class="form-control custom-dropdown">
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

    // Function to clear modal fields
    function clearModalFields() {
        document.getElementById('customer-id').value = '';
        document.getElementById('status-dropdown').value = '';
    }

    // Close the modal when clicking the close button
    if (closeBtn && modalOverlay) {
        closeBtn.addEventListener('click', () => {
            modalOverlay.classList.remove('show');
            setTimeout(() => {
                modalOverlay.style.display = 'none';
                clearModalFields(); // Clear fields when closing
            }, 300);
        });
    }

    // Handle form submission for updating appointment status
    if (form) {
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            const customerId = document.getElementById('customer-id').value;
            const status = document.getElementById('status-dropdown').value;

            if (customerId && status) {
                fetch('update_status.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
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
                            clearModalFields(); // Clear fields after successful submission
                        }, 300);
                        fetchAppointments(); // Refresh the table to reflect changes
                    } else {
                        alert('Error updating status: ' + data.error);
                    }
                })
                .catch(error => console.error('Error updating status:', error));
            }
        });
    }

    // Fetch appointments and handle view/edit button clicks
    function fetchAppointments() {
        $.ajax({
            url: 'fetch_appointment_details.php',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                $('#appointments-tbody').empty(); // Clear the table body

                if (data.length > 0) {
                    data.forEach(function(appointment) {
                        // Only append appointments if the status is not 'Completed'
                        if (appointment.Status !== 'Completed') {
                            const row = $('<tr>').attr('id', `row-${appointment.customer_id}`); // Set ID for row

                            // Append cells with appointment data
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

                            // Convert total_payment to number and format it
                            const totalPayment = Number(appointment.total_payment);
                            row.append($('<td>').text("₱" + totalPayment.toFixed(2)));

                            row.append($('<td>').text(appointment.payment_type));
                            row.append($('<td>').text(appointment.payment_status || 'Not yet Paid'));

                            // Action buttons for Edit and View
                            const actionCell = $('<td>');
                            const editButton = $('<button>')
                                .addClass('edit-btn')
                                .text('Edit')
                                .attr('data-id', appointment.customer_id)
                                .on('click', () => showEditModal(appointment.customer_id));
                            const viewButton = $('<button>')
                                .addClass('view-btn')
                                .text('View')
                                .attr('data-id', appointment.customer_id)
                                .on('click', () => showModal(appointment.customer_id));

                            actionCell.append(editButton).append(viewButton);
                            row.append(actionCell);
                            $('#appointments-tbody').append(row);
                        }
                    });
                } else {
                    $('#appointments-tbody').append($('<tr>').append($('<td colspan="16">').text('No pending appointments found.')));
                }
            },
            error: function(xhr, status, error) {
                console.error('Error fetching data:', error);
            }
        });
    }

    // Initial fetch of appointments
    fetchAppointments(); 

    // Function to show edit modal with customer data
    function showEditModal(customerId) {
        fetch(`view_and_edit_payment.php?customer_id=${customerId}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Populate modal fields with fetched data
                    $('#editCustomerId').text(data.data.customer_id || 'N/A');
                    $('#editFirstName').text(data.data.firstname || 'N/A');
                    $('#editLastName').text(data.data.lastname || 'N/A');
                    $('#editAddress').text(data.data.address || 'N/A');
                    $('#editPhoneNumber').text(data.data.phoneNumber || 'N/A');
                    $('#editEmailAddress').text(data.data.emailAddress || 'N/A');
                    $('#editCarMake').text(data.data.carmake || 'N/A');
                    $('#editCarModel').text(data.data.carmodel || 'N/A');
                    $('#editRepairDetails').text(data.data.repairdetails || 'N/A');
                    $('#editAppointmentTime').text(data.data.appointment_time || 'N/A');
                    $('#editAppointmentDate').text(data.data.appointment_date || 'N/A');
                    $('#editStatus').text(data.data.Status || 'N/A');
                    $('#editServiceType').text(data.data.service_type || 'N/A');
                    $('#editTotalPayment').text(data.data.total_payment || '₱0.00');
                    $('#editPaymentType').text(data.data.payment_type || 'N/A');

                    // Set payment status if it exists in the data
                    if (data.data.payment_status) {
                        $('#editPaymentStatusInput').val(data.data.payment_status); // Set to existing value
                        $('#editPaymentStatusDisplay').text(data.data.payment_status); // Display the status
                    } else {
                        $('#editPaymentStatusInput').val(''); // Clear input if no status
                        $('#editPaymentStatusDisplay').text(''); // Clear display if no status
                    }

                    $('#editCustomerIdInput').val(data.data.customer_id);
                    $('#editModal').show(); // Show the modal
                } else {
                    alert(data.error || 'Error fetching customer data.');
                }
            })
            .catch(error => console.error('Error fetching customer data for edit:', error));
    }

    // Update payment status and clear the display after submission
    $('#editPaymentForm').on('submit', function(event) {
        event.preventDefault(); // Prevent default form submission

        const customerId = $('#editCustomerIdInput').val(); // Get customer ID
        const paymentStatus = $('#editPaymentStatusInput').val(); // Get selected payment status

        if (!customerId) {
            alert('Customer ID is required.');
            return;
        }

        const dataToSend = { customer_id: customerId };
        if (paymentStatus === 'Paid') {
            dataToSend.payment_status = paymentStatus; // Add payment status to data if 'Paid' is selected
        }

        $.ajax({
            url: 'view_and_edit_payment.php', // Your PHP endpoint to update the payment status
            type: 'POST',
            data: dataToSend,
            dataType: 'json',
            success: function(data) {
                if (data.success) {
                    alert('Payment status updated successfully!');

                    // Clear payment status field if "Paid" was selected
                    if (paymentStatus === 'Paid') {
                        $('#editPaymentStatusInput').val(''); // Clear payment status input
                    }
                    
                    $('#editPaymentStatusDisplay').text(paymentStatus); // Update the displayed payment status

                    $('#editModal').hide(); // Hide the modal after successful update
                    fetchAppointments(); // Refresh the appointments table after updating
                } else {
                    alert(data.error || 'Error updating payment status.');
                }
            },
            error: function(xhr, status, error) {
                alert('Error updating payment status: ' + error);
            }
        });
    });

    // Close edit modal when clicking cancel button
    $('#editCancelBtn').on('click', function() {
        $('#editModal').hide(); // Hide the modal
    });
});




   </script>
<script>
$(document).ready(function() {
    const modalContainer = $('#walkin-modal-container');
    const modalForm = $('#walkin-modal-form');

    // Function to show the modal and fetch customer data
    function showModal(customerId) {
        console.log("Showing modal for customer ID:", customerId); // Debugging line

        // Clear previous data
        $('#walkin-modal-customer-id').val('');
        $('#walkin-modal-status-dropdown').val('In Progress'); // Reset to default status

        // AJAX call to fetch customer data
        $.ajax({
            url: 'get_walkin_appointment.php',
            method: 'GET',
            data: { customer_id: customerId },
            dataType: 'json',
            success: function(response) {
                console.log("Data received from server:", response); // Debugging line
                if (response.status === 'success') {
                    const appointment = response.data;
                    
                    // Populate modal fields with received data
                    $('#walkin-modal-customer-id').val(appointment.customer_id);
                    $('#walkin-modal-status-dropdown').val(appointment.Status);
                    modalContainer.fadeIn(); // Show the modal
                } else {
                    alert('Error: ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error fetching customer data:', error);
                alert('Failed to fetch customer data. Please try again.');
            }
        });
    }

    // Event to close the modal
    $('#walkin-modal-close').on('click', function() {
        modalContainer.fadeOut(); // Fade out to hide modal
    });

    // Form submission to update status
    modalForm.on('submit', function(event) {
        event.preventDefault();

        const customerId = $('#walkin-modal-customer-id').val();
        const status = $('#walkin-modal-status-dropdown').val();

        console.log("Submitting form for customer ID:", customerId, "with status:", status); // Debugging line

        // AJAX call to update status
        $.ajax({
            url: 'update_walkin_status.php',
            method: 'POST',
            data: { customer_id: customerId, status: status },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    alert('Status updated successfully!');
                    modalContainer.fadeOut(); // Close modal after update
                    fetchAppointments(); // Refresh appointments table
                } else {
                    alert('Error updating status: ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error updating status:', error);
                alert('Failed to update status. Please try again.');
            }
        });
    });

    // Function to fetch appointments
    function fetchAppointments() {
        $.ajax({
            url: 'fetch_walkin_appointments.php',
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                $('#walkin-appointments-tbody').empty();

                if (response.status === 'success' && response.data.length > 0) {
                    response.data.forEach(function(appointment) {
                        const row = $('<tr>');
                        row.append($('<td>').text(appointment.customer_id));
                        row.append($('<td>').text(appointment.firstname));
                        row.append($('<td>').text(appointment.phoneNumber));
                        row.append($('<td>').text(appointment.emailAddress));
                        row.append($('<td>').text(appointment.repairdetails));
                        row.append($('<td>').text(appointment.appointment_time));
                        row.append($('<td>').text(appointment.appointment_date));
                        row.append($('<td>').text(appointment.Status));
                        row.append($('<td>').text(appointment.carmodel));
                        row.append($('<td>').text(appointment.service_type));
                        row.append($('<td>').text(appointment.total_payable));
                        row.append($('<td>').text(appointment.payment_type));
                        row.append($('<td>').text(appointment.payment_status));

                        const actionCell = $('<td>');
                        const viewButton = $('<button>')
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
                console.error('Error fetching appointments:', error);
            }
        });
    }

    // Initial fetch of appointments on page load
    fetchAppointments();

    // Handle view button click to show the modal
    $('#walkin-appointments-tbody').on('click', '.view-btn', function() {
        const customerId = $(this).data('id');
        console.log("View button clicked, customer ID:", customerId); // Debugging line
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
     <script>
        $(document).ready(function() {
    function fetchCounts() {
        // Optionally show a loading indicator
        $('#loadingIndicator').show();

        $.ajax({
            url: 'fetchCounts.php', // URL to the PHP file
            type: 'GET',
            data: { action: 'getCounts' },
            dataType: 'json',
            success: function(response) {
                // Hide loading indicator
                $('#loadingIndicator').hide();

                console.log('Counts Response:', response); // Log the entire response for debugging

                if (response.status !== 'error') {
                    // Update dashboard metrics with the counts
                    $('#approvedCount').text(response.approved);
                    $('#rejectedCount').text(response.rejected);
                    $('#inProcessingCount').text(response.in_processing);
                    $('#walkinCount').text(response.total_walkins);

                    // Optional: Handle zero counts with messages
                    if (parseInt(response.rejected, 10) === 0) {
                        $('#rejectedCount').text('No rejected appointments found.');
                    }
                } else {
                    console.error(response.message);
                    alert("Error fetching counts: " + response.message); // User-friendly alert
                }
            },
            error: function(xhr, status, error) {
                $('#loadingIndicator').hide();
                console.error("AJAX Error: " + error);
                alert("An error occurred while fetching counts. Please try again later."); // User-friendly alert
            }
        });
    }

    // Fetch counts on page load
    fetchCounts();
});</script>

</body>
</html>
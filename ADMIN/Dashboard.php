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
                    <li><a class="link_name" href="">Category</a></li>
                    <li><a href="#">HTML & CSS</a></li>
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
                    <a href="walkin_appointments.php">
                        <i class='bx bx-plug'></i>
                        <span class="link_name">Appointments</span>
                    </a>
                    <i class='bx bxs-chevron-down arrow'></i>
                </div>
                <ul class="sub-menu">
                    <li><a class="link_name" href="walkin_appointments.php">walk-in</a></li>
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
                        <div class="box-topic">Total Order</div>
                        <div class="number">40,876</div>
                        <div class="indicator">
                            <i class='bx bx-up-arrow-alt'></i>
                            <span class="text">Up from yesterday</span>
                        </div>
                    </div>
                    <i class='bx bx-cart-alt cart'></i>
                </div>
                <div class="metric-box">
                    <div class="metric-details">
                        <div class="box-topic">Total Sales</div>
                        <div class="number">38,876</div>
                        <div class="indicator">
                            <i class='bx bx-up-arrow-alt'></i>
                            <span class="text">Up from yesterday</span>
                        </div>
                    </div>
                    <i class='bx bxs-cart-add cart two'></i>
                </div>
                <div class="metric-box">
                    <div class="metric-details">
                        <div class="box-topic">Total Profit</div>
                        <div class="number">$12,876</div>
                        <div class="indicator">
                            <i class='bx bx-up-arrow-alt'></i>
                            <span class="text">Up from yesterday</span>
                        </div>
                    </div>
                    <i class='bx bx-dollar cart three'></i>
                </div>
                <div class="metric-box">
                    <div class="metric-details">
                        <div class="box-topic">Total Reviews</div>
                        <div class="number">4,876</div>
                        <div class="indicator">
                            <i class='bx bx-down-arrow-alt down'></i>
                            <span class="text">Down from yesterday</span>
                        </div>
                    </div>
                    <i class='bx bx-message-detail cart four'></i>
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
                    <th>Phone Number</th>
                    <th class="hide">Email Address</th>
                    <th class="hide">Car Make</th>
                    <th class="hide">Car Model</th>
                    <th>Repair Details</th>
                    <th>Appointment Time</th>
                    <th>Appointment Date</th>
                    <th>Status</th>
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
                let arrowParent = e.target.parentElement.parentElement; // Selecting the main parent of the arrow
                arrowParent.classList.toggle("showMenu");
            });
        });

        let sidebar = document.querySelector(".sidebar");
        let sidebarBtn = document.querySelector(".bx-menu");
        sidebarBtn.addEventListener("click", () => {
            sidebar.classList.toggle("close");
        });

        // Modal visibility
        const modalOverlay = document.getElementById('modal-overlay');
        const closeBtn = document.getElementById('close-btn');
        const form = document.getElementById('appointment-form');

        function showModal(customerId) {
            fetch(`fetch_customer.php?customer_id=${customerId}`)
                .then(response => response.json())
                .then(data => {
                    if (!data.error) {
                        document.getElementById('customer-id').value = data.customer_id;
                        document.getElementById('status-dropdown').value = data.Status;
                        modalOverlay.style.display = 'flex'; // Display modal overlay
                        setTimeout(() => {
                            modalOverlay.classList.add('show'); // Add class to show modal
                        }, 10); // Short delay to ensure the modal starts with 'display: flex'
                    } else {
                        alert(data.error);
                    }
                })
                .catch(error => console.error('Error fetching customer data:', error));
        }

        if (closeBtn) {
            closeBtn.addEventListener('click', function() {
                modalOverlay.classList.remove('show'); // Remove class to hide modal
                setTimeout(() => {
                    modalOverlay.style.display = 'none'; // Hide modal overlay after animation
                }, 300); // Match this with the CSS transition duration
            });
        }

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
                        modalOverlay.classList.remove('show'); // Remove class to hide modal
                        setTimeout(() => {
                            modalOverlay.style.display = 'none'; // Hide modal overlay after animation
                        }, 300); // Match this with the CSS transition duration
                    } else {
                        alert('Error updating status: ' + data.error);
                    }
                });
            });
        }

        // Fetch appointments and handle view button clicks
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
                            row.append($('<td>').text(appointment.phoneNumber));
                            row.append($('<td class="hide">').text(appointment.emailAddress));
                            row.append($('<td class="hide">').text(appointment.carmake));
                            row.append($('<td class="hide">').text(appointment.carmodel));
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

                            $('#appointments-tbody').append(row);
                        });
                    } else {
                        $('#appointments-tbody').append($('<tr>').append($('<td colspan="12">').text('No pending appointments found.')));
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching data:', error);
                }
            });
        }

        fetchAppointments();

        $('#appointments-tbody').on('click', '.view-btn', function() {
            var customerId = $(this).data('id');
            showModal(customerId);
        });
        
    });
   </script>
<script>
     document.addEventListener('DOMContentLoaded', function() {
        const modalContainer = document.getElementById('walkin-modal-container');
        const modalClose = document.getElementById('walkin-modal-close');
        const modalForm = document.getElementById('walkin-modal-form');

        function showModal(customerId) {
            fetch(`get_walkin_appointment.php?customer_id=${customerId}`)
                .then(response => response.json())
                .then(data => {
                    if (!data.error) {
                        document.getElementById('walkin-modal-customer-id').value = data.customer_id;
                        document.getElementById('walkin-modal-status-dropdown').value = data.Status;
                        modalContainer.style.display = 'flex';
                        setTimeout(() => {
                            modalContainer.classList.add('show');
                        }, 10);
                    } else {
                        alert(data.error);
                    }
                })
                .catch(error => console.error('Error fetching customer data:', error));
        }

        if (modalClose) {
            modalClose.addEventListener('click', function() {
                modalContainer.classList.remove('show');
                setTimeout(() => {
                    modalContainer.style.display = 'none';
                }, 300);
            });
        }

        if (modalForm) {
            modalForm.addEventListener('submit', function(event) {
                event.preventDefault();

                const customerId = document.getElementById('walkin-modal-customer-id').value;
                const status = document.getElementById('walkin-modal-status-dropdown').value;

                fetch('update_walkin_status.php', {
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
                        modalContainer.classList.remove('show');
                        setTimeout(() => {
                            modalContainer.style.display = 'none';
                        }, 300);
                        fetchAppointments(); // Refresh the table to show updated status
                    } else {
                        alert('Error updating status: ' + data.error);
                    }
                })
                .catch(error => console.error('Error updating status:', error));
            });
        }

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
                            row.append($('<td class="hide-column">').text(appointment.lastname)); // Hidden column
                            row.append($('<td>').text(appointment.phoneNumber));
                            row.append($('<td>').text(appointment.emailAddress));
                            row.append($('<td class="hide-column">').text(appointment.carmake)); // Hidden column
                            row.append($('<td class="hide-column">').text(appointment.carmodel)); // Hidden column
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
                        $('#walkin-appointments-tbody').append($('<tr>').append($('<td colspan="12">').text('No pending appointments found.')));
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching data:', error);
                }
            });
        }

        fetchAppointments();

        $('#walkin-appointments-tbody').on('click', '.view-btn', function() {
            var customerId = $(this).data('id');
            showModal(customerId);
        });
    }); 
</script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
    const customerId = 123; // Replace with the actual customer ID
    const notificationContainer = document.getElementById('notification-container');

    // Function to fetch notifications
    function fetchNotifications() {
        fetch('fetch_notifications.php?customer_id=' + customerId)
            .then(response => response.json())
            .then(data => {
                if (data.success && data.notifications.length > 0) {
                    data.notifications.forEach(notification => {
                        displayNotification(notification.message);
                    });
                }
            })
            .catch(error => console.error('Error fetching notifications:', error));
    }

    // Function to display notification
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
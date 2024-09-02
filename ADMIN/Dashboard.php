<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard with Sidebar and Modal</title>
    <link rel="stylesheet" href="Dashboard.css">
    <link rel="stylesheet" href="Appointment.css">
    <link rel="stylesheet" href="Modal.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="Modal.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <style>
        /* Styling for Walk-In Appointments Section */
.walkin-appointments {
    margin: 20px;
}

.walkin-appointments h2 {
    font-size: 24px;
    margin-bottom: 20px;
    color: #333;
}

/* Styling for Walk-In Appointments Table */
.walkin-appointments-table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
    font-size: 16px;
    text-align: left;
    border: 1px solid #ddd;
}

.walkin-appointments-table th,
.walkin-appointments-table td {
    padding: 12px;
    border-bottom: 1px solid #ddd;
}

.walkin-appointments-table th {
    background-color: #f4f4f4;
    color: #333;
}

.walkin-appointments-table tr:hover {
    background-color: #f1f1f1;
}

.walkin-appointments-table .view-btn {
    padding: 6px 12px;
    border: none;
    color: #fff;
    cursor: pointer;
    border-radius: 4px;
    font-size: 14px;
    background-color: #007bff;
    transition: background-color 0.3s;
}

.walkin-appointments-table .view-btn:hover {
    background-color: #0056b3;
}

.walkin-appointments-table .hide {
    display: none;
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
                    <a href="#">
                        <i class='bx bx-plug'></i>
                        <span class="link_name">Plugins</span>
                    </a>
                    <i class='bx bxs-chevron-down arrow'></i>
                </div>
                <ul class="sub-menu">
                    <li><a class="link_name" href="InProcessing.php">Plugins</a></li>
                    <li><a href="walkin_appointments.php">UI Face</a></li>
                    <li><a href="ApprovedAppoitnments.php">Pigments</a></li>
                    <li><a href="Unapproved.php">Box Icons</a></li>
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
    <a href="/Repair-Shop-Locator-new-Shop/LOGIN/Sign-in.php" class="logout-link">
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
    <div class="walkin-appointments">
    <h2>Walk-In Appointments</h2>
    <table class="walkin-appointments-table">
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
                <th>Action</th> <!-- Added Action header -->
            </tr>
        </thead>
        <tbody id="walkin_appointments-tbody">
            <!-- Rows will be inserted here by JavaScript -->
        </tbody>
    </table>
</div>
    </section>
    <div class="modal-overlay" id="modal-overlay" style="display: none;">
    <div class="modal modern-modal">
        <div class="modal-header">
            <h2><i class="fas fa-info-circle"></i> Customer Details</h2>
            <button class="close-btn" id="close-btn">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <form id="appointment-form">
            <div class="modal-body">
                <!-- Display Customer ID -->
                <div class="form-group">
                    <label for="customer-id"><i class="fas fa-user"></i> Customer ID</label>
                    <input type="text" id="customer-id" name="customer-id" readonly class="input-field">
                </div>

                <!-- Dropdown for Status -->
                <div class="form-group">
                    <label for="status-dropdown"><i class="fas fa-exchange-alt"></i> Change Status</label>
                    <select id="status-dropdown" name="status-dropdown" class="form-control input-field">
                        <option value="Approve" class="approve-option">Approve &#x2714;</option>
                        <option value="Reject" class="reject-option">Reject &#x2716;</option>
                        <option value="In Processing" class="processing-option">In Processing &#x231B;</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="submit-btn modern-btn">
                    <i class="fas fa-paper-plane"></i> Submit
                </button>
            </div>
        </form>
    </div>
</div>
<div id="viewWalkinModal" class="overlay-modal">
    <div class="modal-container">
        <div class="modal-top">
            <h2>View Walk-In Appointment</h2>
            <span class="modal-close">&times;</span>
        </div>
        <div class="modal-content">
            <div class="input-group">
                <label for="customer-id-input">Customer ID</label>
                <input type="text" id="customer-id-input" class="input-customer-id" name="customer_id" disabled>
            </div>
            <div class="input-group">
                <label for="status-dropdown">Status</label>
                <select id="status-dropdown" class="dropdown-status">
                    <option value="Approved">Approved</option>
                    <option value="Rejected">Rejected</option>
                    <option value="In Processing">In Processing</option>
                </select>
            </div>
        </div>
        <div class="modal-bottom">
            <button type="button" class="modal-close-button">Close</button>
        </div>
    </div>
</div>

<<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
document.getElementById('status-dropdown').addEventListener('change', function () {
    const selectedStatus = this.value;
    const customerIdInput = document.getElementById('customer-id');

    // Assuming you have the customer_id stored in a data attribute or available in your code
    const customerId = customerIdInput.value;

    // Perform an AJAX request to fetch the walk-in appointment details based on the customer_id and status
    fetch('fetch_walkin_appointments.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ customer_id: customerId, status: selectedStatus })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Populate the modal with the fetched data
            customerIdInput.value = data.customer_id;
            // Optionally update the dropdown if needed
            document.getElementById('status-dropdown').value = data.status;
        } else {
            alert('No data found for the selected status.');
        }
    })
    .catch(error => console.error('Error:', error));
});

</script>
</body>
</html>
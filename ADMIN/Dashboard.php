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
                    <li><a class="link_name" href="#">Plugins</a></li>
                    <li><a href="WalkinAppointments.php">UI Face</a></li>
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
    <a href="/REPAIRSHOP-LOCATOR-REVISE/LOGIN/Sign-in.php" class="logout-link">
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
        <h2>Pending Appointments</h2>
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

    </section>
    <div class="modal-overlay" id="modal-overlay" style="display: none;">
    <div class="modal">
        <div class="modal-header">
            <h2><i class="fas fa-info-circle"></i> Customer Details</h2>
            <button class="close-btn" id="close-btn"><i class="fas fa-times"></i></button>
        </div>
        <form id="appointment-form">
            <div class="modal-body">
                <!-- Display Customer Details -->
                <div class="form-group">
                    <label for="customer-id"><i class="fas fa-user"></i> Customer ID</label>
                    <input type="text" id="customer-id" name="customer-id" readonly>
                </div>
                <div class="form-group">
                    <label for="first-name"><i class="fas fa-user"></i> First Name</label>
                    <input type="text" id="first-name" name="first-name" readonly>
                </div>
                <div class="form-group">
                    <label for="repair-details"><i class="fas fa-tools"></i> Repair Details</label>
                    <textarea id="repair-details" name="repair-details" rows="4" readonly></textarea>
                </div>

                <!-- Dropdown for Status -->
                <div class="form-group">
                    <label for="status-dropdown"><i class="fas fa-exchange-alt"></i> Change Status</label>
                    <div class="custom-dropdown" id="status-dropdown">
                        <div class="selected-option">
                            <i class='bx bx-check icon'></i>
                            <span class="selected-text">Select Status</span>
                        </div>
                        <div class="options-container">
                            <div class="option" data-value="Approve">
                                <i class='bx bx-check icon'></i>
                                Approve
                            </div>
                            <div class="option" data-value="Reject">
                                <i class='bx bx-x icon'></i>
                                Reject
                            </div>
                            <div class="option" data-value="In Processing">
                                <i class='bx bx-hourglass icon'></i>
                                In Processing
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="submit-btn"><i class="fas fa-paper-plane"></i> Submit</button>
            </div>
        </form>
    </div>
</div>


    <script>
        document.querySelector(".selected-option").addEventListener("click", () => {
            const dropdown = document.querySelector(".custom-dropdown");
            const optionsContainer = dropdown.querySelector(".options-container");
            optionsContainer.classList.toggle("show");
        });

        // Handle option selection
        document.querySelectorAll(".options-container .option").forEach(option => {
            option.addEventListener("click", (e) => {
                const value = e.target.getAttribute("data-value");
                const icon = e.target.querySelector(".icon").classList;
                const selectedOption = document.querySelector(".selected-option");
                selectedOption.querySelector(".icon").className = icon;
                selectedOption.querySelector(".selected-text").textContent = e.target.textContent.trim();
                document.querySelector(".options-container").classList.remove("show");
            });
        });

        // Close modal on close button click
        document.getElementById("close-btn").addEventListener("click", () => {
            document.getElementById("modal-overlay").style.display = "none";
        });

        // Close modal on overlay click
        document.getElementById("modal-overlay").addEventListener("click", (e) => {
            if (e.target === document.getElementById("modal-overlay")) {
                document.getElementById("modal-overlay").style.display = "none";
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            // Function to fetch and display appointments
            function fetchAppointments() {
                $.ajax({
                    url: 'fetch_appointment_details.php', // URL to the PHP script
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        // Clear any existing rows
                        $('#appointments-tbody').empty();

                        // Check if there is data returned
                        if (data.length > 0) {
                            data.forEach(function(appointment) {
                                // Create a new row
                                var row = $('<tr>');

                                // Create cells for each field
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

                                // Create action button
                                var actionCell = $('<td>');
                                var viewButton = $('<button>')
                                    .addClass('view-btn')
                                    .text('View')
                                    .attr('data-id', appointment.customer_id);
                                actionCell.append(viewButton);
                                row.append(actionCell);

                                // Append the row to the tbody
                                $('#appointments-tbody').append(row);
                            });
                        } else {
                            // If no data, display a message or handle accordingly
                            $('#appointments-tbody').append($('<tr>').append($('<td colspan="12">').text('No pending appointments found.')));
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching data:', error);
                    }
                });
            }

            // Fetch and display appointments on page load
            fetchAppointments();

            // Additional JavaScript for modal functionality (if needed)
            $('#close-btn').on('click', function() {
                $('#modal-overlay').hide();
            });

            // Add click event for view buttons dynamically
            $('#appointments-tbody').on('click', '.view-btn', function() {
                var customerId = $(this).data('id');
                // You can load more details into the modal based on the customerId if needed
                $('#modal-overlay').show();
            });
        });
    </script>
   <script>
    // JavaScript for handling dropdown functionality
document.addEventListener('DOMContentLoaded', function () {
    // Handle dropdown toggle
    const statusDropdown = document.getElementById('status-dropdown');
    const selectedOption = statusDropdown.querySelector('.selected-option');
    const optionsContainer = statusDropdown.querySelector('.options-container');

    selectedOption.addEventListener('click', function () {
        optionsContainer.style.display = optionsContainer.style.display === 'block' ? 'none' : 'block';
    });

    // Handle option selection
    statusDropdown.querySelectorAll('.option').forEach(function (option) {
        option.addEventListener('click', function () {
            const selectedValue = this.getAttribute('data-value');
            selectedOption.querySelector('.selected-text').textContent = this.textContent;
            optionsContainer.style.display = 'none';
            // You can also do something with the selectedValue here, e.g., update the form
        });
    });

    // Close the dropdown if clicked outside
    document.addEventListener('click', function (event) {
        if (!statusDropdown.contains(event.target)) {
            optionsContainer.style.display = 'none';
        }
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
<script>
</script>


</body>
</html>
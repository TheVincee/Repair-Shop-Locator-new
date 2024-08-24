<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard with Sidebar and Modal</title>
    <link rel="stylesheet" href="Dashboard.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

        /* Modal styling */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }
        .modal {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            width: 400px;
            max-width: 100%;
            position: relative;
        }
        .modal h2 {
            margin-top: 0;
        }
        .modal form {
            display: flex;
            flex-direction: column;
        }
        .modal label {
            margin-bottom: 10px;
        }
        .modal select {
            margin-bottom: 20px;
            padding: 8px;
            font-size: 16px;
        }
        .modal .submit-btn, .modal .close-btn {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            margin-right: 10px;
        }
        .modal .submit-btn {
            background-color: #007bff;
            color: #fff;
        }
        .modal .submit-btn:hover {
            background-color: #0056b3;
        }
        .modal .close-btn {
            background-color: #ccc;
            color: #000;
        }
        .modal .close-btn:hover {
            background-color: #999;
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
                    <li><a class="link_name" href="#">Category</a></li>
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
                    <i class='bx bx-log-out'></i>
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

        <!-- Pending Appointments Section -->
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
                <tbody>
                    <tr>
                        <td>C001</td>
                        <td>John</td>
                        <td class="hide">Doe</td>
                        <td>123-456-7890</td>
                        <td class="hide">john.doe@example.com</td>
                        <td class="hide">Toyota</td>
                        <td class="hide">Camry</td>
                        <td>Engine Repair</td>
                        <td>10:00 AM</td>
                        <td>2024-08-21</td>
                        <td>Pending</td>
                        <td><button class="view-btn" data-id="C001">View</button></td>
                    </tr>
                    <tr>
                        <td>C002</td>
                        <td>Jane</td>
                        <td class="hide">Smith</td>
                        <td>987-654-3210</td>
                        <td class="hide">jane.smith@example.com</td>
                        <td class="hide">Honda</td>
                        <td class="hide">Civic</td>
                        <td>Brake Replacement</td>
                        <td>11:30 AM</td>
                        <td>2024-08-22</td>
                        <td>Pending</td>
                        <td><button class="view-btn" data-id="C002">View</button></td>
                    </tr>
                    <!-- Add more rows as needed -->
                </tbody>
            </table>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal-overlay" id="modal-overlay">
        <div class="modal">
            <h2>Appointment Details</h2>
            <form id="appointment-form">
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
                <button type="submit" class="submit-btn">Submit</button>
                <button type="button" class="close-btn" id="close-btn">Close</button>
            </form>
        </div>
    </div>


    <script>
        // Toggle sidebar
        document.getElementById("hamburgerMenu").addEventListener("click", () => {
            document.querySelector(".sidebar").classList.toggle("close");
        });

        // Toggle submenu
        document.querySelectorAll(".arrow").forEach(arrow => {
            arrow.addEventListener("click", () => {
                const submenu = arrow.parentElement.nextElementSibling;
                submenu.classList.toggle("show");
            });
        });

        // Show modal on button click
        document.querySelectorAll(".view-btn").forEach(button => {
            button.addEventListener("click", (e) => {
                const appointmentId = e.target.getAttribute("data-id");
                // Here, you can fetch and display specific details based on the appointmentId
                document.getElementById("modal-overlay").style.display = "flex";
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
</body>
</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Walk-In Appointments</title>
    <link rel="stylesheet" href="Inprocessing.css">
    <style>
        /* General Styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 20px;
        }

        /* Back Button Styling */
        .back-button {
            display: inline-block;
            margin-bottom: 20px;
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 18px;
            font-weight: bold;
            text-decoration: none;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .back-button:hover {
            background-color: #388E3C;
            transform: scale(1.05);
        }

        .back-button i {
            margin-right: 8px;
        }

        /* Styling for Walk-In Appointments Section */
        .walkin-appointments {
            margin: 20px;
        }

        .walkin-appointments h2 {
            font-size: 26px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #333;
        }

        /* Styling for Walk-In Appointments Table */
        .walkin-appointments-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 18px;
            text-align: left;
            border: 2px solid #ddd;
        }

        .walkin-appointments-table th,
        .walkin-appointments-table td {
            padding: 16px;
            border-bottom: 2px solid #ddd;
            font-weight: bold;
        }

        .walkin-appointments-table th {
            background-color: #e0e0e0;
            color: #333;
            font-size: 18px;
        }

        .walkin-appointments-table tr:hover {
            background-color: #f1f1f1;
            transform: translateY(-2px);
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.15);
        }

        .walkin-appointments-table .view-btn {
            padding: 10px 20px;
            border: 2px solid #007bff;
            color: #007bff;
            cursor: pointer;
            border-radius: 6px;
            font-size: 16px;
            background-color: #ffffff;
            transition: background-color 0.3s, color 0.3s, border-color 0.3s;
        }

        .walkin-appointments-table .view-btn:hover {
            background-color: #007bff;
            color: #ffffff;
            border-color: #0056b3;
        }

        .walkin-appointments-table .hide {
            display: none;
        }

        /* Modal Styling */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 30px;
            border: 2px solid #888;
            width: 80%;
            border-radius: 10px;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.3);
            font-size: 18px;
            font-weight: bold;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 30px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <!-- Back Button -->
    <a href="Dashboard.php" class="back-button"><i>&larr;</i> Back</a>

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
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="walkin-appointments-tbody">
                <!-- Rows will be inserted here by JavaScript -->
            </tbody>
        </table>
    </div>

    <!-- View Modal -->
    <div id="viewModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('viewModal')">&times;</span>
            <h2>View Appointment Details</h2>
            <p>Details about the appointment will go here.</p>
        </div>
    </div>

    <!-- Update Modal -->
    <div id="updateModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('updateModal')">&times;</span>
            <h2>Update Appointment Details</h2>
            <p>Form to update the appointment will go here.</p>
        </div>
    </div>

    <script>
        function openModal(modalId) {
            document.getElementById(modalId).style.display = "block";
        }

        function closeModal(modalId) {
            document.getElementById(modalId).style.display = "none";
        }

        // Example usage: 
        // openModal('viewModal');
        // openModal('updateModal');
    </script>
</body>

</html>

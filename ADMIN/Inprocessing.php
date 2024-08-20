<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Processing Appointments</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
            padding: 20px;
        }
        .table-container {
            background-color: #ffffff;
            padding: 50px;
            border-radius: 25px;
            box-shadow: 0px 10px 25px rgba(0, 0, 0, 0.15);
            margin-bottom: 20px;
        }
        .back-button {
            display: inline-block;
            margin-bottom: 20px;
            font-weight: bold;
            color: #007bff;
            text-decoration: none;
        }
        .back-button i {
            margin-right: 5px;
        }
        .grid-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 25px;
        }
        .grid-item {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 25px;
            box-shadow: 0px 10px 25px rgba(0, 0, 0, 0.15);
        }
        .grid-item h5 {
            margin-bottom: 15px;
            font-weight: bold;
            color: #333333;
        }
        .grid-item p {
            margin-bottom: 10px;
            color: #555555;
            font-weight: 500;
        }
        .grid-item .btn-delete {
            font-weight: bold;
            color: #ffffff;
            background-color: #dc3545;
            margin-right: 10px;
        }
        .grid-item .btn-update {
            font-weight: bold;
            color: #ffffff;
            background-color: #ffc107;
        }
    </style>
</head>
<body>

<div class="container">
    <a href="Dashboard.php" class="back-button"><i class="fas fa-arrow-left"></i> Back to Previous Page</a>
    <div class="table-container">
        <h2 class="mb-4 text-center">Processing Appointments</h2>
        <div class="grid-container">
            <div class="grid-item">
                <h5>Customer ID: 31</h5>
                <p><strong>First Name:</strong> John</p>
                <p><strong>Phone Number:</strong> 23123</p>
                <p><strong>Email Address:</strong> john@gmail.com</p>
                <p><strong>Repair Details:</strong> Tire Replacement</p>
                <p><strong>Appointment Time:</strong> 21:32:00</p>
                <p><strong>Appointment Date:</strong> 2024-07-27</p>
                <p><strong>Status:</strong> Processing</p>
                <div>
                    <button type="button" class="btn btn-delete btn-sm">Delete</button>
                    <button type="button" class="btn btn-update btn-sm">Update</button>
                </div>
            </div>
            <!-- Add more grid items as needed -->
        </div>
    </div>
</div>

<!-- Bootstrap JS (Optional, for interactive elements like dropdowns) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>

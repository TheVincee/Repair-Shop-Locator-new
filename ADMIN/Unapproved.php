<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unapproved Management</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        /* Custom CSS */
        .container {
            margin-top: 20px;
        }
        .back-button {
            margin-bottom: 20px;
        }
        .table {
            border-collapse: separate;
            border-spacing: 0;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Enhanced shadow */
            border: 2px solid #dc3545; /* Thicker border */
        }
        .table thead th {
            background-color: #dc3545; /* Bootstrap danger color */
            color: #ffffff;
            font-weight: bold;
            border-bottom: 2px solid #dc3545; /* Thicker border for header */
        }
        .table tbody tr {
            background-color: #f8f9fa; /* Off-white color */
        }
        .table tbody tr:nth-child(even) {
            background-color: #e9ecef; /* Slightly darker off-white for alternating rows */
        }
        .table th, .table td {
            text-align: center;
            vertical-align: middle;
            border: 1px solid #dc3545; /* Thicker border for table cells */
        }
        .table .status-icon {
            color: #dc3545; /* Danger color */
            font-size: 1.2rem;
        }
        .img-thumbnail {
            max-width: 80px; /* Adjust size */
            height: auto;
        }
        .modal-content {
            border-radius: 15px;
        }
        .modal-header {
            background-color: #dc3545; /* Bootstrap danger color */
            color: #ffffff;
            border-bottom: none;
        }
        .modal-body {
            padding: 2rem;
        }
        .btn-primary {
            background-color: #dc3545; /* Danger color */
            border-color: #dc3545;
        }
        .btn-primary:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }
        .btn-secondary {
            border-radius: 0.375rem;
        }
        .btn-info, .btn-danger {
            border-radius: 0.375rem;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .card-body {
            padding: 1.5rem;
        }
    </style>
</head>
<body>
    
    <div class="container">
        <!-- Back Button -->
        <div class="back-button">
            <a href="Dashboard.php" class="btn btn-secondary">Back to Dashboard</a>
        </div>

        <!-- Unapproved Table -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-4">Unapproved List</h5>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Project Name</th>
                            <th>Client</th>
                            <th>Deadline</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Website Redesign</td>
                            <td>Acme Corp</td>
                            <td>2024-08-20</td>
                            <td><span class="status-icon">&#10060;</span> Unapproved</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Mobile App</td>
                            <td>Beta Ltd.</td>
                            <td>2024-09-10</td>
                            <td><span class="status-icon">&#10060;</span> Unapproved</td>
                        </tr>
                        <!-- More rows as needed -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

   
    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

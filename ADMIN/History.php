<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enhanced Task Management</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        /* Custom CSS for Enhanced Design */
        .table {
            margin-top: 20px; /* Space above the table */
            border-radius: 0.75rem; /* More rounded corners */
            overflow: hidden; /* Ensure rounded corners apply to content */
            box-shadow: 0 6px 12px rgba(0,0,0,0.15); /* Deeper shadow for modern look */
        }
        
        .table thead th {
            text-align: center; /* Center align text */
            padding: 1rem; /* Padding for header */
            font-weight: bold; /* Bold text */
        }
        .table tbody tr {
            transition: background-color 0.3s, transform 0.3s; /* Smooth transitions */
        }
        .table tbody tr:hover {
            background-color: #f1f1f1; /* Light grey for hover effect */
            transform: scale(1.02); /* Slight zoom on hover */
        }
        .table tbody tr.success {
            background-color: #28a745; /* Success color */
        }
        .table tbody tr.danger {
            background-color: #f8d7da; /* Danger color */
        }
        .table tbody tr.warning {
            background-color: #fff3cd; /* Warning color */
        }
        .table td, .table th {
            vertical-align: middle; /* Center align text vertically */
            padding: 1rem; /* Padding for better spacing */
            text-align: center; /* Center align text */
        }
        .status-icon {
            font-size: 1.25rem; /* Larger icons for better visibility */
            vertical-align: middle; /* Align icons with text */
        }
        .status-text {
            font-weight: 500; /* Semi-bold text */
            font-size: 1rem; /* Standard text size */
            vertical-align: middle; /* Align text with icons */
            margin-left: 0.5rem; /* Space between icon and text */
        }
        .success .status-icon {
            color: #28a745; /* Green color for success */
        }
        .danger .status-icon {
            color: #dc3545; /* Red color for danger */
        }
        .warning .status-icon {
            color: #ffc107; /* Yellow color for warning */
        }
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .table td, .table th {
                padding: 0.75rem; /* Smaller padding on smaller screens */
            }
            .status-icon {
                font-size: 1.1rem; /* Slightly smaller icons on small screens */
            }
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <!-- Back Button -->
        <div class="mb-4">
            <a href="Dashboard.php" class="btn btn-primary">
                <i class=""></i> Back to Dashboard
            </a>
        </div>

        <h1 class="mb-4">History</h1>

        <!-- Table with Custom Header and Enhanced Rows -->
        <table class="table table-striped">
            <thead class="bg-success text-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">First</th>
                    <th scope="col">Last</th>
                    <th scope="col">Handle</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                <tr class="success">
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                    <td><i class="bi bi-check-circle status-icon"></i><span class="status-text">Approved</span></td>
                </tr>
                <tr class="danger">
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>@fat</td>
                    <td><i class="bi bi-x-circle status-icon"></i><span class="status-text">Rejected</span></td>
                </tr>
                <tr class="warning">
                    <th scope="row">3</th>
                    <td>Larry</td>
                    <td>the Bird</td>
                    <td>@twitter</td>
                    <td><i class="bi bi-exclamation-circle status-icon"></i><span class="status-text">In Progress</span></td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

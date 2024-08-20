<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        /* Custom CSS */
        .container {
            margin-top: 20px;
        }
        .back-button {
            margin-bottom: 20px;
        }
        .table thead th {
            background-color: #0d6efd; /* Bootstrap primary color */
            color: #ffffff;
        }
        .table tbody tr {
            background-color: #f8f9fa; /* Off-white color */
        }
        .table tbody tr:nth-child(even) {
            background-color: #e9ecef; /* Slightly darker off-white for alternating rows */
        }
        .table th, .table td {
            text-align: center;
        }
        .img-thumbnail {
            max-width: 100px;
            height: auto;
        }
    </style>
</head>
<body>
    
    <div class="container">
        <!-- Back Button -->
        <div class="back-button">
            <a href="Dashboard.php" class="btn btn-secondary">Back to Dashboard</a>
        </div>

        <!-- Header -->
        <h1 class="mb-4">Employee Management</h1>

        <!-- Add Employee Button -->
        <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#addEmployeeModal">
            Add New Employee
        </button>

        <!-- Employee Table -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Employee List</h5>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Photo</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Position</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td><img src="path/to/photo.jpg" alt="John Doe" class="img-thumbnail"></td>
                            <td>John Doe</td>
                            <td>john.doe@example.com</td>
                            <td>Software Engineer</td>
                            <td>
                                <button class="btn btn-info btn-sm">Edit</button>
                                <button class="btn btn-danger btn-sm">Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td><img src="path/to/photo.jpg" alt="Jane Smith" class="img-thumbnail"></td>
                            <td>Jane Smith</td>
                            <td>jane.smith@example.com</td>
                            <td>Project Manager</td>
                            <td>
                                <button class="btn btn-info btn-sm">Edit</button>
                                <button class="btn btn-danger btn-sm">Delete</button>
                            </td>
                        </tr>
                        <!-- More rows as needed -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal for Add Employee -->
    <div class="modal fade" id="addEmployeeModal" tabindex="-1" aria-labelledby="addEmployeeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addEmployeeModalLabel">Add New Employee</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="your-server-endpoint" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="employeePhoto" class="form-label">Employee Photo</label>
                            <input type="file" class="form-control" id="employeePhoto" name="employeePhoto" accept="image/*" required>
                        </div>
                        <div class="mb-3">
                            <label for="employeeName" class="form-label">Employee Name</label>
                            <input type="text" class="form-control" id="employeeName" name="employeeName" required>
                        </div>
                        <div class="mb-3">
                            <label for="employeeEmail" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="employeeEmail" name="employeeEmail" required>
                        </div>
                        <div class="mb-3">
                            <label for="employeePosition" class="form-label">Position</label>
                            <input type="text" class="form-control" id="employeePosition" name="employeePosition" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Employee</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

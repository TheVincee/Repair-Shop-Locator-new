<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications</title>
    <!-- Add Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .toast {
            max-width: 700px; /* Increase the max width */
            font-size: 1.25rem; /* Increase the font size */
        }
    </style>
</head>
<body>
<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-body">
            Your changes have been successfully saved!
            <div class="mt-2 pt-2 border-top">
                <a href="Dashboard.php" class="btn btn-primary btn-sm">Go to Dashboard</a>
                <a href="#" class="btn btn-secondary btn-sm" data-bs-dismiss="toast">Close</a>
            </div>
        </div>
    </div>
</div>

<!-- Add Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

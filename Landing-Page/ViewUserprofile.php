<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <!-- Add Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-4">
        <div class="card mx-auto form-container">
            <div class="card-header text-center">
                <h5>User Profile</h5>
            </div>
            <div class="card-body">
                <div id="profileData" class="row g-2">
                    <div class="col-md-12">
                        <label class="form-label">Email</label>
                        <p id="email" class="form-control-plaintext"></p>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Address</label>
                        <p id="address" class="form-control-plaintext"></p>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Address 2</label>
                        <p id="address2" class="form-control-plaintext"></p>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">City</label>
                        <p id="city" class="form-control-plaintext"></p>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">State</label>
                        <p id="state" class="form-control-plaintext"></p>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Zip</label>
                        <p id="zip" class="form-control-plaintext"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Add Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $.ajax({
                url: 'fetch_profile.php',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (!response.error) {
                        $('#email').text(response.email);
                        $('#address').text(response.address);
                        $('#address2').text(response.address2);
                        $('#city').text(response.city);
                        $('#state').text(response.state);
                        $('#zip').text(response.zip);
                    } else {
                        alert(response.error);
                    }
                },
                error: function() {
                    alert('An error occurred while fetching the profile data.');
                }
            });
        });
    </script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <!-- Add Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .profile-picture {
            width: 120px;
            height: 120px;
        }
    </style>
</head>
<body>
<div class="container my-4">
    <div class="card mx-auto form-container">
        <div class="card-header text-center">
            <h5>User Profile</h5>
        </div>
        <div class="card-body">
            <form id="profileForm" class="row g-2">
                <div class="text-center mb-3">
                    <img id="profilePicture" src="https://via.placeholder.com/100" class="img-thumbnail profile-picture" alt="Profile Picture" style="cursor: pointer;">
                    <input type="file" id="uploadProfilePicture" name="profilePicture" class="d-none">
                </div>
                <div class="col-md-12">
                    <label for="inputEmail4" class="form-label">Email</label>
                    <input type="email" class="form-control" id="inputEmail4" name="email">
                </div>
                <div class="col-md-12">
                    <label for="inputPassword4" class="form-label">Password</label>
                    <input type="password" class="form-control" id="inputPassword4" name="password">
                </div>
                <div class="col-12">
                    <label for="inputAddress" class="form-label">Address</label>
                    <input type="text" class="form-control" id="inputAddress" name="address" placeholder="1234 Main St">
                </div>
                <div class="col-12">
                    <label for="inputAddress2" class="form-label">Address 2</label>
                    <input type="text" class="form-control" id="inputAddress2" name="address2" placeholder="Apartment, studio, or floor">
                </div>
                <div class="col-md-6">
                    <label for="inputCity" class="form-label">City</label>
                    <input type="text" class="form-control" id="inputCity" name="city">
                </div>
                <div class="col-md-4">
                    <label for="inputState" class="form-label">State</label>
                    <select id="inputState" class="form-select" name="state">
                        <option selected>Choose...</option>
                        <option>Ki=</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="inputZip" class="form-label">Zip</label>
                    <input type="text" class="form-control" id="inputZip" name="zip">
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-secondary">Back</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Add Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Add event listener to the profile picture
    $('#profilePicture').on('click', function() {
        $('#uploadProfilePicture').click();
    });

    // Change profile picture when a new file is selected
    $('#uploadProfilePicture').on('change', function(event) {
        if (event.target.files && event.target.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#profilePicture').attr('src', e.target.result);
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    });

    // Handle form submission with AJAX
    $('#profileForm').on('submit', function(event) {
        event.preventDefault(); // Prevent the default form submission

        var formData = new FormData(this);

        $.ajax({
            url: 'upload_profile.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                var res = JSON.parse(response);
                alert(res.message);
            },
            error: function() {
                alert('An error occurred!');
            }
        });
    });
</script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Details Form in Modal - Car Repair Shop</title>
    <!-- Link Bootstrap CSS from CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

<!-- Button to trigger the modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Add Customer Details
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Customer Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="customerForm">
          <div class="row mb-3">
            <div class="col">
              <label for="firstNameModal" class="form-label">First Name</label>
              <input type="text" class="form-control" id="firstNameModal" name="firstName" placeholder="Enter first name" required>
            </div>
            <div class="col">
              <label for="lastNameModal" class="form-label">Last Name</label>
              <input type="text" class="form-control" id="lastNameModal" name="lastName" placeholder="Enter last name" required>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col">
              <label for="phoneModal" class="form-label">Phone Number</label>
              <input type="tel" class="form-control" id="phoneModal" name="phoneNumber" placeholder="Enter phone number" required>
            </div>
            <div class="col">
              <label for="emailModal" class="form-label">Email Address</label>
              <input type="email" class="form-control" id="emailModal" name="emailAddress" placeholder="Enter email address" required>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col">
              <label for="carMakeModal" class="form-label">Car Make</label>
              <input type="text" class="form-control" id="carMakeModal" name="carMake" placeholder="Enter car make" required>
            </div>
            <div class="col">
              <label for="carModelModal" class="form-label">Car Model</label>
              <input type="text" class="form-control" id="carModelModal" name="carModel" placeholder="Enter car model" required>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col">
              <label for="repairDetailsModal" class="form-label">Repair Details</label>
              <textarea class="form-control" id="repairDetailsModal" name="repairDetails" rows="3" placeholder="Describe repair details"></textarea>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col">
              <label for="appointmentDateModal" class="form-label">Appointment Date</label>
              <input type="date" class="form-control" id="appointmentDateModal" name="appointmentDate" required>
            </div>
            <div class="col">
              <label for="appointmentTimeModal" class="form-label">Appointment Time</label>
              <input type="time" class="form-control" id="appointmentTimeModal" name="appointmentTime" required>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="saveCustomerDetails">Save Customer Details</button>
      </div>
    </div>
  </div>
</div>

<!-- Link Bootstrap JS bundle from CDN (needed for modal functionality) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<!-- Your custom script for handling form submission via AJAX -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('saveCustomerDetails').addEventListener('click', function () {
            var form = document.getElementById('customerForm');
            var formData = new FormData(form);

            fetch('insert.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                console.log(data); // Optional: Log the response data
                $('#exampleModal').modal('hide'); // Hide the modal
                form.reset(); // Reset the form
                // Optionally update the table or show a success message
            })
            .catch(error => {
                console.error('Error:', error);
                // Optionally show an error message to the user
            });
        });
    });
</script>

</body>
</html>

<div class="modal fade" id="addModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Employee</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="employeeForm">
            <div class="form-group mb-3">
                <label for="fname">First Name</label>
                <input type="text" class="form-control" name="fname" id="fname">
                <small class="text-danger" id="fnameError"></small>
            </div>
            <div class="form-group mb-3">
                <label for="lname">Last Name</label>
                <input type="text" class="form-control" name="lname" id="lname">
                <small class="text-danger" id="lnameError"></small>
            </div>
            <div class="form-group mb-3">
                <label for="phone">Phone Number</label>
                <input type="text" class="form-control" name="phone" id="phone">
                <small class="text-danger" id="phoneError"></small>
            </div>
            <div class="form-group mb-3">
                <label for="email">Email</label>
                <input type="text" class="form-control" name="email" id="email">
                <small class="text-danger" id="emailError"></small>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    $('#employeeForm').submit(function(event) {
        event.preventDefault(); // Prevent default form submission

        $.ajax({
            url: "<?php echo base_url('employee/store'); ?>",
            method: "POST",
            data: $(this).serialize(),
            dataType: "json",
            success: function(response) {
                console.log(response); // Debugging: Check if errors are received

                // Clear previous error messages
                $('#fnameError').text('');
                $('#lnameError').text('');
                $('#phoneError').text('');
                $('#emailError').text('');

                if (response.status === 'error') {
                    // Display validation errors
                    $('#fnameError').text(response.errors.fname || '');
                    $('#lnameError').text(response.errors.lname || '');
                    $('#phoneError').text(response.errors.phone || '');
                    $('#emailError').text(response.errors.email || '');
                } else if (response.status === 'success') {
                    // Redirect if validation passes
                    window.location.href = "<?php echo base_url('employee'); ?>";
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', error); // Log error if AJAX request fails
            }
        });
    });
});
</script>

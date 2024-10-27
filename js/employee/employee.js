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
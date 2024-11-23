$(document).ready(function () {
    $('#myform').submit(function (event) {
        // Prevent default form submission
        event.preventDefault();


        // Reference to the form
        var form = $(this);
        // show error-msg only onece time
        form.find('.error-msg').remove();

      
        $.ajax({
            type: "POST",
            url: "send_email.php",
            data: form.serialize(),
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    // Display success alert using Sweet alert
                    swal({
                        title: "Message Sent!",
                        text: "Thank you for reaching out! We'll get back to you soon.",
                        icon: "success"
                    });
                    // Reset the form
                    form.trigger('reset');
                } else {
                    // Loop through error messages and display them below corresponding input fields
                    $.each(response.error, function (key, value) {
                        // Find the input field corresponding to the error
                        var inputField = form.find('[name="' + key + '"]');
                        // Display the error message below the input field
                        inputField.after('<div class="error-msg">' + value + '</div>');
                    });
                }
            },
            error: function () {
                swal({
                    title: "Oops!",
                    text: "Something went wrong. Please try again later.",
                    icon: "error",
                  });
                
            }
        });
    });
});

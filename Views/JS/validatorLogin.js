$(function() {
    $("#formLog").validate({

        rules: {
            username: "required",
            password: "required",
            password:{
                required: true,
                maxlength: 8
            }
        },
        messages: {
            username: "Please enter your username",
            password: {
                required: "Please provide your password",
            }
        },
        errorClass: "errorMessage",
        function(form) {
            form.submit();
        }
        });
});
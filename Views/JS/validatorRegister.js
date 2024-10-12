function validarCorreo(correo) {

    var formatoCorreo = /\b[A-Z0-9._%+-]+@gmail\.com\b/i;
    return formatoCorreo.test(correo);
}

$(function() {
    $("#formReg").validate({

        rules: {
            mail: "required",
            mail: {
                required: true,
                email: validarCorreo("#mail")
            },
            username: "required",
            password1:{
                required: true,
                maxlength: 50
            },
            password1: "required",
            password2: "required",
            password1:{
                required: true,
                maxlength: 8
            },
            password2:{
                required: true,
                maxlength: 8
            }
        },
        messages: {
            mail: {
                required: "Please enter your email",
                email: "Please enter a valid email address"
            },
            username: {
                required: "Please enter an username",
                maxlength: "The password can't be more than 50 characters"
            },
            password1: {
                required: "Please provide your password",
                maxlength: "The password can't be more than 8 characters"
            },
            password2: {
                required: "Please provide your password",
                maxlength: "The password can't be more than 8 characters"
            }
        },
        errorClass: "errorMessage",
        function(form) {
            form.submit();
        }
        });
});

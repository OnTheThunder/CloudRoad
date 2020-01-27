window.onload = function () {
    $(document).ready(function () {

        /**
         *  Que coincidan las contraseñas
         */
        $('#contra1, #contra2').on('keyup', function () {
            if ($('#contra1').val() == $('#contra2').val()) {
                $('#message').html('Coinciden').addClass('text-success').removeClass('text-danger');
                $('#changepassword').removeClass('disabled');
            } else
                $('#message').html('No coinciden').addClass('text-danger').removeClass('text-success');
        });
    });
};

window.onload = function () {
    $(document).ready(function () {

        $('#imagen').append('<img src="../img/logout.gif" >')

        setTimeout(function(){
            window.location.href = '/';
        }, 3100);

    });
};

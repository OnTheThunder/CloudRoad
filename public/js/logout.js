window.onload = function () {
    $(document).ready(function () {
        //poner la imagen
        $('#imagen').append('<img src="../images/logout.gif"  alt="logout">');
        //simular cerrar sesion y cambiar de pantalla
        setTimeout(function () {
            window.location.href = '/';
        }, 1);
    });
};

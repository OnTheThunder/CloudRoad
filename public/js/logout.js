window.onload = function () {
    $(document).ready(function () {
        //poner la imagen
        $('#imagen').append('<img src="../img/logout.gif"  alt="logout">');
        //simular cerrar sesion y cambiar de pantalla
        setTimeout(function () {
            window.location.href = '/';
        }, 3010);
    });
};

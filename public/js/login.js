window.onload = function () {
    $('#login-main-container').css('display', 'none');
    //Una vez cargada la pagina quitamos el overlay para mostrarla
    $('#loadOverlay').css('display', 'none');
    $('#login-main-container').fadeIn(300);

    $('#laptop').on('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend',
    function(){
        $(this).css('animation', 'none');
    });
    $('#first-quote').on('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend',
    function(){
        $(this).css('animation', 'none');
    });
};

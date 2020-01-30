window.onload = function () {
    $(document).ready(function () {

        /**
         * Si se hace scroll que aparezca el boton de ir arriba de la pagina
         */
        $(window).scroll(function () {
            // si es pantalla md o menos, que no salga
            if ($(window).width() > 768) {
                if ($(this).scrollTop() > 100) {
                    $('a.scroll-top').fadeIn('slow').removeClass('d-none');
                    //$('a.scroll-top').removeClass('d-none');
                } else {
                    $('a.scroll-top').fadeOut('slow').addClass('d-none');
                }
            } else if (!$('a.scroll-top').hasClass('d-none')) {
                // ponerle en d-none al ser pantalla chiquita
                $('a.scroll-top').addClass('d-none');
            }
        });

        /**
         * Animacion de ir arriba
         */
        $('a.scroll-top').click(function (event) {
            $('body').animate({scrollTop: 0}, 'swing');
        });
    });
};

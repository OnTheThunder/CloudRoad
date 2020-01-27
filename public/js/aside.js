window.onload = function () {
    $(document).ready(function () {

        $(window).scroll(function () {
            if ($(this).scrollTop() > 100) {
                $('a.scroll-top').fadeIn('slow').removeClass('d-none');
                //$('a.scroll-top').removeClass('d-none');
            } else {
                $('a.scroll-top').fadeOut('slow').addClass('d-none');
            }
        });

        $('a.scroll-top').click(function (event) {
            event.preventDefault();
            $('html, body').animate({scrollTop: 0}, 600);
        });
    });
};

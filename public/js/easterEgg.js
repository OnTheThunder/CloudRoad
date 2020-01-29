$(document).ready(function () {

    let ultimas7Letras = [];
    let trucos = [
        //Trucos de dinero
        "HESOYAM",
        //Invencibilidad
        "BAGUVIX"
    ];
    $('html').bind('keypress', function (e) {

        //comprobar si el array esta lleno
        if (ultimas7Letras.length < 7) {
            // si no lo está añadirle al array de letras
            ultimas7Letras.push(e.key);
        } else {
            // si lo está, quitar la primera letra y añadirle al final la nueva
            ultimas7Letras.shift();
            ultimas7Letras.push(e.key);
        }
        // comprobar si coincide con alguno de los trucos
        trucos.forEach(function (e) {
            let palabra = "";
            ultimas7Letras.forEach(function (value) {
                palabra += value;
            });
            if (e.toLowerCase() === palabra.toLowerCase()) {
                $('.truco').css('display', 'block').css('opacity', '1').animate({
                    opacity: 0
                }, 3500, function () {
                    // Animation complete.
                });
            }
        });
    });
});

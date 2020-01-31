/**
 * Html elements que contienen los links de los css diurno y nocturno
 */
let light: any = document.getElementById('light-css');
let dark: any = document.getElementById('dark-css');

// comprobar si existe o no la cookie, y poner su modo
if (checkCookie()) {
    ver(true);
} else {
    setCookie('modo', 'nocturno', 7); // diurno o nocturno
    ver(true);
}

// listener del boton de cambiar el modo
try {
    // @ts-ignore
    document.getElementById('modo-nocturno-diurno').addEventListener('click', function () {
        ver(false);
        location.reload();
    });
} catch (e) {
    console.log('en login no hace falta');
}


function ver(opcional: boolean) {
    // cambiar el valor de la cookie a nocturno/diurno
    let c: string = getCookie('modo');
    if (c != null && c != "") {
        if (c === "diurno") {
            // cambiar link del css
            light.disabled = true;
            dark.disabled = false;
            if (!opcional) {
                console.log('nocturno')

                setCookie('modo', 'nocturno', 7);
            }
        } else {
            light.disabled = false;
            dark.disabled = true;
            if (!opcional) {
                console.log('diurno')

                setCookie('modo', 'diurno', 7);
            }
        }
    }
}

/**
 * Crear la cookie
 * @param nombreCookie
 * @param valorCookie
 * @param diasDeVida
 */
function setCookie(nombreCookie: string, valorCookie: string, diasDeVida: number) {
    var d = new Date();
    d.setTime(d.getTime() + (diasDeVida * 24 * 60 * 60 * 1000));
    var expires = "expires=" + d.toUTCString();
    document.cookie = nombreCookie + "=" + valorCookie + ";" + expires + ";path=/";
}

/**
 * Devuelve un string
 * @param nombreCookie
 */
function getCookie(nombreCookie: string) {
    var name = nombreCookie + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

/**
 * Comprueba si la cookie ya tiene valor o no
 * @return boolean
 */
function checkCookie() {
    var username = getCookie("modo");
    return username !== "";
}

var lasCookies = document.cookie.split(';');

let light = document.getElementById('light-css');
let dark = document.getElementById('dark-css');

if (checkCookie()) {
    ver(true);
} else {
    setCookie('modo', 'nocturno', 7) // diurno o nocturno
}

try {
    document.getElementById('modo-nocturno-diurno').addEventListener('click', function () {
        ver(false);
        location.reload();
    });
} catch (e) {
    console.log('en login no hace falta');
}


function ver(opcional) {
    // cambiar el valor de la cookie a nocturno/diurno
    let c = getCookie('modo');
    if (c != null && c != "") {
        if (c === "diurno") {
            // cambiar link del css
            light.disabled = true;
            dark.disabled = false;
            if (!opcional) {
                setCookie('modo', 'nocturno', 7);
            }
        } else {
            light.disabled = false;
            dark.disabled = true;
            if (!opcional) {
                setCookie('modo', 'diurno', 7);
            }
        }
    }
}

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    var name = cname + "=";
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

function checkCookie() {
    var username = getCookie("modo");
    return username !== "";
}

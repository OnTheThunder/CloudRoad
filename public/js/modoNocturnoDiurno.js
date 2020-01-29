var lasCookies = document.cookie.split(';');

let light = document.getElementById('light-css');
let dark = document.getElementById('dark-css');

if (checkCookie()) {
    console.log('existe')
    ver(true);
} else {
    console.log('no eitste')
    setCookie('modo', 'diurno', 10000) // diurno o nocturno
}


document.getElementById('modo-nocturno-diurno').addEventListener('click', function () {
    ver(false);
    location.reload();
});

function ver(opcional) {
    console.log('ver')
    // cambiar el valor de la cookie a nocturno/diurno
    let c = getCookie('modo');
    if (c != null && c != "") {
        if (c === "diurno") {
            // cambiar link del css
            light.disabled = true;
            dark.disabled = false;
            if (!opcional) {
                setCookie('modo', 'nocturno', 10000);
            }
        } else {
            light.disabled = false;
            dark.disabled = true;
            if (!opcional) {
                setCookie('modo', 'diurno', 10000);
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
    if (username != "") {
        return true
    } else {
        return false;
    }
}

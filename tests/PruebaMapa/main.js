//Variables globales
let tiempoAlTallerMasCercano;
let kmAlTallerMasCercano;
let numeroTallerMasCercano = -1;
let contadorTalleres = 0;
let marker;
let renderFastestRoute;
let map;
let objetoResponse;

//Variables globales de prueba
let vitoria;
let bilbao;
let donosti;

//Inicializar mapa
function initMap() {
    let searchBox = new google.maps.places.SearchBox(document.getElementById("mapsearch"));
    let defaultLatLng = {lat: 42.842326386012516, lng: -2.691612846296414}; //Punto en el que está centrado el mapa por defecto
    let directionsService = new google.maps.DirectionsService();
    let directionsRenderer = new google.maps.DirectionsRenderer();
    vitoria = new google.maps.LatLng(42.842326386012516, -2.691612846296414); //Ubicación taller de prueba
    bilbao = new google.maps.LatLng(43.24478743516591, -2.927818900983914); //Ubicación taller de prueba
    donosti = new google.maps.LatLng(43.3019993718923, -1.969261772077664); //Ubicación taller de prueba

    //Crea el mapa
    map = new google.maps.Map(document.getElementById('map'), {
        zoom: 9,
        center: defaultLatLng
    });


    //RUTAS POR CLICK
    google.maps.event.addDomListener(map, 'click', function( event ){

        document.getElementById("mapsearch").value = "";

        let lugarIncidencia = {lat: event.latLng.lat(), lng: event.latLng.lng()};

        //Eliminar el render de la anterior ruta
        deleteRouteRender();

        //createMarker(lugarIncidencia);

        //Select talleres a base de datos
        let talleres = getTalleres();

        //Resetear los calculos de las rutas
        resetRouteValues();

        //Iterar a traves de los talleres para obtener el más cercano a la incidencia
        iterateTalleresRoutes(talleres, lugarIncidencia, directionsService, directionsRenderer);

        //deletePreviousMarker();
        //getLatLngOnClick(lugarIncidencia);
    });

    //RUTAS POR BUSQUEDAS
    google.maps.event.addDomListener(searchBox, 'places_changed', function () {

        //Eliminar el render de la anterior ruta
        deleteRouteRender();

        let places = searchBox.getPlaces();
        let lugarIncidencia = {lat: places[0].geometry.location.lat(), lng: places[0].geometry.location.lng()};

        //createMarker(lugarIncidencia);

        //Select talleres a base de datos
        let talleres = getTalleres();

        //Resetear los calculos de las rutas
        resetRouteValues();

        //Iterar a traves de los talleres para obtener el más cercano a la incidencia
        iterateTalleresRoutes(talleres, lugarIncidencia, directionsService, directionsRenderer);

        //deletePreviousMarker();
    })
}


function calcRoute(talleres, numeroTaller, puntoOrigen, puntoDestino, directionsService, directionsRenderer) {
    let request = {
        origin: puntoOrigen, //el origen son los talleres. Iterar a través de todos los talleres
        destination: puntoDestino,
        travelMode: 'DRIVING',
        unitSystem: google.maps.UnitSystem.METRIC
    };
    directionsService.route(request, function(response, status) {
        if (status == 'OK') {
            directionsRenderer.setDirections(response);
            let tiempoDesdeTallerActual = response.routes[0].legs[0].duration.value;
            //Asigna el taller y el tiempo de recorrido en caso de ser el más rapido
            if(tiempoAlTallerMasCercano === undefined || tiempoAlTallerMasCercano > tiempoDesdeTallerActual) {
                //Guardamos el objeto response de esta iteracion para coger sus datos mas adelante
                objetoResponse = response;
                tiempoAlTallerMasCercano = tiempoDesdeTallerActual;
                kmAlTallerMasCercano = objetoResponse.routes[0].legs[0].distance.value;
                numeroTallerMasCercano = numeroTaller;
                //Creamos un objeto render con la ruta mas rapida para luego poder displayearlo
                renderFastestRoute = new google.maps.DirectionsRenderer();
                renderFastestRoute.setDirections(objetoResponse);
            }
            //Get Data Iteración Actual
            consoleLogIteracionRuta(numeroTaller, tiempoDesdeTallerActual);

            //Si hemos iterado a través de todos los talleres muestra el más eficiente
            if(contadorTalleres === talleres.length -1){
                let tallerAddress = objetoResponse.routes[0].legs[0].start_address;
                let incidenciaAddress = objetoResponse.routes[0].legs[0].end_address;
                let provinciaIncidencia = getProvinciaIncidencia(incidenciaAddress);
                renderFastestRoute.setMap(map);

                createInfoBox(tallerAddress, incidenciaAddress);

                //Get Data Best Route
                consoleLogBestRuta(talleres, incidenciaAddress, provinciaIncidencia);
            }
        }
        else{
            console.log("Este punto no es accesible en coche")
        }
        contadorTalleres++;
    })
}

function createMarker(lugarIncidencia) {
    marker = new google.maps.Marker({
        position: lugarIncidencia,
        map: map
    });
}

function deletePreviousMarker() {
    if (typeof marker !== 'undefined') {
        marker.setMap(null);
    }
}

function getTalleres() {
    return [vitoria, bilbao, donosti]; //Array prueba
}

function resetRouteValues() {
    tiempoAlTallerMasCercano = undefined;
    numeroTallerMasCercano = -1;
    contadorTalleres = 0;
}

function iterateTalleresRoutes(talleres, lugarIncidencia, directionsService, directionsRenderer) {
    talleres.forEach((item, i)=>{
        calcRoute(talleres, i, talleres[i], lugarIncidencia, directionsService, directionsRenderer);
    });
}

function deleteRouteRender() {
    if(renderFastestRoute !== undefined){
        renderFastestRoute.setMap(null);
    }
}

function getProvinciaIncidencia(incidenciaAddress) {
    if(incidenciaAddress.includes('Araba') || incidenciaAddress.includes('Álava')){
        return 'Araba';
    }
    else if(incidenciaAddress.includes('Gipuzkoa') || incidenciaAddress.includes('Guipuzcoa')){
        return 'Gipuzkoa';
    }
    else if(incidenciaAddress.includes('Bizkaia') || incidenciaAddress.includes('Vizcaya')){
        return 'Bizkaia';
    }
}

function getLatLngOnClick(lugarIncidencia) {
    console.log("Lat: " + lugarIncidencia.lat);
    console.log("Long: " + lugarIncidencia.lng);
}


function consoleLogIteracionRuta(numeroTaller, tiempoDesdeTallerActual) {
    console.log("%c ---ITERACION--- " + numeroTaller, "color: orange; font-weight: bold;")
    console.log("Tiempo desde este taller: " + Math.round(tiempoDesdeTallerActual / 60) + " minutos");
    console.log("Tiempo desde el taller + cercano: " + Math.round(tiempoAlTallerMasCercano / 60) + " minutos");
    console.log("Numero taller + cercano: " + numeroTallerMasCercano);
}

function consoleLogBestRuta(talleres, incidenciaAddress, provinciaIncidencia) {
    console.log("%c ---RESULTADO FINAL---", "color: red; font-weight: bold;");
    console.log("Lugar del taller mas cercano: " + talleres[numeroTallerMasCercano]);
    console.log("Lugar de la incidencia: " + incidenciaAddress)
    console.log("Tiempo desde el taller + cercano: " + Math.round(tiempoAlTallerMasCercano / 60) + " minutos");
    console.log("Km desde el taller + cercano: " + Math.round(kmAlTallerMasCercano / 1000) + "km"); //Obtiene los kilometros
    console.log("Provincia de la incidencia: " + provinciaIncidencia);
}

function createInfoBox(tallerAddress, incidenciaAddress) {
    $('#map').append('<div class="infoBox panel panel-default">\n' +
                    '    <div id="infoBoxInsideWrapper">\n' +
                    '        <div class="container panel-body">\n' +
                    '           <div class="row justify-content-center">\n' +
                    '              <span id="infoBoxTitle">Taller más cercano</span>\n' +
                    '           </div>\n' +
                    '           <hr id="infoBoxSeparator">\n' +
                    '           <div class="row mb-2">\n' +
                    `              <span class="infoBoxDataTitles">Lugar del taller: </span>
                                   <span class="infoBoxData">${tallerAddress}</span>\n` +
                    '           </div>\n' +
                    '           <div class="row mb-2">\n' +
                    `              <span class="infoBoxDataTitles">Lugar de la incidencia: </span>
                                   <span class="infoBoxData">${incidenciaAddress}</span>\n` +
                    '           </div>\n' +
                    '           <div class="row justify-content-end" id="infoBoxkmTime">\n' +
                    `              <span>${Math.round(kmAlTallerMasCercano / 1000)} km</span>\n` +
                    `              <span>${Math.round(tiempoAlTallerMasCercano / 60)} minutos</span>\n` +
                    '           </div>\n' +
                    '        </div>\n' +
                    '    </div>')
}











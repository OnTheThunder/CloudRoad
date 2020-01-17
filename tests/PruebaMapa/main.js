let tiempoAlTallerMasCercano;
let numeroTallerMasCercano = -1;
let contadorTalleres = 0;
let marker;
let renderFastestRoute;
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
    let map = new google.maps.Map(document.getElementById('map'), {
        zoom: 9,
        center: defaultLatLng
    });


    //RUTAS POR CLICK
    google.maps.event.addDomListener(map, 'click', function( event ){

        document.getElementById("mapsearch").value = "";

        //Eliminar el render de la anterior ruta
        deleteRouteRender();

        let lugarIncidencia = {lat: event.latLng.lat(), lng: event.latLng.lng()};

        //Crear Marca
        createMarker(lugarIncidencia, map);

        //Select talleres a base de datos
        let talleres = getTalleres();

        //Resetear los calculos de las rutas
        resetRouteValues();

        //Iterar a traves de los talleres para obtener el más cercano a la incidencia
        iterateTalleresRoutes(talleres, lugarIncidencia, directionsService, directionsRenderer);

        //Renderizamos la ruta una vez completadas las llamadas a la API de Gooogle maps
        setTimeout(()=>{
            renderFastestRoute.setMap(map)
        }, 300);

        deletePreviousMarker();

        //Coordenadas marker
        //console.log("Lat: " + lugarIncidencia.lat);
        //console.log("Long: " + lugarIncidencia.lng);
    });

    //RUTAS POR BUSQUEDAS
    google.maps.event.addDomListener(searchBox, 'places_changed', function () {

        //Eliminar el render de la anterior ruta
        deleteRouteRender();

        let places = searchBox.getPlaces();
        let lugarIncidencia = {lat: places[0].geometry.location.lat(), lng: places[0].geometry.location.lng()};
        let bounds = new google.maps.LatLngBounds();
        let i, place;

        //Crear Marca
        createMarker(lugarIncidencia, map);

        //Select talleres a base de datos
        let talleres = getTalleres();

        //Resetear los calculos de las rutas
        resetRouteValues();

        //Iterar a traves de los talleres para obtener el más cercano a la incidencia
        iterateTalleresRoutes(talleres, lugarIncidencia, directionsService, directionsRenderer);

        for (i = 0; place=places[i]; i++) {
            bounds.extend(place.geometry.location);
            marker.setPosition(place.geometry.location);
        }

        map.fitBounds(bounds);
        map.setZoom(11);

        //Renderizamos la ruta una vez completadas las llamadas a la API de Gooogle maps
        setTimeout(()=>{
            renderFastestRoute.setMap(map)
        }, 300);

        deletePreviousMarker();
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
            //console.log(response);
            //console.log(Math.round(response.routes[0].legs[0].distance.value) / 1000 + "km"); //Obtiene los kilometros

            //Asigna el taller y el tiempo de recorrido en caso de ser el más rapido
            if(tiempoAlTallerMasCercano === undefined || tiempoAlTallerMasCercano > response.routes[0].legs[0].duration.value) {
                tiempoAlTallerMasCercano = response.routes[0].legs[0].duration.value;
                numeroTallerMasCercano = numeroTaller;
                //Creamos un objeto render con la ruta mas rapida para luego poder displayearlo
                renderFastestRoute = new google.maps.DirectionsRenderer();
                renderFastestRoute.setDirections(response);
            }
            console.log("%c ---ITERACION--- " + numeroTaller, "color: orange; font-weight: bold;")
            console.log("Tiempo desde este taller: " + Math.round(response.routes[0].legs[0].duration.value / 60) + " minutos");
            console.log("Tiempo desde el taller + cercano: " + Math.round(tiempoAlTallerMasCercano / 60) + " minutos");
            console.log("Numero taller + cercano: " + numeroTallerMasCercano);

            //Si hemos iterado a través de todos los talleres muestra el más eficiente
            if(contadorTalleres === talleres.length -1){
                console.log("%c ---RESULTADO FINAL---", "color: red; font-weight: bold;");
                console.log("Coordenadas del taller mas cercano: " + talleres[numeroTallerMasCercano]);
                console.log("Tiempo desde el taller + cercano: " + Math.round(tiempoAlTallerMasCercano / 60) + " minutos");
            }
        }
        else{
            console.log("Este punto no es accesible en coche")
        }
        contadorTalleres++;
    })
}

function createMarker(lugarIncidencia, map) {
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











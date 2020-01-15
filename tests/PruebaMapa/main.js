function initMap() {
    let defaultLatLng = {lat: 42.842326386012516, lng: -2.691612846296414}; //Punto en el que está centrado el mapa por defecto
    let directionsService = new google.maps.DirectionsService();
    let directionsRenderer = new google.maps.DirectionsRenderer();
    let vitoria = new google.maps.LatLng(42.842326386012516, -2.691612846296414); //Ubicación origen de prueba

    //Crea el mapa
    let map = new google.maps.Map(document.getElementById('map'), {
        zoom: 9,
        center: defaultLatLng
    });

    //Crea un marcador donde al clickar en el mapa
    google.maps.event.addDomListener(map, 'click', function( event ){
        if (typeof marker !== 'undefined') {
            marker.setMap(null);
        }

        let lugarIncidencia = {lat: event.latLng.lat(), lng: event.latLng.lng()};

        marker = new google.maps.Marker({
            position: lugarIncidencia,
            map: map
        });
        calcRoute(vitoria, lugarIncidencia, directionsService, directionsRenderer);
        // console.log("Lat: " + lugarIncidencia.lat);
        // console.log("Long: " + lugarIncidencia.lng);
    });
}

function calcRoute(puntoOrigen, puntoDestino, directionsService, directionsRenderer) {
    let request = {
        origin: puntoOrigen, //el origen son los talleres. Iterar a través de todos los talleres
        destination: puntoDestino,
        travelMode: 'DRIVING',
        unitSystem: google.maps.UnitSystem.METRIC
    };
    directionsService.route(request, function(response, status) {
        if (status == 'OK') {
            directionsRenderer.setDirections(response);
            console.log(response);
            console.log(Math.round(response.routes[0].legs[0].distance.value) / 1000 + "km"); //Obtiene los kilometros
        }
        else{
            console.log("Este punto no es accesible en coche")
        }
    });
}









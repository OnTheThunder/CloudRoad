let tiempoAlTallerMasCercano;
let numeroTallerMasCercano = -1;
let contadorTalleres = 0;

function initMap() {
    let defaultLatLng = {lat: 42.842326386012516, lng: -2.691612846296414}; //Punto en el que está centrado el mapa por defecto
    let directionsService = new google.maps.DirectionsService();
    let directionsRenderer = new google.maps.DirectionsRenderer();
    let vitoria = new google.maps.LatLng(42.842326386012516, -2.691612846296414); //Ubicación origen de prueba
    let bilbao = new google.maps.LatLng(43.24478743516591, -2.927818900983914); //Ubicación origen de prueba

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

        //Iterar a traves de los talleres para obtener el más cercano a la incidencia
        //array = select talleres a base de datos
        let talleres = [vitoria, bilbao]; //Array prueba

        //Resetear el valor de los calculos referentes a las antiguas marcas
        tiempoAlTallerMasCercano = undefined;
        numeroTallerMasCercano = -1;
        contadorTalleres = 0;

        talleres.forEach((item, i)=>{
            calcRoute(talleres, i, talleres[i], lugarIncidencia, directionsService, directionsRenderer);
        });
        //Coordenadas marker
        /*console.log("Lat: " + lugarIncidencia.lat);
        console.log("Long: " + lugarIncidencia.lng);*/
    });

    var searchBox = new google.maps.places.SearchBox(document.getElementById('pac-input'));
    map.controls[google.maps.ControlPosition.TOP_CENTER].push(document.getElementById('pac-input'));
    google.maps.event.addListener(searchBox, 'places_changed', function() {
        searchBox.set('map', null);


        var places = searchBox.getPlaces();

        var bounds = new google.maps.LatLngBounds();
        var i, place;
        for (i = 0; place = places[i]; i++) {
            (function(place) {
                var marker = new google.maps.Marker({

                    position: place.geometry.location
                });
                marker.bindTo('map', searchBox, 'map');
                google.maps.event.addListener(marker, 'map_changed', function() {
                    if (!this.getMap()) {
                        this.unbindAll();
                    }
                });
                bounds.extend(place.geometry.location);


            }(place));

        }
        map.fitBounds(bounds);
        searchBox.set('map', map);
        map.setZoom(Math.min(map.getZoom(),12));

    });
}


function calcRoute(talleres, numeroTaller, puntoOrigen, puntoDestino, directionsService, directionsRenderer) {
    let request = {
        origin: puntoOrigen, //el origen son los talleres. Iterar a través de todos los talleres
        destination: puntoDestino,
        travelMode: 'DRIVING',
        unitSystem: google.maps.UnitSystem.METRIC
    };
    directionsService.route(request, function(response, status) {
        console.log("%c ITERACION " + numeroTaller, "color: orange; font-weight: bold;")
        if (status == 'OK') {
            directionsRenderer.setDirections(response);
            console.log("Tiempo iteracion actual: " + response.routes[0].legs[0].duration.value)
            /*console.log(response);
            console.log(Math.round(response.routes[0].legs[0].distance.value) / 1000 + "km"); //Obtiene los kilometros
            console.log(Math.round(response.routes[0].legs[0].duration.value / 60) + " minutos"); //Obtiene los minutos que lleva completar el recorrido*/
            if(tiempoAlTallerMasCercano === undefined || tiempoAlTallerMasCercano > response.routes[0].legs[0].duration.value) {
                tiempoAlTallerMasCercano = response.routes[0].legs[0].duration.value;
                numeroTallerMasCercano = numeroTaller;
            }

            console.log("tiempoAlTallerMasCercano: " + Math.round(tiempoAlTallerMasCercano / 60) + " minutos");
            console.log("numero taller mas cercano: " + numeroTallerMasCercano);
            console.log(contadorTalleres)
            console.log(talleres.length -1)
            if(contadorTalleres === talleres.length -1){
                console.log("%c FINAL", "color: red; font-weight: bold;");
                console.log("coordenadas del taller mas cercano: " + talleres[numeroTallerMasCercano]);
                console.log("tiempo desde el taller mas cercano: " + Math.round(tiempoAlTallerMasCercano / 60) + " minutos");
            }
        }
        else{
            console.log("Este punto no es accesible en coche")
        }
        contadorTalleres++;
    })
}









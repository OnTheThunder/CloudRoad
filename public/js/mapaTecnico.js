window.onload = function () {
    let map;
    let directionsService;
    let directionsRenderer;

    $('.incidencia-show-wrapper').css('display', 'none');
    $('.incidencia-show-wrapper').fadeIn(1000);
    initMapFinal();

    //Inicializar mapa
    function initMapFinal() {

        let defaultLatLng = {lat: 42.842326386012516, lng: -2.691612846296414}; //Punto en el que está centrado el mapa por defecto
        directionsService = new google.maps.DirectionsService();
        directionsRenderer = new google.maps.DirectionsRenderer();


        //Crea el mapa
        map = new google.maps.Map(document.getElementById('final-map'), {
            zoom: 9,
            center: defaultLatLng,
            options: {
                gestureHandling: 'greedy'
            }
        });

        //Coger el id de la incidencia a través de la url
        let url = window.location.href;
        let idStartIndex = url.lastIndexOf("/");
        let idIncidencia = "";
        for (let i = idStartIndex + 1; i < url.length; i++) {
            idIncidencia += url.charAt(i)
        }

        //Get coordenadas incidencia y taller de BD
        $.ajax({
            type: 'get',
            url: `/incidencias/${idIncidencia}/getCoordenadas`,
            dataType: 'json',
            success: function(result){
                console.log("SUCCESS");
                console.log(result);
                let startCoord = new google.maps.LatLng(result.latitudTaller, result.longitudTaller);
                let endCoord = new google.maps.LatLng(result.latitudIncidencia, result.longitudIncidencia);
                //Set Route
                calcRoute(startCoord, endCoord);
            },
            error: function (result) {
                console.log("ERROR");
                console.log(result);
            }
        });
    }

    function calcRoute(startCoord, endCoord) {
        let request = {
            origin: startCoord,
            destination: endCoord,
            travelMode: 'DRIVING'
        };
        directionsService.route(request, function(result, status) {
            if (status === 'OK') {
                let directionsRenderer = new google.maps.DirectionsRenderer();
                directionsRenderer.setDirections(result);
                directionsRenderer.setMap(map);
                createInfoBoxTecnico(result.routes[0].legs[0].end_address, result.routes[0].legs[0].distance.value, result.routes[0].legs[0].duration.value);
            }
        });
    }

    function createInfoBoxTecnico(incidenciaAddress, kmAlTallerMasCercano, tiempoAlTallerMasCercano) {
        $('#final-map').append('<div class="infoBoxTecnico">\n' +
            '    <div id="infoBoxInsideWrapper">\n' +
            '        <div class="container">\n' +
            '           <div class="row mb-2">\n' +
            '              <i class="fas fa-directions"></i>' +
            `              <span class="infoBoxDataTitles">Lugar de la incidencia:&nbsp;</span>
                       <span class="infoBoxData">${incidenciaAddress}</span>\n` +
            '           </div>\n' +
            '           <div class="row justify-content-end" id="infoBoxkmTime">\n' +
            `              <span>${Math.round(kmAlTallerMasCercano / 1000)} km</span>\n` +
            `              <span>${Math.round(tiempoAlTallerMasCercano / 60)} minutos</span>\n` +
            '           </div>\n' +
            '        </div>\n' +
            '    </div>')
    }
};





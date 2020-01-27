//Variables globales
let tiempoAlTallerMasCercano;
let kmAlTallerMasCercano;
let numeroTallerMasCercano = -1;
let contadorTalleres = 0;
let marker;
let renderFastestRoute;
let map;
let objetoResponse;
let talleres;
let tecnicos;
let oTallerMasCercano;

window.onload = function () {
    initMap();
    $('html, body').scrollTop(0);
    $('body').css('overflow', 'hidden'); //Mapa en fullscreen
    $(function () {$('[data-toggle="tooltip"]').tooltip()});//Activate tooltips
};

//Inicializar mapa
function initMap() {
    getTalleresAJAX();

    let searchBox = new google.maps.places.SearchBox(document.getElementById("mapsearch"));
    let defaultLatLng = {lat: 42.842326386012516, lng: -2.691612846296414}; //Punto en el que está centrado el mapa por defecto
    let directionsService = new google.maps.DirectionsService();
    let directionsRenderer = new google.maps.DirectionsRenderer();


    //Crea el mapa
    map = new google.maps.Map(document.getElementById('map'), {
        zoom: 9,
        center: defaultLatLng,
        options: {
            gestureHandling: 'greedy'
        }
    });


    //RUTAS POR CLICK
    google.maps.event.addDomListener(map, 'click', function( event ){

        document.getElementById("mapsearch").value = "";

        let lugarIncidencia = {lat: event.latLng.lat(), lng: event.latLng.lng()};

        //Eliminar el render de la anterior ruta
        deleteRouteRender();

        //createMarker(lugarIncidencia);

        //Resetear los calculos de las rutas
        resetRouteValues();

        //Iterar a traves de los talleres para obtener el más cercano a la incidencia
        iterateTalleresRoutes(lugarIncidencia, directionsService, directionsRenderer);

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

        //Resetear los calculos de las rutas
        resetRouteValues();

        //Iterar a traves de los talleres para obtener el más cercano a la incidencia
        iterateTalleresRoutes(lugarIncidencia, directionsService, directionsRenderer);

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
        if (status === 'OK') {
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
                //Guardamos el objeto de BD del taller mas cercano
                oTallerMasCercano = talleres[numeroTaller];
            }
            //Get Data Iteración Actual
            //consoleLogIteracionRuta(numeroTaller, tiempoDesdeTallerActual);

            //Si hemos iterado a través de todos los talleres muestra el más eficiente
            if(contadorTalleres === talleres.length -1){
                renderFastestRoute.setMap(map);
                createInfoBox();
                createTecnicoButton();
                renderTableHeader();
                findTecnicos();
                //Get Data Best Route
                //consoleLogBestRuta(talleres, incidenciaAddress, provinciaIncidencia);
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


function resetRouteValues() {
    tiempoAlTallerMasCercano = undefined;
    numeroTallerMasCercano = -1;
    contadorTalleres = 0;
}

function iterateTalleresRoutes(lugarIncidencia, directionsService, directionsRenderer) {
    console.log(talleres);
    talleres.forEach((item, i)=>{
        let coordenadasTallerActual = new google.maps.LatLng(talleres[i].latitud, talleres[i].longitud);
        calcRoute(talleres, i, coordenadasTallerActual, lugarIncidencia, directionsService, directionsRenderer);
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
    else if(incidenciaAddress.includes('Gipuzkoa') || incidenciaAddress.includes('Guipúzcoa')){
        return 'Gipuzkoa';
    }
    else if(incidenciaAddress.includes('Bizkaia') || incidenciaAddress.includes('Vizcaya')){
        return 'Bizkaia';
    }
    else if(incidenciaAddress.includes('Navarra') || incidenciaAddress.includes('Nafarroa') || incidenciaAddress.includes('Navarre')){
        return 'Nafarroa';
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
    console.log("Lugar del taller mas cercano: " + objetoResponse.routes[0].legs[0].start_address);
    console.log("Lugar de la incidencia: " + incidenciaAddress)
    console.log("Tiempo desde el taller + cercano: " + Math.round(tiempoAlTallerMasCercano / 60) + " minutos");
    console.log("Km desde el taller + cercano: " + Math.round(kmAlTallerMasCercano / 1000) + "km"); //Obtiene los kilometros
    console.log("Provincia de la incidencia: " + provinciaIncidencia);
}

function createInfoBox() {
    let tallerAddress = objetoResponse.routes[0].legs[0].start_address;
    let incidenciaAddress = objetoResponse.routes[0].legs[0].end_address;

    $('#map').append('<div class="infoBox">\n' +
        '    <div id="infoBoxInsideWrapper">\n' +
        '        <div class="container">\n' +
        '           <div class="row justify-content-center">\n' +
        `              <span id="infoBoxTitle">${oTallerMasCercano.nombre}</span>\n` +
        '           </div>\n' +
        '           <hr id="infoBoxSeparator">\n' +
        '           <div class="row mb-2">\n' +
        '              <i class="fas fa-map-marker-alt"></i>' +
        `              <span class="infoBoxDataTitles">Lugar del taller:&nbsp;</span>
                       <span class="infoBoxData">${tallerAddress}</span>\n` +
        '           </div>\n' +
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

function createTecnicoButton() {
    if($('#btn-tecnicos').length === 0){
        $('#map').append('<div class="btn-scrollers" id="btn-tecnicos">\n' +
            '<i class="fas fa-user-cog"></i>\n' +
            '</div>')
    }

    $('#btn-tecnicos').on('click', function(e){
        //Scroll to data section
        let posTop = $("#tecnico-fullscreen-data").offset().top;
        e.preventDefault();
        e.stopPropagation();
        $('html, body').scrollTop(posTop);
    })
}

function getTalleresAJAX() {
    $.ajax({
        type: 'get',
        url: '/incidencias/create/map/getTalleres',
        dataType: 'json',
        success: function(result){
            talleres = result;
        }
    });
}

function getTecnicosByTallerAJAX() {
    let idTaller = oTallerMasCercano.id;
    let url = `/incidencias/create/map/taller/${idTaller}/getTecnicos`;
    $.ajax({
        type: 'get',
        url: url,
        dataType: 'json',
        success: function(result){
            tecnicos = result;
            renderTecnicos();
            renderButtonUp();
        }
    });
}

function renderTableHeader() {
    $('body').css('overflow', 'visible');
    let listaTecnicosTooltip = $('#lista-tecnicos-info');

    listaTecnicosTooltip.on('hover', function () {
        listaTecnicosTooltip.tooltip('show')
    })
}


function findTecnicos() {
    getTecnicosByTallerAJAX();
}

function renderTecnicos() {
    let tablaTecnicos = $("#tabla-tecnicos-disponibles");
    let cabeceraTablaTecnicos = $('#table-header-container');
    tablaTecnicos.css('display', 'table');
    cabeceraTablaTecnicos.css('display', 'flex');
    let tableBody = tablaTecnicos.find( "tbody" );
    tableBody.empty();

    tecnicos.forEach((item)=>{
        tableBody.append('<tr>\n' +
            `<td>${item.nombre}</td>\n` +
            `<td>${item.apellidos}</td>\n` +
            `<td>${item.telefono}</td>\n` +
            `<td>${item.email}</td>\n` +
            '<td>\n' +
            `<button value="${item.id},${item.email}" type="button" class="btn-notificar-tecnico btn btn-outline-primary">Notificar` +
                '<span class="mensaje-tecnico-notificado">Notificación enviada!</span>' +
            '</button>\n' +
            '</td>\n' +
            '</tr>')
    });

    //Crear evento onClick para el boton notificar tecnico
    let btnNotificarTecnico = $('.btn-notificar-tecnico');

    btnNotificarTecnico.on('click', function () {
        //window.location.href = '/';
        let clickedIndex = btnNotificarTecnico.index(this);
        $('.mensaje-tecnico-notificado').eq(clickedIndex).fadeIn("1000");
        let oDatosIncidencia = prepareIncidenciaData(this.value);
        storeIncidenciaAJAX(oDatosIncidencia);

        //FadeOut page
        setTimeout(function () {
            $('.fadeOut-wrapper').fadeOut('1000');
        }, 2000)
    })
}

function sendEmailAJAX(emailTecnico) {
    $.ajax({
        type: 'GET',
        url: '/send-mail',
        data: {'mail': emailTecnico},
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(result){
            console.log("SUCCESS")
            console.log(result)
        },
        error: function (result) {
            console.log("ERROR");
            console.log(result);
        }
    });
}

function renderButtonUp() {
    if($('#btn-scrollUp').length === 0){
        $('#tecnico-fullscreen-data')
            .append('<div class="btn-scrollers" id="btn-scrollUp">\n' +
                '<i class="fas fa-chevron-up"></i>\n' +
                '</div>');
        $('#btn-scrollUp').on('click', function () {
            $('html, body').scrollTop(0);
        })
    }
}


function prepareIncidenciaData(idEmailTecnico) {
    let coordenadasIncidencia = {};
    let datosTecnico = {};

    //Coordenadas Incidencia
    coordenadasIncidencia.latitud = objetoResponse.routes[0].legs[0].end_location.lat();
    coordenadasIncidencia.longitud = objetoResponse.routes[0].legs[0].end_location.lng();
    coordenadasIncidencia.provincia = getProvinciaIncidencia(objetoResponse.routes[0].legs[0].end_address);
    //Tecnico
    let idTecnico = idEmailTecnico.substr(0, idEmailTecnico.indexOf(','));
    let emailTecnico = idEmailTecnico.substr(idEmailTecnico.indexOf(',') + 1, idEmailTecnico.length-1);
    datosTecnico.id = idTecnico;
    datosTecnico.email = emailTecnico;
    console.log(datosTecnico.id);
    console.log(datosTecnico.email);

    let oDatosIncidencia = getJSONfromCookie();

    oDatosIncidencia.coordenadasIncidencia = coordenadasIncidencia;
    oDatosIncidencia.tecnico = datosTecnico;

    return oDatosIncidencia;
}

function storeIncidenciaAJAX(oDatosIncidencia) {
    $.ajax({
        type: 'POST',
        url: '/incidencias/store',
        data: oDatosIncidencia,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(){
            console.log("SUCCESS");
            sendEmailAJAX(oDatosIncidencia.tecnico.email);
            window.location.href = '/'; //Si no envía el correo colocar el href dentro del success de sendemail
        },
        error: function (result) {
            console.log("ERROR");
        }
    });
}


function getJSONfromCookie() {
    let cookiesString = document.cookie;
    let handledCookie = "";
    for (let i = 0; cookiesString.charAt(i) !== ";"; i++) {
        handledCookie += cookiesString.charAt(i);
    }
    return JSON.parse(handledCookie);
}







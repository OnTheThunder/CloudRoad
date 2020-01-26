window.onload = function () {
    $(document).ready(function () {

        crearMapa();
        //url camaras
        let url = "https://www.geo.euskadi.eus/contenidos/ds_localizaciones/camaras_trafico/opendata/camaras-trafico.json";
        var jsonCamaras = getCaramasUrl(url);
        llenarSelectYMarkers(jsonCamaras);

        /**
         * LISTENERS
         */
        // cuando se clica en una linea de la tabla de lugares
        $("#tabla-lugares tr").click(function () {
            // resaltar linea marcada
            var selected = $(this).hasClass("resaltar");
            $("#tabla-lugares tr").removeClass("resaltar");
            if (!selected)
                $(this).addClass("resaltar");
            // poner la imagen de la camara
            let p = this.children;
            anyadirImagenDeCamara(p[2].textContent);
        });

        /**
         * FUNCIONES
         */

        /**
         * Funcion que crea el mapa
         */
        function crearMapa() {
            let defaultLatLng = {lat: 42.842326386012516, lng: -2.691612846296414}; //Punto en el que está centrado el mapa por defecto;
            //Crea el mapa
            map = new google.maps.Map(document.getElementById('mapa-camaras'), {
                zoom: 9,
                minZoom: 9,
                maxZoom: 14,
                center: defaultLatLng,
                options: {
                    gestureHandling: 'greedy'
                }
            });
        }

        /**
         * Obtiene de la url dada un json a devolver como objetos
         * @param url
         * @returns {string}
         */
        function getCaramasUrl(url) {
            var matrizCamaras = "";
            $.ajax({
                url: url,
                async: false
            }).always(function (data) {
                if (data.status == 200) {// que to-do OK
                    var jsonCallBack = (data.responseText);
                    matrizCamaras = JSON.parse(jsonCallBack.substring('13', jsonCallBack.length - 2));
                }
            });
            return matrizCamaras;
        }

        /**
         * Crear los markers de todas las camaras para el mapa
         * @param jsonCamaras
         */
        function llenarSelectYMarkers(jsonCamaras) {
            var selector = $('#tabla-lugares');

            for (let i = 0; i < jsonCamaras.length; i++) {
                //añadir cada lugar y la tabla
                selector.append('<tr>' +
                    '<td>' + jsonCamaras[i].TITLE + '</td>' +
                    '<td>' + jsonCamaras[i].ROAD + '</td>' +
                    '<td class="d-none">' + jsonCamaras[i].URLCAM + '</td>' +
                    ' </tr>');
                // crear marcadores en el mapa con su locaclizacion
                let lugarIncidencia = {
                    lat: parseFloat(jsonCamaras[i].LATWGS84),
                    lng: parseFloat(jsonCamaras[i].LONWGS84)
                };
                createMarker(lugarIncidencia, jsonCamaras[i].TITLE, jsonCamaras[i].ROAD, jsonCamaras[i].URLCAM);
            }
        }

        /**
         * Crear un marker con su infoWindow
         * @param lugarIncidencia
         * @param titulo
         * @param carretera
         * @param imagen
         */
        function createMarker(lugarIncidencia, titulo, carretera, imagen) {
            let marker = new google.maps.Marker({
                position: lugarIncidencia,
                map: map
            });
            // la info window que muestra lugar y carretera
            let infowindow = new google.maps.InfoWindow({
                content: "<div>" +
                    "<h4>" + titulo + "</h4>" +
                    "<span>" + carretera + "</span>" +
                    "</div>",
                map: map
            });
            marker.addListener('click', function () {
                infowindow.open(marker.get('map'), marker);
                map.setCenter(marker.getPosition());
                // poner imagen de la CAMARA quitando antes la anterior
                anyadirImagenDeCamara(imagen);
            });
            // cerrar las infowindow cuando click en el mapa
            map.addListener('click', function () {
                infowindow.close();
            });
        }


        /**
         * Funcion para cambiar la imagen de la camara actualmente seleccionada
         * cuando se hace click en un marker o row de la tabla
         * @param urlImagen
         */
        function anyadirImagenDeCamara(urlImagen) {
            let imagen_caja = $('#imagen');
            imagen_caja.empty();
            imagen_caja.append('<img alt="Imagen no disponible" class="img-thumbnail" src="' + urlImagen + '">');
        }

    });
};

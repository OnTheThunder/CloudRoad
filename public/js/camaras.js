window.onload = function () {
    $(document).ready(function () {
        console.log("ready!");

        let url = "https://www.geo.euskadi.eus/contenidos/ds_localizaciones/camaras_trafico/opendata/camaras-trafico.json";
        var jsonCamaras = getCaramasUrl(url);
        llenarSelect(jsonCamaras);

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

        function llenarSelect(jsonCamaras) {
            var selector = $('#lugares');

            for (let i = 0; i < jsonCamaras.length; i++) {
                selector.append('<option value=' + jsonCamaras[i].TITLE + '>' + jsonCamaras[i].TITLE + '</option>');
            }
        }


    });
};

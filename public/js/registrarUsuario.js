window.onload = function () {

    /**
     * Dependiendo del rol seleccionado aparece mas campos a añadir o no
     */
    $('#rolSelect').on('change', function () {
        let optionSelected = $("#rolSelect option:selected").text();
        if (optionSelected === 'Técnico') {
            $('#div-extra').append(
                '<div class="form-group jornada-form">\n' +
                    '<label for="jornadaSelect">Selecciona su jornada</label>\n' +
                    '<select class="form-control" id="jornadaSelect" name="turno">\n' +
                        '<option>Mañana</option>\n' +
                        '<option>Tarde</option>\n' +
                        '<option>Noche</option>\n' +
                    '</select>\n' +
                '</div>\n' +
                '<div class="form-group taller-form">\n' +
                    '<label for="tallerSelect">Selecciona su taller</label>\n' +
                    '<select class="form-control" id="tallerSelect" name="tallerId">\n' +
                    //rellenar mediante ajax
                rellenarConTalleres()+
                    '</select>\n' +
                '</div>');
        } else {
            $(".jornada-form").remove();
            $(".taller-form").remove();
        }
    });

    /**
     * Llama a route /talleres para que devuelva todos los talleres y mostrarlos en
     * un select de añadir usuario para que elija
     * @returns {string}
     */
    function rellenarConTalleres() {
        let crearOptions = "";
        $.ajax({
            url: '/talleres',
            async: false,
            success: function (data) {
                data.forEach(element => crearOptions += "<option value='" + element.id + "'>" + element.nombre + "</option>");
            }
        });
        return crearOptions;
    }
};

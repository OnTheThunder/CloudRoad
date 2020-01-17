window.onload = function () {

    $('#rolSelect').on('change', function () {
        let optionSelected = $( "#rolSelect option:selected" ).text();
        if(optionSelected === 'Técnico'){
            $('.user-create-form').append('<div class="form-group jornada-form">\n' +
                                            '<label for="jornadaSelect">Selecciona su jornada</label>\n' +
                                            '<select class="form-control" id="jornadaSelect">\n' +
                                                '<option>Mañana</option>\n' +
                                                '<option>Tarde</option>\n' +
                                                '<option>Noche</option>\n' +
                                            '</select>\n' +
                                        '</div>\n' +
                                        '<div class="form-group taller-form">\n' +
                                            '<label for="tallerSelect">Selecciona su taller</label>\n' +
                                            '<select class="form-control" id="tallerSelect">\n' +
                                                '<option></option>\n' +
                                                '<option></option>\n' +
                                                '<option></option>\n' +
                                            '</select>\n' +
                                        '</div>');
        }
        else{
            $( ".jornada-form" ).remove();
            $( ".taller-form" ).remove();
        }
    })
}

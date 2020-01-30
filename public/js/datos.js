window.onload = function () {

    //Datos por defecto
    $.ajax({
        type: 'get',
        url: '/admin/datos',
        dataType: 'json',
        data: {tipoDato: 'Operadores'},
        success: function(result){
            crearTablaDatos(['nombre', 'apellidos', 'telefono', 'dni', 'email'], result.length, result);
        }
    });


    let selectFiltroDatos = $('#selectFiltroDatos');
    selectFiltroDatos.on('change', function () {
        $.ajax({
            type: 'get',
            url: '/admin/datos',
            dataType: 'json',
            data: {tipoDato: selectFiltroDatos.val()},
            success: function(result){
                console.log(result);
                switch (selectFiltroDatos.val()) {
                    case 'Clientes': crearTablaDatos(['nombre', 'apellidos', 'telefono', 'dni'], result.length, result);
                    break;
                    case 'Tecnicos': crearTablaDatos(['nombre', 'apellidos', 'telefono', 'dni', 'email', 'turno', 'disponibilidad'], result.length, result);
                    break;
                    case 'Talleres': crearTablaDatos(['nombre', 'provincia'], result.length, result);
                    break;
                    case 'Operadores': crearTablaDatos(['nombre', 'apellidos', 'telefono', 'dni', 'email'], result.length, result);
                    break;
                    case 'Coordinadores': crearTablaDatos(['nombre', 'apellidos', 'telefono', 'dni', 'email'], result.length, result);
                    break;
                    case 'Jefes': crearTablaDatos(['nombre', 'apellidos', 'telefono', 'dni', 'email'], result.length, result);
                    break;
                }
            }
        });
    });

    function crearTablaDatos(arrayColumnas, nFilas, result) {
        let tablaDatos = $('#tabla-datos');
        tablaDatos.empty();

        //TR CABECERA
        tablaDatos.append('<thead class="bg-color-cards"></thead>')
        //TD CABECERA
        arrayColumnas.forEach((item, i)=>{
            tablaDatos.find('thead').append(`<td class="text-capitalize">${item}</td>`);
        });

        if(selectFiltroDatos.val() !== 'Coordinadores' && selectFiltroDatos.val() !== 'Jefes'){
            for (let i = 0; i < nFilas; i++) {
                printRow(tablaDatos, arrayColumnas, i, result)
            }
        }
        else{
            for (let i = 0; i < nFilas; i++) {
                if(selectFiltroDatos.val() === 'Jefes' && result[i]['isJefe'] === 1){
                    printRow(tablaDatos, arrayColumnas, i, result)
                }
                else if(selectFiltroDatos.val() === 'Coordinadores' && result[i]['isJefe'] === 0){
                    printRow(tablaDatos, arrayColumnas, i, result)
                }
            }
        }
    }

    function printRow(tablaDatos, arrayColumnas, i, result) {
        tablaDatos.append('<tr>');
        //TD FILAS
        for (let j = 0; j < arrayColumnas.length; j++) {
            tablaDatos.append(`<td>${result[i][arrayColumnas[j]]}</td>`)
        }
        tablaDatos.append('</tr>');
    }
};

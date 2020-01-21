window.onload = function () {
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
                    case 'Operadores': crearTablaDatos(['nombre', 'apellidos', 'telefono', 'dni'], result.length, result);
                    break;
                    case 'Coordinadores': crearTablaDatos(['nombre', 'apellidos', 'telefono', 'dni'], result.length, result);
                    break;
                    case 'Jefes': crearTablaDatos(['nombre', 'apellidos', 'telefono', 'dni'], result.length, result);
                    break;
                }
            }
        });
    });

    function crearTablaDatos(arrayColumnas, nFilas, result) {
        let tablaDatos = $('#tabla-datos');
        tablaDatos.empty();

        //TR CABECERA
        tablaDatos.append('<tr></tr>')
        //TD CABECERA
        arrayColumnas.forEach((item, i)=>{
            tablaDatos.find('tr').append(`<td>${item}</td>`);
        });
        //TR FILAS
        for (let i = 0; i < nFilas; i++) {
            tablaDatos.append('<tr></tr>');
            //TD FILAS
            for (let j = 0; j < arrayColumnas.length; j++) {
                tablaDatos.append(`<td>${result[i][arrayColumnas[j]]}</td>`)
            }
        }
    }
};

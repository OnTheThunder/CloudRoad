window.onload = function(){

    //Autocompletar datos cliente
    $('#dni').on('focusout', function () {
        let dni = $('#dni').val();
        $.ajax({
            type: 'GET',
            url: `/cliente/find-by-dni/${dni}`,
            dataType: 'JSON',
            success: function(result){
                console.log("SUCCESS");
                if(result.length > 0){
                    rellenarCamposCliente(result[0]);
                }
            },
            error: function (result) {
                console.log("ERROR");
                console.log(result);
            }
        })
    });

    //Autocompletar datos vehiculo
    $('#matricula').on('focusout', function () {
        let matricula = $('#matricula').val();
        $.ajax({
            type: 'GET',
            url: `/vehiculo/find-by-matricula/${matricula}`,
            dataType: 'JSON',
            success: function(result){
                console.log("SUCCESS");
                if(result.length > 0){
                    rellenarCamposVehiculo(result[0]);
                }
            },
            error: function (result) {
                console.log("ERROR");
                console.log(result);
            }
        })
    });



    //Guardar en el cliente los datos del formulario a la espera de terminar la incidencia.
    $('#btn-crear-incidencia').on('click', function () {
        let datosCliente = {};
        let datosVehiculo = {};
        let datosIncidenciaParciales = {};

        datosCliente.nombre = $('#nombre').val();
        datosCliente.apellidos = $('#apellidos').val();
        datosCliente.telefono = $('#telefono').val();
        datosCliente.dni = $('#dni').val();

        datosVehiculo.marca = $('#marca').val();
        datosVehiculo.modelo = $('#modelo').val();
        datosVehiculo.matricula = $('#matricula').val();
        datosVehiculo.aseguradora = $('#aseguradora').val();

        datosIncidenciaParciales.tipo = $('#tipo').val();
        datosIncidenciaParciales.descripcion = $('#descripcion').val();

        let oDatosIncidencia = {
            cliente: datosCliente,
            vehiculo: datosVehiculo,
            incidencia: datosIncidenciaParciales
        };

        document.cookie = JSON.stringify(oDatosIncidencia);
    });
};

function rellenarCamposCliente(cliente) {
    $('#nombre').val(cliente['nombre']);
    $('#apellidos').val(cliente['apellidos']);
    $('#telefono').val(cliente['telefono']);
}

function rellenarCamposVehiculo(vehiculo) {
    $('#aseguradora').val(vehiculo['aseguradora']);
    $('#marca').val(vehiculo['marca']);
    $('#modelo').val(vehiculo['modelo']);
}







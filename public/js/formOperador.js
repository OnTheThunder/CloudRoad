window.onload = function(){
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






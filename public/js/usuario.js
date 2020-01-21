window.onload = function () {

    $(document).ready(function () {

        let id = $('#usuario_id').val();
        let rol = $('#usuario_rol').val();
        let objeto_usuario = $('#objeto_usuario');
        if (id != null) {
            getUsuario();
        }

        /**
         * Con esta funcion obtengo la info completa ya del usuario
         */
        function getUsuario() {
            var matrizCamaras = "";
            $.ajax({
                url: '/getUser/' + id + '/' + rol,
                async: false
            }).always(function (data) {
                //    console.log(data);
                objeto_usuario.val(JSON.stringify(data[0]));

            });
        }
    });
};

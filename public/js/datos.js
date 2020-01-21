window.onload = function () {
    let selectFiltroDatos = $('#selectFiltroDatos');
    selectFiltroDatos.on('change', function () {
        $.ajax({
            type: 'get',
            url: '/admin/datos',
            dataType: 'json',
            data: {tipoDato: selectFiltroDatos.val()},
            success: function(result){
                console.log(result)
            }
        });
    })
};

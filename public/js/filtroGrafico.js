/*$(document).ready(function () {
    $('#filtro').on('change', function () {
        $('#filtro option:selected').each(function () {
            elegido = $(this).val();
            $.post('/admin/estadisticas/cargar', {elegido: elegido}, function(data) {
                $('#grafico').html(data)
            })
        })
    })
})*/

window.onload = function(){
    $('#filtro').on('change', function () {
        $.ajax({
            type: 'POST',
            url: '/admin/estadisticas/cargar',
            data: {elegido: $('#filtro').val()},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(result){
                console.log("SUCCESS")
                console.log(result);
            },
            error: function (result) {
                console.log("ERROR");
                console.log(result);
            }
        });
    })
};

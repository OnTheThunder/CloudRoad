window.onload = function () {
    $('#selectFiltroDatos').on('change', function () {
        $.ajax({
            type: 'get',
            url: '/admin/datos',
            dataType: 'json',
            success: function(result){
                console.log(result)
            }
        });
    })
};

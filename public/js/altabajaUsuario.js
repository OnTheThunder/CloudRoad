function altaBaja(tipo, id) {
    let options = "";
    $.ajax({
        url: '/usuario/update?modo=' + tipo + '&id=' + id,
        async: false,
        success: function (data) {
            console.log('suces ' + data)
            //refrescar
            location.reload();
        },
        fail: function (result) {
            console.log('fail ' + result)
        }
    });
    return options;
}


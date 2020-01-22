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
                filtro = $('#filtro').val()
                switch (filtro){
                    case 'Incidencias por hora':
                        porHora(result);
                        break;
                    case 'Incidencias de cada tecnico':
                        porTecnico(result);
                        break;
                    case 'Incidencias por provincia':
                        porProvincia(result);
                        break;
                    case 'Estado de incidencia':
                        porEstado(result);
                        break;
                    case 'Tipo de avería':
                        porTipo(result);
                        break;
                }

                console.log(result);
            },
            error: function (result) {
                console.log("ERROR");
                console.log(result);
            }
        });
    })
};

function porHora(result){
    var ctx = document.getElementById('miGrafico');
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'line',

        // The data for our dataset
        data: {
            labels: ['00', '01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16',
                '17', '18', '19', '20', '21', '22', '23'],
            datasets: [{
                label: $('#filtro').val(),

                borderColor: 'rgb(255, 99, 132)',
                data: [result[0].length, result[1].length, result[2].length, result[3].length, result[4].length, result[5].length,
                    result[6].length, result[7].length, result[8].length, result[9].length, result[10].length, result[11].length,
                    result[12].length, result[13].length, result[14].length, result[15].length, result[16].length, result[17].length,
                    result[18].length, result[19].length, result[20].length, result[21].length, result[22].length, result[23].length]
            }]
        },
        // Configuration options go here
        options: {}
    });
}

function porProvincia(result){
    var ctx = document.getElementById('miGrafico');
    var chart = new Chart(ctx, {
        // El tipo de grafico que vamos a crear
        type: 'doughnut',

        // The data for our dataset
        data: {
            labels: ['Alava','Guipuzcoa','Vizcaya','Navarra'],
            datasets: [{
                data: [result[0].length, result[1].length, result[2].length, result[3].length],
                backgroundColor: ['rgb(143,35,255)','rgb(36,255,63)','rgb(41,45,255)','rgb(255,65,16)'],
            }]
        },
        // Configuration options go here
        options: {}
    });
}

function porEstado(result){
    var ctx = document.getElementById('miGrafico');
    var chart = new Chart(ctx, {
        // El tipo de grafico que vamos a crear
        type: 'bar',
        // The data for our dataset
        data: {
            labels: ['Terminado','Garaje'],
            datasets: [{
                label: 'Estado de las incidencias',
                data: [result[0].length, result[1].length],
                backgroundColor: ['rgb(143,35,255)','rgb(36,255,63)'],
            }]
        },
        // Configuration options go here
        options: {
            scales: {
                yAxes: [{
                    display: true,
                    ticks: {
                        beginAtZero: true   // minimum value will be 0.
                    }
                }]
            }
        }
    });
}

let chart;
let c = getCookie('modo');
var color;
if(c === 'nocturno'){
    color = '#666';
}else
    color ="white"

function getCookie(nombreCookie) {
    var name = nombreCookie + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

window.onload = function(){
    $( document ).ready(function() {
        if(chart !== undefined)
            chart.destroy()
        $.ajax({
            type: 'POST',
            url: '/admin/estadisticas/cargar',
            data: {elegido: 'Incidencias por hora'},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(result){
                console.log("SUCCESS")
                console.log(result);
                porHora(result)
            },
            error: function (result) {
                console.log("ERROR");
                console.log(result);
            }
        });
    });
    $('#filtro').on('change', function () {
        if(chart !== undefined)
            chart.destroy()
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
                        console.log("hola")
                        break;
                }


            },
            error: function (result) {
                console.log("ERROR");
                console.log(result);
            }
        });
    })

    function porHora(result){
        var ctx = document.getElementById('miGrafico');
        chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'line',

            // The data for our dataset
            data: {
                labels: ['00', '01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16',
                    '17', '18', '19', '20', '21', '22', '23'],
                datasets: [
                    {
                        label: 'Incidencias totales por hora ',

                        borderColor: 'rgb(255,106,94)',
                        backgroundColor: 'rgba(0,0,0,0)',
                        data: [result[0][0].length, result[0][1].length, result[0][2].length, result[0][3].length, result[0][4].length, result[0][5].length,
                            result[0][6].length, result[0][7].length, result[0][8].length, result[0][9].length, result[0][10].length, result[0][11].length,
                            result[0][12].length, result[0][13].length, result[0][14].length, result[0][15].length, result[0][16].length, result[0][17].length,
                            result[0][18].length, result[0][19].length, result[0][20].length, result[0][21].length, result[0][22].length, result[0][23].length],
                        hidden:true
                    },{
                        label: 'Incidencias por hora el ultimo mes',

                        borderColor: 'rgb(143,255,127)',
                        backgroundColor: 'rgba(0,0,0,0)',
                        data: [result[1][0].length, result[1][1].length, result[1][2].length, result[1][3].length, result[1][4].length, result[1][5].length,
                            result[1][6].length, result[1][7].length, result[1][8].length, result[1][9].length, result[1][10].length, result[1][11].length,
                            result[1][12].length, result[1][13].length, result[1][14].length, result[1][15].length, result[1][16].length, result[1][17].length,
                            result[1][18].length, result[1][19].length, result[1][20].length, result[1][21].length, result[1][22].length, result[1][23].length]
                    },{
                        label: 'Incidencias por hora la ultima semana',

                        borderColor: 'rgb(92,145,255)',
                        backgroundColor: 'rgba(0,0,0,0)',
                        data: [result[2][0].length, result[2][1].length, result[2][2].length, result[2][3].length, result[2][4].length, result[2][5].length,
                            result[2][6].length, result[2][7].length, result[2][8].length, result[2][9].length, result[2][10].length, result[2][11].length,
                            result[2][12].length, result[2][13].length, result[2][14].length, result[2][15].length, result[2][16].length, result[2][17].length,
                            result[2][18].length, result[2][19].length, result[2][20].length, result[2][21].length, result[2][22].length, result[2][23].length],
                        hidden:true
                    }]
            },
            // Configuration options go here
            options: {
                legend: {
                    labels: {
                        fontColor: color
                    }
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            fontColor: color
                        }
                    }],
                    xAxes: [{
                        ticks: {
                            fontColor: color
                        }
                    }],
                },
                responsive: true,
                maintainAspectRatio: false
            }
        });
    }

    function porTecnico(result){
        var ctx = document.getElementById('miGrafico');
        chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'horizontalBar',

            // The data for our dataset
            data: {
                labels: [result[0][1],result[1][1],result[2][1],result[3][1],result[4][1],result[5][1],result[6][1],result[7][1],result[8][1],result[9][1]],
                datasets: [{
                    label: 'Tecnicos con mayor Nº de incidencias resueltas',

                    borderColor: 'rgb(255, 99, 132)',
                    data: [result[0][0],result[1][0],result[2][0],result[3][0],result[4][0],result[5][0],result[6][0],result[7][0],result[8][0],result[8][0]]
                }]
            },
            // Configuration options go here
            options: {
                legend: {
                    labels: {
                        fontColor: color
                    }
                },
                responsive: true,
                scales: {
                    xAxes: [{
                        display: true,
                        ticks: {
                            beginAtZero: true,   // minimum value will be 0.
                            fontColor: color
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            fontColor: color
                        }
                    }],
                    responsive: true,
                    maintainAspectRatio: false
                }
            }
        });
    }

    function porProvincia(result){
        var ctx = document.getElementById('miGrafico');
        chart = new Chart(ctx, {
            // El tipo de grafico que vamos a crear
            type: 'doughnut',

            // The data for our dataset
            data: {
                labels: ['Alava','Guipuzcoa','Vizcaya','Navarra'],
                datasets: [{
                    data: [result[0].length, result[1].length, result[2].length, result[3].length],
                    backgroundColor: ['rgb(92,145,255)','rgb(143,255,127)','rgb(255,119,129)','rgb(255,242,133)'],
                }]
            },
            // Configuration options go here
            options: {
                legend: {
                    labels: {
                        fontColor: color
                    }
                },
                responsive: true,
                maintainAspectRatio: false
            }
        });
    }

    function porEstado(result){
        var ctx = document.getElementById('miGrafico');
        chart = new Chart(ctx, {
            // El tipo de grafico que vamos a crear
            type: 'bar',
            // The data for our dataset
            data: {
                labels: ['Terminado','Garaje','En curso'],
                datasets: [{
                    label: 'Estado de las incidencias totales',
                    data: [result[0][0].length, result[0][1].length, result[0][2].length],
                    backgroundColor: ['rgb(159,206,255)','rgb(159,206,255)','rgb(159,206,255)'],
                    hidden:true
                },{
                    label: 'Estado de las incidencias el ultimo mes',
                    data: [result[1][0].length, result[1][1].length, result[1][2].length],
                    backgroundColor: ['rgb(255,162,217)','rgb(255,162,217)','rgb(255,162,217)'],
                },{
                    label: 'Estado de las incidencias la ultima semana',
                    data: [result[2][0].length, result[2][1].length, result[2][2].length],
                    backgroundColor: ['rgb(172,255,122)','rgb(172,255,122)','rgb(172,255,122)'],
                    hidden:true
                }]
            },
            // Configuration options go here
            options: {
                legend: {
                    labels: {
                        fontColor: color
                    }
                },
                responsive: true,
                scales: {
                    xAxes: [{
                        display: true,
                        ticks: {
                            beginAtZero: true,   // minimum value will be 0.
                            fontColor: color
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            fontColor: color
                        }
                    }],

                },
                responsive: true,
                maintainAspectRatio: false
            }
        });
    }

    function porTipo(result){
        var ctx = document.getElementById('miGrafico');
        chart = new Chart(ctx, {
            // El tipo de grafico que vamos a crear
            type: 'pie',

            // The data for our dataset
            data: {
                labels: ['Golpe','Pinchazo','Averia','Otro'],
                datasets: [{
                    data: [result[0].length, result[1].length, result[2].length, result[3].length],
                    backgroundColor: ['rgb(92,145,255)','rgb(172,255,122)','rgb(255,106,94)','rgb(255,252,115)'],
                }]
            },
            // Configuration options go here
            options: {
                legend: {
                    labels: {
                        fontColor: color
                    }
                },
                responsive: true,
                maintainAspectRatio: false
            }
        });
    }

};

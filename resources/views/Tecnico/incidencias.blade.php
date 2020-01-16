<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://kit.fontawesome.com/0ef2ef9810.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>CloudRoad</title>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-3">
            @if($user == 1)
                <div class="d-flex flex-column">
                    <button type="button" class="btn btn-primary my-5"><i class="fas fa-video" ></i> Camaras</button>

                    <div class="list-group">
                        <a href="#" class="list-group-item list-group-item-action "> <i class="fas fa-user-plus"></i> Nuevo usuario</a>
                        <a href="#" class="list-group-item list-group-item-action"><i class="fas fa-chart-bar"></i> Estadisticas</a>
                        <a href="#" class="list-group-item list-group-item-action"><i class="fas fa-users"></i> Datos</a>
                    </div>
                </div>
            @elseif($user == 2)
                <div class="d-flex flex-column">
                    <button type="button" class="btn btn-primary my-5"><i class="fas fa-video" ></i> Camaras</button>
                </div>
            @endif
        </div>
        <div class="col-6 d-flex flex-column">
            <div class="d-flex justify-content-center my-4">
                <button class="btn btn-primary btn-lg btn-block">Nueva Incidencia</button>
            </div>

            <div class="d-flex justify-content-between my-2">
                <h2>Historial</h2>
                <div class="dropdown">
                    <button class="dropdown-toggle btn btn-primary btn-lg" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Filtro</button>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Tipo</a>
                        <a class="dropdown-item" href="#">Estado</a>
                    </div>
                </div>

            </div>
            <div>
                {{--@foreach($incidencias as $incidencia)
                    <div>
                        <h3>{{ $incidencia->tipo }}</h3>
                        <p>{{ $incidencia->descripcion }}</p>
                        <p>{{ $incidencia->estado }}</p>
                    </div>
                @endforeach--}}
            </div>

        </div>

    </div>
</div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>

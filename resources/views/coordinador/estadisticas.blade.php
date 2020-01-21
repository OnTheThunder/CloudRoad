@extends('layouts.layout')

@section('content')
    <div class="row">
        <div class="col-3">
            <div class="d-flex flex-column">
                <button type="button" class="btn btn-primary my-5"><i class="fas fa-video" ></i> Camaras</button>

                <div class="list-group">
                    <a href="#" class="list-group-item list-group-item-action "> <i class="fas fa-user-plus"></i> Nuevo usuario</a>
                    <a href="{{ route('coordinador.estadisticas') }}" class="list-group-item list-group-item-action"><i class="fas fa-chart-bar"></i> Estadisticas</a>
                    <a href="{{ route('coordinador.datos') }}" class="list-group-item list-group-item-action"><i class="fas fa-users"></i> Datos</a>
                </div>
            </div>
        </div>
        <div class="col-6 d-flex flex-column">
            <div class="d-flex justify-content-between my-2">
                <h2>Estadisticas</h2>
                <div class="dropdown">
                    <button class="dropdown-toggle btn btn-primary btn-lg" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Filtro</button>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Incidencias por hora</a>
                        <a class="dropdown-item" href="#">Incidencias de cada tecnico</a>
                        <a class="dropdown-item" href="#">Incidencias por provincia</a>
                        <a class="dropdown-item" href="#">Estado de incidencias</a>
                        <a class="dropdown-item" href="#">Tipo de incidencais</a>
                    </div>
                </div>
            </div>
            <div>
                {{ $chart->container() }}
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
    {!! $chart->script() !!}
@endsection

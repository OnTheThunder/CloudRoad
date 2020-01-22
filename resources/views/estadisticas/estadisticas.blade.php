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
            <div class="row d-flex justify-content-between my-2">
                <h2>Estadisticas</h2>
                <div class="form-group">
                    <select class="form-control" id="filtro">
                        <option>Incidencias por hora</option>
                        <option>Incidencias de cada tecnico</option>
                        <option>Incidencias por provincia</option>
                        <option>Estado de incidencia</option>
                        <option>Tipo de avería</option>
                    </select>
                </div>
            </div>
            <div id="grafico">
                <canvas id="miGrafico"></canvas>
            </div>

        </div>
    </div>
    <script src="{{ secure_asset('js/filtroGrafico.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>


@endsection

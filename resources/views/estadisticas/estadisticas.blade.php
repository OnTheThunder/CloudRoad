@extends('layouts.layout')

@section('content')
    <div class="row">

        @include('usuario.aside')

        <div class="col-md-6 d-flex flex-column">
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
            <div class="card">
                <div class="card-body">
                    <canvas id="miGrafico"></canvas>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ secure_asset('js/filtroGrafico.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>


@endsection

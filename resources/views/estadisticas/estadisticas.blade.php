@extends('layouts.layout')

@section('content')
    <div class="row">

        @include('usuario.aside')
        <div class="col-12 col-lg-8 col-xl-6 offset-xl-1 mt-3 d-flex flex-column">
            <div class="loading-logo-estadisticas">
                <img src="{{asset('images/loading')}}" alt="">
            </div>
            <div class="row d-flex justify-content-between my-2 px-4">
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
            <div class="chart-container w-100">
                <canvas id="miGrafico"></canvas>
            </div>
        </div>
    </div>
    <script src="{{ secure_asset('js/filtroGrafico.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>


@endsection

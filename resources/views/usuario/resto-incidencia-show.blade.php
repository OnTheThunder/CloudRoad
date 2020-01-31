@extends('layouts.layout')

@include('php.funcionesPropias')

@section('content')
    <div class="row">
        @include('usuario.aside')
        <div class="col-12 col-lg-7 col-xl-6 offset-lg-1">
            <div class="d-flex justify-content-center mb-3 mt-5">
                <h2>Incidencia # {{ $incidencia->id }}</h2>
            </div>
            <div>
                <div>
                    <h3>{{ $incidencia->tipo }}</h3>
                    <p>{{ $incidencia->descripcion }}</p>
                </div>
                <div>
                    <h3>Datos Vehiculo</h3>
                    <div class="d-flex datos-show">
                        <p><strong>Matricula: </strong>{{ $vehiculo->matricula }}</p>
                        <p><strong>Marca: </strong>{{ $vehiculo->marca }}</p>
                        <p><strong>Modelo: </strong>{{ $vehiculo->modelo }}</p>
                        <p><strong>Modelo: </strong>{{ $vehiculo->aseguradora }}</p>
                    </div>
                </div>
                <div>
                    <h3>Datos Cliente</h3>
                    <div class="d-flex datos-show">
                        <p><strong>Nombre: </strong>{{ $cliente->nombre }}</p>
                        <p><strong>Telefono: </strong>{{ $cliente->telefono }}</p>
                        <p><strong>Apellidos: </strong>{{ $cliente->apellidos }}</p>
                        <p><strong>DNI: </strong>{{ $cliente->dni }}</p>
                    </div>
                </div>
                @if(!$hideMap)
                <div class="final-map-container">
                    <div id="final-map"></div>
                </div>
                @else
                    <a href="{{route('incidencia.map', ['incidenciaLatitud' => $incidencia->latitud, 'incidenciaLongitud' => $incidencia->longitud, 'idIncidencia' => $incidencia->id])}}" class="btn btn-warning btn-lg btn-block">Reasignar Incidencia</a>
                @endif
                <div class="mt-5">
                    <h3 >Comentarios</h3>
                    @foreach($comentarios as $comentario)
                            <div class="card m-1 shadow my-3">
                                <div class="card-body">
                                    <p class="card-text">{{ $comentario->texto }}</p>
                                    <div class="text-secondary text-right text-monospace font-weight-bolder">Creado
                                        <span class="font-italic font-weight-lighter">
                                    @php
                                        fechaCastellano($comentario->created_at);
                                    @endphp
                                    </span>
                                    </div>
                                </div>
                            </div>

                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @if(!$hideMap)
    <script src="{{ asset('js/mapaTecnico.js') }}"></script>
    @endif
@endsection

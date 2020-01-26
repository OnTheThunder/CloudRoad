@extends('layouts.layout')

@section('content')
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6 d-flex flex-column">
            <div class="d-flex justify-content-center my-2">
                <h2>Incidencia # {{ $incidencia->id }}</h2>
            </div>
            <div>
                <div>
                    <h3 class="d-flex justify-content-center">Datos Incidencia</h3>
                    <h4>{{ $incidencia->tipo }}</h4>
                    <p>{{ $incidencia->descripcion }}</p>
                </div>
                <div>
                    <h3 class="d-flex justify-content-center">Datos Vehiculo</h3>
                    <div class="d-flex justify-content-between">
                        <p><strong>Matricula: </strong>{{ $vehiculo->matricula }}</p>
                        <p><strong>Marca: </strong>{{ $vehiculo->marca }}</p>
                        <p><strong>Modelo: </strong>{{ $vehiculo->modelo }}</p>
                    </div>

                </div>
                <div>
                    <h3 class="d-flex justify-content-center">Datos Cliente</h3>
                    <div class="d-flex justify-content-around">
                        <div>
                            <p><strong>Nombre: </strong>{{ $cliente->nombre }}</p>
                            <p><strong>Telefono: </strong>{{ $cliente->telefono }}</p>
                        </div>
                        <div>
                            <p><strong>Apellidos: </strong>{{ $cliente->apellidos }}</p>
                            <p><strong>DNI: </strong>{{ $cliente->dni }}</p>
                        </div>
                    </div>
                </div>
                <div class="final-map-container">
                    <div id="final-map"></div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/mapaTecnico.js') }}"></script>
@endsection

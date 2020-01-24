@extends('layouts.layout')

@section('content')
    <div class="row">
        <div class="col-3"></div>
        <div class="col-6 d-flex flex-column">
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
                <div id="map-container">
                    <div id="map"></div>
                </div>
            </div>
            <div>
                @if($incidencia->estado != 'En curso')
                @if($tecnico->disponibilidad)
                    <a href="{{ route('tecnico.update', ['id' => $incidencia->tecnico_id])  }}" class="btn btn-success btn-lg btn-block">Aceptar</a>
                    <a href="{{ route('incidencia.update', ['id' => $incidencia->id, 'update' => 'tecnico_id']) }}" class="btn btn-danger btn-lg btn-block">Rechazar</a>
                @else
                    <a href="{{ route('tecnico.update', ['id' => $incidencia->id, 'update' => 'estadoTerminado'])  }}" class="btn btn-success btn-lg btn-block">Finalizado</a>
                    <a href="{{ route('main.index', ['id' => $incidencia->id, 'update' => 'estadoGaraje']) }}" class="btn btn-danger btn-lg btn-block">Finalizado en garaje</a>
                @endif
                @endif
            </div>
        </div>
    </div>
    <script src="{{ asset('js/mapaOperador.js') }}"></script>
@endsection

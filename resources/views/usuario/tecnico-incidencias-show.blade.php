@extends('layouts.layout')
@php
    use Illuminate\Support\Facades\Log;
@endphp
@section('content')
<div class="incidencia-show-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-12 d-flex flex-column">
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
                <div>
                    @if($incidencia->estado == 'En curso' AND $tecnico->disponibilidad == 0 AND $tecnico->notificacion_respondida == 0)
                        <a href="{{ route('tecnico.update', ['idTecnico' => $incidencia->tecnico_id, 'idIncidencia' => $incidencia->id])  }}" class="btn btn-success btn-lg btn-block">Aceptar</a>
                        <a href="{{ route('incidencia.update', ['id' => $incidencia->id]) }}" class="btn btn-danger btn-lg btn-block">Rechazar</a>
                    @elseif($incidencia->estado == 'En curso' AND $tecnico->notificacion_respondida)
                        <a href="{{ route('incidencia.update', ['id' => $incidencia->id, 'estado' => 'Resuelta'])  }}" class="btn btn-success btn-lg btn-block">Finalizado</a>
                        <a href="{{ route('incidencia.update', ['id' => $incidencia->id, 'estado' => 'Garaje']) }}" class="btn btn-danger btn-lg btn-block">Finalizado en garaje</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/mapaTecnico.js') }}"></script>
@endsection

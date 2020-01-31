@extends('layouts.layout')
@php
    use Illuminate\Support\Facades\Log;
@endphp

@include('php.funcionesPropias')

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
                        <h3>{{ $incidencia->tipo }}</h3>
                        <p>{{ $incidencia->descripcion }}</p>
                    </div>
                    <div>
                        <h3>Datos Vehiculo</h3>
                        <div class="d-flex datos-show">
                            <p><strong>Matricula: </strong>{{ $vehiculo->matricula }}</p>
                            <p><strong>Marca: </strong>{{ $vehiculo->marca }}</p>
                            <p><strong>Modelo: </strong>{{ $vehiculo->modelo }}</p>
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
                    <div class="final-map-container">
                        <div id="final-map"></div>
                    </div>
                </div>
                <form class="vista-show-buttons-container" action="{{ route('tecnico.update', ['idTecnico' => $incidencia->tecnico_id, 'idIncidencia' => $incidencia->id]) }}" method="post">
                    @method('POST')
                    @csrf
                    @if($incidencia->estado == 'En curso' AND $tecnico->disponibilidad == 0 AND $tecnico->notificacion_respondida == 0)
                        <button class="btn btn-success btn-lg btn-block">Aceptar</button>
                        <a href="{{ route('incidencia.update', ['id' => $incidencia->id]) }}" class="m-0 btn btn-danger btn-lg btn-block">Rechazar</a>
                    @elseif($incidencia->estado == 'En curso' AND $tecnico->notificacion_respondida)
                        <a href="{{ route('incidencia.update', ['id' => $incidencia->id, 'estado' => 'Resuelta'])  }}" class="m-0 btn btn-success btn-lg btn-block">Finalizado</a>
                        <a href="{{ route('incidencia.update', ['id' => $incidencia->id, 'estado' => 'Garaje']) }}" class="m-0 btn btn-danger btn-lg btn-block">Finalizado en taller</a>
                    @endif
                </form>
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
</div>
<script src="{{ asset('js/mapaTecnico.js') }}"></script>
@endsection

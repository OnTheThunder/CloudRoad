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
                        <div>
                            <p><strong>Matricula: </strong>{{ $vehiculo->matricula }}</p>
                            <p><strong>Marca: </strong>{{ $vehiculo->marca }}</p>
                        </div>
                        <div>
                            <p><strong>Modelo: </strong>{{ $vehiculo->modelo }}</p>
                            <p><strong>Modelo: </strong>{{ $vehiculo->aseguradora }}</p>
                        </div>
                    </div>

                </div>
                <div>
                    <h3 class="d-flex justify-content-center">Datos Cliente</h3>
                    <div class="d-flex justify-content-between">
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
                <div>
                    @foreach($comentarios as $comentario)
                        <a class="mt-3 text-decoration-none text-dark" href="{{ route('incidencia.show', ['id' => $incidencia->id]) }}">
                            <div class="card m-1 shadow">
                                <div class="card-body">
                                    <h3 class="card-title">{{ $incidencia->tipo }}</h3>
                                    <p class="card-text">{{ $incidencia->descripcion }}</p>
                                    <span>Lugar: </span>{{$incidencia->provincia}}
                                    @if($incidencia->estado == 'Resuelta')
                                        <p class="card-footer border text-color-primario font-weight-bold mt-2">Resuelta</p>
                                    @elseif($incidencia->estado == 'Garaje')
                                        <p class="card-footer border text-color-primario font-weight-bold mt-2">Resuelta en taller</p>
                                    @else
                                        <p class="card-footer border text-color-borrar-suave font-weight-bold mt-2">En curso</p>
                                    @endif
                                    <div class="text-secondary text-right text-monospace font-weight-bolder">Creada
                                        <span class="font-italic font-weight-lighter">
                                    @php
                                        fechaCastellano($incidencia->created_at);
                                    @endphp
                                    </span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/mapaTecnico.js') }}"></script>
@endsection

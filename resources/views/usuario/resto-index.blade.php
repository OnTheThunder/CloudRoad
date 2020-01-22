@extends('layouts.layout')

@section('content')
    <div class="row bg-danger fondo">
        <div class="col-3 bg-danger">
            <!-- Aside de cosas que puede hacer -->
            <div class="d-flex flex-column p-2    h-100">
                <a type="button" class="btn btn-primary mb-2" href="{{route('camaras.show')}}">
                    <i class="fas fa-video mr-2"></i>Camaras de tráfico
                </a>
                <div class="list-group">
                    <!-- If de crear usuario -->
                    @if($usuario->rol == 'jefe' || $usuario->rol == 'coordinador')
                        <a href="#" class="list-group-item list-group-item-action bg-color-anyadir-suave">
                            <i class="fas fa-user-plus mr-2"></i>Nuevo usuario</a>
                        <a href="#" class="list-group-item list-group-item-action bg-color-borrar-suave">
                            <i class="fas fa-user-minus mr-2"></i>Dar de baja usuario</a>
                    @endif
                    <a href="{{ route('coordinador.estadisticas') }}"
                       class="list-group-item list-group-item-action bg-color-estadisticas-suave">
                        <i class="fas fa-chart-bar mr-2"></i>Estadisticas</a>
                    <a href="{{ route('coordinador.datos') }}"
                       class="list-group-item list-group-item-action bg-color-datos-suave">
                        <i class="fas fa-users mr-2"></i>Datos</a>
                </div>
            </div>
        </div>

        <!-- Main container de ver historial y filtrar -->
        <div class="col d-flex flex-column mr-2 p-2 bg-warning">
            @if($usuario->rol == 'operario')
                <div class="d-flex justify-content-center">
                    <a href="{{ route('incidencia.create') }}" class="btn btn-primary btn-lg btn-block">
                        <i class="fas fa-plus mr-2"></i>Crear Incidencia
                    </a>
                </div>
            @endif
            <div class="container-fluid">
                <h2 class="d-flex justify-content-center p-2">Historial</h2>
                <div class="row m-1">
                    <div class="col-6">
                        <p>Filtro actual: $filtro</p>
                    </div>
                    <div class="col-6">
                        <div class="dropdown d-flex justify-content-end">
                            <button class="dropdown-toggle btn btn-primary btn-lg" id="navbarDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Filtro
                            </button>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">Tipo</a>
                                <a class="dropdown-item" href="#">Estado</a>
                                <a class="dropdown-item" href="#">fecha fin asc</a>
                                <a class="dropdown-item" href="#">fecha fin desc</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- TODO Meterle paginacion al historial-->

            @foreach($incidencias as $incidencia)
                <a class="mt-3 text-decoration-none text-dark" href="#">
                    <div class="card m-3 shadow">
                        <div class="card-body">
                            <h3 class="card-title">{{ $incidencia->tipo }}</h3>
                            <p class="card-text">{{ $incidencia->descripcion }}</p>
                            <span>Lugar: </span>{{$incidencia->provincia}}
                            @if($incidencia->estado)
                                <p class="card-footer border text-color-primario font-weight-bold mt-2">Resuelta</p>
                            @else
                                <p class="card-footer border text-color-borrar-suave font-weight-bold mt-2">En proceso</p>
                            @endif
                            <div class="text-secondary text-right">Fecha fin "{{$incidencia->updated_at}}"</div>
                        </div>
                    </div>
                </a>
            @endforeach
            <div class="ml-3">
                {{ $incidencias->links() }}
            </div>


        </div>
    </div>
@endsection

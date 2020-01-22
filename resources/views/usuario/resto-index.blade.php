@extends('layouts.layout')

@section('content')
    <div class="row">
    @include('usuario.aside')

    <!-- Main container de ver historial y filtrar -->
        <div class="col d-flex flex-column mr-2 ">
            @if($usuario->rol == 'operario')
                <div class="d-flex justify-content-center">
                    <a href="{{ route('incidencia.create') }}" class="btn btn-primary btn-lg btn-block">
                        <i class="fas fa-plus mr-2"></i>Crear Incidencia
                    </a>
                </div>
            @endif
            <div class="container-fluid border">
                <h2 class="d-flex justify-content-center p-2">Historial de incidencias</h2>
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
                    <div class="card m-1 shadow">
                        <div class="card-body">
                            <h3 class="card-title">{{ $incidencia->tipo }}</h3>
                            <p class="card-text">{{ $incidencia->descripcion }}</p>
                            <span>Lugar: </span>{{$incidencia->provincia}}
                            @if($incidencia->estado)
                                <p class="card-footer border text-color-primario font-weight-bold mt-2">Resuelta</p>
                            @else
                                <p class="card-footer border text-color-borrar-suave font-weight-bold mt-2">En
                                    proceso</p>
                            @endif
                            <div class="text-secondary text-right">Fecha fin "{{$incidencia->updated_at}}"</div>
                        </div>
                    </div>
                </a>
            @endforeach
            <div class="ml-1 mb-5">
                {{ $incidencias->links() }}
            </div>
        </div>
    </div>
@endsection

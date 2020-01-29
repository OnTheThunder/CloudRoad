@extends('layouts.layout')

<!-- IMPORTAR FUNCIONES PROPIAS-->
@include('php.funcionesPropias')

@section('content')
    <div class="fadeIn-wrapper">
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

                <div class="container-fluid pl-0 mb-3">
                    <h2 class="d-flex justify-content-center p-2">Historial de Incidencias</h2>
                    <div class="row">
                        <div class="col-md-12 mb-n1 ml-1 filters-container">
                            <div class="dropdown show">
                                <!--<div class="form-group">
                                    <label>
                                        Buscar por tecnico
                                    </label>
                                    <input name="buscar" class="form-control" type="text">
                                </div>-->
                                <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Filtrar
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <form action="{{route('incidencias.estado')}}" method="get">
                                        <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">Estado</a>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <button class="dropdown-item btn-filtro-resuelta" name="estado"
                                                            value="resuelta">Resuelta
                                                    </button>
                                                </li>
                                                <li>
                                                    <button class="dropdown-item btn-filtro-garaje" name="estado"
                                                            value="taller">Resuelta en Taller
                                                    </button>
                                                </li>
                                                <li>
                                                    <button class="dropdown-item btn-filtro-encurso" name="estado"
                                                            value="en curso">En Curso
                                                    </button>
                                                </li>
                                            </ul>
                                        </li>
                                    </form>
                                    <form action="{{route('incidencias.tipo')}}" method="get">
                                        <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">Tipo
                                                de incidencia</a>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <button class="dropdown-item" name="tipo" value="Pinchazo">
                                                        Pinchazo
                                                    </button>
                                                </li>
                                                <li>
                                                    <button class="dropdown-item" name="tipo" value="Golpe">Golpe
                                                    </button>
                                                </li>
                                                <li>
                                                    <button class="dropdown-item" name="tipo" value="Averia">Avería
                                                    </button>
                                                </li>
                                                <li>
                                                    <button class="dropdown-item" name="tipo" value="Otro">Otro</button>
                                                </li>
                                            </ul>
                                        </li>
                                    </form>
                                </ul>
                            </div>
                            @if(isset($filtro))
                                <form action="{{route('main.index')}}" method="get">
                                    <a href="#" id="btn-filtro-actual" class="btn btn-primary">
                                        {{ucfirst($filtro)}}
                                        <button id="cross-remove-filtro"><i class="fas fa-times"></i></button>
                                    </a>
                                </form>
                            @endif
                            <form class="leyenda-filtro-default" action="{{route('main.index')}}" method="get">
                                <button>
                                    @if(session('orden') == 'reciente' || !session('orden'))
                                        <span>Más Recientes...</span>
                                        <i class="fas fa-sort-amount-up-alt"></i>
                                        <input type="hidden" name="orden" value="antigua">
                                    @elseif(session('orden') == 'antigua')
                                        <span>Más Antiguas...</span>
                                        <i class="fas fa-sort-amount-down-alt"></i>
                                        <input type="hidden" name="orden" value="reciente">
                                    @endif
                                </button>
                            </form>
                        </div>
                    </div>
                </div>


                @foreach($incidencias as $incidencia)
                    <a class=" text-decoration-none text-dark"
                       href="{{ route('incidencia.show', ['id' => $incidencia->id]) }}">
                        <div class="mb-1 card shadow">
                            <div class="card-body">
                                <span class="card-title h3 clearfix">{{ $incidencia->tipo }}: </span>
                                <span class="float-right text-secondary lugar">Lugar: <span
                                        class="text-primary font-weight-bolder">{{$incidencia->provincia}}</span></span>
                                <p class="m-2 card-footer border">{{ $incidencia->descripcion }}</p>
                                @if($incidencia->estado == 'Resuelta')
                                    <p class="row flex-row flex-wrap  font-weight-bold ml-1 mr-1 card-pie">
                                    <span class="text-color-primario col-md-4">
                                        Resuelta
                                      </span>
                                        <small
                                            class="text-secondary d-flex justify-content-end text-monospace font-weight-bolder fecha col-md-8">
                                            Creada:
                                            <span class="font-italic">
                                                @php
                                                    fechaCastellano($incidencia->created_at);
                                                @endphp
                                                </span>
                                        </small>
                                    </p>
                                @elseif($incidencia->estado == 'Garaje')
                                    <p class="row flex-row flex-wrap border-0 font-weight-bold ml-1 mr-1 card-pie">
                                        <span class="text-color-primario col-md-4">
                                            Resuelta en taller
                                            </span>
                                        <small
                                            class="text-secondary d-flex justify-content-end text-monospace font-weight-bolder fecha col-md-8">
                                            Creada:
                                            <span class="font-italic">
                                                @php
                                                    fechaCastellano($incidencia->created_at);
                                                @endphp
                                                </span>
                                        </small>
                                    </p>
                                @else
                                    <p class="row flex-row flex-wrap font-weight-bold ml-1 mr-1 card-pie">
                                         <span class="text-color-borrar-suave col-md-4">
                                        En curso
                                            </span>
                                        <small
                                            class="text-secondary d-flex justify-content-end text-monospace font-weight-bolder fecha col-md-8">

                                            Creada:

                                            <span class="font-italic">
                                                @php
                                                    fechaCastellano($incidencia->created_at);
                                                @endphp
                                                </span>
                                        </small>
                                    </p>
                                @endif
                            </div>
                        </div>
                    </a>
                @endforeach
                <div class="mb-5 mt-3 paginacion">
                    {{ $incidencias->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

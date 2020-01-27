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

                <div class="container-fluid pl-0">
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
                                <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Filtrar
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <form action="{{route('incidencias.estado')}}" method="get">
                                        <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">Estado</a>
                                            <ul class="dropdown-menu">
                                                <li><button class="dropdown-item btn-filtro-resuelta" name="estado" value="resuelta">Resuelta</button></li>
                                                <li><button class="dropdown-item btn-filtro-garaje" name="estado" value="taller">Resuelta en Taller</button></li>
                                                <li><button class="dropdown-item btn-filtro-encurso" name="estado" value="en curso">En Curso</button></li>
                                            </ul>
                                        </li>
                                    </form>
                                    <form action="{{route('incidencias.tipo')}}" method="get">
                                        <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">Tipo de incidencia</a>
                                            <ul class="dropdown-menu">
                                                <li><button class="dropdown-item" name="tipo" value="Pinchazo">Pinchazo</button></li>
                                                <li><button class="dropdown-item" name="tipo" value="Golpe">Golpe</button></li>
                                                <li><button class="dropdown-item" name="tipo" value="Averia">Avería</button></li>
                                                <li><button class="dropdown-item" name="tipo" value="Otro">Otro</button></li>
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


                @foreach($incidenciasRechazadas as $incidenciaRechazada)
                    <a class="mt-3 text-decoration-none text-dark" href="{{ route('incidencia.show', ['id' => $incidenciaRechazada->id]) }}">
                        <div class="card m-1 shadow">
                            <div class="card-body">
                                <h3 class="card-title">{{ $incidenciaRechazada->tipo }}</h3>
                                <p class="card-text">{{ $incidenciaRechazada->descripcion }}</p>
                                <span>Lugar: </span>{{$incidenciaRechazada->provincia}}
                                @if($incidenciaRechazada->estado == 'Resuelta')
                                    <p class="card-footer border text-color-primario font-weight-bold mt-2">Resuelta</p>
                                @elseif($incidenciaRechazada->estado == 'Garaje')
                                    <p class="card-footer border text-color-primario font-weight-bold mt-2">Resuelta en taller</p>
                                @else
                                    <p class="card-footer border text-color-borrar-suave font-weight-bold mt-2">En curso</p>
                                @endif
                                <div class="text-secondary text-right text-monospace font-weight-bolder">Creada
                                    <span class="font-italic font-weight-lighter">
                                    @php
                                        fechaCastellano($incidenciaRechazada->created_at);
                                    @endphp
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
                <div class="mb-5 mt-3 paginacion">
                    {{ $incidenciasRechazadas->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.layout')

<!-- IMPORTAR FUNCIONES PROPIAS-->
@include('php.funcionesPropias')

@section('content')
    <div class="fadeIn-wrapper">
        <div class="row">
        @include('usuario.aside')
        @if(isset($filtro))
            @php $column = "col-12" @endphp
        @else
            @php $column = "col-6" @endphp
        @endif
        <!-- Main container de ver historial y filtrar -->
            <div class="col col-lg-8 d-flex flex-column mr-2">
                @if($usuario->rol == 'operario')
                    <div class="d-flex justify-content-center">
                        <a href="{{ route('incidencia.create') }}" class="btn btn-primary btn-lg btn-block my-4 col-sm-4 col-md-3">
                            <i class="fas fa-plus mr-2"></i>Crear Incidencia
                        </a>
                    </div>
                @endif

                <div class="container mb-3">
                    <h2 class="d-flex justify-content-center p-2 mt-4 mb-3 page-title">Historial de Incidencias</h2>
                    <div class="row">
                        <div class="row col-md-12 mb-n1 filters-container pr-0">
                            <div class="{{$column}} col-sm-6 dropdown show">
                                <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Filtrar
                                </a>
                                @if(isset($filtro))
                                    <form class="d-inline-block" action="{{route('main.index')}}" method="get">
                                        <a href="#" id="btn-filtro-actual" class="btn btn-primary">
                                            {{ucfirst($filtro)}}
                                            <button id="cross-remove-filtro"><i class="fas fa-times"></i></button>
                                        </a>
                                    </form>
                                @endif
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
                            <form class="{{$column}} col-sm-6 pr-0 d-flex justify-content-end align-items-end leyenda-filtro-default mt-2" action="{{route('main.index')}}" method="get">
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

                <div class="container incidencias-container">
                {{-- Crear 1 row cada 2 cards--}}
                @php $i = 0 @endphp
                @foreach($incidencias as $incidencia)
                    @if($i == 0 || $i%2 == 0)
                        <div class="row">
                    @endif
                    <div class="col-xl-6">
                        <a class="text-decoration-none text-dark"
                           href="{{ route('incidencia.show', ['id' => $incidencia->id]) }}">
                            <div class="container mb-4 card shadow card-incidencia d-flex align-items-center justify-content-center">
                                <div class="w-100">
                                    <span class="card-title h4 clearfix">#{{$incidencia->id}} {{ $incidencia->tipo }}: </span>
                                    <div class="lugar-label-container d-flex justify-content-center align-items-center">
                                        <span id="lugar-label" class="text-secondary lugar">Lugar:
                                        <span class="text-color-primario font-weight-bolder">{{$incidencia->provincia}}</span></span>
                                    </div>
                                    <p class="my-2 card-footer border">{{ $incidencia->descripcion }}</p>
                                    @if($incidencia->estado == 'Resuelta')
                                        <p class="row flex-row flex-wrap font-weight-bold m-0 justify-content-between">
                                        <span class="text-color-primario col-5 estado-label px-0">
                                            Resuelta
                                          </span>
                                            <small
                                                class="text-secondary d-flex justify-content-end text-monospace font-weight-bolder fecha pr-0 align-items-center col-7 date-label">
                                                <span class="font-italic">
                                                    @php
                                                        fechaCastellano($incidencia->created_at);
                                                    @endphp
                                                    </span>
                                            </small>
                                        </p>
                                    @elseif($incidencia->estado == 'Garaje')
                                        <p class="row flex-row flex-wrap border-0 font-weight-bold m-0 justify-content-between">
                                            <span class="text-color-primario col-5 estado-label px-0">
                                                Resuelta en taller
                                                </span>
                                            <small
                                                class="text-secondary d-flex justify-content-end text-monospace font-weight-bolder fecha pr-0 align-items-center col-7 date-label">
                                                <span class="font-italic">
                                                    @php
                                                        fechaCastellano($incidencia->created_at);
                                                    @endphp
                                                    </span>
                                            </small>
                                        </p>
                                    @else
                                        <p class="row flex-row flex-wrap font-weight-bold m-0 justify-content-between">
                                             <span class="text-color-borrar-suave col-5 estado-label px-0">
                                            En curso
                                                </span>
                                            <small
                                                class="text-secondary d-flex justify-content-end text-monospace font-weight-bolder fecha pr-0 align-items-center col-7 date-label">
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
                    </div>
                    @if($i%2 != 0)
                        </div>
                    @endif
                    @php $i++ @endphp
                @endforeach
                </div>
                <div class="mb-5 mt-3 paginacion">
                    {{ $incidencias->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

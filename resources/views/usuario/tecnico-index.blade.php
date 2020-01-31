@extends('layouts/layout')
@php
    use Illuminate\Support\Facades\Log;
@endphp
<!-- IMPORTAR FUNCIONES PROPIAS-->
@include('php.funcionesPropias')
@section('content')
    <div class="row">
        <div class="col d-flex flex-column mr-2">
            <div class="container mb-3">
                <h2 class="d-flex justify-content-center p-2">Mis Incidencias</h2>
                <div class="row">
                    <div class="col-md-12 mb-n1 ml-1 filters-container">
                        <div class="dropdown show">
                            <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Filtrar
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <form action="{{route('incidencias.tecnico.estado', ['id' => $tecnicoId])}}" method="get">
                                    <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">Estado</a>
                                        <ul class="dropdown-menu">
                                            <li><button class="dropdown-item btn-filtro-resuelta" name="estado" value="resuelta">Resuelta</button></li>
                                            <li><button class="dropdown-item btn-filtro-garaje" name="estado" value="taller">Resuelta en Taller</button></li>
                                            <li><button class="dropdown-item btn-filtro-encurso" name="estado" value="en curso">En Curso</button></li>
                                        </ul>
                                    </li>
                                </form>
                                <form action="{{route('incidencias.tecnico.tipo', ['id' => $tecnicoId])}}" method="get">
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

            @if(count($incidencias) == 0)
                <div class="container d-flex flex-column sin-incidencias">
                    <h1 class="jumbotron-heading">Aún no tienes incidencias</h1>
                    <p class="lead text-muted">En cuanto recibas una incidencia aparecerá aquí</p>
                </div>
            @endif

            <div class="container incidencias-container">
            {{-- Crear 1 row cada 2 cards--}}
            @php $i = 0 @endphp
            @foreach($incidencias as $incidencia)
                @if($i == 0 || $i%2 == 0)
                    <div class="row">
                @endif
                <div class="col-xl-6">
                @php $incidenciasEnPagUno = count($incidencias) >= 15 ? 15 : count($incidencias) @endphp <!-- Para calcular cuantas paginas quedarán en la primera pag y poder mostrar la notificacion en la tarjeta correcta -->
                <a class="text-decoration-none text-dark" href="{{ route('incidencia.show', ['id' => $incidencia->id]) }}">
                <!-- Si tenemos una notificacion estilizamos la incidencia mas reciente que nos han asignado -->
                @if($incidencia->estado == 'En curso' AND isset($notificacion) AND $notificacion == 1 AND count($incidencias) - $incidenciasEnPagUno == $i) <!-- Asignar a la ultima incidencia la notificacion -->
                    <div class="mb-4 card shadow card-incidencia card-incidencia-nueva">
                        <div class="nueva-incidencia-container">
                            <div class="glow"></div>
                        </div>
                @else
                    <div class="mb-4 card shadow card-incidencia">
                @endif
                        <div class="card-body">
                            <span class="card-title h4 clearfix">#{{$incidencia->id}} {{ $incidencia->tipo }}: </span>
                            <span id="lugar-label" class="text-secondary lugar">Lugar: <span
                                    class="text-color-primario font-weight-bolder">{{$incidencia->provincia}}</span></span>
                            <p class="my-2 card-footer border">{{ $incidencia->descripcion }}</p>
                            @if($incidencia->estado == 'Resuelta')
                                <p class="row flex-row flex-wrap font-weight-bold ml-1 mr-1 card-pie justify-content-between">
                                    <span class="text-color-primario col-md-3 col-5 estado-label  px-0">
                                        Resuelta
                                    </span>
                                    <small
                                        class="text-secondary d-flex justify-content-end text-monospace font-weight-bolder fecha pr-0 align-items-center col-md-9 col-7 date-label">

                                        <span class="font-italic">
                                        @php
                                            fechaCastellano($incidencia->created_at);
                                        @endphp
                                        </span>
                                    </small>
                                </p>
                            @elseif($incidencia->estado == 'Garaje')
                                <p class="row flex-row flex-wrap border-0 font-weight-bold ml-1 mr-1 card-pie justify-content-between">
                                    <span class="text-color-primario col-md-3 col-5 estado-label  px-0">
                                        Resuelta en taller
                                    </span>
                                    <small
                                        class="text-secondary d-flex justify-content-end text-monospace font-weight-bolder fecha pr-0 align-items-center col-md-9 col-7 date-label">

                                    <span class="font-italic">
                                    @php
                                        fechaCastellano($incidencia->created_at);
                                    @endphp
                                    </span>
                                    </small>
                                </p>
                            @else
                                <p class="row flex-row flex-wrap font-weight-bold ml-1 mr-1 card-pie justify-content-between">
                                    <span class="text-color-borrar-suave col-md-3 col-5 estado-label  px-0">
                                    En curso
                                    </span>
                                    <small
                                        class="text-secondary d-flex justify-content-end text-monospace font-weight-bolder fecha pr-0 align-items-center col-md-9 col-7 date-label">
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

@endsection

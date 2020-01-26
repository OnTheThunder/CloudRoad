@extends('layouts/layout')
@php
    use Illuminate\Support\Facades\Log;
@endphp
<!-- IMPORTAR FUNCIONES PROPIAS-->
@include('php.funcionesPropias')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col d-flex flex-column mr-2 mt-5">
                <div class="container-fluid pl-0">
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
                            <div class="leyenda-filtro-default">
                                <span>Más Recientes...</span>
                                <i class="fas fa-sort-amount-up-alt"></i>
                            </div>
                        </div>
                    </div>
                </div>
                @php $i = 0 @endphp

                @foreach($incidencias as $incidencia)
                    @php $incidenciasEnPagUno = count($incidencias) >= 5 ? 5 : count($incidencias) @endphp <!-- Para calcular cuantas paginas quedarán en la primera pag y poder mostrar la notificacion en la tarjeta correcta -->
                    <a class="mt-3 text-decoration-none text-dark" href="{{ route('incidencia.show', ['id' => $incidencia->id]) }}">
                    <!-- Si tenemos una notificacion estilizamos la incidencia mas reciente que nos han asignado -->
                    @if($incidencia->estado == 'En curso' AND isset($notificacion) AND $notificacion == 1 AND count($incidencias) - $incidenciasEnPagUno == $i) <!-- Asignar a la ultima incidencia la notificacion -->
                        <div class="card m-1 shadow card-incidencia">
                            <div class="nueva-incidencia-container">
                                <div class="glow"></div>
                                <span>Nueva incidencia</span>
                            </div>
                    @else
                        <div class="card m-1 shadow">
                    @endif
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
                    </a><!--No hacer caso a este error, está bien cerrado-->
                    @php $i++; @endphp
                @endforeach
                <div class="ml-1 mb-5 mt-3">
                    {{ $incidencias->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

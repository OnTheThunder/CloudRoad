@extends('layouts/layout')

@section('content')
    <div class="row">
        <div class="col-3">
            @if($user == 1)
                <div class="d-flex flex-column">
                    <button type="button" class="btn btn-primary my-5"><i class="fas fa-video" ></i> Camaras</button>

                    <div class="list-group">
                        <a href="#" class="list-group-item list-group-item-action "> <i class="fas fa-user-plus"></i> Nuevo usuario</a>
                        <a href="#" class="list-group-item list-group-item-action"><i class="fas fa-chart-bar"></i> Estadisticas</a>
                        <a href="#" class="list-group-item list-group-item-action"><i class="fas fa-users"></i> Datos</a>
                    </div>
                </div>
            @elseif($user == 2)
                <div class="d-flex flex-column">
                    <button type="button" class="btn btn-primary my-5"><i class="fas fa-video" ></i> Camaras</button>
                </div>
            @endif
        </div>
        <div class="col-6 d-flex flex-column">
            <div class="d-flex justify-content-center my-4">
                <button class="btn btn-primary btn-lg btn-block" id="incidencia">Nueva Incidencia <i class="fas fa-bell" id="notificacion"></i></button>
            </div>

            <div class="d-flex justify-content-between my-2">
                <h2>Historial</h2>
                <div class="dropdown">
                    <button class="dropdown-toggle btn btn-primary btn-lg" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Filtro</button>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Tipo</a>
                        <a class="dropdown-item" href="#">Estado</a>
                    </div>
                </div>

            </div>
            <div>
                {{--@foreach($incidencias as $incidencia)
                    <div>
                        <h3>{{ $incidencia->tipo }}</h3>
                        <p>{{ $incidencia->descripcion }}</p>
                        <p>{{ $incidencia->estado }}</p>
                    </div>
                @endforeach--}}
            </div>
        </div>
    </div>
    <script src="{{ asset('js/notificacion.js') }}"></script>
@endsection



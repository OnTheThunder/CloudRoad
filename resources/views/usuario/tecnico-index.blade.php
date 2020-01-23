@extends('layouts/layout')
@section('content')
    <div class="row">
        <div class="d-flex justify-content-between my-2">
            <h2>Historial</h2>
            <div class="dropdown show">
                <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Filtrar
                </a>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <li><a class="dropdown-item" href="#">Estado</a></li>
                    <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">Tipo de incidente</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Pinchazo</a></li>
                            <li><a class="dropdown-item" href="#">Golpe</a></li>
                            <li><a class="dropdown-item" href="#">Avería</a></li>
                            <li><a class="dropdown-item" href="#">Otro</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>

        <div>
            @foreach($incidencias as $incidencia)
                <div>
                    <p>{{ $incidencia->tecnico_id }}</p>
                    <p>{{Auth::user()->id}}</p>
                    <h3>{{ $incidencia->tipo }}</h3>
                    <p>{{ $incidencia->descripcion }}</p>
                    @if($incidencia->estado)
                        <p>Resuelta</p>
                    @else
                        <p>En proceso</p>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
    <script src="{{ asset('js/dropdown-filtros.js') }}"></script>
    <script src="{{ asset('js/notificacion.js') }}"></script>
@endsection

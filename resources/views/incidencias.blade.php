@extends('layouts.layout')

@section('content')
    <div class="row">
        <div class="col-3">
            @include('layouts.aside')
        </div>
        <div class="col-6 d-flex flex-column">
            @if($user == 2)
                <div class="d-flex justify-content-center my-4">
                    <a href="{{ route('incidencia.create') }}" class="btn btn-primary btn-lg btn-block"><i class="fas fa-plus"></i> Crear Incidencia</a>
                </div>
            @elseif($user == 3)
                <div class="d-flex justify-content-center my-4">
                    <a href="" class="btn btn-primary btn-lg btn-block">Nueva Incidencia <i class="fas fa-bell"></i></a>
                </div>
            @endif

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
                @foreach($incidencias as $incidencia)
                    <div>
                        <h3>{{ $incidencia->tipo }}</h3>
                        <p>{{ $incidencia->descripcion }}</p>
                        <p>{{ $incidencia->estado }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @if($user = 3)
        <script src="{{ asset('js/notificacion.js') }}"></script>
    @endif
@endsection



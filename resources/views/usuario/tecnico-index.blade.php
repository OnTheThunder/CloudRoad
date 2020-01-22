@extends('layouts/layout')
@section('content')
    <div class="row">
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

        <div class="incidenciasprueba">
            @foreach($incidencias as $incidencia)
                <div>
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

    <script src="{{ asset('js/notificacion.js') }}"></script>
@endsection

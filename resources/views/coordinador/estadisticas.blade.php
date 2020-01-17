@extends('layouts.layout')

@section('content')
    <div class="row">
        <div class="col-3">
            @include('layouts.aside')
        </div>
        <div class="col-6">
            <div class="d-flex justify-content-between my-4">
                <h2>Estadisticas</h2>
                <a href="{{ route('incidencia.index') }}" class="btn btn-primary">Volver</a>
            </div>
            <div class="dropdown">
                <button class="dropdown-toggle btn btn-primary btn-lg" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Filtro</button>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Tipo</a>
                    <a class="dropdown-item" href="#">Estado</a>
                </div>
            </div>
        </div>
@endsection


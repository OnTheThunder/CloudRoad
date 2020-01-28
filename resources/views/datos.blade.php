@extends('layouts/layout')
@section('content')
    <div class="row">

        @include('usuario.aside')
        <div class="col d-flex flex-column mr-2 ">
            <div class="h1 text-center">
                <label for="selectFiltroDatos" class="col h1">Datos</label>
                <select class="form-control" name="selectFiltro" id="selectFiltroDatos">
                    <option selected="selected" disabled="disabled">Filter</option>
                    <option>Clientes</option>
                    <option>Tecnicos</option>
                    <option>Talleres</option>
                    <option>Operadores</option>
                    <option>Coordinadores</option>
                    <option>Jefes</option>
                </select>
            </div>
            <div class="container overflow-auto">
                <div class="row justify-content-center m-2 mt-5">
                    <table class="col-12 table table-bordered table-striped table-hover overflow-auto"
                           id="tabla-datos">
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/datos.js') }}"></script>
@endsection

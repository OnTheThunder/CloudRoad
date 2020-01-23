@extends('layouts/layout')
@section('content')
    <div class="row">

        @include('usuario.aside')

        <div class="col d-flex flex-column">
            <div class="d-flex flex-row">
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
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered table-striped" id="tabla-datos">
            </table>
        </div>
    </div>
    <script src="{{ asset('js/datos.js') }}"></script>
@endsection

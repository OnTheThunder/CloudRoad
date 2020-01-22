@extends('layouts/layout')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-11">Datos</div>
            <a class="col-md-1 btn btn-primary">Volver</a>
        </div>
        <div class="row">
            <div class="col-md-12">
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
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered" id="tabla-datos">
                </table>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/datos.js') }}"></script>
@endsection

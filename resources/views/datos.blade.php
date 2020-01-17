@extends('layouts/layout')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <!--include('')-->
            </div>
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-6">Datos</div>
                    <a class="col-md-6 btn-primary">Volver</a>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <select name="selectFiltro" id="selectFiltro">
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
                        <table>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

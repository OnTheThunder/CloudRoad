@extends('layouts.layout')

@section('content')
    <div class="row">
        <div class="col-3"></div>
        <div class="col-6">
            <div class="d-flex justify-content-between my-4">
                <h2>Nueva Incidencia</h2>
                <a href="{{ route('incidencia.index') }}" class="btn btn-primary">Volver</a>
            </div>
            <div>
                <form action="{{ route('incidencia.map') }}" method="get"> <!--class="needs-validation" novalidate>-->
                    <h3>Datos Cliente</h3>
                    <div class="form-group row">
                        <div class="col">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                            <div class="invalid-feedback">
                                Hay que introducir un nombre.
                            </div>
                        </div>
                        <div class="col">
                            <label for="apellidos">Apellidos</label>
                            <input type="text" class="form-control" id="apellidos" name="apellidos" required>
                            <div class="invalid-feedback">
                                Hay que introducir los apellidos.
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col">
                            <label for="telefono">Teléfono</label>
                            <input type="text" class="form-control" id="telefono" name="telefono" required>
                            <div class="invalid-feedback">
                                Hay que introducir un teléfono.
                            </div>
                        </div>
                        <div class="col">
                            <label for="dni">DNI</label>
                            <input type="text" class="form-control" id="dni" name="dni" required>
                            <div class="invalid-feedback">
                                Hay que introducir un DNI.
                            </div>
                        </div>
                    </div>
                    <h3>Datos Vehículo</h3>
                    <div class="form-group row">
                        <div class="col">
                            <label for="marca">Marca</label>
                            <input type="text" class="form-control" id="marca" name="marca" required>
                            <div class="invalid-feedback">
                                Hay que introducir una marca.
                            </div>
                        </div>
                        <div class="col">
                            <label for="modelo">Modelo</label>
                            <input type="text" class="form-control" id="modelo" name="modelo" required>
                            <div class="invalid-feedback">
                                Hay que introducir un modelo.
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col">
                            <label for="matricula">Matrícula</label>
                            <input type="text" class="form-control" id="matricula" name="matricula" required>
                            <div class="invalid-feedback">
                                Hay que introducir una matrícula.
                            </div>
                        </div>
                        <div class="col">
                            <label for="aseguradora">Aseguradora</label>
                            <input type="text" class="form-control" id="aseguradora" name="aseguradora" required>
                            <div class="invalid-feedback">
                                Hay que introducir una aseguradora.
                            </div>
                        </div>
                    </div>
                    <h3>Datos Incidencia</h3>
                    <div class="form-group row">
                        <div class="col">
                            <label for="tipo">Tipo</label>
                            <select class="form-control" id="tipo" name="tipo">
                                <option selected disabled>Selecciona el tipo de Avería</option>
                                <option>Avería</option>
                                <option>Pinchazo</option>
                                <option>Golpe</option>
                                <option>Otros</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col">
                            <label for="descripcion">Descripción</label>
                            <textarea class="form-control" id="descripcion" rows="3" name="descripcion" required></textarea>
                            <div class="invalid-feedback">
                                Hay que introducir una descripción.
                            </div>
                        </div>
                    </div>
                    <button id="btn-crear-incidencia" type="submit" class="btn btn-primary btn-lg btn-block">Crear</button>
                </form>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/validacionForm.js') }}"></script>
    <script src="{{ asset('js/formOperador.js') }}"></script>
@endsection

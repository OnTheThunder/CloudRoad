@extends('layouts/layout')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-3">Nuevo usuario</div>
            <a class="btn btn-primary col-md-3">Volver</a>
        </div>
        <div class="row justify-content-center">
            <form class="user-create-form col-md-6">
                <div class="form-group">
                    <label for="exampleInputName">Nombre</label>
                    <input type="text" class="form-control" id="exampleInputName" placeholder="Enter Name">
                </div>
                <div class="form-group">
                    <label for="exampleInputApellido">Apellido</label>
                    <input type="text" class="form-control" id="exampleInputApellido" placeholder="Enter Surname">
                </div>
                <div class="form-group">
                    <label for="exampleInputTelefono">Telefono</label>
                    <input type="number" class="form-control" id="exampleInputTelefono" placeholder="Enter Phone Number">
                </div>
                <div class="form-group">
                    <label for="exampleInputDni">DNI</label>
                    <input type="number" class="form-control" id="exampleInputDni" placeholder="Enter DNI">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <div class="form-group">
                    <label for="rolSelect">Selecciona su rol</label>
                    <select class="form-control" id="rolSelect">
                        <option>Jefe</option>
                        <option>Coordinador</option>
                        <option>Técnico</option>
                        <option>Operador</option>
                    </select>
                </div>
            </form>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <button class="btn btn-primary float-right">Enviar</button>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/newUserForm.js') }}"></script>
@endsection

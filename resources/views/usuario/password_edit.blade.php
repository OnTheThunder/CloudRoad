@extends('layouts/layout')
@section('content')

    <div class="row">
        @if(app('request')->input('resultado') == "0")
            <div class="col-12">
                <div class="alert alert-danger" role="alert">
                    Error en el cambio de contraseña
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        @endif
        @if(app('request')->input('resultado') == "1")
            <div class="col-12">
                <div class="alert alert-success" role="alert">
                    Contraseña cambiada correctamente
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        @endif

        @include('usuario.aside')
        <div class="col d-flex flex-column mr-2 ">
            <div class="h1 text-center">Cambiar contraseña</div>
            <div class="row ">
                <form class="col-12" method="post" action="{{route('usuario.update')}}">
                    @csrf
                    <input name="modo" value="password" hidden>
                    <div class="col-12 ">
                        <div class="form-group">
                            <label for="contra1">Contraseña actual</label>
                            <input name="contra1" class="form-control" type="password" id="contra1" required>
                        </div>
                        <div class="form-group">
                            <label for="contra2">Repetir contraseña actual</label>
                            <input name="contra2" class="form-control" type="password" id="contra2" required>
                            <span id='message'></span>
                        </div>
                        <div class="form-group">
                            <label for="nuevaContra">Nueva Contraseña</label>
                            <input name="nuevaContra" class="form-control" type="password" id="nuevaContra" required>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <button class="btn btn-primary justify-content-center disabled" id="changepassword">Enviar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="{{secure_asset('js/password.js')}}"></script>

@endsection

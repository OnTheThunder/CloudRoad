<!-- Aside de navegacion usuario -->
<div class="col-12 col-lg-3 bg-color-body border-right">
    <div class="d-flex flex-column p-2  sticky-top mt-4">
        <a type="button" class="btn btn-primary mb-2" href="{{route('camaras.show')}}">
            <i class="fas fa-video mr-2"></i>Camaras de tráfico
        </a>
        <div class="list-group">
            @if($usuario->rol == 'operario')
                <a href="{{ route('incidencia.rechazadas') }}"
                   class="list-group-item list-group-item-action text-color-borrar-suave bg-color-cards">
                    <i class="fas fa-ban mr-2"></i>Incidencias rechazadas</a>
            @endif
            <a href="{{route('main.index')}}" class="list-group-item list-group-item-action text-white bg-color-cards">
                <i class="fas fa-user mr-2"></i>Historial incidencias</a>
            <!-- If de crear usuario -->
            @if($usuario->rol == 'jefe' || $usuario->rol == 'coordinador' && Auth::user()->email != 'prueba@prueba.com')
                <a href="{{route('usuario.create')}}" class="list-group-item list-group-item-action text-color-anyadir-suave bg-color-cards">
                    <i class="fas fa-user-plus mr-2"></i>Nuevo usuario</a>
                <a href="{{route('usuario.baja.edit')}}" class="list-group-item list-group-item-action text-color-borrar-suave bg-color-cards">
                    <i class="fas fa-user-minus mr-2"></i>Alta/baja usuario</a>
            @endif
            <a href="{{ route('coordinador.estadisticas') }}"
               class="list-group-item list-group-item-action text-color-estadisticas-suave bg-color-cards">
                <i class="fas fa-chart-bar mr-2"></i>Estadisticas</a>
            <a href="{{ route('coordinador.datos') }}"
               class="list-group-item list-group-item-action text-color-datos-suave bg-color-cards">
                <i class="fas fa-users mr-2"></i>Datos</a>
        </div>
        <div class="d-none d-sm-flex justify-content-center text-decoration-none">
            <a href="#" class="scroll-top d-none" title="Ir arriba">
                <i class="fas fa-arrow-up shadow bg-color-dark mt-3 p-3 rounded-circle text-color-primario"></i>
            </a>
        </div>
    </div>
</div>
<script src="{{secure_asset('js/aside.js')}}"></script>

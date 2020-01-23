<!-- Aside de navegacion usuario -->
<div class="col-12 col-md-3 ">
    <div class="d-flex flex-column p-2 bg-white">
        <a type="button" class="btn btn-primary mb-2" href="{{route('camaras.show')}}">
            <i class="fas fa-video mr-2"></i>Camaras de tráfico
        </a>
        <div class="list-group">
            <a href="{{route('main.index')}}" class="list-group-item list-group-item-action text-white bg-secondary">
                <i class="fas fa-user mr-2"></i>Historial incidencias</a>
            <!-- If de crear usuario -->
            @if($usuario->rol == 'jefe' || $usuario->rol == 'coordinador')
                <a href="#" class="list-group-item list-group-item-action text-color-anyadir-suave bg-secondary">
                    <i class="fas fa-user-plus mr-2"></i>Nuevo usuario</a>
                <a href="#" class="list-group-item list-group-item-action text-color-borrar-suave bg-secondary">
                    <i class="fas fa-user-minus mr-2"></i>Dar de baja usuario</a>
            @endif
            <a href="{{ route('coordinador.estadisticas') }}"
               class="list-group-item list-group-item-action text-color-estadisticas-suave bg-secondary">
                <i class="fas fa-chart-bar mr-2"></i>Estadisticas</a>
            <a href="{{ route('coordinador.datos') }}"
               class="list-group-item list-group-item-action text-color-datos-suave bg-secondary">
                <i class="fas fa-users mr-2"></i>Datos</a>
        </div>
    </div>
</div>

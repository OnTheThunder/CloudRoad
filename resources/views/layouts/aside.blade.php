<div class="d-flex flex-column">
    @if(Auth::user()->rol != 'tecnico')

        <button type="button" class="btn btn-primary my-5"><i class="fas fa-video"></i> Camaras</button>
    @endif
    @if(Auth::user()->rol == 'jefe'||Auth::user()->rol == 'coordinador')
        <div class="list-group">
            <a href="#" class="list-group-item list-group-item-action "> <i class="fas fa-user-plus"></i> Nuevo usuario</a>
            <a href="#" class="list-group-item list-group-item-action"><i class="fas fa-chart-bar"></i> Estadisticas</a>
            <a href="#" class="list-group-item list-group-item-action"><i class="fas fa-users"></i> Datos</a>
        </div>
    @endif
</div>

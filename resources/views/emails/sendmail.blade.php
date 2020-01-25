<p>Hola {{$nombreTecncico}},</p>
<p>Se le ha asignado una nueva incidencia.</p>
<p>Un {{$vehiculoMarca}} {{$vehiculoModelo}} con matrícula {{$vehiculoMatricula}} ha sufrido un incidente</p>
<div>
    <a href="{{asset('/incidencias/' . $idIncidencia)}}">Acceda a la aplicacion</a> para consultar los detalles.
</div>
<br><br>
<p>Un saludo del equipo OnTheThunder,</p>
<img src="{{(asset('images/onTheThunderMin.png'))}}">







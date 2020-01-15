<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible">
    <title>CloudRoad</title>
</head>
<body>

{{$vehiculos}}

<div>
    <form method="post" action="{{route('vehiculo.store')}}">
        @csrf
        <label>Matricula<input type="text" name="matricula"></label><br>
        <label>Modelo<input type="text" name="modelo"></label><br>
        <label>Marca<input type="text" name="marca"></label><br>
        <label>Aseguradora<input type="text" name="aseguradora"></label><br>
        <label>id_cliente<input type="text" name="cliente_id" disabled value="1"></label><br>
        <button type="submit">Guardar</button>
    </form>
</div>

</body>
</html>

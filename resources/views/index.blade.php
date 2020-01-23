@extends('layouts.layout')

<!-- Index principal; Aqui se diferencia los dos tipos de pantallas para tecnico, y el resto (y ya en cada una de ellas se ponen sus ifs)

Hay variables de prueba para que no casque, que estan copiadas de incidencias.blade
-->
@if(Auth::user()->rol == 'tecnico')
    @include('usuario.tecnico-index',['user'=>1,'incidencias'=>[]])
    tecnico
@else
    @include('usuario.resto-index',['user'=>1,'incidencias'=>[]])
    resto
@endif

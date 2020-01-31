<?php
function fechaCastellano($fecha)
{
    $fecha2 = substr($fecha, 0, 10);
    $numeroDia = date('d', strtotime($fecha2));
    $dia = date('l', strtotime($fecha2));
    $mes = date('F', strtotime($fecha2));
    $anio = date('Y', strtotime($fecha2));
    $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
    $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
    $nombredia = str_replace($dias_EN, $dias_ES, $dia);
    $meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
    $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
    $nombreMes = str_replace($meses_EN, $meses_ES, $mes);

    //Get numero mes
    $diaMes = array_search($mes, $meses_EN) + 1;
    if($diaMes < 10){
        $diaMes = "0" . $diaMes;
    }

    echo $numeroDia . "/" . $diaMes . "/" . $anio . " " . substr($fecha, 11, strlen($fecha));
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    public function cliente()
    {
        return $this->hasOne('App\Cliente');
    }
    public function Incidencia()
    {
        return $this->belongsTo('App\Incidencia');
    }
}

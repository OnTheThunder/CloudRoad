<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{

    public function incidencias()
    {
        return $this->hasMany('App\Incidencia');
    }

    public function vehiculos()
    {
        return $this->hasMany('App\Vehiculo');
    }
}

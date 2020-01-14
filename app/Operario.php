<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Operario extends Model
{
    public function incidencias()
    {
        return $this->hasMany('App\Incidencia');
    }

    public function usuario()
    {
        return $this->belongsTo('App\Usuario');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class incidencia extends Model
{
    public function comentarios()
    {
        return $this->hasMany('App\Comentario');
    }

    public function cliente()
    {
        return $this->hasOne('App\Cliente');
    }

    public function tecnico()
    {
        return $this->hasOne('App\Tecnico');
    }

    public function operario()
    {
        return $this->hasOne('App\Operario');
    }
    public function vehiculo()
    {
        return $this->hasOne('App\Vehiculo');
    }
}

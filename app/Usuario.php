<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    public function coordinador()
    {
        return $this->hasOne('App\Coordinador');
    }
    public function tecnico()
    {
        return $this->hasOne('App\Tecnico');
    }
    public function operario()
    {
        return $this->hasOne('App\Operario');
    }
}

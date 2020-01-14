<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tecnico extends Model
{
    public function taller()
    {
        return $this->belongsTo('App\Taller');
    }

    public function usuario()
    {
        return $this->belongsTo('App\Usuario');
    }
}

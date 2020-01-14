<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    public function incidencias()
    {
        return $this->belongsTo('App\Incidencia');
    }

}

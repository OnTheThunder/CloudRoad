<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coordinador extends Model
{
    public function usuarios()
    {
        return $this->hasOne('App\Usuario');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coordinador extends Model
{
    protected $table = 'coordinadores';

    public function usuarios()
    {
        return $this->hasOne('App\Usuario');
    }
}

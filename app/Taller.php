<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Taller extends Model
{
    public function tecnicos()
    {
        return $this->hasMany('App\Tecnico');
    }
}

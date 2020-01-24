<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Taller extends Model
{
    protected $table = "talleres";

    public function tecnicos()
    {
        return $this->hasMany('App\Tecnico');
    }
}

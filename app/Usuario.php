<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Kyslik\ColumnSortable\Sortable;


class Usuario extends Authenticatable
{
    use Sortable;
    public $sortable = ['id', 'nombre', 'email', 'rol', 'created_at', 'updated_at'];


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

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [

    ];


}

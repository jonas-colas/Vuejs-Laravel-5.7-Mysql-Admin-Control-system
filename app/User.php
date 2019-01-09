<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
use Illuminate\Notifications\Notifiable;
/*use Illuminate\Foundation\Auth\User as Authenticatable;*/


class User extends Model implements AuthenticatableContract{ 
    use Authenticatable;
    use Notifiable;

    protected $fillable = [
        'id',
        'idrol',
        'name', 
        'usuario', 
        'password',
        'condicion'
    ];
    
    public $timestamps = false;

    protected $hidden = [
        'password', 'remember_token'
    ];

    public function roles(){
        return $this->belongsTo('App\Role');
    }

}

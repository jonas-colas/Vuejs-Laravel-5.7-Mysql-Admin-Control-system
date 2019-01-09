<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    protected $fillable =[
        'id_desarrollo',
        'nombre',
        'foto'
    ];
    public function fotos(){
        return $this->belongsTo('App\Desarrollo');
    }
}

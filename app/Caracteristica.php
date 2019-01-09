<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Caracteristica extends Model
{
    protected $fillable =[
        'id_desarrollo',
        'planta',
        'ambiente_1',
        'ambiente_2',
        'ambiente_3',
        'ambiente_4'
    ];
    public function caracteristicas(){
        return $this->belongsTo('App\Desarrollo');
    }
}

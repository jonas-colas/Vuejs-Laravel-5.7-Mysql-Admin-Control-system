<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Planta extends Model
{
    protected $table = 'plantas';

    protected $fillable =[
        'id_desarrollo',
        'nombre',
        'imagen',
        'pdf'
    ];
    public function plantas(){
        return $this->belongsTo('App\Desarrollo');
    }
}

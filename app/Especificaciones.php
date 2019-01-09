<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Especificaciones extends Model
{
    protected $fillable =[
        'id_desarrollo',
        'Estar_y_Monoambiente',
        'banios',
        'dormitorios',
        'cocinas'
    ];
    
    public function especificaciones(){
        return $this->belongsTo('App\Desarrollo');
    }
}

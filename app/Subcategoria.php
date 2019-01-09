<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subcategoria extends Model
{
    protected $fillable = ['nombre','descripcion','condicion'];

    public function desarrollos()
    {
        return $this->hasMany('App\Desarrollo');
    }
}

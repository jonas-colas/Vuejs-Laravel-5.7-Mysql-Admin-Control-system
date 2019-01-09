<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Desarrollo extends Model
{
    protected $fillable =[
        'idcategoria',
        'idsubcategoria',
        'direccion',
        'precio_por_metro',
        'descripcion',
        'latitud',
        'longitud',
        'detalle_de_entrega',
        'condicion'
    ];

    public function categorias(){
        return $this->belongsTo('App\Categoria');
    }

    public function subcategorias(){
        return $this->belongsTo('App\Subcategoria');
    }

    public function plantas()
    {
        return $this->hasMany('App\Planta');
    }

    public function fotos()
    {
        return $this->hasMany('App\Foto');
    }

    public function caracteristicas()
    {
        return $this->hasMany('App\Caracteristica');
    } 

    public function especificaciones()
    {
        return $this->hasMany('App\Especificacion');
    }
}

<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

/*Las Categorias*/
Route::resource('categoria', 'CategoriaController', ['only' => ['index', 'show']] );

/*Las Subcategorias*/
Route::resource('subcategoria', 'SubcategoriaController', ['only' => ['index', 'show']] );

/*Todos los desarrollos y por un Desarrollo*/
Route::resource('desarrollo', 'DesarrolloController', ['only' => ['index', 'show']] );

/*Especificaciones*/
Route::resource('especificaciones', 'EspecificacionesController', ['only' => ['index']] );

/*Caracteristicas*/
Route::resource('caracteristicas', 'CaracteristicaController', ['only' => ['index']] );

/*Todas las Fotos*/
Route::resource('fotos', 'FotoController', ['only' => ['index']] );

/*Imagenes de las Plantas*/
Route::resource('plantas', 'PlantaController', ['only' => ['index']] );


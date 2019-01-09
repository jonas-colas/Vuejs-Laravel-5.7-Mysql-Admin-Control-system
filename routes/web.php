<?php


Route::group(['middleware'=>['guest']],function(){
    Route::get('','Auth\LoginController@showLoginForm');
    Route::get('login','Auth\LoginController@showLoginForm');
    Route::post('login', 'Auth\LoginController@login')->name('login');
});


Route::group(['middleware'=>['auth']],function(){

	Route::post('logout', 'Auth\LoginController@logout')->name('logout');
	
	Route::get('main', function () {
		return view('contenido/contenido'); 
	})->name('main');

	Route::group(['middleware' => ['Empleado']], function () {

		/*Route::get('todosLosDesarrollos', 'DesarrolloController@index');*/

		Route::get('categoria', 'CategoriaController@index');
		Route::get('categoria/seleccion', 'CategoriaController@show');
		Route::post('categoria/registrar', 'CategoriaController@store');
		Route::put('categoria/actualizar/{id}', 'CategoriaController@update');
		Route::put('categoria/desactivar/{id}', 'CategoriaController@desactivar');
		Route::put('categoria/activar/{id}', 'CategoriaController@activar');

		Route::get('subcategoria', 'SubcategoriaController@index');
		Route::get('subcategoria/seleccion', 'SubcategoriaController@show');
		Route::post('subcategoria/registrar', 'SubcategoriaController@store');
		Route::put('subcategoria/actualizar/{id}', 'SubcategoriaController@update');
		Route::put('subcategoria/desactivar/{id}', 'SubcategoriaController@desactivar');
		Route::put('subcategoria/activar/{id}', 'SubcategoriaController@activar');

		Route::get('desarrollo', 'DesarrolloController@index');
		Route::get('desarrollo/{id}', 'DesarrolloController@show');
		Route::post('desarrollo/registrar', 'DesarrolloController@store');
		Route::put('desarrollo/actualizar/{id}', 'DesarrolloController@update');
		Route::put('desarrollo/desactivar/{id}', 'DesarrolloController@desactivar');
		Route::put('desarrollo/activar/{id}', 'DesarrolloController@activar');
		Route::delete('desarrollo/delete/{id}', 'DesarrolloController@destroy');

		Route::get('especificaciones/{id}', 'EspecificacionesController@index');
		Route::post('especificaciones/registrar', 'EspecificacionesController@store');
		Route::put('especificaciones/actualizar/{id}', 'EspecificacionesController@update');
		Route::delete('especificaciones/borrar/{id}', 'EspecificacionesController@destroy');

		Route::get('caracteristicas/{id}', 'CaracteristicaController@index');
		Route::post('caracteristicas/registrar', 'CaracteristicaController@store');
		Route::put('caracteristicas/actualizar/{id}', 'CaracteristicaController@update');
		Route::delete('caracteristicas/delete/{id}', 'CaracteristicaController@destroy');

		Route::get('fotos/{id}', 'FotoController@index');
		Route::post('fotos/registrar', 'FotoController@store');
		Route::put('fotos/actualizar/{id}', 'FotoController@update');
		Route::delete('fotos/borrar/{id}', 'FotoController@destroy');

		Route::get('plantas/{id}', 'PlantaController@index');
		Route::post('plantas/registrar', 'PlantaController@store');
		Route::put('plantas/actualizar/{id}', 'PlantaController@update');
		Route::delete('plantas/borrar/{id}', 'PlantaController@destroy');
	});
	
	Route::group(['middleware' => ['Administrador']], function () {

		Route::get('role', 'RoleController@index');
		Route::get('role/selectRole', 'RoleController@selectRole');

		Route::get('user', 'UserController@index');
		Route::get('user/seleccion', 'UserController@show');
		Route::post('user/registrar', 'UserController@store');
		Route::put('user/actualizar', 'UserController@update');
		Route::put('user/desactivar', 'UserController@desactivar');
		Route::put('user/activar', 'UserController@activar');
		Route::delete('user/borrar', 'UserController@delete');


		Route::get('/todosLosDesarrollos', 'DesarrolloController@index');

		
		Route::get('categoria', 'CategoriaController@index');
		Route::get('categoria/seleccion', 'CategoriaController@show');
		Route::post('categoria/registrar', 'CategoriaController@store');
		Route::put('categoria/actualizar/{id}', 'CategoriaController@update');
		Route::put('categoria/desactivar/{id}', 'CategoriaController@desactivar');
		Route::put('categoria/activar/{id}', 'CategoriaController@activar');

		Route::get('subcategoria', 'SubcategoriaController@index');
		Route::get('subcategoria/seleccion', 'SubcategoriaController@show');
		Route::post('subcategoria/registrar', 'SubcategoriaController@store');
		Route::put('subcategoria/actualizar/{id}', 'SubcategoriaController@update');
		Route::put('subcategoria/activar/{id}', 'SubcategoriaController@activar');
		Route::put('subcategoria/desactivar/{id}', 'SubcategoriaController@desactivar');

		Route::get('desarrollo', 'DesarrolloController@index');
		Route::get('desarrollo/{id}', 'DesarrolloController@show');
		Route::post('desarrollo/registrar', 'DesarrolloController@store');
		Route::put('desarrollo/actualizar/{id}', 'DesarrolloController@update');
		Route::put('desarrollo/desactivar/{id}', 'DesarrolloController@desactivar');
		Route::put('desarrollo/activar/{id}', 'DesarrolloController@activar');
		Route::delete('desarrollo/delete/{id}', 'DesarrolloController@destroy');

		Route::get('especificaciones/{id}', 'EspecificacionesController@index');
		Route::post('especificaciones/registrar', 'EspecificacionesController@store');
		Route::put('especificaciones/actualizar/{id}', 'EspecificacionesController@update');
		Route::delete('especificaciones/borrar/{id}', 'EspecificacionesController@destroy');


		Route::get('caracteristicas/{id}', 'CaracteristicaController@index');
		Route::post('caracteristicas/registrar', 'CaracteristicaController@store');
		Route::put('caracteristicas/actualizar/{id}', 'CaracteristicaController@update');
		Route::delete('caracteristicas/delete/{id}', 'CaracteristicaController@destroy');

		Route::get('fotos/{id}', 'FotoController@index');
		Route::post('fotos/registrar', 'FotoController@store');
		Route::put('fotos/actualizar/{id}', 'FotoController@update');
		Route::delete('fotos/borrar/{id}', 'FotoController@destroy');

		Route::get('plantas/{id}', 'PlantaController@index');
		Route::post('plantas/registrar', 'PlantaController@store');
		Route::put('plantas/actualizar/{id}', 'PlantaController@update');
		Route::delete('plantas/borrar/{id}', 'PlantaController@destroy');
	});
});


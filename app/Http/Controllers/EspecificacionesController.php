<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Especificaciones;

class EspecificacionesController extends Controller
{
    
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');
        $especificaciones = Especificaciones::join('desarrollos','especificaciones.id_desarrollo','=','desarrollos.id')
        ->select('especificaciones.id','especificaciones.id_desarrollo','especificaciones.Estar_y_Monoambiente','especificaciones.banios','especificaciones.dormitorios','especificaciones.cocinas')->where('especificaciones.id_desarrollo','=',$request->id);
        return $especificaciones->get();       
    }
    
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $datos = new Especificaciones();
        $datos->id_desarrollo = $request->id_desarrollo;
        $datos->Estar_y_Monoambiente = $request->Estar_y_Monoambiente;
        $datos->banios = $request->banios;
        $datos->dormitorios = $request->dormitorios;
        $datos->cocinas = $request->cocinas;
    
        $datos->save();
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $especificaciones = Especificaciones::findOrFail($request->id);
        /*$especificaciones->id_desarrollo = $request->id_desarrollo;*/
        $especificaciones->Estar_y_Monoambiente = $request->Estar_y_Monoambiente;
        $especificaciones->banios = $request->banios;
        $especificaciones->dormitorios = $request->dormitorios;
        $especificaciones->cocinas = $request->cocinas;
       
        $especificaciones->save();
    }

   public function destroy(Request $request)
   {
    if (!$request->ajax()) return redirect('/');
    $especificaciones = Especificaciones::findOrFail($request->id);
    $especificaciones->delete();
   }
}

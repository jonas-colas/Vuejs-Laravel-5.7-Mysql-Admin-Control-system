<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Caracteristica;

class CaracteristicaController extends Controller
{
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');
        $caracteristicas = Caracteristica::join('desarrollos','caracteristicas.id_desarrollo','=','desarrollos.id')->select('caracteristicas.id','caracteristicas.id_desarrollo','caracteristicas.planta','caracteristicas.ambiente_1','caracteristicas.ambiente_2','caracteristicas.ambiente_3','caracteristicas.ambiente_4')->where('caracteristicas.id_desarrollo','=',$request->id);
        /*->where('caracteristicas.id_desarrollo', 4);*/

        return $caracteristicas->get();
    }
    
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $caracteristica = new Caracteristica();
        $caracteristica->id_desarrollo = $request->id_desarrollo;
        $caracteristica->planta = $request->planta;
        $caracteristica->ambiente_1 = $request->ambiente_1;
        $caracteristica->ambiente_2 = $request->ambiente_2;
        $caracteristica->ambiente_3 = $request->ambiente_3;
        $caracteristica->ambiente_4 = $request->ambiente_4;
    
        $caracteristica->save();
    }

    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $caracteristica = Caracteristica::findOrFail($request->id);
        $caracteristica->planta = $request->planta;
        $caracteristica->ambiente_1 = $request->ambiente_1;
        $caracteristica->ambiente_2 = $request->ambiente_2;
        $caracteristica->ambiente_3 = $request->ambiente_3;
        $caracteristica->ambiente_4 = $request->ambiente_4;
       
        $caracteristica->save();
    }

    /*public function destroy(Request $request)
	{
		if (!$request->ajax()) return redirect('/');
	    DB::table('caracteristicas')->where('id', '=', $request->id)->delete();
	}*/

    public function destroy(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $caracteristica = Caracteristica::findOrFail($request->id);
        $caracteristica->delete();
    }
}

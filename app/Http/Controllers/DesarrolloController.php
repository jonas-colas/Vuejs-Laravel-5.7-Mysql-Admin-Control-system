<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Desarrollo;

class DesarrolloController extends Controller
{
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $desarrollos = Desarrollo::join('categorias','desarrollos.idcategoria','=','categorias.id')
            ->join('subcategorias','desarrollos.idsubcategoria','=','subcategorias.id')
            ->select('desarrollos.id','desarrollos.idcategoria','desarrollos.idsubcategoria','desarrollos.direccion','desarrollos.precio_por_metro','categorias.nombre as nombre_categoria','subcategorias.nombre as nombre_subcategoria','desarrollos.descripcion','desarrollos.foto_1','desarrollos.latitud','desarrollos.longitud','desarrollos.detalle_de_entrega','desarrollos.condicion')
            ->orderBy('desarrollos.id', 'asc')->paginate(10);
        }
        else{
            $desarrollos = Desarrollo::join('categorias','desarrollos.idcategoria','=','categorias.id')
            ->join('subcategorias','desarrollos.idsubcategoria','=','subcategorias.id')
            ->select('desarrollos.id','desarrollos.idcategoria','desarrollos.idsubcategoria','desarrollos.direccion','desarrollos.precio_por_metro','categorias.nombre as nombre_categoria','subcategorias.nombre as nombre_subcategoria','desarrollos.descripcion','desarrollos.foto_1','desarrollos.latitud','desarrollos.longitud','desarrollos.detalle_de_entrega','desarrollos.condicion')
            /*->select('desarrollos.id','desarrollos.idcategoria','desarrollos.direccion','desarrollos.precio_por_metro','categorias.nombre as nombre_categoria','desarrollos.descripcion','desarrollos.foto_1','desarrollos.latitud','desarrollos.longitud','desarrollos.detalle_de_entrega','desarrollos.condicion')*/
            ->where('desarrollos.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('desarrollos.id', 'asc')->paginate(10);
        }
        

        return [
            'pagination' => [
                'total'        => $desarrollos->total(),
                'current_page' => $desarrollos->currentPage(),
                'per_page'     => $desarrollos->perPage(),
                'last_page'    => $desarrollos->lastPage(),
                'from'         => $desarrollos->firstItem(),
                'to'           => $desarrollos->lastItem(),
            ],
            'desarrollos' => $desarrollos
        ];
    }

    public function show(Request $request)
    { 
        //if (!$request->ajax()) return redirect('/');
        $desarrollo = Desarrollo::join('categorias','desarrollos.idcategoria','=','categorias.id')
        ->join('subcategorias','desarrollos.idsubcategoria','=','subcategorias.id')
        ->select('desarrollos.id','desarrollos.idcategoria','desarrollos.idsubcategoria','desarrollos.direccion','desarrollos.precio_por_metro','categorias.nombre as nombre_categoria','subcategorias.nombre as nombre_subcategoria','desarrollos.descripcion'/*,'desarrollos.foto_1','desarrollos.foto_section'*/,'desarrollos.latitud','desarrollos.longitud','desarrollos.detalle_de_entrega','desarrollos.condicion')->where('desarrollos.id', '=', $request->id);
        return $desarrollo->get();
    }
    
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $desarrollo = new Desarrollo();
        $desarrollo->idcategoria = $request->idcategoria;
        $desarrollo->idsubcategoria = $request->idsubcategoria;
        $desarrollo->direccion = $request->direccion;
        $desarrollo->precio_por_metro = $request->precio_por_metro;
        $desarrollo->descripcion = $request->descripcion;
        /*$desarrollo->foto_1 = $request->foto_1;
        $desarrollo->foto_section = $request->foto_section;*/
        $desarrollo->latitud = $request->latitud;
        $desarrollo->longitud = $request->longitud;
        $desarrollo->detalle_de_entrega = $request->detalle_de_entrega;
        $desarrollo->condicion = '1';
        $desarrollo->save();

        return response()->json(array('success' => true, 'last_insert_id' => $desarrollo->id), 200);

        /*response()->json(['data' => $desarrollo], 200);*/
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $desarrollo = Desarrollo::findOrFail($request->id);
        $desarrollo->idcategoria = $request->idcategoria;
        $desarrollo->idsubcategoria = $request->idsubcategoria;
        $desarrollo->direccion = $request->direccion;
        $desarrollo->precio_por_metro = $request->precio_por_metro;
        $desarrollo->descripcion = $request->descripcion;
        /*$desarrollo->foto_1 = $request->foto_1;
        $desarrollo->foto_section = $request->foto_section;*/
        $desarrollo->latitud = $request->latitud;
        $desarrollo->longitud = $request->longitud;
        $desarrollo->detalle_de_entrega = $request->detalle_de_entrega;
        $desarrollo->condicion = '1';
        $desarrollo->save();
    }

    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $desarrollo = Desarrollo::findOrFail($request->id);
        $desarrollo->condicion = '0';
        $desarrollo->save();
    }

    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $desarrollo = Desarrollo::findOrFail($request->id);
        $desarrollo->condicion = '1';
        $desarrollo->save();
    }

    public function destroy(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $desarrollo = Desarrollo::findOrFail($request->id);
        /*$destroysignal =*/ $desarrollo->delete();
        
        /*if ($destroysignal) {*/
            /*return Redirect::route('desarrollos.index');*/
        /*}*/
    }
}

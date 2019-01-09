<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Foto;

class FotoController extends Controller
{
	public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');
        $fotos = Foto::join('desarrollos','fotos.id_desarrollo','=','desarrollos.id')
        ->select('fotos.id','fotos.id_desarrollo','fotos.nombre','fotos.foto')
        ->where('fotos.id_desarrollo','=',$request->id);

        return $fotos->get();
    }
    
    public function store(Request $request)
    {
      if($request->get('image'))
      {
        /*Move to Folder*/
        $image = $request->get('image');
        $name = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
        \Image::make($request->get('image'))->save(public_path('Fotos/').$name);
      }
      /*Store to database*/
      $image= new Foto();
      $image->id_desarrollo = $request->id_desarrollo;
      $image->nombre = $request->nombre;
      $image->foto = $name;
      $image->save();

      return response()->json(['success' => 'You have successfully uploaded an image'], 200);
    }

    public function update(Request $request)
    {
      if (!$request->ajax()) return redirect('/');

      if($request->get('image'))
      {
        $image = $request->get('image');
        $name = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
        \Image::make($request->get('image'))->save(public_path('Fotos/').$name);
      }

       /*$image= new Foto();*/
      $image = Foto::findOrFail($request->id);
      $image->nombre = $request->nombre;
      $image->foto = $name;
      $image->save();

      return response()->json(['success' => 'You have successfully uploaded an image'], 200);
    }

 /* public function delete(Request $request)
	{
		if (!$request->ajax()) return redirect('/');
	    DB::table('fotos')->where('id', '=', $request->id)->delete();
	}*/

  public function destroy(Request $request)
  {
    if (!$request->ajax()) return redirect('/');
    $image = Foto::findOrFail($request->id);
    $image->delete();
    return response()->json(['success' => 'you have successfully delete an image'], 200);
  }
}

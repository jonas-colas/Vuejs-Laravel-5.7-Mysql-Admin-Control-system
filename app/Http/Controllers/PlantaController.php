<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Planta;

class PlantaController extends Controller
{
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');
        $plantas = Planta::join('desarrollos','plantas.id_desarrollo','=','desarrollos.id')
        ->select('plantas.id','plantas.id_desarrollo','plantas.nombre','plantas.imagen','plantas.pdf')
        ->where('plantas.id_desarrollo','=',$request->id);

        return $plantas->get();
    }
    
    public function store(Request $request)
    {
      if (!$request->ajax()) return redirect('/');

      if($request->get('imageP'))
      {
        /*Move to Folder*/
        /*Image Planta*/
        $imageP = $request->get('imageP');
        $name = time().'.' . explode('/', explode(':', substr($imageP, 0, strpos($imageP, ';')))[1])[1];
        \Image::make($request->get('imageP'))->save(public_path('Imagen_planta/').$name);
        
      }

/*        $uniqueFileName = uniqid() . $request->get('pdf')->getClientOriginalName() . '.' . $request->get('pdf')->getClientOriginalExtension());

        $request->get('pdf')->move(public_path('files') . $uniqueFileName);

        return redirect()->back()->with('success', 'File uploaded successfully.');*/
/*      $file = base64_decode($request['pdf']);
      $folderName = 'public/Imagen_planta/';
      $safeName = str_random(10).'.'.'pdf';
      $destinationPath = public_path() . $folderName;
      file_put_contents(public_path().'/Imagen_planta/'.$safeName, $file);*/
      $pdf = base64_decode($request['pdf']);

      /*Store to database*/
      $image= new Planta();
      $image->id_desarrollo = $request->id_desarrollo;
      $image->nombre = $request->nombre;
      $image->imagen = $name;
      $image->pdf = $request->file($pdf)->store('public');
      /*$image->pdf = $uniqueFileName;*/
      /*$image->pdf = $safeName;*/

      $image->save();

      return response()->json(['success' => 'You have successfully uploaded an image'], 200);
    }

    public function update(Request $request)
    {
      if (!$request->ajax()) return redirect('/');

      if($request->get('imageP'))
      {
        /*Move to Folder*/
        /*Image Planta*/
        $imageP = $request->get('imageP');
        $name = time().'.' . explode('/', explode(':', substr($imageP, 0, strpos($imageP, ';')))[1])[1];
        \Image::make($request->get('imageP'))->save(public_path('Imagen_planta/').$name);
        
      }

      $file = base64_decode($request['pdf']);
      $folderName = 'public/Imagen_planta/';
      $safeName = str_random(10).'.'.'pdf';
      $destinationPath = public_path() . $folderName;
      file_put_contents(public_path().'/Imagen_planta/'.$safeName, $file);


      $planta = Planta::findOrFail($request->id);
      /*$planta->id_desarrollo = $request->id_desarrollo;*/
      $image->nombre = $request->nombre;
      $image->imagen = $name;
      $image->pdf = $safeName;
     
      $image->save();
    }

  /*  public function delete(Request $request)
	{
		if (!$request->ajax()) return redirect('/');
	    DB::table('plantas')->where('id', '=', $request->id)->delete();
	}*/

  public function destroy(Request $request)
  {
    if (!$request->ajax()) return redirect('/');
    $image = Planta::findOrFail($request->id);
    $image->delete();
  }
}

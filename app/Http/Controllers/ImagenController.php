<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImagenController extends Controller
{
    public function store(Request $request)
    {
        //$input = $request->all();
        $imagen = $request->file('file');
        $nombreImagen = Str::uuid().".".$imagen->extension();
        $imagenServidor = Image::make($imagen);
        //haciendo uso de intervention image forzamos a que cada imagen mida los mismo.
        $imagenServidor->fit(1000, 1000);
        //definimos la ubicacion donde vamos a subir la imagen
        $imagenPath = public_path('uploads').'/'.$nombreImagen;
        //ejecutamos el salvado en el servidor
        $imagenServidor->save($imagenPath);
        //probando respuesta
        return response()->json( $nombreImagen );
    }
}

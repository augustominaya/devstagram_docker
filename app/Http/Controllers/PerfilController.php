<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{

    //probocamos que siempre se ejecute el constructos al momento de acceder alguien
    //no autenticado en nuestro sistema
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
       return view('perfil.index');
    }

    public function store(Request $request)
    {

        //Modificar el request
        $request->request->add(['username'=> Str::slug($request->username)]);

        $this->validate($request, [
            //por recomendacion de laravel, cuando son mas de 3 reglas 
            //hacer uso de un arreglo
        //'username' => 'required|unique:users|min:3|max:20'
        //creamos una lista negra con not_in
        //omitir validacion si el username a cambiar es el ya existente
        // 'unique:users,username,'.auth()->user()->id
        'username' => ['required','unique:users,username,'.auth()->user()->id,'min:3','max:20','not_in:twitter,editar-perfil']
       ]);

       //Si hay imagen hacemos el tratamiento a la imagen
       if($request->imagen)
       {
        $imagen = $request->file('imagen');
        $nombreImagen = Str::uuid().".".$imagen->extension();
        $imagenServidor = Image::make($imagen);
        $imagenServidor->fit(1000, 1000);
        $imagenPath = public_path('perfiles').'/'.$nombreImagen;
        $imagenServidor->save($imagenPath);
       }

       // ***** guardar cambio *****
       // 1- Recuperamos el Usuario y lo dejamos en la variable $usuario
       $usuario = User::find(auth()->user()->id);
       // 2- Asignamos el nombre de usuario del request a $usuario->username
       $usuario->username = $request->username;
       // 3- Asignamos la imagen de request o la dejamos vacia.
       $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? null;
       // 4 - aplicamos cambios en la base de datos
       $usuario->save();

       //Redireccionamos al muro o dashboard del usuario.
       return redirect()->route('posts.index', $usuario->username);

    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {

        //rescribimos el valor de una variable dentro del reques,
        // el metodo slug, deja el nombre en minuscula y le agrega un Guion para que sea una URL
        $request->request->add(['username'=> Str::slug($request->username)]);
        //la funcion dd, detiene la ejecucion de laravel y es de mucha ayuda para debugar variables.
        //dd($request);
        //acceder a un parametro en cuestion
        //dd($request->get('username'));

        //trabajamos con la validacion
        //llamamos al metodo validate de laravel, le pasamos el $request
        //y comenzamos a validar los campos con sus reglas.
        $this->validate($request,[
            'name' => 'required|max:30',
            'username' => 'required|unique:users|min:3|max:20',
            'email' => 'required|unique:users|email|max:60',
            'password' => 'required|confirmed|min:6',
            
        ]);

        //llamamos al metodo estatico create que es el equivalente a insert into
        // ahora le pasamos las variables usando atritubos de arreglos asociativos
        User::create([

            //pasamos todas las variables necesarias para insertar el registro
            'name'=> $request->name,
            // con la clase Str y e
            // Antes = 'username'=> $request->username,
            // 'username'=> Str::lower($request->username), solo para minuscula
            'username'=> $request->username,
            'email'=> $request->email,
            //realizamos un pequeno cambio para crear el hash utilizando un metodo de laravel
            // antes 'password'=> $request->password
            'password'=> Hash::make($request->password)
        ]);

        //funcion para intentar autenticar un usuario
        // auth()->attempt([
        //     'email'=> $request->email,
        //     'password'=> $request->password,
        // ]);

        //otra manera de autenticar
        auth()->attempt($request->only('email','password'));

        //redireccionar
        //laraver tiene una funcion que permite el redireccionamiento.
        return redirect()->route('posts.index', auth()->user()->username);

        //dd('Creando Usuario');
    }
}

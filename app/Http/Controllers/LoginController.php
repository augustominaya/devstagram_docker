<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class LoginController extends Controller
{
    
    public function index()
    {
       return view('auth.login');
    }

    //recibimos un objeto de tipo request
    public function store(Request $request)
    {
        //llamamos al metodo que nos ayudara con las validaciones
        //le pasamos nuestro objeto $request que contine los campos a validar
        $this->validate ($request, [
            //definimos los campos a validar con sus reglas de validacion
            'email'=> 'required|email',
            'password'=> 'required'
        ]);

        //llamamos auth es que el modulo de autenticacion de usuario en laravel
        //hacemos uso del metodo attempt que permite verificar credenciales, devuelve true o false.
        if(!auth()->attempt($request->only('email','password')))
        {
            //el mensaje es colocado en una variable de sesion que debemos postearlo en algun lugar
            //en nuestro caso sera en el login.blade.php
            //with permite crear una session con un mensaje
            //back permite regresar a la pagina anterior
            return back()->with('Mensaje','Credenciales incorrectas');
        }

        return redirect()->route('posts.index');
    }
}

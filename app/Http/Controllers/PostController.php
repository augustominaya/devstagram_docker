<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    //probocamos que siempre se ejecute el constructos al momento de acceder alguien
    //no autenticado en nuestro sistema
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //auth es una funcion que te informa que usuario esta autenticado.
        // dd(auth()->user());        
        // dd('Desde el Muro');

        return view('dashboard');

    }
}

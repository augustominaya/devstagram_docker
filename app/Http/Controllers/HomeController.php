<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //protegemos que solo usuarios autenticados
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function __invoke()
    {
        // obtener a quienes seguimos
        $ids = auth()->user()->followings->pluck('id')->toArray() ;
        // obtenemos los post de los usuarios que seguimos
        //agregamos el parametro latest para ordenar
        $posts = Post::whereIn('user_id', $ids)->latest()->paginate(20);
        //enviamos los post a la vista
        return view('home',[
            'posts' => $posts
        ]);
    }
}

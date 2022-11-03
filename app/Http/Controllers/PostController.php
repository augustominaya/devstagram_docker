<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    //probocamos que siempre se ejecute el constructos al momento de acceder alguien
    //no autenticado en nuestro sistema
    public function __construct()
    {
        //agrgamos excepcion para poder ver las publicaciones.
        //$this->middleware('auth');
        $this->middleware('auth')->except('show','index');
    }

    public function index(User $user)
    {
        //filtramos por coleccion
        $posts = Post::where('user_id', $user->id)->latest()->paginate(4);
        return view('dashboard',[
            'user' => $user,
            'posts' => $posts
        ]);

    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'titulo'=> 'required|max:255',
            'descripcion'=> 'required',
            'imagen'=> 'required',

        ]);

        //Luego de la validacion, vamos a guardar la publicacion.
        // Post::create([
        //     'titulo'=> $request->titulo,
        //     'descripcion'=> $request->descripcion,
        //     'imagen'=> $request->imagen,
        //     //guardamos el user ID que creao la publicacion
        //     'user_id'=> auth()->user()->id
        // ]);

        // otra forma de guardar publicaciones.
        // $post = new Post;
        // $post->titulo=$request->titulo;
        // $post->descripcion=$request->descripcion;
        // $post->imagen=$request->imagen;
        // $post->user_id=auth()->user()->id;
        // $post->save();

        //3era forma para insertar utilizando Eloquent ORM -> Relacion de moledos
        $request->user()->posts()->create([
             'titulo'=> $request->titulo,
             'descripcion'=> $request->descripcion,
             'imagen'=> $request->imagen,
             'user_id'=> auth()->user()->id
        ]);

        //redireccionamos al muro con el nombre de usuario.
        return redirect()->route('posts.index', auth()->user()->username);
    }

    public function show(User $user, Post $post)
    {
            return view('posts.show', [
                'post' => $post,
                'user' => $user
            ]);
    }

    public function destroy(Post $post)
    {
        //llamamos a la politica que evalua si el usuario esta
        //autorizado para eliminar el post
        $this->authorize('delete', $post);
        //si pasa la validacion entonces eliminamos el post
        $post->delete();
        //eliminar imagen
        //antes definimos la ruta completa de la imagen
        // que es igual al public_path + la carpeta de uploads 
        // y el nombre de la imagen
        $imagen_path = public_path('uploads/' . $post->imagen);
        if(File::exists($imagen_path))
        {
            unlink($imagen_path);
        }
        //luego lo redirccionamos a su muro o dashboard.
        return redirect()->route('posts.index', auth()->user()->username);
    }
}

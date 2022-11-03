<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ComentarioController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//ruta para el home del usuario
//Route::get('/', [HomeController::class, 'index'])->name('home');
//ruta para el home utilizando __invoke, se elimina el arreglo
Route::get('/', HomeController::class )->name('home');

//Despues
//RegisterController es la clase del controlador
// los 2 puntos :: es para llamar un metodo estatico
// index es el metodo que llamara a la visa
// por convencion el que muestra una ruta debe tener index
// creamos un nombre a la ruta o un alias.
Route::get('/crear-cuenta', [RegisterController::class, 'index'])->name('Registrar');
//ejemplo de crear otra ruta en mismo controlador
Route::post('/crear-cuenta', [RegisterController::class, 'store']);
//se crea la ruta para el controlador login, su ruta, clase y alias o name.
Route::get('/login', [LoginController::class, 'index'])->name('login');
//se crea la nueva ruta para validar el login del usuario, utilizando el metodo post y el metodo store
Route::post('/login', [LoginController::class, 'store']);
//creamos la ruta para el logout
Route::post('/logout', [LogoutController::class, 'store'])->name('logout');
//ruta para poder ver el perfil
Route::get('/editar-perfil', [PerfilController::class, 'index'])->name('perfil.index');
//ruta para poder editar el perfil
Route::post('/editar-perfil', [PerfilController::class, 'store'])->name('perfil.store');
//controlador para el muro de las publicaciones.
//cambiamos la ruta del muro aplicando route model binding, user es un Modelo.
//cambiamos el ID por el username.
Route::get('/{user:username}', [PostController::class, 'index'])->name('posts.index');
//ruta para crear post
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
//ruta para guardar los Post o publicaciones
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
//Ruta para ver el detalle de las publicaciones.
Route::get('/{user:username}/posts/{post}', [PostController::class, 'show'])->name('posts.show');
//ruta para eliminar publicaciones
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
//Ruta guardar los comentarios
Route::post('/{user:username}/posts/{post}', [ComentarioController::class, 'store'])->name('comentarios.store');
//ruta para el controlador de las imagenes
Route::post('/imagenes', [ImagenController::class, 'store'])->name('imagenes.store');
//ruta para registrar likes
Route::post('/posts/{post}/likes', [LikeController::class, 'store'])->name('posts.likes.store');
//ruta para eliminar likes
Route::delete('/posts/{post}/likes', [LikeController::class, 'destroy'])->name('posts.likes.destroy');
//ruta para seguir a un usuario
Route::post('/{user:username}/follow', [FollowerController::class, 'store'])->name('users.follow');
//ruta para dejar de seguir a un usuario
Route::delete('/{user:username}/unfollow', [FollowerController::class, 'destroy'])->name('users.unfollow');
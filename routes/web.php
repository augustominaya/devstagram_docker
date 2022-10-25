<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('principal');
});

//Antes
// Route::get('/crear-cuenta', function () {
//     return view('auth.register');
// });

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
//controlador para el muro de las publicaciones.
Route::get('/muro', [PostController::class, 'index'])->name('posts.index');
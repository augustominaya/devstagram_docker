<?php

namespace App\Models;

use App\Models\Like;
use App\Models\Comentario;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    //declaramos la variable protegida fillable y le pasamos
    //un arreglo de los campos que vamos a insertar en la tabla.
    protected $fillable = [
        'titulo',
        'descripcion',
        'imagen',
        'user_id',
    ];


    public function user()
    {
        //limitamos la seleccion de informacion a nombre y nombre de usuario
        return $this->belongsTo(User::class)->select(['name','username']);
    }

    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
        
    public function checkLike(User $user)
    {
        //validamos si un usuario ya dio like.
        //llamamos al metodo like de la misma clase
        //el metodo contains verifica si un id ya existe en un campo
        return $this->likes->contains('user_id', $user->id);
    }
    
}

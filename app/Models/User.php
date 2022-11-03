<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Like;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts()
    {
        //Utilizamos la relacion One to Many 
        //y la pasamos la clase o modelo Post
        //return $this->hasMany(Post::class);
        //en caso de que no digamos las convenciones correctamente
        // le informamos a laravel cual campo reppresenta la llave foranea
        return $this->hasMany(Post::class, 'user_id');
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    //Almacena los seguidores de un usuario
    public function followers()
    {
        //importante = Nos salimos de las convenciones de laravel y debemos ser
        //muy especifico con la relacion entre las tablas y campos que deseamos
        //relacionar.
        //significa que del modelo User -> campo user_id --> sera relacionado con el modelo follower campo follower_id
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'follower_id');
    }

    //Almacena los que seguimos
    public function followings()
    {
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'user_id');
    }
    
    //comprobar si un usuario ya sigue a otro
    public function siguiendo(User $user)
    {
        //llamamos al metodo interno followers y con el metodo contains
        //preguntamos si el user->id esta siguiendo al otro usuario
        return $this->followers->contains( $user->id );
    }


    
}

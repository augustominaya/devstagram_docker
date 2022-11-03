<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LikePost extends Component
{
    //registramos la variable post para recibir 
    //la informacion desde la vista
    public $post;

    //hacemos de livewire mas reactivo donde necesitamos
    //que nos actualice los elemento que necesito actualizar.
    public $isLiked;
    
    //atributo que tendra el conteos de los like
    public $likes;
    
    //creamos nuestra funcion mount que es similar a un constructor.
    public function mount($post)
    {
        //validamos si el usuario actual le dio me gusta.
        $this->isLiked = $post->checkLike( auth()->user());
        $this->likes = $post->likes->count();
    }

    public function like()
    {
        if( $this->post->checkLike( auth()->user() )){
            $this->post->likes()->where('post_id', $this->post->id)->delete();
            $this->isLiked = false;
            $this->likes--;
        }else{
            $this->post->likes()->create([
                'user_id' => auth()->user()->id
            ]);
            $this->isLiked = true;
            $this->likes++;
        }
    }

    public function render()
    {
        return view('livewire.like-post');
    }
}

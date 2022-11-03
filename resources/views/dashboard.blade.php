@extends('layouts.app')

@section('titulo')
{{-- Cambiamos tu cuenta por la informacion de la variable user --}}
    Perfil: {{$user->username}}
@endsection

@section('contenido')

<div class="flex justify-center">

    <div class="w-full md:w-8/12 lg:w-6/12 flex flex-col items-center md:flex-row">
        
        <div class="w-8/12 lg:w-6/12 px-5">
            {{-- 
            colocamos la imagen del usuario y en caso contrario
            colocamos la imagen por defecto
            para esto utilizamos un codigo ternario extraño.
            asset('img/Usuario.jpg')
                --}}
            <img src="{{ 
            $user->imagen ? 
            asset('perfiles').'/'.$user->imagen : 
            asset('img/Usuario.jpg')  }}" alt="Imagen Usuario"/>
        </div>

        <div class="md:w-8/12 lg:w-6/12 px-5 flex flex-col items-center md:justify-center md:items-start py-10">
            {{-- para mostrar el usuario que visitamos debes llamar la variable $user
                el cual la hemos enviado desde el controlador PostController para ser
                utilizada en la vista de dashboard.  --}}

                <div class="flex items-center gap-2">
                    <p class="text-gray-700 text-2x1">{{ $user->username }}</p>
                    @auth
                        @if ( $user->id === auth()->user()->id )
                            <a  href="{{ route('perfil.index') }}" 
                                class="text-gray-500 hover:text-gray-600 cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" 
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 
                                4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 
                                01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                </svg>
                            </a>
                        @endif
                    @endauth
                </div>

            <p class="text-gray-800 text-sm mb-3 font-bold">
                {{ $user->followers->count() }}                
                <span class="font-normal"> @choice('seguidor|seguidores', $user->followers->count()) </span>
            </p>
            <p class="text-gray-800 text-sm mb-3 font-bold">
                {{ $user->followings->count() }}                
                <span class="font-normal"> seguiendo</span>
            </p>
            <p class="text-gray-800 text-sm mb-3 font-bold">
                {{ $user->posts->count()}}
                <span class="font-normal">Posts</span>
            </p>

            @auth
            {{-- Evitar seguirte a ti mismo --}}
                    @if ($user->id !== auth()->user()->id)
                    {{-- Otro if para comprobar si el usuario atenticado ya sigue al usuario visitante --}}
                    @if ( !$user->siguiendo( auth()->user() ) )
                            <form
                                action="{{ route('users.follow', $user) }}"
                                method="POST"
                            >
                                @csrf
                                <input
                                    type="submit"
                                    class="bg-blue-600 text-white uppercase rounded-lg px-3 py-1 
                                    text-xs font-bold cursor-pointer"
                                    value="Seguir"
                                />
                            </form>
                            @else
                            <form
                            action="{{ route('users.unfollow', $user) }}"
                            method="POST"
                        >
                            @csrf
                            @method('DELETE')
                            <input
                                type="submit"
                                class=" bg-red-600 text-white uppercase rounded-lg px-3 py-1 
                                text-xs font-bold cursor-pointer"
                                value="Dejar de Seguir"
                            />
                        </form>
                    @endif
                @endif
            @endauth
        </div>

    </div>
</div>

<section class="container mx-aut mt-10">
    <h2 class="text-4xl text-center font-black my-10">Publicaciones</h2>
    <x-listar-post :posts="$posts"/>
</section>

@endsection
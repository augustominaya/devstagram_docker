@extends('layouts.app')

@section('titulo')
    Registro en Devstagram
@endsection

@section('contenido')

{{-- 
    md = es el tamaño de la caja
    flex = es como una caja 
    md:justify-center
    md:gap-10 = le deja una separacion 10 pixeles a los div dentro
    md:items-center = alinea en el centro los div u objetos
    p-5 = para que la imagen no sea tan grande
     --}}
<div class="md:flex md:justify-center md:gap-10 md:items-center p-5">
    {{-- md = es un tamaño medio de la caja
        w-1/2 = es para que tome el 50% 
        w-4/12 = lo centraliza en el medio
        w-6/12 = para hacer un poco mas grande el div o contenedor
         --}}
    <div class="md:w-6/12 p-5">
        {{-- la funcion asset nos permite cargar los archivo desde el servidor --}}
        <img src="{{ asset('img/registrar.jpg') }}" alt="Imagen registro de usuarios">
    </div>

    <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-xl">
        {{-- en action llamamos el nombre o alias de la ruta para que sea mas facil realiar cambios 
            en la vista en cuestion. --}}
        <form action="{{ route('Registrar')}}" method="POST" novalidate>
            @csrf
            {{-- mb-5 margin bottom de 5 pixele --}}
            <div class="mb-5">    
                            {{-- En los label en vez de utilizar id usamos for, ya que for
                                activa el input relacionado a dicho label
                                --}}
                <label for="name" class="mb-2 block uppercase text-gray-500 font-bold">
                Nombre</label>
                <input
                id="name" 
                name="name"
                type="text"
                placeholder="Tu Nombre"
                {{--  border = para colocar un borde
                      p-3    = padding de 3 pixele
                      w-full = para que tome el 100 del ancho
                      agergamos un cambio en el diseno siempre y cuando haya un error
                     --}}
                class="border p-3 w-full rounded-lg @error('name') border-red-500
                @enderror"
                value="{{ old('name')}}"
                />
                {{-- hacemos uso de la directriz @error, para mostrar errores en la pantalla --}}
                @error('name')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                        {{ $message }}
                @enderror
            </div>


            <div class="mb-5">                
                <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">
                Username</label>
                <input
                id="username" 
                name="username"
                type="text"
                placeholder="Tu Nombre de Usuario"
                class="border p-3 w-full rounded-lg @error('username') border-red-500
                @enderror"
                value="{{ old('username')}}"
                />
                @error('username')
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                    {{ $message }}
            @enderror
            </div>

            <div class="mb-5">                
                <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">
                    Email</label>
                <input
                id="email" 
                name="email"
                type="email"
                placeholder="Tu Email de Registro"
                class="border p-3 w-full rounded-lg @error('email') border-red-500
                @enderror"
                value="{{ old('email')}}"
                />
                @error('email')
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                    {{ $message }}
            @enderror
            </div>

            <div class="mb-5">                
                <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">
                    Password</label>
                <input
                id="password" 
                name="password"
                type="password"
                placeholder="Password de Registro"
                class="border p-3 w-full rounded-lg @error('password') border-red-500
                @enderror"
                />
                @error('password')
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                    {{ $message }}
            @enderror
            </div>


            <div class="mb-5">    
                            {{-- si agregas el confirmation en ingles, laravel automaticamente
                                activa la funcionalidad de validar o confirmar el password por ti --}}
                <label for="password_confirmation" class="mb-2 block uppercase text-gray-500 font-bold">
                    Repetir Password</label>
                <input
                id="password_confirmation" 
                name="password_confirmation"
                type="password"
                placeholder="Repite tu Password"
                class="border p-3 w-full rounded-lg"
                />
            </div>

            <input
            type="submit"
            value="Crear Cuenta"
            class=" bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg"
            />

        </form>
    </div>

</div>

@endsection


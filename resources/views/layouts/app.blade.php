<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Devstagram - @yield('titulo')</title>
        
        @vite("resources/css/app.css") 
        @vite("resources/css/dropzone.min.css") 
        @vite("resources/js/app.js")
        @livewireStyles
    
    </head>
    {{-- 
        bg-gray-100 = permite crear un fondo de color gris  
        --}}
    <body class="bg-gray-100">
    {{--  
     p-5      = padding de 5 pixele
     border-b = border bottom o parte inferior
     bg-white = fondo blanco
     shadow   = sombra
    --}}
        <header class="p-5 border-b bg-white shadow">

            {{-- 
                container = definimos un contenedor
                mx-auto   = deja el texto centrado
                flex      = no lo entiendo
                justify-between = para que lo justifique a la derecha
                item-center = para que este centrado verticalmente
                --}}
            <div class="container mx-auto flex justify-between items-center">
                {{-- 
                    text-3xl = tamano de la letra a 3em
                    font-black = color de la fuente negro.
                    items-center = para centralizar.
                    --}}
                <a href="{{ route('home') }}" class="text-3xl font-black">
                    DevStagram
                </a>


                {{-- Podemos utilizar otra directiva que valide que esta autentica --}}
                @auth
                <nav class="flex gap-2 items-center">

                    <a class="flex items-center gap-2 bg-white border p-2 text-gray-600 rounded text-sm uppercase font-bold cursor-pointer" 
                    href="{{ route('posts.create')}}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z" />
                      </svg>                      
                        Crear
                    </a>

                    {{-- font-bold = fondo gruezo
                         text-gray-600 = texto gris y con un grosol de 600
                         text-sm = poner el texto un poco mas pequeño
                        --}}
                    <a class="font-bold text-gray-600 text-sm" 
                    href="{{ route('posts.index', auth()->user()->username )}}">
                        Hola: <span class="font-normal"> {{ auth()->user()->username }}</span>
                    </a>
                    
                    {{-- cambiamos la manera de cerrar sesion para utilizar el metodo POST con un formulario --}}
                        <form method="POST" action="{{ route('logout')}}">
                            {{-- la directiva @csrf crea una variable oculta para enviar un token y validar el cierre de sesion 
                                y asi evitame ataques malicioso --}}
                            @csrf
                            <button type="submit" class="font-bold uppercase text-gray-600 text-sm" href="{{ route('logout')}}">
                                Cerrar Sesion</button>
                        </form>

                </nav>
                @endauth

                {{-- Hay otra directiva guest para los usuarios no autenticado --}}
                @guest
                {{-- 
                    flex = ni idea
                    gap-2 = para separa 2 pixeles                    
                    --}}
                    <nav class="flex gap-2 items-center">
                        {{-- font-bold = fondo gruezo
                             uppercase = mayuscula
                             text-gray-600 = texto gris y con un grosol de 600
                             text-sm = poner el texto un poco mas pequeño
                            --}}
                        <a class="font-bold uppercase text-gray-600 text-sm" href="{{ route('login')}}">Login</a>
                        {{-- Aqui vamos a llamar la ruta de crear-cuenta por el alias o name de ruta registrar --}}
                        <a class="font-bold uppercase text-gray-600 text-sm" href="{{ route('Registrar')}}">
                            Crear Cuenta</a>
    
                    </nav>
                @endguest

            </div>
        </header>

            {{-- mt-10 = margin top de 10 pixeles 
                 --}}
        <main class="container mx-auto mt-10">

            {{-- font-black = color de la fuente negro.
                text-center = alinear en el centro.
                text-3xl    = tamano de la fuente un poco mas grande.
                mb-10       = margin bottom de 10 pixeles 
                 --}}
            <h2 class="font-black text-center text-3xl mb-10">
                @yield('titulo')
            </h2>

            {{-- En este yield o sesion ira el contenido de la plantilla, es decir, es el lugar donde iremos
                dejando toda la informacion de cada una de las vistas o pagina que trabajaremos --}}
            @yield('contenido')

        </main>

        <footer class="mt-10 text-center p-5 text-gray-500 font-bold uppercase">
            DevStagram - Todos los derechos reservados 
            {{ //now es una funcion o helper de laravel para blade que muestra el año
             now()->year
              }}
        </footer>
        @livewireScripts
    </body>
</html>
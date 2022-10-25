<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Devstagram - @yield('titulo')</title>
        @vite("resources/css/app.css")
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
                <h1 class="text-3xl font-black">
                    DevStagram
                </h1>


                {{-- Podemos utilizar otra directiva que valide que esta autentica --}}
                @auth
                <nav class="flex gap-2 items-center">
                    {{-- font-bold = fondo gruezo
                         text-gray-600 = texto gris y con un grosol de 600
                         text-sm = poner el texto un poco mas pequeño
                        --}}
                    <a class="font-bold text-gray-600 text-sm" href="#">
                        Hola: <span class="font-normal"> {{ auth()->user()->username }}</span>
                    </a>
                    {{-- Aqui vamos a llamar la ruta de crear-cuenta por el alias o name de ruta registrar --}}
                    <a class="font-bold uppercase text-gray-600 text-sm" href="{{ route('Registrar')}}">
                        Cerrar Sesion</a>

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
    </body>
</html>
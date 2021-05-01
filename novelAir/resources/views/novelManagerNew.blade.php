<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Novel Manager</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>

    <!-- Body: Tailwind el "bg" funciona raro, no llena toda la pantalla -->
    <!-- Arreglar responsive -->
    <body class="bg-gradient-to-br from-gray-800 to-gray-900 bg-no-repeat container mx-auto">

        <!-- Pequeño page history: Solo habra un boton de "BACK" -->
        <div class="container mt-5">

            <!-- Boton back -->
            <a class="text-l text-black font-bold bg-white p-2 py-1 rounded" href="{{route('dashboard')}}">BACK</a>

        </div>

        <!-- Grid(5x2): Grid que contiene las novelas del usuario. -->
        <div class="grid grid-cols-5 grid-rows-2 my-5">
        
            <!-- Seccion Novelas: Contiene todas las novelas del usuario -->
            <!-- Por hacer seccion interaccion -->
            <div class="bg-white rounded col-span-3 row-span-2 mr-12">

                <!-- Seccion crear novelas: Boton que te redirige a la pagina de creacion -->
                <div class="border-b border-gray-300 mx-5 pb-5 pt-5 ">

                    <p class="text-xl text-black text-center mb-3">Crea una nueva novela ahora!</p>

                    <!-- Boton crear -->
                    <a class="text-l text-white font-bold bg-blue-500 hover:bg-blue-700 p-2 py-1 mx-72 rounded" href="{{route('createNovel')}}">+ CREAR +</a>

                </div>

                <!-- Seccion sin novelas: Texto que aparece si no tienes novelas creadas -->
                @if(count($novels) == 0)

                    <div class="container pt-7 pb-3">

                        <p class="text-xl text-black text-center">No tienes novelas creadas!</p>

                        <p class="text-xl text-black text-center">Crea una nueva con el boton de arriba!</p>

                    </div>

                @endif

                <!-- Seccion de novelas: el foreach recorre todas las novelas y crea sus div's en la seccion padre -->
                @foreach ($novels as $novel)

                    <div class="flex border-b border-gray-300 mx-5 pb-5 pt-5 ">

                        <!-- Seccion imagen: Contiene la imagen de la novela -->
                        <div class="inline-block w-1/5 mx-2.5">

                            <!-- Error imagen: Hay que arreglar de alguna manera que la extension(No siempre es .png) de la imagen llegue junto a la ruta-->
                            <img width="70%" src="{{asset($novel->novel_dir.'/cover.png')}}" alt="{{ $novel->name }}">
                        
                        </div>
                        
                        <!-- Seccion info: Contiene informacion sobre la novela -->
                        <div class="inline-block w-2/5 mx-2.5">

                            <p class="text-xl text-black text-left mb-3">{{ $novel->name }}</p>

                            <p class="text-sm text-blue-700 text-left leading-none mb-2">{{ substr($novel->sinopsis,0,100) }}...</p>

                            <!-- Error(Tailwindcss) n_capitulos: No he conseguido con tailwind ponerlo abajo del todo -->
                            <p class="text-sm text-gray-700 text-right mb-2">Numero de capitulos: {{ $novel->chapters_count }}</p>

                        </div>

                        <!-- Seccion interaccion: Contiene informacion sobre las interacciones con la novela -->
                        <!-- Por hacer -->
                        <div class="inline-block w-1/5 mx-2.5 py-5">

                            <!-- Lecturas: Lecturas dinamicas -->
                            <!-- Por hacer -->
                            <p class="text-base text-black text-left mb-3">7983 Leido</p>

                            <!-- Seguidores: Seguidores dinamicas -->
                            <!-- Por hacer -->
                            <p class="text-base text-black text-left mb-3">2125 Siguiendo</p>

                        </div>

                        <!-- Seccion ver novela: Contiene el boton para configuarar o añadir capitulos a la novela-->
                        <div class="inline-block w-1/5 mx-2.5">
                        
                            <a class="text-l text-white font-bold bg-blue-500 hover:bg-blue-700 p-2 py-1 rounded" href="{{url('novel_manager')}}/{{$novel->id}}">VER NOVELA</a>
                        
                        </div>

                    </div>

                @endforeach

            </div>

            <!-- Seccion Estadisticas: Contiene todas las estadisitcas -->
            <!-- Por hacer -->
            <div class="bg-white rounded col-span-2 ">

                <div class="border-b border-gray-300 mx-5 my-3">

                    <p class="text-xl text-black text-center mb-3">Tus estadisticas</p>

                </div>

                <!-- Seccion Lecturas: Lecturas dinamicas -->
                <!-- Por hacer -->
                <div class="border-b border-gray-300 mx-5 my-3">

                    <p class="text-xl text-black text-center mb-3">Lecturas totales: 7983 </p>

                    <p class="text-lg text-gray-600 text-center mb-5">Lecturas este mes: 7983</p>

                </div>

                <!-- Seccion seguidores: Seguidores dinamicas -->
                <!-- Por hacer -->
                <div class=" mx-5">

                    <p class="text-xl text-black text-center mb-3">Seguidores totales: 2125</p>

                    <p class="text-lg text-gray-600 text-center mb-5">Seguidores este mes: 124</p>

                </div>

            </div>  

        </div>

    </body>
    
</html>

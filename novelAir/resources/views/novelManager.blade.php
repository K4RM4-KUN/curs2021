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
        <link rel="icon" href="{{ URL::asset('favicon.ico') }}" type="image/x-icon"/>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>

    <!-- Body: Tailwind el "bg" funciona raro, no llena toda la pantalla -->
    <body class="bg-gradient-to-br from-gray-700 to-gray-800 min-h-screen">
        @include('layouts.navigationNew')
        <!-- Pequeño page history: Solo habra un boton de "BACK" -->
        <div class="container mt-5">

            <!-- Boton back -->
            <a class="text-l text-black font-bold bg-white p-2 py-1 rounded" href="{{url('/')}}">BACK</a>

        </div>

        <!-- Grid(5x2): Grid que contiene las novelas del usuario. -->
        <div class="grid grid-cols-3 sm:grid-cols-5 gap-x-5 grid-rows-2 gap-y-5 sm:grid-rows-2 my-5">
        
            <!-- Seccion Novelas: Contiene todas las novelas del usuario -->
            <!-- Por hacer seccion interaccion -->
            <div class="bg-white rounded col-span-3 row-span-2">
                <div class="border-b border-gray-300 bg-gradient-to-l from-blue-700 to-blue-500 pt-3 rounded-t">

                    <p class="text-xl text-white text-center mb-3">Tus novelas</p>

                </div>

                <!-- Seccion crear novelas: Boton que te redirige a la pagina de creacion -->
                <div class="border-b border-gray-300 mx-5 pb-5 pt-5 ">

                    <p class="text-xl text-black text-center mb-3">Crea una nueva novela ahora!</p>

                    <!-- Boton crear -->
                    <div class="w-1/1 text-center">
                        <a class="text-l text-white font-bold bg-blue-500 hover:bg-blue-700 p-2 py-1 rounded" href="{{route('createNovel')}}">+ CREAR +</a>
                    </div>
                    
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
                    
                    <a class="" href="{{url('novel_manager')}}/{{$novel->id}}">
                        <div class="flex border-b border-gray-300 mx-5 pb-5 pt-5 hover:bg-blue-50">

                            <!-- Seccion imagen: Contiene la imagen de la novela -->
                            <div class="inline-block w-1/5 mx-2.5">

                                <img class="m-auto" width="65%" src="{{asset($novel->novel_dir.'/cover'.$novel->imgtype)}}" alt="{{ $novel->name }}">
                            
                            </div>
                            
                            <!-- Seccion info: Contiene informacion sobre la novela -->
                            <div class="inline-block w-3/5 mx-2.5 ">

                                <p class="h-1/6 text-xl text-black text-left mb-3">{{ $novel->name }}</p>

                                <p class="h-3/6 text-sm text-blue-700 text-left hidden sm:block leading-none mb-2">{{ substr($novel->sinopsis,0,200) }}...</p>

                                <!-- Error(Tailwindcss) n_capitulos: No he conseguido con tailwind ponerlo abajo del todo -->
                                <p class="h-1/6 text-sm text-gray-700 text-right mb-2">{{ $novel->chapters_count }} capitulo/s</p>

                            </div>

                            <!-- Seccion interaccion: Contiene informacion sobre las interacciones con la novela -->
                            <!-- Por hacer 1/2 -->
                            <div class="inline-block w-1/5 mx-2.5 py-5">

                                <!-- Lecturas: Lecturas dinamicas -->
                                <p class="text-base text-black text-left mb-3">@if(count($novel->chapters)==0)0 @else {{$novel->chapters_sum_views}} @endif Leido</p>

                                <!-- Seguidores: Seguidores dinamicas -->
                                <!-- Por hacer -->
                                <p class="text-base text-black text-left mb-3">{{$novel->uns_count}} Siguiendo</p>

                                <!-- Seguidores: Seguidores dinamicas -->
                                <!-- Por hacer -->
                                <p class="text-base text-black text-left mb-3">Nota: {{$novel->Mark}}/10</p>

                            </div>


                        </div>
                    </a>
                @endforeach
                <div class="my-5 w-full text-white flex justify-center">
                    {!! $novels->links() !!}
                </div>

            </div>

            <!-- Seccion Estadisticas: Contiene todas las estadisitcas -->
            <!-- Por hacer -->
            <div class="bg-white rounded col-span-2 min-h-full hidden sm:block ">

                <div class="border-b border-gray-300 bg-gradient-to-l from-blue-700 to-blue-500 mb-3 pt-3 rounded-t">

                    <p class="text-xl text-white text-center mb-3">Tus estadisticas</p>

                </div>

                <!-- Seccion Lecturas: Lecturas dinamicas -->
                <!-- Por hacer 1/2 -->
                <div class="border-b border-gray-300 mx-5 my-3">

                    <p class="text-xl text-black text-center mb-3">Lecturas totales: {{$viewStats}} </p>

                    <p class="text-lg text-gray-600 text-center mb-5">Lecturas este mes: {{$viewStats}}</p>

                </div>

                <!-- Seccion seguidores: Seguidores dinamicas -->
                <!-- Por hacer -->
                <div class=" mx-5">

                    <p class="text-xl text-black text-center mb-3">Seguidores totales: {{$followersStats}}</p>

                    <p class="text-lg text-gray-600 text-center mb-5">Seguidores este mes: {{$followersStats}}</p>

                </div>

            </div>  

        </div>

        @include('layouts.footer')
    </body>
    
</html>

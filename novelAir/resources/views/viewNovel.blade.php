<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Novel Manager - {{$novels[0]->name}}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="bg-gradient-to-br from-gray-700 to-gray-900 container mx-auto min-h-screen">
        
        <!-- Pequeño page history: Solo habra un boton de "BACK" -->
        <div class="container mt-5">
            <!-- Boton back -->
            <a class="text-l text-black font-bold bg-white p-2 py-1 rounded" href="{{ route('goNM')}}">BACK</a>
        </div>

        <!-- Grid(5x2): Grid que contiene los capitulos del usuario. -->
        <div class="grid grid-cols-3 sm:grid-cols-5 gap-x-5 grid-rows-2 gap-y-5 sm:grid-rows-2 my-5">

            <!-- Seccion Novelas: Contiene todas los capitulos del usuario -->
            <div class="bg-white rounded col-span-3 h-auto">
                <div class="border-b border-gray-300 bg-gradient-to-l from-blue-700 to-blue-500 pt-3 rounded-t">

                    <p class="text-xl text-white text-center mb-3">Tus Capitulos -- {{$novels[0]->name}}</p>

                </div>
                
                <!-- Seccion crear capitulos: Boton que te redirige a la pagina de creacion -->
                <div class="border-b border-gray-300 mx-5 pb-5 pt-5 ">

                    <p class="text-xl text-black text-center mb-3">Crea un nuevo capitulo ahora!</p>

                    <!-- Boton crear -->
                    <div class="w-1/1 text-center">
                        <a class="text-l text-white font-bold bg-blue-500 hover:bg-blue-700 p-2 py-1 rounded" href="{{url('novel_manager')}}/{{$novels[0]->id}}/add_chapter"">+ CREAR +</a>
                    </div>

                </div>

                @if(count($chapters) == 0)

                    <div class="container pt-7 pb-3">

                        <p class="text-xl text-black text-center">No tienes capitulos creados!</p>

                        <p class="text-xl text-black text-center">Crea uno con el boton de arriba!</p>

                    </div>

                @endif

                <!-- Seccion de novelas: el foreach recorre todos los capitulos y crea sus div's en la seccion padre -->
                @foreach ($chapters as $chapter)
                    <div class="flex border-b border-gray-300 mx-5 pb-5 pt-5">
                        
                        <!-- Seccion info: Contiene informacion sobre la novela -->
                        <div class="flex inline-block w-3/5 mx-2.5 items-center">

                            <p class="text-xl text-black text-left mb-3">Capitulo {{ $chapter->chapter_n }}: {{ $chapter->title }}</p>

                        </div>

                        <div class="inline-block w-1/5 mx-2.5 items-center">
                        
                        <p class="text-sm text-gray-700 text-right mb-2">Visitas: {{ $chapter->views }}</p>
                        <p class="text-sm text-gray-700 text-right mb-2"><? $e = explode(" ", $chapter->updated_at); echo $e[0]?></p>
                        
                        </div>

                        <div class="flex items-center justify-center inline-block w-1/5 mx-2.5">
                        
                            <a class="text-l text-white font-bold bg-blue-500 hover:bg-blue-700 p-2 py-1 rounded" href="{{route('goVC',['id'=>$novels[0]->id,'chapter'=>$chapter->id])}}">Editar</a>
                        
                        </div>
                    </div>
                @endforeach
            </div>
            
            <!-- Seccion Estadisticas: Formulario para editar la novela -->
            <div class="bg-white  rounded col-span-3 sm:col-span-2 min-h-full sm:block">
                <div class="border-b border-gray-300 bg-gradient-to-l from-blue-700 to-blue-500 mb-3 pt-3 rounded-t">

                    <p class="text-xl text-white text-center mb-3">Datos de la novela</p>

                </div>

                <div class="mx-5 my-3">

                    <form class=" rounded px-2 pt-6 pb-8 mb-4" action="{{route('editNovel')}}"  method="POST" enctype="multipart/form-data">
                        @csrf

                        <input type="text" hidden name="id" value="{{$novels[0]->id}}">

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                                Nombre
                            </label>

                            <input class="shadow-lg border-none appearance-none rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                            name="name" 
                            type="text" 
                            value="{{$novels[0]->name}}"
                            placeholder="Nombre">
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                                Portada(300x450):
                            </label>

                            <input class="shadow-lg border-none appearance-none rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                            name="cover" 
                            type="file"
                            accept="image/jpg,image/jpeg,image/png">
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                                Genero
                            </label>

                            <input class="shadow-lg border-none appearance-none rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                            name="genre" 
                            type="text" 
                            value="{{$novels[0]->genre}}">
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                                Sinopsis
                            </label>

                            <textarea class="shadow-lg border-none appearance-none rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            name="sinopsis">{{$novels[0]->sinopsis}}</textarea>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                                Tags
                            </label>

                            <input class="shadow-lg border-none appearance-none rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                            name="tags" 
                            type="text" 
                            value="@foreach($tags as $tag){{strtolower($tag->tag_name)}},@endforeach"
                            placeholder="accion,aventura,romance...">
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                                +18
                            </label>

                            <input class="shadow-lg border-none appearance-none rounded w-full py-2 px-3 text-blue-600 leading-tight focus:outline-none focus:shadow-outline" 
                            name="adultContent" 
                            type="checkbox" 
                            value="@foreach($tags as $tag){{strtolower($tag->tag_name)}},@endforeach"
                            @if ($novels[0]->adult_content) checked @endif>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                                Publico
                            </label>

                            <input class="shadow-lg border-none appearance-none rounded w-full py-2 px-3 text-blue-600 leading-tight focus:outline-none focus:shadow-outline" 
                            name="public" 
                            type="checkbox" 
                            value="@foreach($tags as $tag){{strtolower($tag->tag_name)}},@endforeach"
                            @if ($novels[0]->public) checked @endif>
                        </div>

                        <div class="flex items-center justify-between">

                            <input class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" value="Cambiar" type="submit">
                            
                            <a href="{{url('novel_manager/delNovel/'.$novels[0]->id)}}">
                                <input class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" 
                                type="button"
                                value="Eliminar">
                            </a>
                        </div> 
                        
                    </form>
                    @if ($errors->any())
                        <table>
                        @foreach ($errors->all() as $error)
                            <tr><td><a>{{ $error }}</a></td></tr>
                        @endforeach
                        </table>
                    @endif

                </div>
            </div>
        </div>

        
    </body>
</html>
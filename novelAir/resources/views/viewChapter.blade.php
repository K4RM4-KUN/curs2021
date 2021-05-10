<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Novel Manager - {{$chapter[0]->chapter_n}}. {{$chapter[0]->title}}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>

    <!-- Body: Tailwind el "bg" funciona raro, no llena toda la pantalla -->
    <body class="bg-gradient-to-br from-gray-700 to-gray-900 min-h-screen container mx-auto min-h-screen">

        <!-- Pequeño page history: Solo habra un boton de "BACK" -->
        <div class="container mt-5 ">

            <!-- Boton back -->
            <a class="text-l text-black font-bold bg-white p-2 py-1 rounded" href="{{url('novel_manager/'.$novels[0]->id)}}">BACK</a>

        </div>

        <!-- Grid(5x2): Grid que contiene las novelas del usuario. -->
        <div class="grid grid-cols-3 sm:grid-cols-5 my-5 gap-x-7">

            <div class="bg-white rounded shadow col-span-3 col-start-1 mb-10">

                <div class="border-b border-gray-300 bg-gradient-to-l from-blue-700 to-blue-500 pt-3 rounded-t">

                    <p class="text-xl text-white text-center mb-3">Configura el capitulo -- {{$chapter[0]->chapter_n}}. {{$chapter[0]->title}}</p>

                </div>

                <form action="{{route('editChapter')}}" method="POST" class="bg-white rounded px-8 pt-6 pb-8 mb-4">
                    @csrf
                    <input hidden type="text" value="{{$chapter[0]->id}}" name="id">
                    <input hidden type="text" value="{{$novels[0]->id}}" name="novel_id">
                    <div class="mb-4">
                        
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                            Titulo
                        </label>

                        <input class="shadow-lg border-none appearance-none rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                        id="title" 
                        type="text" 
                        name="title"
                        value="{{$chapter[0]->title}}"
                        placeholder="Titulo">
                    
                    </div>

                    <div class="mb-4">
                        
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="chapter_n">
                            Numero de capitulo
                        </label>

                        <input class="shadow-lg border-none appearance-none rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                        id="number" 
                        type="float"
                        name="chapter_n"
                        min="0" 
                        value="{{$chapter[0]->chapter_n}}"
                        placeholder="Titulo">
                    
                    </div>

                    <div class="mb-4">
                        
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="public">
                            Publico
                        </label>

                        <input class="shadow-lg border-none appearance-none rounded w-full py-2 px-3 text-blue-600 leading-tight focus:outline-none focus:shadow-outline" 
                        id="public" 
                        name="public"
                        type="checkbox"
                        @if ($chapter[0]->public) checked @endif
                        placeholder="Titulo">
                    
                    </div>

                    
                    <div class="flex items-center justify-between">

                        <input class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" 
                        type="submit"
                        value="Cambiar">

                        <a href="{{url('novel_manager/delChapter')}}/{{$chapter[0]->id}}">
                            <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">
                                Eliminar
                            </button>
                        </a>

                    </div>
                    @if ($errors->any())
                        <div class="mb-4 flex align-center justify-center">
                            <table>
                            @foreach ($errors->all() as $error)
                                <tr><td><a>{{ $error }}</a></td></tr>
                            @endforeach
                            </table>
                        </div>
                    @endif

                </form>

            </div>

            <div class="bg-white rounded shadow col-span-3 sm:col-span-2 col-start-1 md:col-start-4 mb-10">

                <div class="border-b border-gray-300 bg-gradient-to-l from-blue-700 to-blue-500 pt-3 rounded-t">

                    <p class="text-xl text-white text-center mb-3">Preview</p>

                </div>

                <div class="flex items-center justify-center">

                    <img class="preview w-1/2 mt-5 mb-2 mx-5" src="{{ asset($preview) }}" alt="Preview">

                </div>

                <div class="flex items-center justify-center mt-5">

                    <p class="actualImg mb-5" >Organiza, añade o elimina imagenes!</p>

                </div>

                <div class="flex items-center justify-center">


                    <a href="{{url('novel_manager')}}/chapterImages/{{$novels[0]->id}}/{{$chapter[0]->id}}">

                        <button class="bg-green-500 hover:bg-green-700 text-white font-bold mx-5 mb-5 py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">
                            Modificar Imagenes
                        </button>

                    </a>    

                </div>

            </div>

        </div>


    </body>
    
</html>

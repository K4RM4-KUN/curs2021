<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Nuevo capitulo - {{$novels[0]->name}}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="icon" href="{{ URL::asset('favicon.ico') }}" type="image/x-icon"/>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="bg-gradient-to-br from-gray-700 to-gray-800 min-h-screen">
        @include('layouts.navigationNew')
        <!-- Pequeño page history: Solo habra un boton de "BACK" 
        <div class="container mt-5 ">

             Boton back 
            <a class="text-l text-black font-bold bg-white p-2 py-1 rounded" href="{{route('goNM')}}">BACK</a>

        </div>-->

        <!-- Grid(5x2): Grid que contiene las novelas del usuario. -->
        <div class="grid grid-cols:3 sm:grid-cols-4 my-5 gap-x-7">
        
            <div class="container mt-5 col-start-1 col-span-1 sm:col-start-2 sm:col-span-2 my-5">

                <!-- Boton back -->
                <a class="text-l text-black font-bold bg-white p-2 py-1 rounded" href="{{url('novel_manager/'.$novels[0]->id)}}">BACK</a>

            </div>

            <div class="bg-white rounded shadow col-span-1 sm:col-span-2 col-start-1 sm:col-start-2 mb-10">

                <div class="bg-gradient-to-l from-blue-700 to-blue-500 border-b border-gray-300 pt-3 rounded-t">

                    <p class="text-xl text-white text-center mb-3">Crear capitulo de {{$novels[0]->name}}</p>

                </div>

                <form action="{{route('createChapters')}}" method="POST" enctype="multipart/form-data" class="bg-white rounded px-8 pt-6 pb-8 mb-4">
                    @csrf
                    <input type="text" hidden name="id" value="{{$novels[0]->id}}" id="id">
                    <input type="text" hidden name="novel_dir" value="{{$novels[0]->novel_dir}}" id="novel_dir">
                    <div class="mb-4">
                        
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                            Titulo
                        </label>

                        <input class="shadow-lg border-none appearance-none rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                        id="title" 
                        type="text"
                        name="title"
                        value=""
                        placeholder="Titulo">
                    
                    </div>

                    <div class="mb-4">
                        
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                            Numero de capitulo
                        </label>

                        <input class="shadow-lg border-none appearance-none rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                        id="title" 
                        type="float"
                        name="chapter_n"
                        min="0" 
                        value=""
                        placeholder="1,2,3..">
                    
                    </div>

                    <div class="mb-4">
                    
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                            Imagenes del capitulo
                        </label>

                        <input class="shadow-lg border-none appearance-none rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        multiple 
                        type="file" 
                        accept="image/jpg,image/jpeg,image/png,image/svg,image/webp" 
                        name="content[]" 
                        id="content">

                    </div>

                    <div class="mb-4">
                        
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                            Publico
                        </label>

                        <input class="shadow-lg border-none appearance-none rounded w-full py-2 px-3 text-blue-600 leading-tight focus:outline-none focus:shadow-outline" 
                        id="title" 
                        type="checkbox"
                        name="public"
                        checked
                        placeholder="Titulo">
                    </div>
                    
                    <div class="flex items-center justify-center">

                        <input class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" 
                        type="submit"
                        value="Crear">

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


        </div>

        @include('layouts.footer')
    </body>

</html>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Novel Manager - Nueva novela</title>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <script id="functions" src="{{ asset('js/createNovelJS.js') }}" defer></script>
    </head>

    <!-- Body: Tailwind el "bg" funciona raro, no llena toda la pantalla -->
    <body class="bg-gradient-to-br from-gray-700 to-gray-900 min-h-screen container mx-auto min-h-screen">

        <!-- Pequeño page history: Solo habra un boton de "BACK" 
        <div class="container mt-5 ">

             Boton back 
            <a class="text-l text-black font-bold bg-white p-2 py-1 rounded" href="{{route('goNM')}}">BACK</a>

        </div>-->

        <!-- Grid(5x2): Grid que contiene las novelas del usuario. -->
        <div class="grid grid-cols:3 sm:grid-cols-4 my-5 gap-x-7">
        
            <div class="container mt-5 col-start-1 col-span-1 sm:col-start-2 sm:col-span-2 my-5">

                <!-- Boton back -->
                <a class="text-l text-black font-bold bg-white p-2 py-1 rounded" href="{{route('goNM')}}">BACK</a>

            </div>

            <div class="bg-white rounded shadow col-span-1 sm:col-span-2 col-start-1 sm:col-start-2 mb-10">

                <div class="bg-gradient-to-l from-blue-700 to-blue-500 border-b border-gray-300 pt-3 rounded-t">

                    <p class="text-xl text-white text-center mb-3">Crea Novela</p>

                </div>

                <form action="{{route('insertNovel')}}" method="POST" enctype="multipart/form-data" class="bg-white rounded px-8 pt-6 pb-8 mb-4">
                    @csrf
                    <div class="mb-4">
                        
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                            Nombre
                        </label>

                        <input class="shadow-lg border-none appearance-none rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                        name="name" 
                        type="text"
                        required>
                    
                    </div>

                    <div class="mb-4">
                        
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                            Genero
                        </label>

                        <select name="genre" class="shadow-lg border-none appearance-none rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="order">
                            @foreach ($genres as $genre)
                                <option value="{{$genre->id}}">{{$genre->name}}</option>
                            @endforeach
                        </select>
                    
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                            Sinopsis
                        </label>

                        <textarea class="shadow-lg border-none appearance-none rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        name="sinopsis"></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                            Tags
                        </label>

                        <input class="shadow-lg border-none appearance-none rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                        name="tags" 
                        type="text" 
                        placeholder="accion,aventura,romance...">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                            +18
                        </label>

                        <input class="shadow-lg border-none appearance-none rounded w-full py-2 px-3 text-blue-600 leading-tight focus:outline-none focus:shadow-outline" 
                        name="adultContent" 
                        type="checkbox">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                            Visual Novel
                        </label>

                        <input class="shadow-lg border-none appearance-none rounded w-full py-2 px-3 text-blue-600 leading-tight focus:outline-none focus:shadow-outline" 
                        name="visualNovel"
                        id="visualNovel"
                        type="checkbox">

                        <div id="typeNobels">
                            <input type="radio" id="manga" name="gender" value="manga" checked>
                            <label for="manga">Manga</label><br>
                            <input type="radio" id="manhwa" name="gender" value="manhwa">
                            <label for="manhwa">Manhwa</label><br>
                            <input type="radio" id="manhua" name="gender" value="manhua">
                            <label for="manhua">Manhua</label><br>
                            <input type="radio" id="oneShot" name="gender" value="oneShot">
                            <label for="oneShot">One shot</label><br>
                            <input type="radio" id="other" name="gender" value="other">
                            <label for="other">Other</label>        
                            
                            
                            <div id="typeOthers">
                                <input class="shadow-lg border-none appearance-none rounded w-full py-2 px-3 text-blue-600 leading-tight focus:outline-none focus:shadow-outline" 
                                name="typeOther"
                                id="typeOther"
                                type="text">
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                            Portada(300x450px | 600x900px | 900x1350px):
                        </label>

                        <input class="shadow-lg border-none appearance-none rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                        name="cover" 
                        type="file"
                        accept="image/jpg,image/jpeg,image/png">
                    </div>

                    <div class="mb-4">
                        
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                            Publico
                        </label>

                        <input class="shadow-lg border-none appearance-none rounded w-full py-2 px-3 text-blue-600 leading-tight focus:outline-none focus:shadow-outline" 
                        name="public" 
                        type="checkbox"
                        checked>
                    
                    </div>

                    <div class="flex items-center justify-center">

                        <input class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" 
                        type="submit"
                        value="Acceptar">

                    </div>

                </form>
                @if ($errors->any())
                    <div class="mb-4 flex align-center justify-center">
                        <table>
                        @foreach ($errors->all() as $error)
                            <tr><td><a>{{ $error }}</a></td></tr>
                        @endforeach
                        </table>
                    </div>
                @endif

            </div>


            </div>

        </div>

    </body>
    
</html>

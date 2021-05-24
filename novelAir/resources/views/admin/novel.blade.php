<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Admin Novel Manager</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="icon" href="{{ URL::asset('favicon.ico') }}" type="image/x-icon"/>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>


        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="https://ajax.aspnetcdn.com/ajax/jquery/jquery-3.5.1.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
        <script src="https://kit.fontawesome.com/f01c1fd989.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    </head>
    <body class="bg-gradient-to-br from-gray-700 to-gray-900 min-h-screen">

        @include('layouts.navigationNew')

        <div class="flex flex-col justify-center | w-full">
            <!-- Back -->
            <div class="w-full sm:w-10/12 mx-auto my-3">
                <a class="text-l text-black font-bold bg-white p-2 py-1 rounded" href="{{route('goAdmin')}}">BACK</a>
            </div>

            <div class="flex flex-wrap justify-center | w-full">
                <!-- Novela -->
                <div class="w-full sm:w-5/12 | my-5 w-full mr-0 sm:mr-10 | bg-white | rounded">
                    <div class="w-full bg-red-600">
                        <p class="p-3 text-xl text-white text-center mb-3">Novela</p>
                    </div>
                    <div class="mx-1 sm:mx-7">
                        <div class="mx-1 sm:my-7">
                            <div class="flex flex-col mx-1 sm:mx-10 my-5">
                                <!-- Imagen -->
                                <div class="mx:3 sm:mx-5 xl:mx-24">
                                    <img class="mx-auto " width="50%" style="max-width: 200px;" 
                                    src="{{asset($novel->novel_dir.'/cover'.$novel->imgtype)}}">
                                </div>

                                <!-- Info -->
                                <div class="my-8">
                                    <p class="font-bold text-3xl my-2">{{$novel->name}}</p>
                                    <p><b>Sinopsis:</b> {{$novel->sinopsis}}</p>
                                
                                    <p class="my-5"><b>Author:</b>
                                        <a href="{{url('admin/user/'.$user->id)}}"><lavel class="font-bold text-xl"> {{$user->username}}<lavel></a>
                                    </p>
                                    <p><b>Nota del autor:</b> {{$novel->author_comment}}</p>
                                </div>

                                <!-- Bloquear/eliminar -->
                                <div class="flex flex-wrap| w-full | justify-around">
                                    <a class="my-2 | py-2 px-4 | text-white font-bold | rounded | focus:outline-none focus:shadow-outline
                                    @if($novel->public == 0) bg-yellow-400 hover:bg-yellow-500 @else  bg-green-400 hover:bg-green-500 @endif | " 
                                        href="{{url('admin/blockNovel/'.$novel->id)}}">@if($novel->public == 0) Bloqueada @else Publica @endif</a>
                                    <a class="my-2 | py-2 px-4 | bg-red-600 hover:bg-red-700 | text-white font-bold | rounded | focus:outline-none focus:shadow-outline" 
                                        href="{{url('admin/removeNovel/'.$novel->id)}}">Eliminar</a>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>

                <!-- Capitulos -->
                <div class="w-full sm:w-5/12 | my-5 w-full mr-0 sm:mr-10 | bg-white | rounded">
                    <div class="w-full bg-red-600">
                        <p class="p-3 text-xl text-white text-center mb-3">Capitulos</p>
                    </div>
                    <div class="mx-1 sm:mx-7">
                        <div class="mx-1 sm:my-7">
                            <div class="flex flex-col mx-1 sm:mx-10 my-5">
                                @if(count($chapters) == 0)

                                    <div class="container pt-7 pb-3">
                                        <p class="text-xl text-black text-center">No tienes capitulos creados!</p>
                                    </div>
                                @endif

                                <!-- Seccion de novelas: el foreach recorre todos los capitulos y crea sus div's en la seccion padre -->
                                @foreach ($chapters as $chapter)
                                    <div class="flex border-b border-gray-300 mx-5 hover:bg-blue-50">
                                        <!-- Seccion info: Contiene informacion sobre la novela -->
                                        <div class="flex inline-block w-4/5 mt-4 mx-2.5 items-center">
                                            <p class="text-xl text-black text-left mb-3">Capitulo {{ $chapter->chapter_n }}: {{ $chapter->title }}</p>
                                        </div>

                                        <div class="inline-block w-1/5 mx-2.5 mt-4 items-center">
                                            <p class="text-sm text-gray-700 text-right mb-2">Visitas: {{ $chapter->views }}</p>
                                            <p class="text-sm text-gray-700 text-right mb-2"><? $e = explode(" ", $chapter->updated_at); echo $e[0]?></p>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="my-5 w-full text-white flex justify-center">
                                {!! $chapters->links() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contacto -->
                <div class="w-full sm:w-5/12 | my-5 w-full mr-0 sm:mr-10 | bg-white | rounded">
                    <div class="w-full bg-red-600">
                        <p class="p-3 text-xl text-white text-center mb-3">Enviar Mensaje</p>
                    </div>
                    <div class="mx-7">
                        <!-- Formulario -->
                        <form action="" method="post" class="w-full lg:w-9/12 mx-auto text-black">
                            @csrf
                            <!-- Email Address -->
                            <div class="my-4">
                                <label for="email" class="text-2xl">Email</label>
                                <input class="shadow-lg border-none appearance-none rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                                id="email" type="email" name="email" value="{{$user->email}}" required />
                            </div>

                            <!-- Text Area -->
                            <div class="my-4">
                                <label for="email" class="text-2xl">Mensaje</label>
                                <textarea class="shadow-lg border-none appearance-none rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                                id="email" name="message" required></textarea>
                            </div>

                            <input class="my-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" 
                            type="submit"
                            value="Enviar">
                        </form>
                    </div>
                </div>

                <!-- NO SE QUE PONER -->
                <div class="w-full sm:w-5/12 | my-5 w-full mr-0 sm:mr-10 | bg-white | rounded">
                    <div class="w-full bg-red-600">
                        <p class="p-3 text-xl text-white text-center mb-3">COMING SOON</p>
                    </div>
                    <div class="mx-7">
                        
                    </div>
                </div>


            </div>

        </div>

        @include('layouts.footer')
    </body>
</html>
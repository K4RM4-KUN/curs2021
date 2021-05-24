<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Admin Manager</title>

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
                <a class="text-l text-black font-bold bg-white p-2 py-1 rounded" href="{{url('/')}}">BACK</a>
            </div>

            <div class="flex flex-wrap justify-center | w-full">
                <!-- Usuarios -->
                <div class="w-full sm:w-5/12 | my-10 w-full mr-0 sm:mr-10 | bg-white | rounded">
                    <div class="w-full bg-red-600">
                        <p class="p-3 text-xl text-white text-center mb-3">Usuarios</p>
                    </div>
                    <div class="mx-7">
                        <!-- Formulario -->
                        <div class="border-b-2">
                            <p class="text-base text-black mb-3">Buscar</p>
                            <form action="{{route('adminSearch')}}" method="post" enctype="multipart/form-data">
                            @csrf
                                <div>
                                    <select class="mi-selector shadow-lg border-none appearance-none rounded w-3/6 py-2 px-3 text-white leading-tight"
                                    name="user">
                                        @foreach($users as $user)
                                            <option value='{{$user->id}}'>{{$user->username}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="my-5">
                                    <input class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" 
                                    type="submit"
                                    value="Buscar">
                                </div>
                            </form>
                        </div>

                        <!-- Lista Autores -->
                        <div class="my-7">
                            <p class="text-base text-black mb-3">Usuarios</p>
                            <div class="flex flex-wrap">
                            @foreach($users as $result)
                                <div class="w-1/2 sm:w-4/12 lg:w-3/12 xl:w-2/12">
                                    <div class="m-2">
                                        <a href="{{url('admin/user/'.$result->id)}}">   
                                            <div class="bg-cover bg-no-repeat bg-center" style="background-image:url('{{asset('users/'.$result->id.'/profile/bgImage'.$result->imgtype)}}');">
                                                <div class="w-full | h-full | bg-black bg-opacity-60">
                                                    <div class="mx-auto py-3 | justify-items-center">
                                                        <img class="mx-auto | rounded-full" width="50%" 
                                                        @if(file_exists(public_path() ."/users/". $result->id ."/profile/usericon". $result->imgtype))
                                                            src="{{asset("/users/". $result->id ."/profile/usericon". $result->imgtype)}}"
                                                        @else
                                                            src="{{asset("/images/noimage.png")}}"
                                                        @endif
                                                        alt="">
                                                    </div>
                                                    <div class="w-full">
                                                        <p class="bg-black bg-opacity-60 | py-0.5 px-2 | w-1/1 | text-center text-xs md:text-sm lg:text-xs text-white font-bold | truncate">{{$result->username}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Novelas -->
                <div class="w-full sm:w-5/12 | my-0 sm:my-10 | bg-white | rounded | h-full">
                    <div class="w-full bg-red-600">
                        <p class="p-3 text-xl text-white text-center mb-3">Novelas</p>
                    </div>
                    <div class="mx-7">
                        <!-- Formulario -->
                        <div class="border-b-2">
                            <p class="text-base text-black mb-3">Buscar</p>
                            <form action="{{route('adminSearch')}}" method="post" enctype="multipart/form-data">
                            @csrf
                                <div>
                                    <select class="mi-selector shadow-lg border-none appearance-none rounded w-3/6 py-2 px-3 text-white leading-tight"
                                    name="novel">
                                        @foreach($novels as $novel)
                                            <option value='{{$novel->id}}'>{{$novel->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="my-5">
                                    <input class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" 
                                    type="submit"
                                    value="Buscar">
                                </div>
                            </form>
                        </div>

                        <!-- Lista Novelas -->
                        <div class="my-7">
                            <p class="text-base text-black mb-3">Novelas</p>
                            <div class="flex flex-wrap">
                            @foreach($novels as $result)
                                <div class="w-1/2 sm:w-4/12 lg:w-3/12 xl:w-2/12">
                                    <div class="m-2">
                                        <a href="{{url('admin/novel/'.$result->id)}}">   
                                            <div class="bg-cover bg-no-repeat bg-center" style="background-image:url('{{asset($result->novel_dir.'/cover'.$result->imgtype)}}');">
                                                <div class="w-full | h-32 | flex flex-wrap content-end">
                                                    <div class="w-full">
                                                        <p class="bg-black bg-opacity-60 | py-0.5 px-2 | w-1/1 | text-center text-xs md:text-sm lg:text-xs text-white font-bold | truncate">{{$result->name}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Imagenes carrusel -->
                <div class="w-full sm:w-10/12 | my-5 | bg-white | rounded | h-full">
                    <div class="w-full bg-red-600">
                        <p class="p-3 text-xl text-white text-center mb-3">Imagenes carrousel</p>
                    </div>
                    <div class="mx-7">
                        <div>
                            <form action="{{url('admin/addImg')}}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="flex items-center justify-center">
                                    <div class="flex w-full justify-center bg-grey-lighter">
                                            <input class=""
                                            
                                            multiple 
                                            type="file" 
                                            accept="image/jpg,image/jpeg,image/png" 
                                            name="content[]" 
                                            id="content">
                                    </div>

                                </div>

                                <div class="flex items-center justify-center my-3">

                                    <input class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline my-2"" 
                                    type="submit"
                                    value="Añadir imagenes">

                                </div>

                            </form>
                        <div>
                        <div class="flex flex-wrap justify-center">
                            @foreach($content as $c) 
                                <div class="flex flex-col p-5 w-1/2 sm:w-1/3">
                                    <img src="images/homeShow/{{$c->getFilename()}}" class="w-full" alt="">
                                    <a href="{{url('admin/rmImf/'.$c->getFilename())}}">
                                        <button class="bg-red-500 hover:bg-red-700 text-white font-bold w-full py-2 px-4 rounded focus:outline-none focus:shadow-outline my-2">
                                            Eliminar
                                        </button>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footer')

        <script id="functions" src="{{ asset('js/recomendedAuthorsJS.js') }}" defer></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    </body>
</html>
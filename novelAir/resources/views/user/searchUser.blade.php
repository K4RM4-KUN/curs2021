<!DOCTYPE html>
<html lang="esp">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autores</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="icon" href="{{ URL::asset('favicon.ico') }}" type="image/x-icon"/>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jquery/jquery-3.5.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script id="functions" src="{{ asset('js/searcherJS.js') }}" defer></script>
</head>
<body class="bg-gradient-to-br from-gray-700 to-gray-900 min-h-screen">
    
    @include('layouts.navigationNew') 
    @include('cookieConsent::index')
    
    <div class="flex flex-wrap w-11/12 sm:w-10/12 mx-auto bg-black bg-opacity-30">
        <div class="flex | w-full | bg-black bg-opacity-60">
            <div class="w-1/1 | my-5">
                <p class="font-bold text-ourBlue text-3xl | pl-5"> Buscador de Usuarios</p>
            </div>
        </div>
        <!-- Folmualrio -->
        <div class="w-full sm:w-4/12 | text-white">
            <div class="bg-white bg-opacity-25 | m-1 sm:m-4 | w-1/1">
                <form action="{{route('authorsSearch')}}" method="post" class="p-3 w-1/1">
                    @csrf
                    <div>
                        <input class="shadow-lg border-none appearance-none rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                        type="text"
                        name="searcher"
                        placeholder="Buscar..."
                        value="">
                        <input class="my-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" 
                        type="submit"
                        value="Acceptar">
                    </div>
                </form>
            </div>
        </div>

        <!-- Div de los usuarios -->
        <div class="w-1/1 sm:w-8/12 mx-auto text-white">

            <!-- Resultados de la busqueda -->
            @if($usersSearch != null)
                <p class="text-2xl font-bold text-white | border-b-2 | my-1 mt-5">Resultados de la busqueda</p>&nbsp
                @if(count($usersSearch) == 0)
                    No hay resultados
                @else
                    <div class="w-1/1 | flex flex-wrap">
                        @foreach($usersSearch as $result)
                            <div class="w-1/2 sm:w-4/12 lg:w-3/12 xl:w-2/12">
                                <div class="m-2">
                                    <a href="{{url('perfil/'.$result->id.'/'.$result->username)}}">   
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
                @endif
            @endif

            <!-- Ultimos Usuarios -->
            <p class="text-2xl font-bold text-white | border-b-2 | my-1 mt-5">Ultimos Autores</p>&nbsp
            
            <div class="w-1/1 | flex flex-wrap">
                @foreach($users as $result)
                <div class="w-1/2 sm:w-4/12 lg:w-3/12 xl:w-2/12">
                                <div class="m-2">
                                    <a href="{{url('perfil/'.$result->id.'/'.$result->username)}}">   
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
        @include('layouts.footer')
</body>
</html>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{$user->username}}</title>

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
        <script src="https://kit.fontawesome.com/f01c1fd989.js" crossorigin="anonymous"></script>

    </head>

    <body class="bg-gradient-to-br from-gray-700 to-gray-900 min-h-screen">

        @include('layouts.navigationNew')
        @include('cookieConsent::index')

        <div class="flex justify-center | w-full">

            <div class="w-11/12 | bg-black bg-opacity-30">

                <!--Header-->
                <div class="bg-cover bg-no-repeat bg-center" style="background-image:url('{{asset('users/'.$user->id.'/profile/bgImage'.$profile->imgtype)}}');">
                    <div class="w-1/1 | flex flex-wrap | bg-black bg-opacity-50 | border-b-2">

                        <!-- Imagen Perfil -->
                        <div class="w-full sm:w-3/12 | my-5 sm:my-10">
                            <div class="flex flex-wrap | justify-center content-center">
                                <img class="rounded-full" width="50%" src="{{asset($image)}}?date={{$image}}" alt="">
                            </div>
                        </div>

                        <!-- Descripcion -->
                        <div class="w-1/1 sm:w-7/12 | mt-5 sm:mt-10 mx-5 sm:mx-0 | flex flex-col | text-white">
                            <div>
                                <p class="font-bold text-3xl">{{$user->username}}</p>
                            </div>
                            @if (isset($profile->presentation) && !($profile->private))
                                <div class="my-5 | hidden sm:block">
                                    <p>Presentación: {{$profile->presentation}}</p>
                                </div>
                            @endif
                        </div>

                        <!-- Botones perfil -->
                        <div class="w-full sm:w-2/12 | mt-5 sm:mt-10 mx-5 sm:mx-0 | flex flex-col | text-white">
                            <div class="flex flex-col | content-end">
                                <div class="my-3">
                                    @if ($myProfile)
                                        <a class="my-2 w-full h-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" 
                                        href="{{url('usuario/ajustes/perfil')}}">Editar</a>
                                    @else
                                        <a class="my-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" 
                                        href="{{url('seguir/'.$user->id)}}">
                                        @if($followUser)Siguiendo @else Seguir @endif {{$followersNum}}</a>
                                    @endif
                                </div>
                                @if($authorUser && !($rolUser->role->rol_name == 'user')  && !($profile->private) && !$you)
                                    @if($author->subscriptions)
                                        <div class="my-3 h-1/1">
                                            @if(!$subscription)
                                            <a class="my-2 md:h-1/1 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" 
                                            href="{{url('subscribe/'.$user->id)}}">
                                            Suscribirse 2,50€ </a> 
                                            @else
                                            <a class="my-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" 
                                            href="">
                                            Estas subscrito!</a> 
                                            @endif
                                        </div>
                                    @endif 
                                @endif
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Body -->
                <div class="flex flex-wrap | w-1/1">

                    <!-- Mis novelas -->
                    <div class="flex flex-wrap | w-full @if(!($profile->private))sm:w-9/12 @endif | px:2 sm:px-5">
                        <div class="flex flex-wrap | text-white | w-full | mt-5 | p-2 | bg-black bg-opacity-30">
                            @if (count($novels)==0)
                                <div class="w-full">
                                    <p class="text-xs sm:text-base text-white font-bold">No hay novelas disponibles</p>
                                    <hr class="w-1/1 mx-auto">
                                </div>
                            @else
                                <div class="w-full">
                                    <p class="text-xs sm:text-base text-white font-bold">Mis proyectos</p>
                                    <hr class="w-1/1 mx-auto">
                                </div>


                                @foreach($novels as $result)
                                    <a class="w-1/2 sm:w-4/12 lg:w-3/12 xl:w-2/12" href="{{url('novel/'.$result->id)}}">
                                            
                                        <div class="flex flex-col | h-60 lg:h-42 xl:h-56 | m-2 | bg-cover bg-no-repeat bg-center" style="background-image:url('{{asset($result->novel_dir.'/cover'.$result->imgtype)}}');">
                                            <div class=" w-full | h-full">

                                                <div class="w-full">
                                                    
                                                    <p class="bg-black bg-opacity-60 | py-0.5 px-2 | w-1/1 | text-center text-xs md:text-sm lg:text-xs text-white font-bold | truncate">{{$result->name}}</p>

                                                </div>

                                                <div class="w-1/1 | flex justify-between | |">
                                                    
                                                    <p class="bg-{{$result->novel_type}} | px-1 m-0.5 | rounded | text-xs text-white font-bold">{{strtoupper($result->novel_type)}}</p>
                                                    <p class="hidden sm:block bg-black bg-opacity-60 | px-1 py-0.5 | text-xs text-white font-bold">{{$result->mark}}/10</p>

                                                </div>
                                                
                                            </div>
                                        
                                            <div class="w-full">
                                                
                                            <p class="bg-black bg-opacity-60 | py-2 px-2 | w-1/1 | text-center text-xs text-white font-bold | truncate">
                                                @foreach($genres as $genre) @if($genre->id == $result->genre) {{strtoupper($genre->name)}} @endif @endforeach
                                            </p>

                                            </div>
                                        </div>

                                    </a>
                                @endforeach
                                <div class="w-full text-white flex justify-center">
                                    {!! $novels->links() !!}
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Enlaces persoanles -->
                    @if(!($profile->private))
                        <div class="flex flex-wrap justify-center content-around | w-full sm:w-3/12 | px:2 sm:px-3 sm:pl-0">
                            @if(($profile->showFace) || ($profile->showTwitter) || ($profile->showInstagram) || ($profile->showPatreon) || ($profile->showOther))
                                <div>
                                    <div class="flex flex-col | w-full sm:1/2 md:w-full | mt-5 | p-2">
                                        <div class="bg-white bg-opacity-30">
                                            <div class="pl-2">
                                                <p class="text-lg text-white p-2">Social</p>
                                                <hr class="w-1/1 mx-auto">
                                            </div>
                                            <div class="flex flex-wrap | justify-center | text-white">
                                                @if($profile->showFace)
                                                    <div class="m-2">
                                                        <a href="{{$profile->facebook}}" target="_blank">
                                                            <button type="button" class="transform hover:scale-110">
                                                                <div class="flex flex-wrap | justify-center content-center | h-10 w-10 | bg-blue-500 | rounded">
                                                                    <i class="fab fa-facebook-f"></i>
                                                                </div>
                                                            </button>
                                                        </a>
                                                    </div>
                                                @endif

                                                @if($profile->showTwitter)
                                                    <div class="m-2">
                                                        <a href="{{$profile->twitter}}" target="_blank">
                                                            <button type="button" class="transform hover:scale-110">
                                                                <div class="flex flex-wrap | justify-center content-center | h-10 w-10 | bg-blue-400 | rounded">
                                                                    <i class="fab fa-twitter"></i>
                                                                </div>
                                                            </button>
                                                        </a>
                                                    </div>
                                                @endif

                                                @if($profile->showInstagram)
                                                    <div class="m-2">
                                                        <a href="{{$profile->instagram}}" target="_blank">
                                                            <button type="button" class="transform hover:scale-110">
                                                                <div class="flex flex-wrap | justify-center content-center | h-10 w-10 | bg-gradient-to-b from-purple-500 to-yellow-500 | rounded">
                                                                    <i class="fab fa-instagram"></i>
                                                                </div>
                                                            </button>
                                                        </a>
                                                    </div>
                                                @endif

                                                @if($profile->showPatreon)
                                                    <div class="m-2">
                                                        <a href="{{$profile->patreon}}" target="_blank">
                                                            <button type="button" class="transform hover:scale-110">
                                                                <div class="flex flex-wrap | justify-center content-center | h-10 w-10 | bg-yellow-600 | rounded">
                                                                    <i class="fab fa-patreon"></i>
                                                                </div>
                                                            </button>
                                                        </a>
                                                    </div>
                                                @endif

                                                @if($profile->showOther)
                                                    <div class="m-2">
                                                        <a href="{{$profile->other}}" target="_blank">
                                                            <button type="button" class="transform hover:scale-110">
                                                                <div class="flex flex-wrap | justify-center content-center | h-10 w-10 | bg-black | rounded">
                                                                    ...
                                                                </div>
                                                            </button>
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if(isset($authors1))
                                <div>
                                    <div class="flex flex-col | w-full | p-2 mt-5 sm:mt-0">
                                        <div class="bg-white bg-opacity-30">
                                            <div class="pl-2">
                                                <p class="text-lg text-white | p-2">Autores Recomendados</p>
                                                <hr class="w-1/1 mx-auto">
                                            </div>
                                            <div class="flex flex-wrap | justify-center | text-white">
                                                @if(isset($authors1))
                                                    <div class="m-2">
                                                        <a href="{{url('perfil/'.$authors1->id.'/'.$authors1->username)}}">
                                                            <button type="button" class="transform hover:scale-110 bg-cover bg-no-repeat bg-center rounded-full" 
                                                            @if(file_exists(public_path() ."/users/". $authors1->id ."/profile/usericon". $authors1->imgtype))
                                                                style="background-image:url('{{asset("/users/". $authors1->id ."/profile/usericon". $authors1->imgtype)}}')"
                                                            @else
                                                                style="background-image:url('{{asset("/images/noimage.png")}}')"
                                                            @endif
                                                            >
                                                                <div class="flex flex-wrap | justify-center content-center | h-10 w-10 | rounded">
                                                                </div>
                                                            </button>
                                                        </a>
                                                    </div>
                                                @endif
                                                @if(isset($authors2))
                                                    <div class="m-2">
                                                        <a href="{{url('perfil/'.$authors2->id.'/'.$authors2->username)}}">
                                                            <button type="button" class="transform hover:scale-110 bg-cover bg-no-repeat bg-center rounded-full" 
                                                            @if(file_exists(public_path() ."/users/". $authors2->id ."/profile/usericon". $authors2->imgtype))
                                                                style="background-image:url('{{asset("/users/". $authors2->id ."/profile/usericon". $authors2->imgtype)}}')"
                                                            @else
                                                                style="background-image:url('{{asset("/images/noimage.png")}}')"
                                                            @endif
                                                            >
                                                                <div class="flex flex-wrap | justify-center content-center | h-10 w-10 | rounded">
                                                                </div>
                                                            </button>
                                                        </a>
                                                    </div>
                                                @endif
                                                @if(isset($authors3))
                                                    <div class="m-2">
                                                        <a href="{{url('perfil/'.$authors3->id.'/'.$authors3->username)}}">
                                                            <button type="button" class="transform hover:scale-110 bg-cover bg-no-repeat bg-center rounded-full" 
                                                            @if(file_exists(public_path() ."/users/". $authors3->id ."/profile/usericon". $authors3->imgtype))
                                                                style="background-image:url('{{asset("/users/". $authors3->id ."/profile/usericon". $authors3->imgtype)}}')"
                                                            @else
                                                                style="background-image:url('{{asset("/images/noimage.png")}}')"
                                                            @endif
                                                            >
                                                                <div class="flex flex-wrap | justify-center content-center | h-10 w-10 | rounded">
                                                                </div>
                                                            </button>
                                                        </a>
                                                    </div>
                                                @endif
                                                @if(isset($authors4))
                                                    <div class="m-2">
                                                        <a href="{{url('perfil/'.$authors4->id.'/'.$authors4->username)}}">
                                                            <button type="button" class="transform hover:scale-110 bg-cover bg-no-repeat bg-center rounded-full" 
                                                            @if(file_exists(public_path() ."/users/". $authors4->id ."/profile/usericon". $authors4->imgtype))
                                                                style="background-image:url('{{asset("/users/". $authors4->id ."/profile/usericon". $authors4->imgtype)}}')"
                                                            @else
                                                                style="background-image:url('{{asset("/images/noimage.png")}}')"
                                                            @endif
                                                            >
                                                                <div class="flex flex-wrap | justify-center content-center | h-10 w-10 | rounded">
                                                                </div>
                                                            </button>
                                                        </a>
                                                    </div>
                                                @endif
                                                @if(isset($authors5))
                                                    <div class="m-2">
                                                        <a href="{{url('perfil/'.$authors5->id.'/'.$authors5->username)}}">
                                                            <button type="button" class="transform hover:scale-110 bg-cover bg-no-repeat bg-center rounded-full" 
                                                            @if(file_exists(public_path() ."/users/". $authors5->id ."/profile/usericon". $authors5->imgtype))
                                                                style="background-image:url('{{asset("/users/". $authors5->id ."/profile/usericon". $authors5->imgtype)}}')"
                                                            @else
                                                                style="background-image:url('{{asset("/images/noimage.png")}}')"
                                                            @endif
                                                            >
                                                                <div class="flex flex-wrap | justify-center content-center | h-10 w-10 | rounded">
                                                                </div>
                                                            </button>
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif

                    <!-- Mis listas -->
                    @if(!($profile->private))
                        <div class="flex flex-wrap | w-full | px:2 sm:px-5">
                            <div class="flex flex-wrap | w-full | mt-5 | p-2 | bg-black bg-opacity-30 | text-white">
                                @if (count($novelsList)==0)
                                    <div class="w-full">
                                        <p class="text-xs sm:text-base text-white font-bold">Esta lista esta vacia...</p>
                                        <hr class="w-1/1 mx-auto">
                                    </div>
                                @else
                                    <div class="w-full">
                                        @if($profile->state_id == 1) 
                                            <p class="text-xs sm:text-base text-white font-bold">SIGUIENDO</p>
                                            <hr class="w-1/1 mx-auto border-ourBlue">
                                        @elseif($profile->state_id == 2)
                                            <p class="text-xs sm:text-base text-white font-bold">PENDIENTES</p>
                                            <hr class="w-1/1 mx-auto border-yellow-600">
                                        @elseif($profile->state_id == 3)
                                            <p class="text-xs sm:text-base text-white font-bold">FAVORITOS</p>
                                            <hr class="w-1/1 mx-auto border-red-500">
                                        @elseif($profile->state_id == 4)
                                            <p class="text-xs sm:text-base text-white font-bold">ABANDONADOS</p>
                                            <hr class="w-1/1 mx-auto order-indigo-500">
                                        @elseif($profile->state_id == 5)
                                            <p class="text-xs sm:text-base text-white font-bold">LEIDOS</p>
                                            <hr class="w-1/1 mx-auto border-green-600">
                                        @endif
                                        
                                    </div>

                                    @foreach($novelsList as $result)
                                        <a class="w-1/2 sm:w-4/12 lg:w-3/12 xl:w-2/12" href="{{url('novel/'.$result->id)}}">
                                                
                                            <div class="flex flex-col | h-60 lg:h-42 xl:h-80 | m-2 | bg-cover bg-no-repeat bg-center" style="background-image:url('{{asset($result->novel_dir.'/cover'.$result->imgtype)}}');">
                                                <div class=" w-full | h-full">

                                                    <div class="w-full">
                                                        
                                                        <p class="bg-black bg-opacity-60 | py-0.5 px-2 | w-1/1 | text-center text-xs md:text-sm lg:text-xs text-white font-bold | truncate">{{$result->name}}</p>

                                                    </div>

                                                    <div class="w-1/1 | flex justify-between | |">
                                                        
                                                        <p class="bg-{{$result->novel_type}} bg-purple-700 | px-1 m-0.5 | rounded | text-xs text-white font-bold">{{strtoupper($result->novel_type)}}</p>

                                                    </div>
                                                    
                                                </div>
                                            
                                                <div class="w-full">
                                                    
                                                <p class="bg-black bg-opacity-60 | py-2 px-2 | w-1/1 | text-center text-xs text-white font-bold | truncate">
                                                    @foreach($genres as $genre) @if($genre->id == $result->genre) {{strtoupper($genre->name)}} @endif @endforeach
                                                </p>

                                                </div>
                                            </div>

                                        </a>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    @endif

                    <!-- Perfil privado -->
                    @if($profile->private)
                        <div class="w-full flex text-white | my-10">
                            <div class="flex flex-col | w-full sm:w-6/12 xl-4/12 | mx-auto | py-14 | bg-black bg-opacity-60">
                                <div class="flex | w-full | justify-center">
                                    <i class="fas fa-lock fa-5x"></i>
                                </div>
                                <div class="w-full | mt-5">
                                    <p class="text-center text-xs sm:text-base font-bold">EL PERFIL ES PRIVADO</p>
                                </div>
                            </div>
                        </div>
                    @endif

                </div>

            </div>

        </div>
        @include('layouts.footer')
    </body>

</html>
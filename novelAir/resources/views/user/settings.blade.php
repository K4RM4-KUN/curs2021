<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ucfirst($config)}}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="https://ajax.aspnetcdn.com/ajax/jquery/jquery-3.5.1.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    </head>

    <body class="bg-gradient-to-br from-gray-700 to-gray-900 min-h-screen">

        @include('layouts.navigationNew')

        <div class="flex justify-center | w-full">

            <div class="w-11/12 | bg-black bg-opacity-30">

                <!--Header-->
                <div class="flex justify-around items-center | w-1/1 | bg-black bg-opacity-50">
                    <p class="text-white font-bold text-2xl text-ourBlue | pl-10 p-5">{{ucfirst($config)}}</p>
                    <a href="{{url('perfil/'.Auth::user()->id.'/'.Auth::user()->username)}}">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Volver a tu perfil
                        </button>
                    </a>                    
                </div>
                <div class="flex">
                    <!--Navigator-->
                    <div class="flex flex-col | w-3/12 | bg-black bg-opacity-30">
                        <a href="{{url('usuario/ajustes/personal')}}">
                            <div class="w-10/12 | mx-auto | border-b-2" >
                                <p class="text-white text-base | py-2 px-5">Configuración</p>
                            </div>
                        </a>
                        <a href="{{url('usuario/ajustes/perfil')}}">
                            <div class="w-10/12 | mx-auto | border-b-2" >
                                <p class="text-white text-base | py-2 px-5">Perfil</p>
                            </div>
                        </a>
                        <a href="{{url('usuario/ajustes/subscripciones')}}">
                            <div class="w-10/12 | mx-auto | border-b-2" >
                                <p class="text-white text-base | py-2 px-5">Subscripciones y pagos<p>
                            </div>
                        </a>
                        <a href="{{url('usuario/ajustes/author')}}">
                            <div class="w-10/12 | mx-auto | border-b-2" >
                                <p class="text-white text-base | py-2 px-5">Author</p>
                            </div>
                        </a>
                        <a href="{{url('usuario/ajustes/estadisticas')}}">
                            <div class="w-10/12 | mx-auto | border-b-2" >
                                <p class="text-white text-base | py-2 px-5">Estadisticas<p>
                            </div>
                        </a>
                        @if($role->role->rol_name == 'admin')
                            <a href="{{url('usuario/ajustes/admin')}}">
                                <div class="w-10/12 | mx-auto | border-b-2" >
                                    <p class="text-white text-base | py-2 px-5">Página del admin</p>
                                </div>
                            </a>
                        @endif
                        <a href="{{url('usuario/ajustes/ayuda')}}">
                            <div class="w-10/12 | mx-auto | border-b-2" >
                                <p class="text-white text-base | py-2 px-5">Ayuda</p>
                            </div>
                        </a>
                    </div>
                    <!--Content-->
                    <div class="w-9/12">
                        @if($config == 'perfil')
                            @include('user.profile')
                        @elseif($config == 'personal')
                            @include('user.editUser')
                        @elseif($config == 'subscripciones')
                            @include('user.subscriptionManager')
                        @elseif($config == 'estadisticas')
                            @include('user.stats')
                        @elseif($config == 'author')
                            @include('user.author')
                        @elseif($config == 'ayuda')
                            @include('user.help')
                        @elseif($config == 'contraseña')
                            @include('user.password')
                        @elseif($config == 'admin' && $role->role->rol_name == 'admin')
                            @include('user.admin')
                        @endif
                    </div>
                </div>

            </div>

        </div>

    </body>

</html>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>THINGS</title>

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
                <div class="w-1/1 | bg-black bg-opacity-50">
                    <p class="text-white font-bold text-2xl text-ourBlue | pl-10 p-5">Ajustes de usuario</p>
                </div>
                <div class="flex">
                    <!--Navigator-->
                    <div class="flex flex-col | w-3/12 | bg-black bg-opacity-30">
                        <a href="{{url('user/settings/personal')}}">
                            <div class="w-10/12 | mx-auto | border-b-2" >
                                <p class="text-white text-base | py-2 px-5">Configuración</p>
                            </div>
                        </a>
                        <a href="{{url('user/settings/perfil')}}">
                            <div class="w-10/12 | mx-auto | border-b-2" >
                                <p class="text-white text-base | py-2 px-5">Perfil</p>
                            </div>
                        </a>
                        <a href="{{url('user/settings/preferencias')}}">
                            <div class="w-10/12 | mx-auto | border-b-2" >
                                <p class="text-white text-base | py-2 px-5">Preferencias</p>
                            </div>
                        </a>
                        <a href="{{url('user/settings/author')}}">
                            <div class="w-10/12 | mx-auto | border-b-2" >
                                <p class="text-white text-base | py-2 px-5">Author</p>
                            </div>
                        </a>
                        <a href="{{url('user/settings/ayuda')}}">
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
                        @endif
                    </div>
                </div>

            </div>

        </div>

    </body>

</html>
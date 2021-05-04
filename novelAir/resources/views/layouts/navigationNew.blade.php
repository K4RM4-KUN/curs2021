<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

    </head>

    <body class="bg-gradient-to-br from-gray-700 to-gray-800 min-h-screen">

        <!-- navbar -->
        <nav class="bg-white border-b-4 border-ourBlue ">

            <div class="max-w-7xl mx-auto">

                <div class="flex justify-between">

                    <div class="flex">

                        <!-- logo -->
                        <div class="mx-5">

                            <a class="flex items-center w-40" href="#">

                                <img class="h-20 w-40" src="{{asset('images/logo2.png')}}" alt="">

                            </a>

                        </div>
                        
                        <!-- primary -->
                        <div class="hidden sm:flex items-center mx-5">

                            <!-- BIBLIOTECA -->
                            <a href="@{{Route('library')}}">

                                <button class="px-5 py-7 hover:bg-ourBlue hover:text-white">

                                    BIBLIOTECA

                                </button>

                            </a>

                            <!-- LISTA -->
                            <a href="@{{Route('lists')}}">

                                <button class="px-5 py-7 hover:bg-ourBlue hover:text-white">

                                    LISTAS

                                </button>
                                
                            </a>

                            <!-- AUTORES -->
                            <a href="@{{Route('authors')}}">

                                <button class="px-5 py-7 hover:bg-ourBlue hover:text-white">

                                    AUTORES

                                </button>
                                
                            </a>

                            <!-- CREAR -->
                            <a href="{{Route('goNM')}}">

                                <button class="px-5 py-7 hover:bg-ourBlue hover:text-white bg-gray-100 text-black">

                                    CREAR

                                </button>
                                
                            </a>

                            <!-- NOSOTROS -->
                            <a href="@{{Route('aboutUs')}}">

                                <button class="px-5 py-7 hover:bg-ourBlue hover:text-white">

                                    NOSOTROS

                                </button>
                                
                            </a>

                        </div>

                    </div>

                    <!-- secondary/auth -->
                    <div class="hidden lg:flex items-center justify-center">

                            <a href="">

                                <button class="mx-5 mr-2 px-5 py-2">

                                    LOGIN

                                </button>

                            </a>

                            <a href="">

                                <button class="mx-5 ml-0 px-5 py-2
                                bg-yellow-500 
                                hover:bg-yellow-400 
                                text-white 
                                font-bold 
                                border-b-4 
                                border-yellow-700 
                                hover:border-yellow-500 
                                rounded">

                                    REGISTER

                                </button>

                            </a>

                    </div>
                
                </div>

            </div>

            <!-- mobile -->
            


        </nav>

        <!-- content -->
        <div class="text-center">

            @include('novelManagerNew')

        </div>

    </body>

</html>
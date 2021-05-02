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
        <nav class="bg-white">

            <div class="py-5 max-w-7xl border border-red-400 mx-auto">

                <div class="flex justify-between">

                    <div class="flex">

                        <!-- logo -->
                        <div>
                            <a class="flex items-center" href="#">
                                <img class="h-12 w-12" src="{{asset('images/logo.png')}}" alt="">
                            </a>
                        </div>
                        
                        <!-- primary -->
                        <div class="flex items-center">

                            <p>
                            Primary
                            </p>

                        </div>

                    </div>

                    <!-- secondary/auth -->
                    <div>Secondary</div>
                
                </div>

            </div>

            <!-- mobile -->
            


        </nav>

        <!-- content -->
        <div class="py-32 text-center">

            <h2 class="font-extrabold text-6xl text-blue-400">NovelAir</h2>

        </div>

    </body>

</html>
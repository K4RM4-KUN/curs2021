<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>NovelAir Recuperar Contraseña</title>

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

        <div class="flex w-full h-full justify-center">
            <div class="flex | w-full md:w-7/12 xl:w-5/12 | rounded-md | my-20 | bg-cover " style="background-image: url({{asset('images/bg-nmanager.jpg')}})">
                <div class="bg-black bg-opacity-70 w-full px-5 sm:px-14 py-10 rounded-md">
                    <!-- Errores -->
                    @if ($errors->any())
                        <div class="text-base font-bold text-red-600 mb-5">
                            <p class="text-2xl">¡Ups! Algo salió mal.</p>
                            @foreach ($errors->all() as $error)
                                <tr><td><a>{{ $error }}</a></td></tr>
                            @endforeach
                        </div>
                    @endif

                    
                    <!-- Session Status -->
                    @if(session('status') != null)
                        <div class="text-base font-bold text-green-500 mb-5">
                            {{session('status')}}   
                        </div>
                    @endif


                    <!-- Formulario -->

                    <form method="POST" action="{{ route('password.email') }}" class="w-full text-white">
                        @csrf

                        <!-- Email Address -->
                        <div>
                            <label for="email" class="text-2xl">Email</label>
                            <input class="shadow-lg border-none appearance-none rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                            id="email" type="email" name="email" required autofocus />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <input class="my-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" 
                            type="submit"
                            value="Recuperar Contraseña">
                        </div>
                    </form>
                <div>
            </div>
        </div>
    </body>
</html>

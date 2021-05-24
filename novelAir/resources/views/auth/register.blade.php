<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>NovelAir Registro</title>

            <!-- Fonts -->
            <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

            <!-- Styles -->
        <link rel="icon" href="{{ URL::asset('favicon.ico') }}" type="image/x-icon"/>
            <link rel="stylesheet" href="{{ asset('css/app.css') }}">

            <!-- Scripts -->
            <script src="{{ asset('js/app.js') }}" defer></script>
            <script src="https://ajax.aspnetcdn.com/ajax/jquery/jquery-3.5.1.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    </head>
    <body class="bg-gradient-to-br from-gray-700 to-gray-900 min-h-screen">

        @include('layouts.navigationNew')
        <div class="flex w-full justify-center">
            <div class="flex | w-1/1 md:w-7/12 xl:w-5/12 | rounded-md | my-20 | bg-cover " style="background-image: url({{asset('images/bg-nmanager.jpg')}})">
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

                    <!-- Formulario -->
                    <form method="POST" action="{{ route('register') }}" class="w-full text-white">
                        @csrf
                        <!-- Username -->
                        <div class="my-4">
                            <label for="username" class="text-2xl">Username</label>
                            <input class="shadow-lg border-none appearance-none rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                            id="username" type="username" name="username" value="{{old('username')}}" required autofocus />
                        </div>

                        <!-- Name -->
                        <div class="my-4">
                            <label for="name" class="text-2xl">Nombre<label>
                            <input class="shadow-lg border-none appearance-none rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                            id="name" type="text" name="name" value="{{old('name')}}" required autofocus />
                        </div>

                        <!-- Surname -->
                        <div class="my-4">
                            <label for="surname" class="text-2xl">Apellidos</label>
                            <input class="shadow-lg border-none appearance-none rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                            id="surname" type="text" name="surname" value="{{old('surname')}}" required autofocus />
                        </div>

                        <!-- Date -->
                        <div class="my-4">
                            <label for="birth_date" class="text-2xl">Fecha de nacimiento</label>
                            <input class="shadow-lg border-none appearance-none rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                            id="birth_date" type="date" name="birth_date" value="{{old('birth_date')}}" required autofocus />
                        </div>

                        <!-- Email Address -->
                        <div class="my-4">
                            <label for="email" class="text-2xl">Email</label>
                            <input class="shadow-lg border-none appearance-none rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                            id="email" type="email" name="email" value="{{old('email')}}" required />
                        </div>

                        <!-- Password -->
                        <div class="my-4">
                            <label for="password" class="text-2xl">Contraseña</label>
                            <input class="shadow-lg border-none appearance-none rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                            id="password" type="password" name="password" required autocomplete="new-password" />
                        </div>

                        <!-- Confirm Password -->
                        <div class="my-4">
                            <label for="password_confirmation" class="text-2xl">Confirmar Contraseña</label>
                            <input class="shadow-lg border-none appearance-none rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                            id="password_confirmation" type="password" name="password_confirmation" required />
                        </div>
                        <div class="flex items-center justify-center my-4">
                            <label for="accept" class="text-sm mr-5">Aceptar la <a href="{{url('terminos/privacidad')}}">"<u>Política de Privacidad</u>"</a> y los <a href="{{url('terminos/uso')}}">"<u>Términos de Uso</u>"</a></label>
                            <input class="shadow-lg text-blue-500 border-none appearance-none rounded w-10 h-10 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                            id="accept" type="checkbox" name="accept" required />
                        </div>

                        <div class="my-4">
                            <div class="flex items-center justify-end my-4">
                                <div class="mr-5">
                                    <a class="underline text-sm hover:text-ourBlue" href="{{ route('login') }}">
                                        ¿Ya registrado?
                                    </a>
                                </div>

                                <input class="my-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" 
                                type="submit"
                                value="Registrarse">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
